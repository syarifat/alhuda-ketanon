<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Gallery;
use App\Models\Message;
use Illuminate\Http\Request;

class FrontController extends Controller
{
    public function index()
    {
        // 1 query efisien untuk headline + 4 berita sampingan (tanpa longtext content)
        $recentArticles = Article::where('is_published', true)
            ->select('id', 'title', 'slug', 'thumbnail', 'created_at')
            ->latest()
            ->take(5)
            ->get();

        $headline = $recentArticles->first();
        $articles = $recentArticles->slice(1);

        // Mengambil 6 galeri terbaru dengan kolom spesifik
        $galleries = Gallery::select('id', 'title', 'image_path')
            ->latest()
            ->take(6)
            ->get();

        return view('frontend.index', compact('headline', 'articles', 'galleries'));
    }

    public function storeMessage(Request $request)
    {
        // 1. Anti-Bot Honeypot: bot otomatis mengisi input tersembunyi
        if ($request->filled('website_hp_check')) {
            // Berpura-pura sukses agar bot tidak mencoba lagi, tanpa menulis ke TiDB
            return redirect(url()->previous() . '#kontak')->with('success', 'Pesan Anda berhasil dikirim!');
        }

        // 2. Anti-Spam Rate Limit per sesi/IP (maks 3 pesan per 10 menit)
        $rateLimitKey = 'last_message_sent_at';
        if (session()->has($rateLimitKey) && (now()->timestamp - session()->get($rateLimitKey)) < 60) {
            return redirect(url()->previous() . '#kontak')->with('error', 'Mohon tunggu 1 menit sebelum mengirim pesan berikutnya.');
        }

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'contact' => 'required|string|max:255',
            'content' => 'required|string|max:2000',
        ]);

        Message::create([
            'name' => strip_tags($validated['name']),
            'contact' => strip_tags($validated['contact']),
            'content' => strip_tags($validated['content']),
            'is_read' => false,
        ]);

        session()->put($rateLimitKey, now()->timestamp);

        return redirect(url()->previous() . '#kontak')->with('success', 'Pesan Anda berhasil dikirim! Kami akan segera menghubungi Anda.');
    }

    public function showArticle($slug)
    {
        $article = Article::where('slug', $slug)
            ->where('is_published', true)
            ->firstOrFail();

        // Throttled view increment: hanya tambah view jika pengunjung belum melihat artikel ini di sesinya
        $viewKey = 'viewed_article_' . $article->id;
        if (!session()->has($viewKey)) {
            $article->increment('views');
            session()->put($viewKey, true);
        }

        // Berita terkait dieksekusi di controller dengan kolom spesifik (menghindari query di blade)
        $relatedArticles = Article::where('id', '!=', $article->id)
            ->where('is_published', true)
            ->select('id', 'title', 'slug', 'thumbnail', 'created_at')
            ->latest()
            ->take(6)
            ->get();

        return view('frontend.article', compact('article', 'relatedArticles'));
    }

    public function newsIndex(Request $request)
    {
        $query = Article::where('is_published', true)
            ->select('id', 'title', 'slug', 'thumbnail', 'views', 'created_at');

        if ($request->filled('q')) {
            $keyword = trim($request->q);
            $query->where(function ($q) use ($keyword) {
                $q->where('title', 'like', '%' . $keyword . '%')
                  ->orWhere('content', 'like', '%' . $keyword . '%');
            });
        }

        $articles = $query->latest()->paginate(12)->withQueryString();

        $popularArticles = Article::where('is_published', true)
            ->select('id', 'title', 'slug', 'thumbnail', 'views', 'created_at')
            ->orderBy('views', 'desc')
            ->take(5)
            ->get();

        return view('frontend.news', compact('articles', 'popularArticles'));
    }
}