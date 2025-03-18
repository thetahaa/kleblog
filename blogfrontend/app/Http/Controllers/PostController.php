<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Category;
use App\Models\Tag;
use Illuminate\Contracts\Pagination\Paginator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Pagination\LengthAwarePaginator;

class PostController extends Controller
{
    public function index(Request $request)
    {
        $token = session('token');
        if (!$token) {
            return redirect('/')->with('error', 'Lütfen giriş yapınız.');
        }
        $response = Http::timeout(1000)->withToken($token)->get('http://api_nginx/api/posts');
        $posts = $response->json();

        if (empty($posts)) {
            return view('post.index')->with('error', 'Veriler alınamadı.');
        }

        return view('post.index', compact('posts'));
    }
    
}
