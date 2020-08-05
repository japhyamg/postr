<?php

namespace App\Http\Controllers;

use App\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LikesController extends Controller
{
    public function store(Post $post)
    {
        if (Auth::check()) {
            // The user is logged in...
            auth()->user()->likepost()->toggle($post);
            return response()->json([
                'like_count' => $post->likes->count(),
                'status' => true,
            ]);
        }
        return response()->json([
            'status' => false
        ]);
    }
}
