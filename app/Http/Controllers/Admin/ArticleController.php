<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Article;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class ArticleController extends Controller
{
    public function index()
    {
        $articles = Article::latest()->paginate(10);
        return view('admin.articles.index', compact('articles'));
    }

    public function create()
    {
        return view('admin.articles.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|max:255',
            'content' => 'required',
            'thumbnail' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $path = null;
        if ($request->hasFile('thumbnail')) {
            // Upload ke R2 di folder 'articles'
            $path = $request->file('thumbnail')->store('articles', 'r2');
        }

        Article::create([
            'title' => $request->title,
            'slug' => Str::slug($request->title) . '-' . Str::random(5),
            'content' => $request->content,
            'thumbnail' => $path,
            'is_published' => $request->has('is_published'),
        ]);

        return redirect()->route('admin.articles.index')->with('success', 'Berita berhasil diterbitkan!');
    }

    public function edit(Article $article)
    {
        return view('admin.articles.edit', compact('article'));
    }

    public function update(Request $request, Article $article)
    {
        $request->validate([
            'title' => 'required|max:255',
            'content' => 'required',
            'thumbnail' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $data = [
            'title' => $request->title,
            'slug' => Str::slug($request->title) . '-' . Str::random(2),
            'content' => $request->content,
            'is_published' => $request->has('is_published'),
        ];

        if ($request->hasFile('thumbnail')) {
            // Hapus foto lama dari R2 jika ada
            if ($article->thumbnail) {
                Storage::disk('r2')->delete($article->thumbnail);
            }
            // Upload foto baru
            $data['thumbnail'] = $request->file('thumbnail')->store('articles', 'r2');
        }

        $article->update($data);

        return redirect()->route('admin.articles.index')->with('success', 'Berita berhasil diperbarui!');
    }

    public function destroy(Article $article)
    {
        if ($article->thumbnail) {
            Storage::disk('r2')->delete($article->thumbnail);
        }
        
        $article->delete();
        return redirect()->route('admin.articles.index')->with('success', 'Berita telah dihapus.');
    }
}