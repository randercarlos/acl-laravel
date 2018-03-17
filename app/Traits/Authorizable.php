<?php

namespace App\Traits;

use Illuminate\Support\Facades\Request;

/*
 * Uma trait para manipular a autorização baseada nas permissões do usuário para 
 * um determinado controller
 */
trait Authorizable
{
    /**
     * Habilidades baseadas nos métodos default de controllers do tipo resource
     * 
     * método do controller resource => permissão necessária 
     * 
     * @var array
     */
    private $abilities = [
        'index' => 'view',
        'edit' => 'edit',
        'show' => 'view',
        'update' => 'edit',
        'create' => 'add',
        'store' => 'add',
        'destroy' => 'delete',
        
        /*
         *  permissões para os métodos do RoleController
         */
        'permissions' => 'edit',
        'savePermissions' => 'edit',
    ];

    /**
     * Sobrescreve o método callAction para permitir a autorização antes dele chamar a 
     * action do controller
     *
     * @param $method
     * @param $parameters
     * @return mixed
     */
    public function callAction($method, $parameters)
    {
        if( $ability = $this->getAbility($method) ) {
            $this->authorize($ability);
        }

        return parent::callAction($method, $parameters);
    }

    /**
     * Get ability
     *
     * @param $method
     * @return null|string
     */
    public function getAbility($method)
    {
        $routeName = explode('.', Request::route()->getName());
        $action = array_get($this->getAbilities(), $method);

        return $action ? $action . '_' . $routeName[0] : null;
    }

    /**
     * @return array
     */
    private function getAbilities()
    {
        return $this->abilities;
    }

    /**
     * @param array $abilities
     */
    public function setAbilities($abilities)
    {
        $this->abilities = $abilities;
    }
}