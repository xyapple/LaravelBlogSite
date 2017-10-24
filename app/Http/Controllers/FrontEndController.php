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
              ->with('categories', Category::take(5)->get())
              ->with('first_post', Post::orderBy('created_at', 'desc')->first())
              ->with('second_post', Post::orderBy('created_at', 'desc')->skip(1)->take(1)->get()->first())
              ->with('third_post', Post::orderBy('created_at', 'desc')->skip(2)->take(1)->get()->first())
              ->with('career', Category::find(7))
              ->with('tutorials', Category::find(6))
              ->with('settings', Settings::first());
    }
}
