<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Role extends Model 
{
    protected $fillable = ['name', 'label', 'description'];
    
    public function permissions()
    {
        return $this->belongsToMany(Permission::class, 'permissions_roles');
    }
    
    public function getAllRoles()
    {
        $roles = $this->where(function($query)  {
            
            // somente usuários com perfil admin podem atribuir o perfil admin a outros usuários
            if (!auth()->user()->hasAnyRoles('admin')) {
                $query->where('name', '<>', 'admin');
            }
            
        })->orderBy('label')->pluck('label', 'id');
        
        return $roles;
    }
    
}
