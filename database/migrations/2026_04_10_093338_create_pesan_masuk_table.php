<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pesan_masuk', function (Blueprint $table) {
            $table->id();
            $table->string('nama_pengirim', 150);
            $table->string('email_pengirim', 150);
            $table->string('subjek', 255)->nullable();
            $table->text('isi_pesan');
            $table->dateTime('tanggal_masuk')->useCurrent();
            $table->boolean('is_read')->default(false)->comment('Penanda apakah pesan sudah dibaca admin');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pesan_masuk');
    }
};