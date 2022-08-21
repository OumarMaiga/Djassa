<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

use App\Repositories\CommandeRepository;
use App\Repositories\PaiementRepository;

use Cart;

class CommandeController extends Controller
{
    protected $commandeRepository;
    protected $paiementRepository;

    public function __construct(CommandeRepository $commandeRepository, PaiementRepository $paiementRepository) {
        $this->middleware('admin', ['only' => ['index']]);
        $this->commandeRepository = $commandeRepository;
        $this->paiementRepository = $paiementRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $commandes = $this->commandeRepository->get();
        return view('commandes.index', compact('commandes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('commandes.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Recuperation des données du panier
        $content = Cart::getContent();

        $user_id = Auth::check() ? Auth::user()->id : null;
        $request->merge([
            'user_id' => $user_id,
            'paid' => 0,
        ]);
                
        $commande = $this->commandeRepository->store($request->all())->toArray();
                
        $commande['code'] = "CMD-".$commande['id'];

        $this->commandeRepository->update($commande['id'], $commande);
        
        foreach ($content as $item) {

            DB::table('commande_product')->insert([
                'commande_id' => $commande['id'],
                'product_id' => $item->id,
                'quantity' => $item->quantity
            ]);

            Cart::remove($item->id);

        }
        
        return redirect('/commande/'.$commande['code'].'/paiement')->withStatus("Nouveau commande (".$commande['code'].") vient d'être ajouté");
    
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($code)
    {
        // On recupère la commande et les infos sur les produits
        $commande = DB::select("SELECT commandes.code as commande_code, commandes.id as commande_id, commandes.firstname as commande_firstname,
                                commandes.lastname as commande_lastname, commandes.telephone as commande_telephone, commandes.user_id, commandes.delivered as commande_delivered, users.name as user_name, 
                                products.id, products.title as product_title, products.slug as product_slug, commande_product.product_id, commande_product.commande_id
                                FROM commandes LEFT JOIN users ON commandes.user_id = users.id
                                LEFT JOIN commande_product ON commandes.id = commande_product.commande_id
                                LEFT JOIN products ON commande_product.product_id = products.id 
                                WHERE commandes.code = $code")->first();
                                
        return view('commandes.show', compact('commande'));
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delivered($id)
    {
        $commande = $this->commandeRepository->getById($id);
        if ($commande->montant_du > 0) {
            $commande->montant_payer = $commande->montant_du + $commande->montant_payer;
            $commande->montant_du = 0;
        }
        $data = array (
            'delivered' => 1, 
            'paid' => 1, 
            'montant_du' => $commande->montant_du, 
            'montant_payer' => $commande->montant_payer
        );
        $this->commandeRepository->update($id, $data);
        return redirect()->back()->withStatus("Commande livré");
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view('commandes.edit', compact('commande'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $commande = $this->commandeRepository->update($id, $request->all());
        DB::table('commande_product')->where('commande_id', '=', $id)->delete();
        $content = Cart::getContent();
        foreach ($content as $item) {

            DB::table('commande_product')->insert([
                'commande_id' => $commande->id,
                'product_id' => $item->id,
                'quantity' => $item->quantity
            ]);

        }
        return redirect('/commande')->withStatus("Commande a bien été modifier");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->commandeRepository->destroy($commande->id);
        return redirect()->back()->withError("Commande a bien été supprimer");
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function my_commande($user_id)
    {
        // On recupère les commandes d'un utilisateur, les infos sur les produits
        $commandes = DB::select("SELECT commandes.code as commande_code, commandes.id as commande_id, commandes.firstname as commande_firstname,
                                commandes.lastname as commande_lastname, commandes.telephone as commande_telephone, commandes.user_id, 
                                commandes.paid as commande_paid, commandes.delivered as commande_delivered, commandes.montant_du as commande_montant_du,
                                commandes.montant_payer as commande_montant_payer, users.name as user_name, 
                                products.id, products.title as product_title, products.slug as product_slug, commande_product.product_id, commande_product.commande_id
                                FROM commandes LEFT JOIN users ON commandes.user_id = users.id
                                LEFT JOIN commande_product ON commandes.id = commande_product.commande_id
                                LEFT JOIN products ON commande_product.product_id = products.id 
                                WHERE commandes.user_id = $user_id GROUP BY commande_code");
                                
        return view('commandes.my_commande', compact('commandes'));
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create_paiement($code)
    {
        //die("Fonctionnality not available");
        if (!Auth::check()) {
            die("User must login");
            exit;
        }

        $commande = $this->commandeRepository->getBy('code', '=', $code)->first();
        $products = DB::select("SELECT products.title as product_title, products.slug as product_slug,
                                        products.id as product_id FROM products LEFT JOIN commande_product
                                        ON products.id = commande_product.product_id WHERE commande_product.commande_id = $commande->id");


        return view('commandes.paiement', compact('commande', 'products'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function store_paiement(Request $request, $id)
    {
        //die("Fonctionnality not available");
        if (!Auth::check()) {
            die("User must login");
            exit;
        }
                
        $commande = $this->commandeRepository->getById($id);
        $montant_du = $commande->montant_du - $request->montant;
        $montant_payer = $commande->montant_payer + $request->montant;
        $paid = ($montant_du < 5) ? 1 : 0;
        $commande_id = $id;
        $user_id = Auth::user()->id;

        $inputs1 = array (
            "paid" => $paid,
            "montant_du" => $montant_du,
            "montant_payer" => $montant_payer
        );
        $this->commandeRepository->update($id, $inputs1);
        
        $inputs2 = array( 
            "montant" => $request->montant, 
            "user_id" => $user_id, 
            "commande_id" => $commande_id
        );
        $this->paiementRepository->store($inputs2);

        return redirect('/my-commande/'.$user_id)->withSuccess("Paiement effectué");
        //return redirect()->back()->withError("User must login");
    }

}
