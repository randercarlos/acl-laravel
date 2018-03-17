<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Traits\Authorizable;

class User extends Authenticatable
{
    use Notifiable, Authorizable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
    
    
    /*
     * Acessor for CreatedAt column from users table  
     * 
     * Get CreatedAt date column in brazilian format
     */
    public function getCreatedAtAttribute($value)
    {
        if (is_null($value)) {
            return '-';
        }
        return \Carbon\Carbon::parse($value)->format('d/m/Y H:i:s');
    }
    
    /*
     * Acessor for UpdatedAt column from users table
     *
     * Get UpdatedAt date column in brazilian format
     */
    public function getUpdatedAtAttribute($value)
    {
        if (is_null($value)) {
            return '-';
        }
        
        return \Carbon\Carbon::parse($value)->format('d/m/Y H:i:s');
    }
    
    // atribui bcrypt ao password
    public function setPasswordAttribute($password)
    {
        $this->attributes['password'] = bcrypt($password);
    }
    
    
    public function roles()
    {
        return $this->belongsToMany(Role::class, 'roles_users');
    }
    
    
    public function hasPermission(Permission $permission)
    {
        return $this->hasAnyRoles($permission->roles);
    }
    
    
    public function hasAnyRoles($roles)
    {
        // se $roles for array ou objeto, verifica todas as roles que está no array
        if (is_array($roles) || is_object($roles)) {
            foreach ($roles as $role) {
                if ($this->roles->contains('name', $role->name)) {
                    return true;
                }
            }
        } 
        
        // se $roles for uma string, verifica direto no array de roles 
        return $this->roles->contains('name', $roles);
    }
    
}
