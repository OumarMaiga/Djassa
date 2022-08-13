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
        //$this->middleware('adminOnly', ['only' => ['index', 'create', 'store', 'show', 'edit', 'update', 'destroy']]);
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
        $commandes = $this->commandeRepository->getBy('delivered', '=', 0);
        $month = date('m');
        $year = date('Y');
        $ventes = DB::select("SELECT * FROM commandes 
                            WHERE commandes.delivered = 1 && $month = MONTH(commandes.created_at) 
                            AND $year = YEAR(commandes.created_at)");
        $services = $this->serviceRepository->getBy('etat', '<>', 'done');

        return view('dashboards.index', compact('admins', 'users', 'commandes', 'ventes', 'services'));
    }
    
    /**
     * Display a listing of the product.
     *
     * @return \Illuminate\Http\Response
     */
    public function sells()
    {
        $month = date('m');
        $year = date('Y');
        $sells = DB::select("SELECT commandes.code as commande_code, commandes.id as commande_id, commandes.firstname as commande_firstname,
        commandes.lastname as commande_lastname, commandes.telephone as commande_telephone, commandes.user_id, commandes.delivered as commande_delivered, 
        commandes.paid as commande_paid, commandes.montant_du as commande_montant_du, commandes.montant_payer as commande_montant_payer,
        users.name as user_name, 
        products.id, products.title as product_title, products.slug as product_slug, commande_product.product_id, commande_product.commande_id
        FROM commandes LEFT JOIN users ON commandes.user_id = users.id
        LEFT JOIN commande_product ON commandes.id = commande_product.commande_id
        LEFT JOIN products ON commande_product.product_id = products.id 
        WHERE commandes.delivered = 1 AND MONTH(commandes.created_at) = $month
        AND YEAR(commandes.created_at) = $year GROUP BY commande_code
        ");

        return view('dashboards.sells', compact('sells'));
    }
    
    /**
     * Display a listing of the product.
     *
     * @return \Illuminate\Http\Response
     */
    public function commandes()
    {        
        $commandes = DB::select("SELECT commandes.code as commande_code, commandes.id as commande_id, commandes.firstname as commande_firstname,
        commandes.lastname as commande_lastname, commandes.telephone as commande_telephone, commandes.user_id, commandes.delivered as commande_delivered, 
        commandes.paid as commande_paid, commandes.montant_du as commande_montant_du, commandes.montant_payer as commande_montant_payer,
        users.name as user_name, 
        products.id, products.title as product_title, products.slug as product_slug, commande_product.product_id, commande_product.commande_id
        FROM commandes LEFT JOIN users ON commandes.user_id = users.id
        LEFT JOIN commande_product ON commandes.id = commande_product.commande_id
        LEFT JOIN products ON commande_product.product_id = products.id 
        WHERE commandes.delivered = 0");

        return view('dashboards.commandes.index', compact('commandes'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function commande($id)
    {
        // On recupère la commande et les infos sur les produits
        $commande = DB::select("SELECT commandes.code as commande_code, commandes.id as commande_id, commandes.firstname as commande_firstname,
                                commandes.lastname as commande_lastname, commandes.telephone as commande_telephone, commandes.user_id, commandes.delivered as commande_delivered, users.name as user_name, 
                                products.id, products.title as product_title, products.slug as product_slug, commande_product.product_id, commande_product.commande_id
                                FROM commandes LEFT JOIN users ON commandes.user_id = users.id
                                LEFT JOIN commande_product ON commandes.id = commande_product.commande_id
                                LEFT JOIN products ON commande_product.product_id = products.id 
                                WHERE commandes.id = $id")[0];
                                
        return view('dashboards.commandes.show', compact('commande'));
    }
    
    /**
     * Display a listing of the product.
     *
     * @return \Illuminate\Http\Response
     */
    public function services()
    {
        $services = DB::select("SELECT services.title as service_title, services.id as service_id, services.slug as service_slug,
        services.beneficiaire as service_beneficiaire, services.telephone as service_telephone, services.user_id as service_user_id, 
        services.montant as service_montant, services.paid as service_paid, services.expire as service_expire, services.etat as service_etat,
        users.name as service_user_name
        FROM services 
        LEFT JOIN users ON services.user_id = users.id
        /*WHERE services.etat != 'done'*/");

        return view('dashboards.services.index', compact('services'));
    }
        
    /**
     * Display a listing of the product.
     *
     * @return \Illuminate\Http\Response
     */
    public function service($id)
    {
        $service = $this->serviceRepository->getById($id);
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
        $products = DB::select('SELECT products.id as product_id, products.title as product_title, products.slug as product_slug, products.price as product_price,
        products.overview as product_overview, products.quantity as product_quantity, products.published as product_publised, products.discount as product_discount,
        categories.id as categorie_id, categories.title as category_title, categories.slug as categorie_slug
        FROM products LEFT JOIN categories ON products.category_id = categories.id
        /*WHERE products.quantity > 0 AND products.published = 1*/ ');

        return view('dashboards.products.index', compact('products'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function product($id)
    {
        $product = $this->productRepository->getById($id);
        
        if($product->product_discount != null &&  $product->product_discount > 0) 
        {
            $product->product_price = $product->product_price - ($product->product_price * ($product->product_discount / 100));
        }

        return view('dashboards.products.show', compact('product'));
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
        // On recupère les commandes d'un utilisateur, les infos sur les produits
        $recettes = DB::select("SELECT commandes.code as commande_code, commandes.id as commande_id, commandes.firstname as commande_firstname,
                                commandes.lastname as commande_lastname, commandes.telephone as commande_telephone, commandes.user_id, commandes.delivered as commande_delivered, 
                                commandes.paid as commande_paid, commandes.montant_du as commande_montant_du, commandes.montant_payer as commande_montant_payer, users.name as user_name, 
                                products.id, products.title as product_title, products.slug as product_slug, commande_product.product_id, commande_product.commande_id
                                FROM commandes LEFT JOIN users ON commandes.user_id = users.id
                                LEFT JOIN commande_product ON commandes.id = commande_product.commande_id
                                LEFT JOIN products ON commande_product.product_id = products.id 
                                WHERE commandes.montant_payer > 0 GROUP BY commande_code
                                /*UNION
                                SELECT services.title as service_title, services.slug as service_slug, services.beneficiaire as service_beneficiaire, services.montant as service_montant, services.paid as service_paid
                                FROM services
                                WHERE services.paid = 1*/");

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

    public function dashboard_index() {
        $services = $this->serviceRepository->get();
        return view('dashboard.services.index', compact('services'));
    }
}
