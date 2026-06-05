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
        if (!Schema::hasTable('likedislike')) {
        Schema::create('likedislike', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedInteger('id_progress')->nullable();
            $table->string('emailact')->nullable();
            $table->unsignedSmallInteger('status')->nullable();
            $table->timestamps();
        });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('likedislike');
    }
};
