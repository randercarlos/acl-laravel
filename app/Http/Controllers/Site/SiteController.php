<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class SiteController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Post $post)
    {
        return redirect()->route('panel.index');
    }
    
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function posts()
    {
        $posts = Post::with('user')->get();
        
        return view('site.home', compact('posts'));
    }
    
    public function update($id_post)
    {
        $post = Post::with('user')->find($id_post);
        
        //$this->authorize('update', $post);
        if (Gate::denies('update', $post)) {
        //if (auth()->user()->can('update', Post::class)) {
            abort(403, 'Unathorized');
        }
        
        return view('post-form', compact('post'));
    }
    
    public function rolesPermission()
    {
        echo '<h1>' . auth()->user()->name . '</h1>';
        foreach(auth()->user()->roles as $role) {
            echo $role->name . ' -> ';
            
            $permissions = $role->permissions;
            foreach($permissions as $permission) {
                echo $permission->name . ', ';
            }
            
            echo '<hr />';
        }
    }
}
