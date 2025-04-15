<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Jobs\SendCommentNotificationToAdmin;
class CommentController extends Controller
{
    public function index()
    {
        $comments = Comment::all();
        $comments = Comment::where('status',true)->latest()->get();

    }

    public function store(Request $request, Post $posts)
    {
        $request->validate([
            'content' => 'required|string|min:3',
            'post_id' => 'required|exists:posts,id',
        ]);

        $comment = Comment::create([
            'post_id' => $request->post_id,
            'status'  => false,
            'user_id' => $request->user()->id,
            'content' => $request->content, 
        ]);

        dispatch(new SendCommentNotificationToAdmin($comment));

        return redirect()->route('post.show', $posts->id)
        ->with('success', 'Yorum eklendi!');

        dispatch(new SendCommentNotificationToAdmin($comment));

        return response()->json([
            'success' => true,
            'message' => 'Yorum gönderildi , adminlere bilgi iletildi onaylandıktan sonra sayfa üzerinde gösterilecektir.',
            'comment' => $comments
        ], 201);
    }

}