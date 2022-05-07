<?php

namespace App\Http\Controllers;

use App\Repositories\ProductRepository;

use Illuminate\Http\Request;

class PageController extends Controller
{
    
    protected $productRepository;

    public function __construct(ProductRepository $productRepository) {
        //$this->middleware('adminOnly', ['only' => ['index', 'create', 'store', 'show', 'edit', 'update', 'destroy']]);
        $this->productRepository = $productRepository;
    }
    
    /**
     * Display a listing of the product.
     *
     * @return \Illuminate\Http\Response
     */
    public function products()
    {
        $products = $this->productRepository->get();
        return view('pages.products', compact('products'));
    }
}
