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
        Schema::create('pendaftaran_edukasi', function (Blueprint $table) {
            $table->id();
            $table->foreignId('edukasi_id')->constrained('edukasi')->onDelete('cascade');
            $table->string('karyawan_email')->collation('utf8mb4_general_ci');
            $table->string('status_pendaftaran')->default('menunggu'); // menunggu, diterima, ditolak
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pendaftaran_edukasi');
    }
};
