<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use App\Http\Requests\RoleFormRequest;
use App\Models\Permission;
use App\Models\Role;
use App\Traits\Authorizable;
use Illuminate\Support\Facades\Cache;
use Symfony\Component\HttpFoundation\Request;

class RoleController extends Controller
{
    use Authorizable;
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $roles = Role::all();
        
        return view('panel.role.index', compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('panel.role.form');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(RoleFormRequest $request)
    {
        // recupera os dados do form
        $dataForm = $request->except('_token');
        
        if ($role = Role::create($dataForm)) {
            return redirect()
                        ->route('roles.index')
                        ->with('success', "Perfil <b>{$role->label}</b> cadastrado com sucesso!");
        }
        
        return redirect()->back()->with('error', 'Falha ao cadastrar perfil!');
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $role = Role::find($id);
        
        if (!$role) {
            return redirect()->back()->with('error', "Falha ao encontrar perfil com id <b>{$role->id}</b>");
        }
        
        return view('panel.role.form', compact('role'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(RoleFormRequest $request, $id)
    {
        // recupera os dados do form
        $dataForm = $request->except(['_token', '_method']);
        
        $role = Role::find($id);
        if (!$role) {
            return redirect()
                    ->route('roles.index')
                    ->with('error', "Falha ao encontrar perfil com id <b>{$role->id}</b>");
        }
        
        
        if ($role->update($dataForm)) {
            return redirect()
                    ->route('roles.index')
                    ->with('success', "Perfil <b>{$role->label}</b> atualizado com sucesso!");
        }
        
        return redirect()->back()->with('error', 'Falha ao atualizar perfil!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $role = Role::find($id);
        
        if (!$role) {
            return redirect()
                        ->route('roles.index')
                        ->with('error', "Falha ao encontrar perfil com id <b>{$role->id}</b>");
        }
        
        if ($role->delete($id)) {
            return redirect()
                        ->route('roles.index')
                        ->with('success', "O perfil <b>{$role->label}</b> foi deletado com sucesso!");
        }
        
        return redirect()->back()->with('error', "Falha ao deletar perfil!");
    }
    
    
    public function permissions($id)
    {
        $role = Role::find($id);
        
        // usa o Redis para cachear as consultas
        $permissions_role = Cache::remember('permissions_role', 5, function() use($role) {
            return $role->permissions()->pluck('permissions.id');
        });
        
        // usa o Redis para cachear as consultas
        $permissions = Cache::remember('permissions', 5, function() {
            return Permission::ofType('permissions')->orderBy('id', 'asc')->get();
        });
        
        // usa o Redis para cachear as consultas
        $users_permissions = Cache::remember('users_permissions', 5, function() {
            return Permission::ofType('users')->orderBy('id', 'asc')->get();
        });
        
        // usa o Redis para cachear as consultas
        $roles_permissions = Cache::remember('roles_permissions', 5, function() {
            return Permission::ofType('roles')->orderBy('id', 'asc')->get();
        });
        
        // usa o Redis para cachear as consultas
        $posts_permissions = Cache::remember('posts_permissions', 5, function() {
            return Permission::ofType('posts')->orderBy('id', 'asc')->get();
        });
        
        
        
        return view('panel.role.permissions', compact('role', 'permissions', 'users_permissions', 
            'roles_permissions', 'posts_permissions', 'permissions_role'));
    }
    
    public function savePermissions(Request $request, $id)
    {
        //dd($request->all());        
        
        $role = Role::find($id);
        if (!$role) {
            return redirect()->route('roles.index')
                        ->with('error', "Falha ao encontrar perfil com id <b>{$role->id}</b>");
        }
        
        
        if ($role->permissions()->sync($request->get('role_permissions', []))) {
            return redirect()->route('roles.index')
                        ->with('success', "Permissões do Perfil <b>{$role->label}</b> foi atualizado com sucesso!");
        }
        
        return redirect()->back()->with('error', 'Falha ao atualizar perfil!');
    }
}
