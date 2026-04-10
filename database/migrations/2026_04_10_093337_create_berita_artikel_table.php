<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('berita_artikel', function (Blueprint $table) {
            $table->id();
            $table->string('judul', 255);
            $table->string('slug', 255)->unique();
            $table->string('gambar_cover', 255)->nullable();
            $table->longText('konten')->comment('Penyimpanan untuk Rich Text Editor / HTML');
            $table->unsignedBigInteger('kategori_id')->nullable();
            $table->string('penulis', 100)->nullable();
            $table->dateTime('tanggal_publikasi')->nullable();
            $table->enum('status', ['Draft', 'Publish'])->default('Draft');
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent()->useCurrentOnUpdate();

            $table->foreign('kategori_id')->references('id')->on('kategori_berita')->onDelete('set null');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('berita_artikel');
    }
};