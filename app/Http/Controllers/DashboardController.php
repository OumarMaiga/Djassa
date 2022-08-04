<?php

namespace App\Http\Controllers;

use App\Repositories\ProductRepository;
use App\Repositories\CommandeRepository;
use App\Repositories\RayonRepository;
use App\Repositories\CategoryRepository;
use App\Repositories\SubCategoryRepository;
use App\Repositories\SubSubCategoryRepository;
use App\Repositories\UserRepository;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

use App\Models\Product;

class DashboardController extends Controller
{
    
    protected $productRepository;
    protected $rayonRepository;
    protected $categoryRepository;
    protected $subCategoryRepository;
    protected $subSubCategoryRepository;
    protected $userRepository;
    
    public function __construct(ProductRepository $productRepository, CommandeRepository $commandeRepository, 
                        RayonRepository $rayonRepository, CategoryRepository $categoryRepository, 
                        SubCategoryRepository $subCategoryRepository, SubSubCategoryRepository $subSubCategoryRepository,
                        UserRepository $userRepository) {
        //$this->middleware('adminOnly', ['only' => ['index', 'create', 'store', 'show', 'edit', 'update', 'destroy']]);
        $this->productRepository = $productRepository;
        $this->commandeRepository = $commandeRepository;
        $this->rayonRepository = $rayonRepository;
        $this->categoryRepository = $categoryRepository;
        $this->subCategoryRepository = $subCategoryRepository;
        $this->subSubCategoryRepository = $subSubCategoryRepository;
        $this->userRepository = $userRepository;
    }
        
    /**
     * Display a listing of the product.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $admins = $this->userRepository->getBy('type', 'admin');
        $users = $this->userRepository->getBy('type', 'user');
        $commandes = $this->commandeRepository->getBy('delivered', 0);
        $month = date('m');
        $year = date('Y');
        $ventes = DB::select("SELECT * FROM commandes 
                            WHERE commandes.delivered = 1 && $month = MONTH(commandes.created_at) 
                            AND $year = YEAR(commandes.created_at)");

        return view('dashboards.dashboard', compact('admins', 'users', 'commandes', 'ventes'));
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

        return view('dashboards.commandes', compact('commandes'));
    }
    
    /**
     * Display a listing of the product.
     *
     * @return \Illuminate\Http\Response
     */
    public function products()
    {
        $products = $this->productRepository->get();
        return view('dashboards.products.index', compact('products'));
    }

    /**
     * Display a listing of the product.
     *
     * @return \Illuminate\Http\Response
     */
    public function product_per_category($category_slug)
    {
        $rayons = $this->rayonRepository->get();
        $category = $this->categoryRepository->getBy('slug', $category_slug)->first();
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
        $category = $this->categoryRepository->getBy('slug', $category_slug)->first();
        $sub_category = $this->subCategoryRepository->getBy('slug', $sub_category_slug)->first();        
        $sub_sub_categories = $this->subSubCategoryRepository->getBy('sub_category_id', $sub_category->id);
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
        $category = $this->categoryRepository->getBy('slug', $category_slug)->first();
        $sub_category = $this->subCategoryRepository->getBy('slug', $sub_category_slug)->first();
        $sub_sub_category = $this->subSubCategoryRepository->getBy('slug', $sub_sub_category_slug)->first();
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
                                commandes.lastname as commande_lastname, commandes.telephone as commande_telephone, commandes.user_id, commandes.delivered as commande_delivered, commandes.paid as commande_paid, users.name as user_name, 
                                products.id, products.title as product_title, products.slug as product_slug, commande_product.product_id, commande_product.commande_id
                                FROM commandes LEFT JOIN users ON commandes.user_id = users.id
                                LEFT JOIN commande_product ON commandes.id = commande_product.commande_id
                                LEFT JOIN products ON commande_product.product_id = products.id 
                                WHERE commandes.paid = 1 GROUP BY commande_code");
        return view('dashboards.recettes.index', compact('recettes'));
    }
    
    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function product(Product $product)
    {
        return view('dashboards.products.show', compact('product'));
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
}
