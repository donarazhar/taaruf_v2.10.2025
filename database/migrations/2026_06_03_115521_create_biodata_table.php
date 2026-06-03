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
        Schema::create('biodata', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('email')->nullable();
            $table->string('tempatlahir', 25)->nullable();
            $table->date('tgllahir')->nullable();
            $table->char('goldar', 3)->nullable();
            $table->char('statusnikah', 10)->nullable();
            $table->string('pekerjaan', 25)->nullable();
            $table->string('suku', 25)->nullable();
            $table->string('pendidikan', 10)->nullable();
            $table->text('hobi')->nullable();
            $table->text('motto')->nullable();
            $table->char('nohp', 17)->nullable();
            $table->text('alamat')->nullable();
            $table->unsignedInteger('tinggi')->nullable();
            $table->unsignedInteger('berat')->nullable();
            $table->string('video')->nullable();
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
        Schema::dropIfExists('biodata');
    }
};
