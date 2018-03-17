<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserFormRequest;
use App\Models\Role;
use App\Models\User;
use App\Traits\Authorizable;
use Illuminate\Http\Request;
use Illuminate\Notifications\Notifiable;

class UserController extends Controller
{
    use Notifiable, Authorizable;
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::with('roles')->get();
        
        return view('panel.user.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request, Role $role)
    {
        $roles = $role->getAllRoles();
        
        return view('panel.user.form', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserFormRequest $request, User $user)
    {
        if ($user->create($request->all()) && $user->roles()->sync($request->get('perfis', []))) {
            
            return redirect()->route('users.index')
                    ->with('success', "Usuário <b>{$request->name}</b> cadastrado com sucesso!");
        }
        
        
        return redirect()->back()->with('error', 'Falha ao cadastrar usuário!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id, Role $role)
    {
        $user = User::find($id);
        
        if (!$user) {
            return redirect()->back()->with('error', "Falha ao encontrar usuário com id <b>{$user->id}</b>");
        }
        
        
        $roles = $role->getAllRoles();
        
        return view('panel.user.form', compact('user', 'roles'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UserFormRequest $request, $id)
    {
        $user = User::find($id);
        
        if (!$user) {
            return redirect()
                        ->route('users.index')
                        ->with('error', "Falha ao encontrar usuário com id <b>{$user->id}</b>");
        }

        
        if ($user->name == 'admin') {
            return redirect()->route('users.index')->with('warning', "Usuário <b>admin</b> não pode ser editado!");
        }
        
        
        if ($user->update($request->all()) && $user->roles()->sync($request->get('perfis', []))) {
            
            return redirect()->route('users.index')
                        ->with('success', "Usuário <b>{$user->name}</b> atualizado com sucesso!");
        }
        
        return redirect()->back()->with('error', 'Falha ao atualizar usuário!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::find($id);
        
        
        if ($user->id == 1 && $user->name = 'admin' && $user->roles->contains('name', 'admin')) {
            return redirect()
                        ->route('users.index')
                        ->with('warning', "Usuário <b>admin</b> não pode ser excluído!");
        }
        
        if (!$user) {
            return redirect()
                    ->route('users.index')
                    ->with('error', "Falha ao encontrar usuário com id <b>{$user->id}</b>");
        }
        
        
        if ($user->delete($id)) {
            return redirect()->route('users.index')
                        ->with('success', "O usuário <b>{$user->name}</b> foi deletado com sucesso!");
        }
        
        return redirect()->back()->with('error', "Falha ao deletar usuário!");
    }
    
    
    public function roles($id)
    {
        if ($id == 1) {
            return redirect()
                ->route('users.index')
                ->with('warning', "Usuário <b>admin</b> tem permissão total ao sistema!");
        }
        
        if ( auth()->user()->id == $id ) {
            return redirect()
                        ->route('users.index')
                        ->with('warning', "Não é permitido excluir o usuário atualmente logado!");
        }
        
        $user = User::find($id);
        
        $roles = $user->roles()->get();
        
        return view('panel.user.roles', compact('user', 'roles'));
    }
}
