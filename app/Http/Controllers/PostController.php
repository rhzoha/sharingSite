<?php

namespace App\Http\Controllers;

use App\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $posts = Post::all();
        return view('home', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $request->validate([
            'title'=>'required',
            'body'=>'required',
            'url' => 'image|mimes:jpeg,png,jpg,gif,svg',
        ]);

        $user = Auth::user();
        
        if(request()->url){
            $storyName = $user->id.'_story'.time().'.'.request()->url->getClientOriginalExtension();
            $request->url->storeAs('img/story',$storyName);
        } else {
            $storyName = 'demo.png';
        }

        $data = $request->all();
        $data['user_id'] = auth()->user()->id;
        $data['url'] = $storyName;
    
        Post::create($data);
    
        return redirect()->route('home');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $post = Post::findOrFail($id);

        return view('story.index', ['post' => $post]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $post = Post::findOrFail($id);

        return view('story.edit', ['post' => $post]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        //
        $request->validate([
            'title'=>'required',
            'body'=>'required'
        ]);

        $user = Auth::user();
        
        // if(request()->url){
        //     $storyName = $user->id.'_story'.time().'.'.request()->url->getClientOriginalExtension();
        //     $request->url->storeAs('img/story',$storyName);
        // } else {
        //     $post->url = DB::table('posts')->where('id', '=', $post->id)->get('url');
        // }

        $post->title = $request->title;
        $post->body = $request->body;
        
    
        $post->save();
    
        return redirect()->route('post.show', $post->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        //
        $post->delete();

        return redirect()->route('post.index');
    }

    public function search(Request $request)
    {
        $search = $request->get('search');
        $posts = DB::table('posts')->where('title', 'like', '%'.$search.'%')->orWhere('body', 'like', '%'.$search.'%')->get();

        return view('search.index')->with(['posts'=>$posts]);
    }
}
