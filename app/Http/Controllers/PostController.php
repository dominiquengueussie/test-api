<?php

namespace App\Http\Controllers;

use App\Models\Beat;
use App\Models\Like;
use App\Models\Post;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{

   

    public function store(Request $request)
{
    $user = Auth::user();

    $post = new Post();
    $post->slug = Str::slug($request->input('slug'));
    $post->content = $request->input('content');
    $post->user_id = $user->id;

    // Assurez-vous que le user_id est bien enregistré avec le post
    $post->save();

    return response()->json(['message' => 'Post created successfully']);
}




    public function likePost(Post $post)
    {
        $user = Auth::user();

        $like = new Like();
        $like->user_id = $user->id;

        $post->likes()->save($like);

        return response()->json(['message' => 'Post liked successfully']);
    }
}
