<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('karyawan', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('nip')->unique();
            $table->string('nama');
            $table->string('email')->unique();
            $table->enum('jenkel', ['L', 'P']);
            $table->string('password');
            $table->string('referensi')->nullable();
            $table->text('referensi_detail')->nullable();
            $table->string('foto')->nullable();
            $table->enum('status', ['1', '2', ''])->nullable()->default('');
            $table->string('email_verification_token')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('karyawan');
    }
};
