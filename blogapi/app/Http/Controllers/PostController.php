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
    public function index()
    {
        $posts = Post::all();
        
        $posts = Post::with('categories', 'tags')->get();

        return response()->json($posts);
        return view('post.index', compact('posts'));
    }

    public function show($id)
    {
        $posts = Post::with(['categories', 'tags'])->findOrFail($id);
        return response()->json($posts);
    }

}
