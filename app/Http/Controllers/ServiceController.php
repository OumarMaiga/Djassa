<?php

namespace App\Http\Controllers;


use App\Models\Service;
use App\Models\File;

use App\Repositories\ServiceRepository;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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
    public function index($user_id)
    {
        $services = DB::select("SELECT services.id as service_id, services.title as service_title, services.slug as service_slug, services.overview as service_overview,
        services.beneficiaire as service_beneficiaire, services.telephone as service_telephone, services.expire as service_expire, services.montant as service_montant,
        services.etat as service_etat, services.paid as service_paid, users.id as user_id, users.name as user_name
        FROM services 
        LEFT JOIN users ON services.user_id = users.id
        WHERE services.etat <> 'done' && services.user_id = $user_id");

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

        //Creation du slug
        $i = 0;
        do {
            $i++;
            $slug = Str::slug($request->get('title'))."-".$i;
            if ($i == 1) $slug = Str::slug($request->get('title'));
            $slug_count = $this->serviceRepository->getBy('slug', '=', $slug)->count();
        } while ($slug_count >= 1);
        
        $request->merge([
            'slug' => $slug,
            'user_id' => $user_id,
            'etat' => 'request',
            'paid' => 1,
        ]);
            
        $service = $this->serviceRepository->store($request->all());

        return redirect("/service/".$service->slug)->withStatus("Nouveau service (".$service->title.") vient d'être ajouté");
    
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Service  $service
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        $service = $this->serviceRepository->getBy('slug', '=', $slug)->first();
        $file = null;
        if ($service->etat === "done") {
            $file = File::where('service_id', $service->id)->limit(1)->get()[0];
            $file->file_path = env('APP_URL').$file->file_path;
        }
        return view('services.show', compact('service', 'file'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Service  $service
     * @return \Illuminate\Http\Response
     */
    public function edit($slug)
    {
        $service = $this->serviceRepository->getBy('slug', '=', $slug)->first();
        return view('services.edit', compact('service'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\Request  $request
     * @param  \App\Models\Service  $service
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $slug)
    {
        $service = $this->serviceRepository->getBy('slug', '=', $slug)->first();
        $this->serviceRepository->update($service->id, $request->all());
        return redirect("/my-service/".Auth::user()->id)->withStatus("Service a bien été modifier");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Service  $service
     * @return \Illuminate\Http\Response
     */
    public function destroy ($slug)
    {
        $service = $this->serviceRepository->getBy('slug', '=', $slug)->first();
        $this->serviceRepository->destroy($service->id);
        return redirect()->back()->withError("Service a bien été supprimer");
    }
}
