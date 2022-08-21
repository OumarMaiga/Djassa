<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\File;

use App\Repositories\CategoryRepository;
use App\Repositories\SubCategoryRepository;
use App\Repositories\RayonRepository;
use App\Repositories\FileRepository;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CategoryController extends Controller
{
    protected $categoryRepository;
    protected $subCategoryRepository;
    protected $rayonRepository;
    protected $fileRepository;

    public function __construct(CategoryRepository $categoryRepository, RayonRepository $rayonRepository, 
        SubCategoryRepository $subCategoryRepository, FileRepository $fileRepository) 
    {
        $this->middleware('superAdmin', ['only' => ['index', 'create', 'store', 'show', 'edit', 'update', 'destroy']]);
        $this->categoryRepository = $categoryRepository;
        $this->subCategoryRepository = $subCategoryRepository;
        $this->rayonRepository = $rayonRepository;
        $this->fileRepository = $fileRepository;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = DB::select('SELECT categories.id as category_id, categories.slug as category_slug, categories.rayon_id as category_rayon_id, categories.title as category_title,
        rayons.id as rayon_id, rayons.title as rayon_title,
        files.file_path as category_image
        FROM categories 
        LEFT JOIN rayons ON categories.rayon_id = rayons.id
        LEFT JOIN files ON categories.id = files.category_id
        WHERE categories.etat="enabled"
        ORDER BY category_id ASC');

        return view('dashboards.categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $rayons = $this->rayonRepository->getBy('etat', '=', 'enabled');
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

        //Creation du slug
        $i = 0;
        do {
            $i++;
            $slug = Str::slug($request->get('title'))."-".$i;
            if ($i == 1) $slug = Str::slug($request->get('title'));
            $slug_count = $this->categoryRepository->getBy('slug', '=', $slug)->count();
        } while ($slug_count >= 1);
        
        $request->merge([
            'slug' => $slug,
            'user_id' => Auth::user()->id,
            'etat' => 'enabled',
        ]);
            
        $category = $this->categoryRepository->store($request->all());

        // Enregistrement de l'image
        if($request->hasFile('category_image')) {
            //On upload l'image selectionner
            if ($imagefile = $request->file('category_image')) {
                $fileModel = new File;
                $fileName = time().'_'.$imagefile->getClientOriginalName();
                $filePath = $imagefile->storeAs("uploads/category_image/".$category->id, $fileName, 'public');
                $fileModel->libelle = $fileName;
                $fileModel->file_path = '/storage/' . $filePath;
                $fileModel->user_id =  Auth::check() ? Auth::user()->id : null;
                $fileModel->category_id = $category->id;
                $fileModel->type = 'category_image';
                $fileModel->save();
            }
        }
        return redirect('/dashboard/category/')->withStatus("Nouveau category (".$category->title.") vient d'être ajouté");
    
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        $category = $this->categoryRepository->getBy('slug', '=', $slug)->first();
        return view('dashboards.categories.show', compact('category'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit($slug)
    {
        $category = $this->categoryRepository->getBy('slug', '=', $slug)->first();
        $rayons = $this->rayonRepository->getBy('etat', '=', 'enabled');

        return view('dashboards.categories.edit', compact('category', 'rayons'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $slug)
    {
        $category = $this->categoryRepository->getBy('slug', '=', $slug)->first();
        $this->categoryRepository->update($category->id, $request->all());
        
        if($request->hasFile('category_image')) {
            // On supprime toutes les images de la categorie
            $this->fileRepository->deleteBy('category_id', $category->id);

            //On upload l'image selectionner
            if ($imagefile = $request->file('category_image')) {
                $fileModel = new File;
                $fileName = time().'_'.$imagefile->getClientOriginalName();
                $filePath = $imagefile->storeAs("uploads/category_image/".$category->id, $fileName, 'public');
                $fileModel->libelle = $fileName;
                $fileModel->file_path = '/storage/' . $filePath;
                $fileModel->user_id =  Auth::check() ? Auth::user()->id : null;
                $fileModel->category_id = $category->id;
                $fileModel->type = 'category_image';
                $fileModel->save();
            }
        } 

        return redirect('/dashboard/category')->withStatus("Category a bien été modifier");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy($slug)
    {
        $category = $this->categoryRepository->getBy('slug', '=', $slug)->first();
        $this->categoryRepository->destroy($category->id);
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
        $sub_categories = $this->subCategoryRepository->getBy('category_id', '=', $id);
        return response()->json(['sub_categories' => $sub_categories]);
    }
    
}
