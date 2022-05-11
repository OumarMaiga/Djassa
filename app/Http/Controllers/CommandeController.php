<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

use App\Repositories\CommandeRepository;

use Cart;

class CommandeController extends Controller
{
    protected $commandeRepository;

    public function __construct(CommandeRepository $commandeRepository) {
        $this->commandeRepository = $commandeRepository;
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

        $request->merge([
            'user_id' => Auth::check() ? Auth::user()->id : null,
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
        
        return redirect('/products')->withStatus("Nouveau commande (".$commande['code'].") vient d'être ajouté");
    
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $commande = $this->commandeRepository->getById($id);
        return view('commandes.show', compact('commande'));
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
                                commandes.lastname as commande_lastname, commandes.telephone as commande_telephone, commandes.user_id, users.name as user_name, 
                                products.id, products.title as product_title, products.slug as product_slug, commande_product.product_id, commande_product.commande_id
                                FROM commandes LEFT JOIN users ON commandes.user_id = users.id
                                LEFT JOIN commande_product ON commandes.id = commande_product.commande_id
                                LEFT JOIN products ON commande_product.product_id = products.id 
                                WHERE commandes.user_id = $user_id GROUP BY commande_code");
        
        /*print_r($commandes);
        die();*/
        return view('commandes.my_commande', compact('commandes'));
    }
}
