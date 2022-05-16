<?php

namespace App\Http\Controllers;


use App\Models\Service;

use App\Repositories\ServiceRepository;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    protected $serviceRepository;

    public function __construct(ServiceRepository $serviceRepository) {
        $this->serviceRepository = $serviceRepository;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $services = $this->serviceRepository->get();
        return view('services.index', compact('services'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('services.create');
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
            'montant' => 'required'
        ]);
        $user_id = null;
        if(Auth::check())
        {
            $user_id = Auth::user()->id;
        }

        $request->merge([
            'slug' => Str::slug($request->get('title')),
            'user_id' => $user_id,
            'etat' => 'request',
            'paid' => 0,
        ]);
            
        $service = $this->serviceRepository->store($request->all());

        return redirect('/service')->withStatus("Nouveau service (".$service->title.") vient d'être ajouté");
    
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Service  $service
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $service = $this->serviceRepository->getById($id);
        return view('services.show', compact('service'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Service  $service
     * @return \Illuminate\Http\Response
     */
    public function edit(Service $service)
    {
        return view('services.edit', compact('service'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\Request  $request
     * @param  \App\Models\Service  $service
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->serviceRepository->update($id, $request->all());
        return redirect('/service')->withStatus("Service a bien été modifier");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Service  $service
     * @return \Illuminate\Http\Response
     */
    public function destroy ($id)
    {
        $this->serviceRepository->destroy($id);
        return redirect()->back()->withError("Service a bien été supprimer");
    }

    public function inprogress ($id) {
        $data = array('etat' => 'inprogress');
        $this->serviceRepository->update($id, $data);
        return redirect()->back()->withStatus("Service a bien été prise en compte");
    }

    public function done ($id) {
        die('Fonctionnality nOt available');
        $service = $this->serviceRepository->getById($id);
        if($request->hasFile('justificatif')) {
            
            $fileName = time().'_'.$request->file('justificatif')->getClientOriginalName();
            $filePath = $request->file('justificatif')->storeAs("uploads/justificatif/service/".$service->id, $fileName, 'public');
            $fileModel->libelle = $fileName;
            $fileModel->file_path = '/storage/' . $filePath;

            if (Auth::check()) {
                $fileModel->user_id = Auth::user()->id;
            }

            $fileModel->type = 'justificatif';
            $fileModel->postule_id = $postule->id;
            $fileModel->save();
        } 
        $data = array('etat' => 'done');
        $this->serviceRepository->update($id, $data);
        return redirect()->back()->withStatus("Service a bien été débloqué");
    }
}
