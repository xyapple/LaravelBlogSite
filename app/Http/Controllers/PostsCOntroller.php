<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
use App\Post;
use Session;

class PostsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //only fetech the post is not SoftDeleted
        return view('admin.posts.index')->with('posts', Post::all());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $categories = Category::all();
        if($categories->count()==0)
        {
            Session::flash('info','You must have categories before creating a post.');
            return redirect()->back();
        }
        return view('admin.posts.create')->with('categories', Category::all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //dd($request->all());

         $this->validate($request, [
            'title'=>'required',
            'featured'=>'required|image',
            'content'=>'required',
            'category_id'=>'required'
        ]);
        //handle image upload
        $featured=$request->featured;

        $featured_new_name = time().$featured->getClientOriginalName();
        $featured->move('uploads/posts', $featured_new_name);

        $post = Post::create([

            'title' => $request->title,
            'content' => $request->content,
            'featured' => 'uploads/posts/' . $featured_new_name,
            'category_id' => $request->category_id,
            // create a new post ->create-a-new-post
            'slug'=>str_slug($request->title),
        ]);

        Session::flash('success', 'Post created succesfully.');

        return redirect()->back();

        //dd($request->all());
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
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
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
        //
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
        $post = Post::find($id);
        $post->delete();
        Session::flash('success','You had trashed a Post.');
        return redirect()->route('posts');

    }
    public function trashed()
    {
        //
         $posts = Post::onlyTrashed()->get();
         //dd($posts);
        return view('admin.posts.trashed')->with('posts', $posts);
    }
    public function kill($id)
    {
        //
        $post = Post::withTrashed()->where('id', $id)->first();
        $post->forceDelete();
        Session::flash('success','Post deleted permanently.');
        return redirect()->back();

    }
}
