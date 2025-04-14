<?php

namespace App\Http\Controllers;

use App\Http\Resources\PostResource;
use App\Models\Post;
use App\Models\Category;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Http;

class PostController extends Controller
{
    public function index(Request $request)
    {
        $query = Post::where('status', true)
            ->with(['categories', 'tags', 'comments.user'])
            ->withCount(['comments' => fn($q) => $q->where('status', true)]);

        // Kategori Filtresi
        if ($request->category) {
            $query->whereHas('categories', fn($q) => $q->where('slug', $request->category));
        }

        // Etiket Filtresi
        if ($request->tag) {
            $query->whereHas('tags', fn($q) => $q->where('slug', $request->tag));
        }

        // Popüler/Yeni Filtresi
        $query->when($request->has('filter'), function($q) use ($request) {
            $request->filter === 'popüler' 
                ? $q->orderByDesc('comments_count')
                : $q->latest();
        }, function($q) {
            $q->latest();
        });

        return response()->json([
            'success' => true,
            'data' => $query->get()
        ]);
    }

    public function show($id)
    {
        $posts = Post::with(['categories', 'tags', 'comments.user'])->findOrFail($id)->toArray();;
        return response()->json($posts);
    }

}