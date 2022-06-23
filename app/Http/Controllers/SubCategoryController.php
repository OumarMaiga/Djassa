<?php

namespace App\Http\Controllers;

use App\Models\SubCategory;

use App\Repositories\RayonRepository;
use App\Repositories\SubCategoryRepository;
use App\Repositories\SubSubCategoryRepository;
use App\Repositories\CategoryRepository;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SubCategoryController extends Controller
{
    protected $rayonRepository;
    protected $subCategoryRepository;
    protected $categoryRepository;
    protected $subSubCategoryRepository;

    public function __construct(RayonRepository $rayonRepository, SubCategoryRepository $subCategoryRepository, SubSubCategoryRepository $subSubCategoryRepository, CategoryRepository $categoryRepository) {
        $this->rayonRepository = $rayonRepository;
        $this->subCategoryRepository = $subCategoryRepository;
        $this->subSubCategoryRepository = $subSubCategoryRepository;
        $this->categoryRepository = $categoryRepository;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sub_categories = DB::select('SELECT sub_categories.id as sub_category_id, sub_categories.slug as sub_category_slug, sub_categories.title as sub_category_title,
        rayons.id as rayon_id, rayons.slug as rayon_slug, rayons.title as rayon_title,
        categories.id as category_id, categories.slug as category_slug, categories.title as category_title
        FROM sub_categories 
        LEFT JOIN rayons ON sub_categories.rayon_id = rayons.id
        LEFT JOIN categories ON sub_categories.category_id = categories.id
        WHERE sub_categories.etat="enabled"');

        return view('dashboards.sub_categories.index', compact('sub_categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $rayons = $this->rayonRepository->getBy('etat', 'enabled');
        $categories = $this->categoryRepository->getBy('etat', 'enabled');
        return view('dashboards.sub_categories.create', compact('categories', 'rayons'));
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
            'category_id' => 'required',
        ]);

        $request->merge([
            'slug' => Str::slug($request->get('title')),
            'user_id' => Auth::user()->id,
            'etat' => 'enabled',
        ]);
            
        $subCategory = $this->subCategoryRepository->store($request->all());

        return redirect('/dashboard/sub_category/')->withStatus("Nouveau subCategory (".$subCategory->title.") vient d'être ajouté");
    
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\SubCategory  $subCategory
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $subCategory = $this->subCategoryRepository->getById($id);
        return view('dashboards.sub_categories.show', compact('subCategory'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\SubCategory  $subCategory
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $sub_category = $this->subCategoryRepository->getById($id);   
        $rayons = $this->rayonRepository->getBy('id', $sub_category->rayon_id);
        $categories = $this->categoryRepository->getBy('id', $sub_category->category_id);

        return view('dashboards.sub_categories.edit', compact('rayons', 'sub_category', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\SubCategory  $subCategory
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->subCategoryRepository->update($id, $request->all());
        return redirect('/dashboard/sub_categories')->withStatus("SubCategory a bien été modifier");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\SubCategory  $subCategory
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->subCategoryRepository->destroy($id);
        return redirect()->back()->withError("SubCategory a bien été supprimer");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Category  $rayon_id
     * @return \Illuminate\Http\Response
     */
    public function sub_sub_categories($id)
    {
        $sub_sub_categories = $this->subSubCategoryRepository->getBy('sub_category_id', $id);
        return response()->json(['sub_sub_categories' => $sub_sub_categories]);
    }
    
}
