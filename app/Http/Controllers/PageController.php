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

class PageController extends Controller
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
        return view('pages.product_per_sub_sub_category', compact('rayons', 'category', 'sub_category', 'products', 'sub_sub_category'));
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
        return view('pages.search', compact('products', 'query', 'rayons'));
            
    }
}
