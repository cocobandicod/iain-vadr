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
        Schema::create('berita', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_user');
            $table->string('judul_seo');
            $table->string('judul_berita');
            $table->dateTime('tgl_berita');
            $table->text('isi_berita');
            $table->string('image')->nullable();
            $table->timestamps();
        });

        Schema::create('pengumuman', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_user');
            $table->string('judul_pengumuman');
            $table->dateTime('tgl_pengumuman');
            $table->text('isi_pengumuman');
            $table->string('file_pengumuman')->nullable();
            $table->timestamps();
        });

        Schema::create('sponsor', function (Blueprint $table) {
            $table->id();
            $table->string('judul');
            $table->string('image');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('berita');
        Schema::dropIfExists('pengumuman');
        Schema::dropIfExists('sponsor');
    }
};
