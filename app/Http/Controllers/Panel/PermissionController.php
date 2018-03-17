<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use App\Http\Requests\PermissionFormRequest;
use App\Models\Permission;
use App\Traits\Authorizable;
use Illuminate\Http\Request;

class PermissionController extends Controller
{
    use Authorizable;
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $permissions = Permission::with('roles')->get();
        
        return view('panel.permission.index', compact('permissions'));
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
    public function edit($id)
    {
        $permission = Permission::find($id);
        
        if (!$permission) {
            return redirect()->back()->with('error', "Falha ao encontrar permissão com id <b>{$permission->id}</b>");
        }
        
        return view('panel.permission.form', compact('permission'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PermissionFormRequest $request, $id)
    {
        // recupera os dados do form
        $dataForm = $request->except(['_token', '_method']);
        
        $permission = Permission::find($id);
        if (!$permission) {
            return redirect()
                        ->route('permissions.index')
                        ->with('error', "Falha ao encontrar permissão com id <b>{$permission->id}</b>");
        }
        
        
        if ($permission->update($dataForm)) {
            return redirect()
                        ->route('permissions.index')
                        ->with('success', "Permissão <b>{$permission->label}</b> atualizada com sucesso!");
        }
        
        return redirect()->back()->with('error', 'Falha ao atualizar permissão!');
    }

    
    public function roles($id)
    {
        $permission = Permission::find($id);
        
        $roles = $permission->roles()->get();
        
        return view('panel.permission.roles', compact('permission', 'roles'));
    }
}
