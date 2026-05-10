<?php

namespace App\Http\Controllers;

use App\Models\SchoolProfile;
use App\Models\Article;
use App\Models\Gallery;
use App\Models\Message;
use Illuminate\Http\Request;

class FrontController extends Controller
{
    public function index()
    {
        // Mengambil data profil tunggal
        $profile = SchoolProfile::first();
        
        // Mengambil 1 berita terbaru sebagai Headline
        $headline = Article::where('is_published', true)->latest()->first();
        
        // Mengambil 4 berita selanjutnya untuk list di samping headline
        $articles = Article::where('is_published', true)
                            ->when($headline, function($query) use ($headline) {
                                return $query->where('id', '!=', $headline->id);
                            })
                            ->latest()->take(4)->get();
                            
        // Mengambil 6 galeri terbaru
        $galleries = Gallery::latest()->take(6)->get();

        return view('frontend.index', compact('profile', 'headline', 'articles', 'galleries'));
    }

    public function storeMessage(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'contact' => 'required|string|max:255',
            'content' => 'required|string',
        ]);

        Message::create($request->all());

        return redirect(url()->previous() . '#kontak')->with('success', 'Pesan Anda berhasil dikirim! Kami akan segera menghubungi Anda.');
    }

    public function showArticle($slug)
    {
        $profile = SchoolProfile::first();
        $article = Article::where('slug', $slug)->where('is_published', true)->firstOrFail();

        // Increment views
        $article->increment('views');

        return view('frontend.article', compact('profile', 'article'));
    }
}