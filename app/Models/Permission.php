<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    protected $fillable = ['label'];

    public function roles()
    {
        return $this->belongsToMany(Role::class, 'permissions_roles');
    }

    /**
     * Scope a query to only include permissions of a given type.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @param mixed $type
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeOfType($query, $type)
    {
        return $query->where('model', $type);
    }

    public static function defaultPermissions()
    {
        return [

            ['name' => 'view_users', 'label' => 'Visualizar Usuários', 'model' => 'users'],
            ['name' => 'add_users', 'label' => 'Cadastrar Usuários', 'model' => 'users'],
            ['name' => 'edit_users', 'label' => 'Alterar Usuários', 'model' => 'users'],
            ['name' => 'delete_users', 'label' => 'Excluir Usuários', 'model' => 'users'],


            ['name' => 'view_roles', 'label' => 'Visualizar Perfis', 'model' => 'roles'],
            ['name' => 'add_roles', 'label' => 'Cadastrar Perfis', 'model' => 'roles'],
            ['name' => 'edit_roles', 'label' => 'Alterar Perfis', 'model' => 'roles'],
            ['name' => 'delete_roles', 'label' => 'Excluir Perfis', 'model' => 'roles'],


            ['name' => 'view_permissions', 'label' => 'Visualizar Permissões', 'model' => 'permissions'],
            ['name' => 'add_permissions', 'label' => 'Cadastrar Permissões', 'model' => 'permissions'],
            ['name' => 'edit_permissions', 'label' => 'Alterar Permissões', 'model' => 'permissions'],
            ['name' => 'delete_permissions', 'label' => 'Excluir Permissões', 'model' => 'permissions'],

            ['name' => 'view_posts', 'label' => 'Visualizar Posts', 'model' => 'posts'],
            ['name' => 'add_posts', 'label' => 'Cadastrar Posts', 'model' => 'posts'],
            ['name' => 'edit_posts', 'label' => 'Alterar Posts', 'model' => 'posts'],
            ['name' => 'delete_posts', 'label' => 'Excluir Posts', 'model' => 'posts'],

        ];
    }
}
