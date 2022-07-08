<?php

namespace App\Http\Controllers;

use App\Repositories\ProductRepository;
use App\Repositories\CommandeRepository;
use App\Repositories\RayonRepository;
use App\Repositories\CategoryRepository;
use App\Repositories\SubCategoryRepository;
use App\Repositories\SubSubCategoryRepository;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class PageController extends Controller
{
    
    protected $productRepository;
    protected $rayonRepository;
    protected $categoryRepository;
    protected $subCategoryRepository;
    protected $subSubCategoryRepository;
    
    public function __construct(ProductRepository $productRepository, CommandeRepository $commandeRepository, 
                        RayonRepository $rayonRepository, CategoryRepository $categoryRepository, 
                        SubCategoryRepository $subCategoryRepository, SubSubCategoryRepository $subSubCategoryRepository) {
        //$this->middleware('adminOnly', ['only' => ['index', 'create', 'store', 'show', 'edit', 'update', 'destroy']]);
        $this->productRepository = $productRepository;
        $this->commandeRepository = $commandeRepository;
        $this->rayonRepository = $rayonRepository;
        $this->categoryRepository = $categoryRepository;
        $this->subCategoryRepository = $subCategoryRepository;
        $this->subSubCategoryRepository = $subSubCategoryRepository;
    }
    
    /**
     * Display a listing of the product.
     *
     * @return \Illuminate\Http\Response
     */
    public function welcome()
    {
        $products = DB::select("SELECT products.id as product_id, products.title as product_title, products.slug as product_slug, products.overview as product_overview, 
            products.price as product_price, products.quantity as product_quantity, products.published as product_published, products.discount as product_discount,
            files.file_path as files_file_path
            FROM products
            LEFT JOIN files ON files.product_id = products.id AND products.quantity > 0
            WHERE products.published = 1
            GROUP BY products.id");

        $rayons = $this->rayonRepository->get();

        $page_number = 1;

        return view('pages.welcome', compact('products', 'rayons', 'page_number'));
    }
    
    /**
     * Display a listing of the product.
     *
     * @return \Illuminate\Http\Response
     */
    public function products()
    {
        $products = $this->productRepository->get();
        return view('pages.products.index', compact('products'));
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
        $sub_categories = $this->subCategoryRepository->getBy('category_id', $category->id);
        $products = DB::select("SELECT products.id as product_id, products.title as product_title, products.slug as product_slug, products.overview as product_overview, 
                        products.price as product_price, products.quantity as product_quantity, products.published as product_published, products.discount as product_discount,
                        files.file_path as files_file_path
                        FROM products
                        LEFT JOIN files ON files.product_id = products.id 
                        WHERE products.category_id = $category->id AND products.published = 1 AND products.quantity > 0
                        GROUP BY products.id");
        return view('pages.product_per_category', compact('rayons', 'category', 'products', 'sub_categories'));
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
        return view('pages.product_per_sub_category', compact('rayons', 'category', 'sub_category', 'products', 'sub_sub_categories'));
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
        return view('pages.product_per_sub_sub_category', compact('rayons', 'category', 'sub_category', 'products', 'sub_sub_category'));
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
        return view('pages.products.show', compact('product'));
    }
    
    public function config()
    {
        return view('dashboards.config');
    }
}
