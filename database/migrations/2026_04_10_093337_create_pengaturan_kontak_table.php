<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pengaturan_kontak', function (Blueprint $table) {
            $table->id();
            $table->text('alamat_lengkap')->nullable();
            $table->string('email_sekolah', 150)->nullable();
            $table->string('no_telepon', 50)->nullable();
            $table->text('embed_maps')->nullable()->comment('Tag <iframe> dari Google Maps');
            $table->string('link_instagram', 255)->nullable();
            $table->string('link_facebook', 255)->nullable();
            $table->string('link_youtube', 255)->nullable();
            $table->timestamp('updated_at')->useCurrent()->useCurrentOnUpdate();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pengaturan_kontak');
    }
};