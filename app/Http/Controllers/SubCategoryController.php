<?php

namespace App\Http\Controllers;

use App\Models\SubCategory;

use App\Repositories\SubCategoryRepository;
use App\Repositories\CategoryRepository;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SubCategoryController extends Controller
{
    protected $subCategoryRepository;
    protected $categoryRepository;

    public function __construct(SubCategoryRepository $subCategoryRepository, CategoryRepository $categoryRepository) {
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
        $categories = DB::select('SELECT categories.id as subCategory_id, categories.category_id as subCategory_category_id, categories.title as subCategory_title,
        categorys.id as category_id, categorys.title as category_title
        FROM categories LEFT JOIN categorys ON categories.category_id = categorys.id
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
        $categorys = $this->categoryRepository->getBy('etat', 'enabled');
        return view('dashboards.categories.create', compact('categorys'));
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

        return redirect('/dashboard/subCategory/')->withStatus("Nouveau subCategory (".$subCategory->title.") vient d'être ajouté");
    
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
        return view('dashboards.categories.show', compact('subCategory'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\SubCategory  $subCategory
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $categorys = $this->categoryRepository->getBy('etat', 'enabled');
        $subCategory = $this->subCategoryRepository->getById($id);
        return view('dashboards.categories.edit', compact('subCategory', 'categorys'));
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
        return redirect('/dashboard/subCategory')->withStatus("SubCategory a bien été modifier");
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
    
}
