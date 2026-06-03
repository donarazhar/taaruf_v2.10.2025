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
            $table->enum('jenkel', ['pria', 'wanita']);
            $table->string('password');
            $table->enum('referensi', ['1', '2', '', ''])->nullable();
            $table->text('referensi_detail')->nullable();
            $table->string('foto')->nullable();
            $table->integer('status')->nullable();
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
