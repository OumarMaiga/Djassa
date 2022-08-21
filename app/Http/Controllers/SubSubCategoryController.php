<?php

namespace App\Http\Controllers;

use App\Models\SubSubCategory;

use App\Repositories\RayonRepository;
use App\Repositories\SubSubCategoryRepository;
use App\Repositories\SubCategoryRepository;
use App\Repositories\CategoryRepository;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SubSubCategoryController extends Controller
{
    protected $rayonRepository;
    protected $subSubCategoryRepository;
    protected $subCategoryRepository;
    protected $categoryRepository;

    public function __construct(RayonRepository $rayonRepository, SubSubCategoryRepository $subSubCategoryRepository, SubCategoryRepository $subCategoryRepository, CategoryRepository $categoryRepository) {
        $this->middleware('superAdmin', ['only' => ['index', 'create', 'store', 'destroy', 'show', 'edit', 'update']]);
        $this->rayonRepository = $rayonRepository;
        $this->subSubCategoryRepository = $subSubCategoryRepository;
        $this->subCategoryRepository = $subCategoryRepository;
        $this->categoryRepository = $categoryRepository;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sub_sub_categories = DB::select('SELECT sub_sub_categories.id as sub_sub_category_id, sub_sub_categories.slug as sub_sub_category_slug, sub_sub_categories.title as sub_sub_category_title, 
        sub_sub_categories.category_id as sub_sub_category_category_id, sub_sub_categories.sub_category_id as sub_sub_category_sub_category_id, sub_sub_categories.rayon_id as sub_sub_category_rayon_id, 
        rayons.id as rayon_id, rayons.slug as rayon_slug, rayons.title as rayon_title,
        categories.id as category_id, categories.slug as category_slug, categories.title as category_title,
        sub_categories.id as sub_category_id, sub_categories.slug as sub_category_slug, sub_categories.title as sub_category_title
        FROM sub_sub_categories 
        LEFT JOIN rayons ON sub_sub_categories.rayon_id = rayons.id
        LEFT JOIN categories ON sub_sub_categories.category_id = categories.id
        LEFT JOIN sub_categories ON sub_sub_categories.sub_category_id = sub_categories.id
        WHERE sub_sub_categories.etat="enabled"');

        return view('dashboards.sub_sub_categories.index', compact('sub_sub_categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $rayons = $this->rayonRepository->getBy('etat', '=', 'enabled');
        $categories = $this->categoryRepository->getBy('etat', '=', 'enabled');
        $sub_categories = $this->subCategoryRepository->getBy('etat', '=', 'enabled');
        return view('dashboards.sub_sub_categories.create', compact('categories', 'rayons', 'sub_categories'));
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

        //Creation du slug
        $i = 0;
        do {
            $i++;
            $slug = Str::slug($request->get('title'))."-".$i;
            if ($i == 1) $slug = Str::slug($request->get('title'));
            $slug_count = $this->subSubCategoryRepository->getBy('slug', '=', $slug)->count();
        } while ($slug_count >= 1);
        
        $request->merge([
            'slug' => $slug,
            'user_id' => Auth::user()->id,
            'etat' => 'enabled',
        ]);
            
        $subCategory = $this->subSubCategoryRepository->store($request->all());

        return redirect('/dashboard/sub_sub_category/')->withStatus("Nouveau subCategory (".$subCategory->title.") vient d'être ajouté");
    
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\SubSubCategory  $subCategory
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        $subCategory = $this->subSubCategoryRepository->getBy('slug', '=', $slug)->first();
        return view('dashboards.sub_sub_categories.show', compact('subCategory'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\SubSubCategory  $subCategory
     * @return \Illuminate\Http\Response
     */
    public function edit($slug)
    {
        $sub_sub_category = $this->subSubCategoryRepository->getBy('slug', '=', $slug)->first();

        $rayons = $this->rayonRepository->getBy('id', '=', $sub_sub_category->rayon_id);
        $categories = $this->categoryRepository->getBy('id', '=', $sub_sub_category->category_id);
        $sub_categories = $this->subCategoryRepository->getBy('id', '=', $sub_sub_category->sub_category_id);
        $sub_sub_categories = $this->subSubCategoryRepository->getBy('id', '=', $sub_sub_category->sub_sub_category_id);

        return view('dashboards.sub_sub_categories.edit', compact('sub_sub_category', 'categories', 'rayons', 'sub_categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\SubSubCategory  $subCategory
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $slug)
    {
        $sub_sub_category = $this->subSubCategoryRepository->getBy('slug', '=', $slug)->first();
        $this->subSubCategoryRepository->update($sub_sub_category->id, $request->all());
        return redirect('/dashboard/sub_sub_category')->withStatus("SubSubCategory a bien été modifier");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\SubSubCategory  $subCategory
     * @return \Illuminate\Http\Response
     */
    public function destroy($slug)
    {
        $sub_sub_category = $this->subSubCategoryRepository->getBy('slug', '=', $slug)->first();
        $this->subSubCategoryRepository->destroy($sub_sub_category->id);
        return redirect()->back()->withError("SubSubCategory a bien été supprimer");
    }
    
}
