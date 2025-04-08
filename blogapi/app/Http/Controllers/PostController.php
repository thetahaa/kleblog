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
        $posts = Post::where('status', true);

        $posts->with(['categories','tags','comments' => function($query) {
                $query->where('status', true)->with('user');
            }
        ]);

        $posts->withCount(['comments' => function($query) {
            $query->where('status', true);
        }]);

        if($request->has('filter')) {
            if($request->filter == 'popüler') {
                $posts = $posts->orderBy('comments_count', 'desc')->get();
                return response()->json($posts);
            } else {
                $posts->latest();
            }
        } else {
            $posts->latest();
        }

        $posts = $posts->get();
        return response()->json($posts);
    }

    public function show($id)
    {
        $posts = Post::with(['categories', 'tags', 'comments.user'])->findOrFail($id)->toArray();;
        return response()->json($posts);
    }

}