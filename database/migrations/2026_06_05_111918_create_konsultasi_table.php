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
        Schema::create('konsultasi', function (Blueprint $table) {
            $table->id();
            $table->string('karyawan_email')->collation('utf8mb4_general_ci');
            $table->string('topik_konsultasi');
            $table->text('pesan');
            $table->string('status')->default('menunggu'); // menunggu, dijadwalkan, selesai
            $table->text('pesan_balasan_murobbi')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('konsultasi');
    }
};
