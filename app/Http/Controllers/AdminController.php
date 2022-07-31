<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rules;
use Illuminate\Support\Facades\Hash;


use App\Repositories\UserRepository;


class AdminController extends Controller
{
    protected $userRepository;
    
    public function __construct(UserRepository $userRepository) {
        $this->userRepository = $userRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $admins = $this->userRepository->getBy('type', 'admin');
        return view('dashboards.admins.index', compact('admins'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboards.admins.create');
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
            'name' => 'required|max:255',
            'email' => 'required',
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $request->merge([
            'password' => Hash::make($request->password),
            'user_id' => Auth::user()->id,
            'type' => "admin",
            'etat ' => "enabled"
        ]);

        $admin = $this->userRepository->store($request->all());
        $this->unblocked($admin->id);

        return redirect('/dashboard/admin/')->withStatus("Nouveau admin (".$admin->name.") vient d'être ajouté");
    
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $admin
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $admin = $this->userRepository->getById($id);
        return view('dashboards.admins.show', compact('admin'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $admin
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $admin = $this->userRepository->getById($id);
        return view('dashboards.admins.edit', compact('admin'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\Request  $request
     * @param  \App\Models\User  $admin
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $admin = $this->userRepository->getById($id);
        $this->userRepository->update($admin->id, $request->all());
        return redirect('/dashboard/admin')->withStatus("admin a bien été modifier");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $admin
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->userRepository->destroy($id);
        return redirect()->back()->withError("admin a bien été supprimer");
    }

    public function blocked ($id) {
        $data = array('etat' => 'blocked');
        $this->userRepository->update($id, $data);
        return redirect()->back()->withStatus("admin a bien été bloqué");
    }

    public function unblocked ($id) {
        $data = array('etat' => 'enabled');
        $this->userRepository->update($id, $data);
        return redirect()->back()->withStatus("admin a bien été débloqué");
    }
}
