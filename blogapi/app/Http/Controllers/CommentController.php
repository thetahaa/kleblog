<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function index(Request $request, Post $posts)
    {
        $comments = Comment::all();
        return response()->json($comments);
    }

    public function store(Request $request, Post $posts)
    {
        $validated = $request->validate([
            'content' => 'required|string|max:1000'
        ]);

        $comments = new Comment();
        $comments->content = $validated['content'];
        $comments->user_id = Auth::id();
        $comments->post_id = $posts->id;
        $comments->save();

        return response()->json([
            'success' => true,
            'message' => 'Yorumunuz başarıyla eklendi!',
            'comment' => $comments
        ], 201);
    }

}