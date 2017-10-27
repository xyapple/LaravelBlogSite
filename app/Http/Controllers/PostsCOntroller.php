<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
use App\Post;
use Session;
use App\Tag;
use Auth;
use File;

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
        $tags = Tag::all();

        if($categories->count() == 0 || $tags->count() == 0)
        {
            Session::flash('info','You must have categories or tags before creating a post.');
            return redirect()->back();
        }
        return view('admin.posts.create')->with('categories', Category::all())
                                        
                                         ->with('tags', Tag::all());
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
            'category_id'=>'required',
             'tags' => 'required'
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
            'user_id' => Auth::id(),
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
        $post= Post::find($id);
        return view('admin.posts.edit')->with('post', $post)
                                      ->with('categories', Category::all())
                                      ->with('tags', Tag::all());

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
        $this->validate($request, [
           'title' => 'required',
           'content' => 'required',
           'category_id' => 'required',

       ]);
        $post = Post::find($id);
        if($request->hasFile('featured'))
        {
            $featured = $request->featured;
            $featured_new_name = time() . $featured->getClientOriginalName();
            $featured->move('uploads/posts', $featured_new_name);
            $post->featured = 'uploads/posts/'.$featured_new_name;

        }
        $post->title = $request->title;
        $post->content = $request->content;
        $post->category_id = $request->category_id;

        $post->save();

         $post->tags()->sync($request->tags);

        Session::flash('success', 'Post updated successfully.');
        return redirect()->route('posts');

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
        File::delete($post->featured);
        Session::flash('info','Post deleted permanently.');
        return redirect()->back();

    }
    public function restore($id)
    {
        $post = Post::withTrashed()->where('id', $id)->first();
        $post->restore();
        Session::flash('success','Post restored successfully.');
        return redirect()->route('posts');
    }
}
