<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{

    public function store(Request $request, Post $posts)
    {
        $request->validate([
            'content' => 'required|string|min:3',
            'post_id' => 'required|exists:posts,id',
        ]);

        Comment::create([
            'post_id' => $request->post_id,
            'status'  => false,
            'user_id' => $request->user()->id,
            'content' => $request->content, 
        ]);

        return redirect()->route('post.show', $posts->id)
        ->with('success', 'Yorum eklendi!');

        return response()->json([
            'success' => true,
            'message' => 'Yorumunuz başarıyla eklendi!',
            'comment' => $comments
        ], 201);
    }

}