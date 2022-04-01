<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::paginate(10);
        // $posts = auth()->user()->posts;
        return view('admin.posts.index' , compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('admin.posts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $input = $request->validate([
            'title' => 'required | min:5 | max:225',
            'post_image' => 'file',
            'body' => 'required'
        ]);

        if(request('post_image')){
            // $img = $request->post_image;
            $input['post_image'] = $request->file('post_image')->store('public/images');
        }
        $post = new Post($input);
        $post->user_id = auth()->user()->id;

        $post->save();

        Session::flash('post-created-message' , 'Post Has created');

        return redirect()->route('post.index');



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
        $post = Post::find($id);
        return view('blog-post' , compact('post'));
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

        return view('admin.posts.edit' , compact('post'));
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
        $input = $request->validate([
            'title' => 'required | min:5 | max:225',
            'post_image' => 'file',
            'body' => 'required'
        ]);
        $post = Post::find($id);

        if(request('post_image')){
            $input['post_image'] = $request->post_image->store('public/images');
            $post->post_image = $input['post_image'];
        }

        $post->title = $request->title;
        $post->body = $request->body;

        $this->authorize('update' , $post);

        $post->save();

        Session::flash('post-updated-message' , 'Post Updated');

        return redirect()->route('post.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $post = Post::findorfail($id);
        $post->delete();

        Session::flash('message' , 'Post Has been Deleted');
        return back();
    }
}
