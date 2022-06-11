<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

use App\Models\Product;
use App\Models\File;

use App\Repositories\ProductRepository;
use App\Repositories\FileRepository;
use App\Repositories\CategoryRepository;


class ProductController extends Controller
{
    protected $productRepository;
    protected $fileRepository;
    protected $categoryRepository;

    public function __construct(ProductRepository $productRepository, FileRepository $fileRepository, CategoryRepository $categoryRepository) {
        $this->productRepository = $productRepository;
        $this->fileRepository = $fileRepository;
        $this->categoryRepository = $categoryRepository;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = $this->productRepository->get();
        return view('dashboards.products.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = $this->categoryRepository->getBy('etat', 'enabled');
        return view('dashboards.products.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        $request->validate([
            'title' => 'required|max:255',
            'overview' => 'required',
            'price' => 'required'
        ]);

        $request->merge([
            'slug' => Str::slug($request->get('title')),
            'user_id' => Auth::user()->id,
        ]);
            
        $product = $this->productRepository->store($request->all());

        if($request->hasFile('product_image')) {
            foreach ($request->file('product_image') as $imagefile) {
                $fileModel = new File;
                $fileName = time().'_'.$imagefile->getClientOriginalName();
                $filePath = $imagefile->storeAs("uploads/product_image/".$product->id, $fileName, 'public');
                $fileModel->libelle = $fileName;
                $fileModel->file_path = '/storage/' . $filePath;
                $fileModel->user_id =  Auth::check() ? Auth::user()->id : null;
                $fileModel->product_id = $product->id;
                $fileModel->type = 'product_image';
                $fileModel->save();
            }
        } 

        return redirect('/dashboard/product/')->withStatus("Nouveau product (".$product->title.") vient d'être ajouté");
    
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $product = $this->productRepository->getById($id);
        return view('dashboards.products.show', compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $product = $this->productRepository->getById($id);
        return view('dashboards.products.edit', compact('product'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        $this->productRepository->update($product->id, $request->all());

        if($request->hasFile('product_image')) {
            // On supprime toutes les images du produit
            $this->fileRepository->deleteBy('product_id', $product->id);

            //On upload les images selectionner
            foreach ($request->file('product_image') as $imagefile) {
                $fileModel = new File;
                $fileName = time().'_'.$imagefile->getClientOriginalName();
                $filePath = $imagefile->storeAs("uploads/product_image/".$product->id, $fileName, 'public');
                $fileModel->libelle = $fileName;
                $fileModel->file_path = '/storage/' . $filePath;
                $fileModel->user_id =  Auth::check() ? Auth::user()->id : null;
                $fileModel->product_id = $product->id;
                $fileModel->type = 'product_image';
                $fileModel->save();
            }
        } 

        return redirect('/dashboard/product')->withStatus("Product a bien été modifier");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->productRepository->destroy($id);
        return redirect()->back()->withError("Product a bien été supprimer");
    }
    
    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function detail($id)
    {
        $product = $this->productRepository->getById($id);
        $images = $this->fileRepository->getBy("product_id", $product->id);

        return view('pages.products.show', compact('product', 'images'));
    }
    
    public function list()
    {
        $products = $this->productRepository->get();

        return view('pages.products.show', compact('products'));
    }

    
}
