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
        Schema::create('edukasi', function (Blueprint $table) {
            $table->id();
            $table->string('judul');
            $table->enum('jenis', ['video', 'artikel', 'kelas']);
            $table->text('konten'); // URL untuk video, isi artikel, deskripsi untuk kelas
            $table->string('thumbnail')->nullable();
            $table->date('tanggal_kegiatan')->nullable(); // khusus kelas
            $table->integer('kuota')->nullable(); // khusus kelas
            $table->string('status')->default('aktif'); // aktif, draft
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('edukasi');
    }
};
