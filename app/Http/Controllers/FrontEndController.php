<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Tag;
use App\Post;
use App\Settings;
use App\Category;

class FrontEndController extends Controller
{
    //
    public function index()
    {
        return view('index')
              ->with('title', Settings::first()->site_name)
              ->with('categories', Category::take(10)->get())
              ->with('first_post', Post::orderBy('created_at', 'desc')->first())
              ->with('second_post', Post::orderBy('created_at', 'desc')->skip(1)->take(1)->get()->first())
              ->with('third_post', Post::orderBy('created_at', 'desc')->skip(2)->take(1)->get()->first())
              ->with('Programming', Category::find(1))
              ->with('Machine_Learning', Category::find(2))
              ->with('Travel', Category::find(3))
              ->with('Photography',Category::find(4))
              ->with('Food',Category::find(5))
              ->with('settings', Settings::first());
    }

    public function singlePost($slug)
    {
        $post = Post::where('slug', $slug)->first();

        $next_id = Post::where('id', '>', $post->id)->min('id');
        $prev_id = Post::where('id', '<', $post->id)->max('id');
        
        return view('single')->with('post', $post)
                            ->with('title', $post->title)
                            ->with('settings', Settings::first())
                            ->with('categories', Category::take(5)->get())
                            ->with('next', Post::find($next_id))
                            ->with('prev', Post::find($prev_id))
                            ->with('tags', Tag::all());
    }

    public function category($id)
    {
        $category = Category::find($id);

        return view('category')->with('category', $category)
                               ->with('title', $category->name)
                               ->with('settings', Settings::first())
                               ->with('categories', Category::take(5)->get());
    }

     public function tag($id)
    {
        $tag = Tag::find($id);

        return view('tag')->with('tag', $tag)
                               ->with('title', $tag->tag)
                               ->with('settings', Settings::first())
                               ->with('categories', Category::take(5)->get());
    }


}
