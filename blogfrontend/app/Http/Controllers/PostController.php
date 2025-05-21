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
        try {
            $response = Http::withToken(session('token'))
                ->get('http://api_nginx/api/posts', [
                    'filter' => $request->filter,
                    'category' => $request->category,
                    'tag' => $request->tag
                ]);

            $data = $response->json();
            return view('post.index', [
                'posts' => $data['data'] ?? [],
                'error' => null
            ]);

        } catch (\Exception $e) {
            return view('post.index', [
                'posts' => [],
                'error' => $e->getMessage()
            ]);
        }
    }
    
    public function show($id)
    {
        try {
            $response = Http::timeout(1000)
                ->withToken(session('token'))
                ->get("http://api_nginx/api/posts/{$id}");

            if (!$response->successful()) {
                throw new \Exception('Post bulunamadı veya yetkiniz yok');
            }

            $responseData = $response->json();
            
            if (!isset($responseData['data'])) {
                throw new \Exception('Geçersiz veri formatı');
            }

            return view('post.show', [
                'posts' => $responseData['data']
            ]);

        } catch (\Exception $e) {
            return redirect()->route('post.index')->withErrors($e->getMessage());
        }
    }
    
}