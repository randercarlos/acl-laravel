<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use App\Http\Requests\PostFormRequest;
use App\Models\Post;
use App\Traits\Authorizable;

class PostController extends Controller
{
    use Authorizable;
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::with('user')->get();
        
        return view('panel.post.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('panel.post.form');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PostFormRequest $request, Post $post)
    {
        // recupera os dados do form e popula o objeto post
        $post->fill($request->except('_token'));
        
        // atribui o usuário logado ao autor do post
        $post->user_id = auth()->user()->id;
        
        if ($post->save()) {
            return redirect()
                        ->route('posts.index')
                        ->with('success', "Post <b>\"{$post->title}\"</b> cadastrado com sucesso!");
        }
        
        return redirect()->back()->with('error', 'Falha ao cadastrar post!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $post = Post::with('user')->find($id);
        
        if (!$post) {
            return redirect()->back()->with('error', "Falha ao encontrar post com id <b>{$post->id}</b>");
        }
        
        return view('panel.post.show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post = Post::find($id);
        if (!$post) {
            return redirect()->back()->with('error', "Falha ao encontrar post com id <b>{$post->id}</b>");
        }
        
        return view('panel.post.form', compact('post'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PostFormRequest $request, $id)
    {
        // recupera os dados do form
        $dataForm = $request->except(['_token', '_method']);
        
        $post = Post::find($id);
        if (!$post) {
            return redirect()
                    ->route('posts.index')
                    ->with('error', "Falha ao encontrar post com id <b>{$post->id}</b>");
        }
        
        
        if ($post->update($dataForm)) {
            return redirect()
                    ->route('posts.index')
                    ->with('success', "Post <b>\"{$post->title}\"</b> atualizado com sucesso!");
        }
        
        return redirect()->back()->with('error', 'Falha ao atualizar post!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = Post::find($id);
        
        
        if (!$post) {
            return redirect()
                        ->route('posts.index')
                        ->with('error', "Falha ao encontrar post com id <b>{$post->id}</b>");
        }
        
        
        if ($post->delete($id)) {
            return redirect()
                        ->route('posts.index')
                        ->with('success', "O post <b>\"{$post->title}\"</b> foi deletado com sucesso!");
        }
        
        return redirect()->back()->with('error', "Falha ao deletar post!");
    }
}
