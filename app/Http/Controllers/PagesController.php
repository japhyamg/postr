<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;

class PagesController extends Controller
{
    public function index()
    {
        $posts = Post::orderBy('created_at','desc')->paginate(1);
        return view('welcome',compact('posts'));
    }

    public function show($slug)
    {
        $post = Post::where('slug',$slug)->first();
        return view('show',compact('post'));
    }
}
