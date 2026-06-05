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
        Schema::create('murobbi_recommendations', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('murobbi_id');
            $table->string('karyawan_pria_email');
            $table->string('karyawan_wanita_email');
            $table->string('status')->default('pending'); // pending, viewed
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('murobbi_recommendations');
    }
};
