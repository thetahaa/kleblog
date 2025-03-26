<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Comment;
use Illuminate\Support\Facades\Http;

class CommentController extends Controller
{
    public function index($id, Request $request)
    {
        $token = session('token');
        if (!$token) {
            return redirect('/')->with('error', 'Lütfen giriş yapınız.');
        }
        $response = Http::withToken($token)->get("http://api_nginx/api/posts/{$id}/comments");
        $comments = $response->json();
        
        if (empty($comments)) {
            return view('post.show')->with('error', 'Veriler alınamadı.');
        }
        
        return view('post.show', compact('posts', 'comments'));
    }

    public function store($id, Request $request)
    {
        $token = session('token');
        if (!$token) {
            return redirect('/')->with('error', 'Lütfen giriş yapınız.');
        }

        $response = Http::withToken($token)->post(
            "http://api_nginx/api/posts/{$id}/comments",
            [
                'content' => $request->input('content'),
                'post_id' => $id
            ]
            
        );
        if ($response->successful()) {
            return redirect()->back()->with('success', 'Yorumunuz başarıyla eklendi!');
        } else {
            return redirect()->back()->with('error', 'Yorum eklenirken bir hata oluştu.');
        }
    }

}