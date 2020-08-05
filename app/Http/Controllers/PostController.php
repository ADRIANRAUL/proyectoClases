<?php

namespace App\Http\Controllers;

use App\Post;
use App\User;
use Auth;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function layout(){

/*         if( !Auth::user()->isAdmin() ){
            return response()->json(['data'=>'Acceso no autorizado']);
        } */

        return view('posts');
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::with(['users:id'])->get();
        return response()->json(['data'=>$posts]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validation = $request->validate([
            'name' => 'required|string|max:150',
            'content' => 'required|string'
        ]);

        $post = new Post();
        $post->name = $request->name;
        $post->content = $request->content;

        $user = User::find($post->user_id);
        $post->user()->associate($user);
        $post->save();

        return ['status'=>'registro agregado exitosamente'];
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
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validation = $request->validate([
            'name' => 'required|string|max:150',
            'content' => 'required|string'
        ]);

        $post = Post::findOrFail($id);

        $post->name = $request->name;
        $post->content = $request->content;

        $user = User::find($post->user_id);

        $post->user()->dissociate($user);
        $post->user()->associate($user);

        $post->save();
        return ['status'=>'registro editado exitosamente'];
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = Post::findOrFail($id);
        $post->delete();

        return ['status'=>'registro eliminado exitosamente'];
    }
}
