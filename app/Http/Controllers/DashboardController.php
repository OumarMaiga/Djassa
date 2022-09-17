<?php

namespace App\Http\Controllers;

use App\Repositories\ProductRepository;
use App\Repositories\CommandeRepository;
use App\Repositories\RayonRepository;
use App\Repositories\CategoryRepository;
use App\Repositories\SubCategoryRepository;
use App\Repositories\SubSubCategoryRepository;
use App\Repositories\UserRepository;
use App\Repositories\ServiceRepository;
use App\Repositories\FileRepository;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

use App\Models\Product;
use App\Models\File;

class DashboardController extends Controller
{
    
    protected $productRepository;
    protected $rayonRepository;
    protected $categoryRepository;
    protected $subCategoryRepository;
    protected $subSubCategoryRepository;
    protected $userRepository;
    protected $serviceRepository;
    protected $fileRepository;
    
    public function __construct(ProductRepository $productRepository, CommandeRepository $commandeRepository, 
                        RayonRepository $rayonRepository, CategoryRepository $categoryRepository, 
                        SubCategoryRepository $subCategoryRepository, SubSubCategoryRepository $subSubCategoryRepository,
                        UserRepository $userRepository, ServiceRepository $serviceRepository, FileRepository $fileRepository) 
    {
        $this->middleware('admin', ['only' => ['index', 'sells', 'monthly_sells', 'commandes', 'commande', 'services', 'service', 'products', 'product', 'recettes', 'service_inprogress', 'service_done']]);
        $this->productRepository = $productRepository;
        $this->commandeRepository = $commandeRepository;
        $this->rayonRepository = $rayonRepository;
        $this->categoryRepository = $categoryRepository;
        $this->subCategoryRepository = $subCategoryRepository;
        $this->subSubCategoryRepository = $subSubCategoryRepository;
        $this->userRepository = $userRepository;
        $this->serviceRepository = $serviceRepository;
        $this->fileRepository = $fileRepository;
    }
        
    /**
     * Display a listing of the product.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $admins = $this->userRepository->getBy('type', '=', 'admin');
        $users = $this->userRepository->getBy('type', '=', 'user');
        $products = $this->productRepository->get();
        $commandes = $this->commandeRepository->getBy('delivered', '=', 0);
        $month = date('m');
        $year = date('Y');
        $monthly_sells = DB::select("SELECT * FROM commandes 
                            WHERE commandes.delivered = 1 && $month = MONTH(commandes.created_at) 
                            AND $year = YEAR(commandes.created_at)");
        $sells = DB::select("SELECT * FROM commandes 
                            WHERE commandes.delivered = 1");
        $services = $this->serviceRepository->getBy('etat', '<>', 'done');

        return view('dashboards.index', compact('admins', 'users', 'commandes', 'products', 'monthly_sells', 'sells', 'services'));
    }
    
    /**
     * Display a listing of the product.
     *
     * @return \Illuminate\Http\Response
     */
    public function sells()
    {
        $sells = DB::table('commandes')
        ->selectRaw('commandes.code as commande_code, commandes.id as commande_id, commandes.firstname as commande_firstname,
        commandes.lastname as commande_lastname, commandes.telephone as commande_telephone, commandes.user_id, commandes.delivered as commande_delivered, 
        commandes.paid as commande_paid, commandes.montant_du as commande_montant_du, commandes.montant_payer as commande_montant_payer,
        users.name as user_name, 
        products.id, products.title as product_title, products.slug as product_slug, commande_product.product_id, commande_product.commande_id')
        ->leftJoin('users', 'commandes.user_id', '=', 'users.id')
        ->leftJoin('commande_product', 'commandes.id', '=', 'commande_product.commande_id')
        ->leftJoin('products', 'commande_product.product_id', '=', 'products.id')
        ->where('commandes.delivered', '=', 1)
        ->groupBy('commande_code')
        ->simplePaginate(25);

        return view('dashboards.sells', compact('sells'));
    }
    
    /**
     * Display a listing of the product.
     *
     * @return \Illuminate\Http\Response
     */
    public function monthly_sells()
    {
        $month = date('m');
        $year = date('Y');
        $sells = DB::table('commandes')
        ->selectRaw('commandes.code as commande_code, commandes.id as commande_id, commandes.firstname as commande_firstname,
        commandes.lastname as commande_lastname, commandes.telephone as commande_telephone, commandes.user_id, commandes.delivered as commande_delivered, 
        commandes.paid as commande_paid, commandes.montant_du as commande_montant_du, commandes.montant_payer as commande_montant_payer,
        users.name as user_name, 
        products.id, products.title as product_title, products.slug as product_slug, commande_product.product_id, commande_product.commande_id')
        ->leftJoin('users', 'commandes.user_id', '=', 'users.id')
        ->leftJoin('commande_product', 'commandes.id', '=', 'commande_product.commande_id')
        ->leftJoin('products', 'commande_product.product_id', '=', 'products.id')
        ->where('commandes.delivered', '=', 1)
        ->selectRaw(DB::raw('MONTH(commandes.created_at) = '.$month))
        ->selectRaw(DB::raw('YEAR(commandes.created_at) = '.$year))
        ->groupBy('commande_code')
        ->simplePaginate(25);

        return view('dashboards.sells-of-month', compact('sells'));
    }
    
    /**
     * Display a listing of the product.
     *
     * @return \Illuminate\Http\Response
     */
    public function commandes()
    {        
        $commandes = DB::table('commandes')
        ->selectRaw('commandes.code as commande_code, commandes.id as commande_id, commandes.firstname as commande_firstname,
        commandes.lastname as commande_lastname, commandes.telephone as commande_telephone, commandes.user_id, commandes.delivered as commande_delivered, 
        commandes.paid as commande_paid, commandes.montant_du as commande_montant_du, commandes.montant_payer as commande_montant_payer,
        users.name as user_name, 
        products.id, products.title as product_title, products.slug as product_slug, commande_product.product_id, commande_product.commande_id')
        ->leftJoin('users', 'commandes.user_id', '=', 'users.id')
        ->leftJoin('commande_product', 'commandes.id', '=', 'commande_product.commande_id')
        ->leftJoin('products', 'commande_product.product_id', '=', 'products.id')
        ->where('commandes.delivered', '=', 0)
        ->simplePaginate(25);

        return view('dashboards.commandes.index', compact('commandes'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function commande($code)
    {
        // On recupère la commande et les infos sur les produits
        $commande = DB::select("SELECT commandes.code as commande_code, commandes.id as commande_id, commandes.firstname as commande_firstname,
                                commandes.lastname as commande_lastname, commandes.telephone as commande_telephone, commandes.user_id, commandes.delivered as commande_delivered, users.name as user_name, 
                                products.id, products.title as product_title, products.slug as product_slug, commande_product.product_id, commande_product.commande_id
                                FROM commandes LEFT JOIN users ON commandes.user_id = users.id
                                LEFT JOIN commande_product ON commandes.id = commande_product.commande_id
                                LEFT JOIN products ON commande_product.product_id = products.id 
                                WHERE commandes.code = '$code'")[0];
                                
        return view('dashboards.commandes.show', compact('commande'));
    }
    
    /**
     * Display a listing of the product.
     *
     * @return \Illuminate\Http\Response
     */
    public function services()
    {
        $services = DB::table('services')
        ->selectRaw('services.id as service_id, services.title as service_title, services.slug as service_slug,
        services.beneficiaire as service_beneficiaire, services.telephone as service_telephone, services.user_id as service_user_id, 
        services.montant as service_montant, services.paid as service_paid, services.expire as service_expire, services.etat as service_etat,
        users.name as service_user_name')
        ->leftJoin('users', 'services.user_id', '=', 'users.id')
        ->simplePaginate(25);
        
        return view('dashboards.services.index', compact('services'));
    }
        
    /**
     * Display a listing of the product.
     *
     * @return \Illuminate\Http\Response
     */
    public function service($slug)
    {
        $service = $this->serviceRepository->getBy('slug', '=', $slug)->first();
        $file = null;
        if ($service->etat === "done") {
            $file = $this->fileRepository->getBy('service_id', '=', $service->id);
            if (count($file) > 0) {
                $file = $file[0];
                $file->file_path = env('APP_URL').$file->file_path;
            } else {
                $file = null;
            }
        }
        return view('dashboards.services.show', compact('service', 'file'));
    }
    
    
    /**
     * Display a listing of the product.
     *
     * @return \Illuminate\Http\Response
     */
    public function products()
    {
        $products = DB::table('products')
        ->selectRaw('products.id as product_id, products.title as product_title, products.slug as product_slug, products.price as product_price,
        products.overview as product_overview, products.quantity as product_quantity, products.published as product_publised, products.discount as product_discount,
        categories.id as categorie_id, categories.title as category_title, categories.slug as categorie_slug')
        ->leftJoin('categories', 'products.category_id', '=', 'categories.id')->simplePaginate(25);

        return view('dashboards.products.index', compact('products'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function product($slug)
    {
        $product = $this->productRepository->getBy('slug', '=', $slug)->first();
        $images = $this->fileRepository->getBy("product_id", '=', $product->id);
        $category = $this->categoryRepository->getById($product->category_id);
        $rayon = $this->rayonRepository->getById($category->rayon_id);

        if($product->discount != null &&  $product->discount > 0) 
        {
            $product->discount_price();
        }

        return view('dashboards.products.show', compact('product', 'images', 'category', 'rayon'));
    }

    /**
     * Display a listing of the product.
     *
     * @return \Illuminate\Http\Response
     */
    public function product_per_category($category_slug)
    {
        $rayons = $this->rayonRepository->get();
        $category = $this->categoryRepository->getBy('slug', '=', $category_slug)->first();
        $sub_categories = DB::select("SELECT sub_categories.id as sub_category_id, sub_categories.slug as sub_category_slug, sub_categories.title as sub_category_title,
        files.file_path as sub_category_image
        FROM sub_categories 
        LEFT JOIN rayons ON sub_categories.rayon_id = rayons.id
        LEFT JOIN categories ON sub_categories.category_id = categories.id
        LEFT JOIN files ON sub_categories.id = files.sub_category_id
        WHERE sub_categories.category_id=$category->id
        ORDER BY sub_category_id ASC");
        $products = DB::select("SELECT products.id as product_id, products.title as product_title, products.slug as product_slug, products.overview as product_overview, 
                        products.price as product_price, products.quantity as product_quantity, products.published as product_published, products.discount as product_discount,
                        files.file_path as files_file_path
                        FROM products
                        LEFT JOIN files ON files.product_id = products.id 
                        WHERE products.category_id = $category->id AND products.published = 1 AND products.quantity > 0
                        GROUP BY products.id");
        return view('dashboards.product_per_category', compact('rayons', 'category', 'products', 'sub_categories'));
    }
    
    /**
     * Display a listing of the product.
     *
     * @return \Illuminate\Http\Response
     */
    public function product_per_sub_category($category_slug, $sub_category_slug)
    {
        $rayons = $this->rayonRepository->get();
        $category = $this->categoryRepository->getBy('slug', '=', $category_slug)->first();
        $sub_category = $this->subCategoryRepository->getBy('slug', '=', $sub_category_slug)->first();        
        $sub_sub_categories = $this->subSubCategoryRepository->getBy('sub_category_id', '=', $sub_category->id);
        $products = DB::select("SELECT products.id as product_id, products.title as product_title, products.slug as product_slug, products.overview as product_overview, 
                        products.price as product_price, products.quantity as product_quantity, products.published as product_published, products.discount as product_discount,
                        files.file_path as files_file_path
                        FROM products
                        LEFT JOIN files ON files.product_id = products.id 
                        WHERE products.sub_category_id = $sub_category->id AND products.published = 1 AND products.quantity > 0
                        GROUP BY products.id");
        return view('dashboards.product_per_sub_category', compact('rayons', 'category', 'sub_category', 'products', 'sub_sub_categories'));
    }
    
    /**
     * Display a listing of the product.
     *
     * @return \Illuminate\Http\Response
     */
    public function product_per_sub_sub_category($category_slug, $sub_category_slug, $sub_sub_category_slug)
    {
        $rayons = $this->rayonRepository->get();
        $category = $this->categoryRepository->getBy('slug', '=', $category_slug)->first();
        $sub_category = $this->subCategoryRepository->getBy('slug', '=', $sub_category_slug)->first();
        $sub_sub_category = $this->subSubCategoryRepository->getBy('slug', '=', $sub_sub_category_slug)->first();
        $products = DB::select("SELECT products.id as product_id, products.title as product_title, products.slug as product_slug, products.overview as product_overview, 
                        products.price as product_price, products.quantity as product_quantity, products.published as product_published, products.discount as product_discount,
                        files.file_path as files_file_path
                        FROM products
                        LEFT JOIN files ON files.product_id = products.id 
                        WHERE products.sub_sub_category_id = $sub_sub_category->id AND products.published = 1 AND products.quantity > 0
                        GROUP BY products.id");
        return view('dashboards.product_per_sub_sub_category', compact('rayons', 'category', 'sub_category', 'products', 'sub_sub_category'));
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function recettes()
    {
        // On recupère les recettes
        $recettes = DB::table('paiements')
        ->selectRaw('paiements.montant as montant, paiements.id as id, paiements.user_id as user_id,
        paiements.commande_id as commande_id, paiements.service_id as service_id, paiements.from as paiement_from, paiements.currency as currency, 
        paiements.description as description, paiements.channels as channels, paiements.payment_method as payment_method, paiements.operator_id as operator_id, paiements.customer_name as customer_name, 
        paiements.customer_surname as customer_surname, paiements.customer_email as customer_email, paiements.customer_phone_number as customer_phone_number, 
        paiements.customer_address as customer_address, paiements.customer_city as customer_city, paiements.customer_country as customer_country, 
        paiements.customer_zip_code as customer_zip_code, paiements.customer_state as customer_state, paiements.created_at as created_at, paiements.updated_at as updated_at,
        users.name as user_name, 
        services.title as service_title, services.slug as service_slug, 
        commandes.id, commandes.code as commande_code')
        ->leftJoin('users', 'paiements.user_id', '=', 'users.id')
        ->leftJoin('commandes', 'paiements.commande_id', '=', 'commandes.id')
        ->leftJoin('services', 'paiements.service_id', '=', 'services.id')
        ->simplePaginate(25);

        return view('dashboards.recettes.index', compact('recettes'));
    }

    public function search()
    {
        $query = $_GET['query'];
        $products = DB::select("SELECT products.id as product_id, products.title as product_title, products.slug as product_slug, products.overview as product_overview, 
            products.price as product_price, products.quantity as product_quantity, products.published as product_published, products.discount as product_discount,
            files.file_path as files_file_path
            FROM products
            LEFT JOIN files ON files.product_id = products.id AND products.quantity > 0
            WHERE products.title LIKE '%$query%'
            AND products.published = 1 
            GROUP BY products.id");
        
        $rayons = $this->rayonRepository->get();

        //return response()->json(['products' => $products]);
        return view('dashboards.search', compact('products', 'query', 'rayons'));
            
    }

    public function service_inprogress ($id) 
    {
        $data = array('etat' => 'inprogress');
        $this->serviceRepository->update($id, $data);
        return redirect()->back()->withStatus("Service a bien été prise en compte");
    }

    public function service_done (Request $request, $id) 
    {
        $service = $this->serviceRepository->getById($id);
        if($request->hasFile('proof')) {
            $fileModel = new File;
            
            $fileName = time().'_'.$request->file('proof')->getClientOriginalName();
            $filePath = $request->file('proof')->storeAs("uploads/proof/service/".$service->id, $fileName, 'public');
            $fileModel->libelle = $fileName;
            $fileModel->file_path = '/storage/' . $filePath;

            if (Auth::check()) {
                $fileModel->user_id = Auth::user()->id;
            }

            $fileModel->type = 'justificatif';
            $fileModel->service_id = $service->id;
            $fileModel->save();
        } 
        $data = array('etat' => 'done');
        $this->serviceRepository->update($id, $data);
        
        return redirect()->back()->withStatus("Service marquer comme terminé");
    }
}
