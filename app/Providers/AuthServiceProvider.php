<?php

namespace App\Providers;

use App\Models\Permission;
use App\Models\User;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Schema;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        //Post::class => PostPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot(Permission $permission)
    {
        $this->registerPolicies();
    
        
        // verifica se a tabela existi antes de ativar as permissões
        // corrige o erro da tabela permissions não existir ao rodar as migrations no banco de dados vazio
        if(Schema::hasTable($permission->getTable())) {
            
            $permissions = Permission::with('roles')->get();
            
            foreach ($permissions as $permission) {
                
                Gate::define($permission->name, function(User $user) use ($permission) {
                    return $user->hasPermission($permission);
                });
                
            }
            
            
            Gate::before(function(User $user) {
                  
                if ($user->hasAnyRoles('admin')) {
                    return true;
                }
                
            });
            
        }
    }
}
