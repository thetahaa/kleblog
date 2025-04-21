<?php

namespace App\Http\Controllers;

use App\Http\Resources\PostResource;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class PostController extends Controller
{
    public function index(Request $request)
    {
        // Sorguyu doğru şekilde oluşturma
        $query = Post::published()
            ->with(['categories', 'tags', 'comments.user'])
            ->withCount(['comments' => fn($q) => $q->where('status', true)]);

        // Kategori Filtresi (Collection değil Query üzerinde)
        if ($request->category) {
            $query->whereHas('categories', fn($q) => $q->where('slug', $request->category));
        }

        // Etiket Filtresi
        if ($request->tag) {
            $query->whereHas('tags', fn($q) => $q->where('slug', $request->tag));
        }

        // Sıralama Mantığı
        $query->when($request->has('filter'), function($q) use ($request) {
            $request->filter === 'popüler' 
                ? $q->orderByDesc('comments_count')
                : $q->latest();
        }, function($q) {
            $q->latest();
        });

        // Sorguyu çalıştırma (pagination YOK)
        $posts = $query->get();

        return response()->json([
            'data' => $posts,
            'message' => 'Postlar başarıyla getirildi'
        ]);
    }

    public function show($id)  
    {  
        try {
            $posts = Post::published()  
                ->with(['categories', 'tags', 'comments.user'])  
                ->findOrFail($id);  

            return response()->json([  
                'data' => $posts,  
                'message' => 'Post başarıyla getirildi',  
            ], 200);  

        } catch (ModelNotFoundException $e) {  
            return response()->json([  
                'error' => 'Post bulunamadı',  
                'debug_id' => 'POST_404_' . $id  
            ], 404);  
        }  
    }  

}
