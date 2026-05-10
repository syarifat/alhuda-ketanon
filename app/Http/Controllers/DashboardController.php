<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Gallery;
use App\Models\Message;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'articles'       => Article::count(),
            'articles_pub'   => Article::where('is_published', true)->count(),
            'galleries'      => Gallery::count(),
            'messages'       => Message::count(),
            'messages_unread'=> Message::where('is_read', false)->count(),
        ];

        $recentArticles = Article::latest()->take(5)->get();
        $recentMessages = Message::latest()->take(5)->get();

        return view('dashboard', compact('stats', 'recentArticles', 'recentMessages'));
    }
}
