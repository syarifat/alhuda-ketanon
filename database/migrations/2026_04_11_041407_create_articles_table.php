<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('articles', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug')->unique(); // Untuk URL ramah SEO, misal: /berita/juara-lomba
            $table->longText('content');
            $table->string('thumbnail')->nullable(); // Disiapkan untuk path dari Cloudflare R2
            $table->boolean('is_published')->default(true); // Status rilis atau draft
            $table->unsignedBigInteger('views')->default(0); // Menghitung jumlah pembaca (untuk sidebar "Terpopuler")
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('articles');
    }
};
