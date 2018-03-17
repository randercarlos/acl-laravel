<?php

Auth::routes();
Route::get('/', 'Site\\SiteController@index')->name('site.index');
Route::get('/posts', 'Site\\SiteController@posts')->name('site.posts');

Route::group(['prefix' => 'panel', 'namespace' => 'Panel', 'middleware' => ['auth:web']], function(){
    Route::resource('/posts', 'PostController');
    
    // Roles
    Route::resource('/roles', 'RoleController', ['except' => ['show']]);   
    Route::get('/roles/{id}/permissions', 'RoleController@permissions')->name('role.permissions');   
    Route::post('/roles/{id}/permissions/save', 'RoleController@savePermissions')->name('role.savePermissions');   
    
    // Permissions
    Route::resource('/permissions', 'PermissionController', ['only' => ['index', 'show', 'edit', 'update' ] ]);
    Route::get('/permissions/{id}/roles', 'PermissionController@roles')->name('permission.roles');
    
    Route::resource('/users', 'UserController', ['except' => ['show']]);        
    Route::get('/users/{id}/roles', 'UserController@roles')->name('user.roles');        
    
    Route::get('/', 'PanelController@index')->name('panel.index');
});



//Route::get('/home', 'HomeController@index')->name('home');
