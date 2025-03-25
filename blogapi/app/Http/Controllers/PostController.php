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
        
        $posts = Post::with('categories', 'tags', 'comments.user')->get()->toArray();;
        $posts = Post::where('status',true)->latest()->get();

        return response()->json($posts);
    }

    public function show($id)
    {
        $posts = Post::with(['categories', 'tags', 'comments.user'])->findOrFail($id)->toArray();;
        return response()->json($posts);
    }

}