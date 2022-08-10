<?php

namespace App\Http\Controllers;

use App\Http\Requests\Request;

use App\Models\User;

use App\Repositories\UserRepository;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class UserController extends Controller
{
    protected $userRepository;

    public function __construct(UserRepository $userRepository) {
        $this->middleware('admin', ['only' => ['index', 'blocked', 'unblocked']]);
        $this->userRepository = $userRepository;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = $this->userRepository->getBy('type', '=', 'user');
        return view('dashboards.users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboards.users.create');
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
            
        $user = $this->userRepository->store($request->all());

        return redirect('/dashboard/user/')->withStatus("Nouveau user (".$user->title.") vient d'être ajouté");
    
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = $this->userRepository->getById($id);
        return view('dashboards.users.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        return view('dashboards.users.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->userRepository->update($user->id, $request->all());
        return redirect('/dashboard/user')->withStatus("User a bien été modifier");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->userRepository->destroy($id);
        return redirect()->back()->withError("User a bien été supprimer");
    }

    public function blocked ($id) {
        $data = array('etat' => 'blocked');
        $this->userRepository->update($id, $data);
        return redirect()->back()->withStatus("User a bien été bloqué");
    }

    public function unblocked ($id) {
        $data = array('etat' => 'enabled');
        $this->userRepository->update($id, $data);
        return redirect()->back()->withStatus("User a bien été débloqué");
    }
}
