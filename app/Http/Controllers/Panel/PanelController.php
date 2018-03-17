<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use App\Models\Permission;
use App\Models\Post;
use App\Models\Role;
use App\Models\User;

class PanelController extends Controller
{
    public function index()
    {
        $totalUsers        = User::count(); 
        $totalPosts        = Post::count();
        $totalRoles        = Role::count();
        $totalPermissions  = Permission::count();
        
        return view('panel.home.index', compact('totalUsers', 'totalPosts', 'totalRoles', 'totalPermissions'));
    }
}
