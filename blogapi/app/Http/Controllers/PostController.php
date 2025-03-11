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
        $posts = Post::with('category', 'tags')->latest()->get();
        return view('posts.index', compact('posts'));
    }

    // Post Oluşturma Formunu Göster
    public function create()
    {
        $categories = Category::all();
        $tags = Tag::all();
        return view('posts.create', compact('categories', 'tags'));
    }

    // Yeni Postu Kaydet
    public function store(Request $request)
    {
        // Validation
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'image' => 'required',
            'category_id' => 'required|exists:categories,id',
            'tags' => 'array|exists:tags,id' // Etiketler checkbox ile geliyorsa
        ]);

        // Resmi Yükle ve Yolu Al
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('posts', 'public');
            $validated['image'] = $imagePath;
        }

        // Postu Oluştur
        $post = Post::create($validated);

        // Etiketleri Ekle (Many-to-Many ilişki)
        if ($request->has('tags')) {
            $post->tags()->attach($request->tags);
        }

        return redirect()->route('posts.index')->with('success', 'Post başarıyla oluşturuldu!');
    }

    // Postu Göster
    public function show(Post $post)
    {
        return view('posts.show', compact('post'));
    }

    // Post Düzenleme Formunu Göster
    public function edit(Post $post)
    {
        $categories = Category::all();
        $tags = Tag::all();
        return view('posts.edit', compact('post', 'categories', 'tags'));
    }

    // Postu Güncelle
    public function update(Request $request, Post $post)
    {
        // Validation
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'category_id' => 'required|exists:categories,id',
            'tags' => 'array|exists:tags,id'
        ]);

        // Yeni Resmi Yükle ve Eski Resmi Sil
        if ($request->hasFile('image')) {
            // Eski resmi sil
            if ($post->image) {
                Storage::disk('public')->delete($post->image);
            }
            // Yeni resmi kaydet
            $imagePath = $request->file('image')->store('posts', 'public');
            $validated['image'] = $imagePath;
        }

        // Postu Güncelle
        $post->update($validated);

        // Etiketleri Senkronize Et
        if ($request->has('tags')) {
            $post->tags()->sync($request->tags);
        } else {
            $post->tags()->detach();
        }

        return redirect()->route('posts.index')->with('success', 'Post başarıyla güncellendi!');
    }

    // Postu Sil
    public function destroy(Post $post)
    {
        // Resmi sil
        if ($post->image) {
            Storage::disk('public')->delete($post->image);
        }

        $post->delete();
        return redirect()->route('posts.index')->with('success', 'Post başarıyla silindi!');
    }
}
