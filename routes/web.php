<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\ArticleController;
use App\Http\Controllers\Admin\GalleryController;
use App\Http\Controllers\Admin\MessageController;
use App\Http\Controllers\Admin\SchoolProfileController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\FrontController;

use App\Http\Controllers\DashboardController;

Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/', [FrontController::class, 'index'])->name('home');
Route::post('/kirim-pesan', [FrontController::class, 'storeMessage'])->name('send.message');
Route::get('/berita/{slug}', [FrontController::class, 'showArticle'])->name('article.show');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Grouping route untuk Admin CMS
Route::middleware(['auth', 'verified'])->prefix('admin')->name('admin.')->group(function () {
    Route::resource('articles', ArticleController::class);
    Route::resource('galleries', GalleryController::class);
    Route::resource('messages', MessageController::class)->only(['index', 'show', 'destroy']); 
    Route::resource('users', UserController::class)->except(['show']);
    Route::get('school-profile', [SchoolProfileController::class, 'edit'])->name('school-profile.edit');
    Route::put('school-profile', [SchoolProfileController::class, 'update'])->name('school-profile.update');
});


require __DIR__.'/auth.php';
