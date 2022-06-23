<?php

namespace App\Http\Controllers;

use App\Models\Category;

use App\Repositories\CategoryRepository;
use App\Repositories\SubCategoryRepository;
use App\Repositories\RayonRepository;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CategoryController extends Controller
{
    protected $categoryRepository;
    protected $subCategoryRepository;
    protected $rayonRepository;

    public function __construct(CategoryRepository $categoryRepository, RayonRepository $rayonRepository, 
        SubCategoryRepository $subCategoryRepository) 
    {
        $this->categoryRepository = $categoryRepository;
        $this->subCategoryRepository = $subCategoryRepository;
        $this->rayonRepository = $rayonRepository;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = DB::select('SELECT categories.id as category_id, categories.rayon_id as category_rayon_id, categories.title as category_title,
        rayons.id as rayon_id, rayons.title as rayon_title
        FROM categories LEFT JOIN rayons ON categories.rayon_id = rayons.id
        WHERE categories.etat="enabled"');

        return view('dashboards.categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $rayons = $this->rayonRepository->getBy('etat', 'enabled');
        return view('dashboards.categories.create', compact('rayons'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        $request->validate([
            'title' => 'required|max:255',
            'rayon_id' => 'required',
        ]);

        $request->merge([
            'slug' => Str::slug($request->get('title')),
            'user_id' => Auth::user()->id,
            'etat' => 'enabled',
        ]);
            
        $category = $this->categoryRepository->store($request->all());

        return redirect('/dashboard/category/')->withStatus("Nouveau category (".$category->title.") vient d'être ajouté");
    
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $category = $this->categoryRepository->getById($id);
        return view('dashboards.categories.show', compact('category'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $category = $this->categoryRepository->getById($id);
        $rayons = $this->rayonRepository->getBy('etat', 'enabled');

        return view('dashboards.categories.edit', compact('category', 'rayons'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->categoryRepository->update($id, $request->all());
        return redirect('/dashboard/category')->withStatus("Category a bien été modifier");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->categoryRepository->destroy($id);
        return redirect()->back()->withError("Category a bien été supprimer");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Category  $rayon_id
     * @return \Illuminate\Http\Response
     */
    public function sub_categories($id)
    {
        $sub_categories = $this->subCategoryRepository->getBy('category_id', $id);
        return response()->json(['sub_categories' => $sub_categories]);
    }
    
}
