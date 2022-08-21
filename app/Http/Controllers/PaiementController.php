<?php

namespace App\Http\Controllers;


use App\Models\Paiement;
use App\Models\File;

use App\Repositories\PaiementRepository;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class PaiementController extends Controller
{
    protected $paiementRepository;

    public function __construct(PaiementRepository $paiementRepository) {
        $this->paiementRepository = $paiementRepository;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $paiements = $this->paiementRepository->get();
        return view('paiements.index', compact('paiements'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('paiements.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user_id = null;
        if(Auth::check())
        {
            $user_id = Auth::user()->id;
        }

        $request->merge([
            'user_id' => $user_id,
        ]);
            
        $paiement = $this->paiementRepository->store($request->all());
        return response()->json(['paiement' => $paiement]);
    
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Paiement  $paiement
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $paiement = $this->paiementRepository->getById($id);
        $file = null;
        if ($paiement->etat === "done") {
            $file = File::where('paiement_id', $paiement->id)->limit(1)->get()[0];
            $file->file_path = env('APP_URL').$file->file_path;
        }
        return view('paiements.show', compact('paiement', 'file'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Paiement  $paiement
     * @return \Illuminate\Http\Response
     */
    public function edit(Paiement $paiement)
    {
        return view('paiements.edit', compact('paiement'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\Request  $request
     * @param  \App\Models\Paiement  $paiement
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->paiementRepository->update($id, $request->all());
        return redirect('/paiement')->withStatus("Paiement a bien été modifier");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Paiement  $paiement
     * @return \Illuminate\Http\Response
     */
    public function destroy ($id)
    {
        $this->paiementRepository->destroy($id);
        return redirect()->back()->withError("Paiement a bien été supprimer");
    }

    public function inprogress ($id) {
        $data = array('etat' => 'inprogress');
        $this->paiementRepository->update($id, $data);
        return redirect()->back()->withStatus("Paiement a bien été prise en compte");
    }

    public function done (Request $request, $id) {
        //die('Fonctionnality nOt available');

        $paiement = $this->paiementRepository->getById($id);
        if($request->hasFile('proof')) {
            $fileModel = new File;
            
            $fileName = time().'_'.$request->file('proof')->getClientOriginalName();
            $filePath = $request->file('proof')->storeAs("uploads/proof/paiement/".$paiement->id, $fileName, 'public');
            $fileModel->libelle = $fileName;
            $fileModel->file_path = '/storage/' . $filePath;

            if (Auth::check()) {
                $fileModel->user_id = Auth::user()->id;
            }

            $fileModel->type = 'justificatif';
            $fileModel->paiement_id = $paiement->id;
            $fileModel->save();
        } 
        $data = array('etat' => 'done');
        $this->paiementRepository->update($id, $data);
        
        return redirect()->back()->withStatus("Paiement marquer comme terminé");
    }
}
