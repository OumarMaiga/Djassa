<?php

namespace App\Http\Controllers;

use App\Repositories\ProductRepository;
use App\Repositories\CommandeRepository;
use App\Repositories\RayonRepository;
use App\Repositories\CategoryRepository;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class PageController extends Controller
{
    
    protected $productRepository;
    protected $rayonRepository;
    protected $categoryRepository;
    
    public function __construct(ProductRepository $productRepository, CommandeRepository $commandeRepository, RayonRepository $rayonRepository, CategoryRepository $categoryRepository) {
        //$this->middleware('adminOnly', ['only' => ['index', 'create', 'store', 'show', 'edit', 'update', 'destroy']]);
        $this->productRepository = $productRepository;
        $this->commandeRepository = $commandeRepository;
        $this->rayonRepository = $rayonRepository;
        $this->categoryRepository = $categoryRepository;
    }
    
    /**
     * Display a listing of the product.
     *
     * @return \Illuminate\Http\Response
     */
    public function welcome()
    {
        $products = DB::select("SELECT products.id as product_id, products.title as product_title, products.slug as product_slug, products.overview as product_overview, 
            products.price as product_price, products.quantity as product_quantity, products.published as product_published 
            FROM products
            WHERE products.published = 1");
        $rayons = $this->rayonRepository->get();
        return view('pages.welcome', compact('products', 'rayons'));
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
        $category = $this->categoryRepository->getBy('slug', $category_slug)[0];
        $products = DB::select("SELECT products.id as product_id, products.title as product_title, products.slug as product_slug, products.overview as product_overview, 
                        products.price as product_price, products.quantity as product_quantity, products.published as product_published 
                        FROM products
                        WHERE products.category_id = $category->id AND products.published = 1 AND products.quantity > 0");
        return view('pages.product_per_category', compact('rayons', 'category', 'products'));
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
}
