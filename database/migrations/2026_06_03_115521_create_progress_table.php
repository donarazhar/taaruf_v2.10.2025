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
        if (!Schema::hasTable('progress')) {
        Schema::create('progress', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('email_auth')->nullable();
            $table->string('email_profile')->nullable();
            $table->date('progress_tgl')->nullable();
            $table->tinyInteger('status')->nullable();
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
        Schema::dropIfExists('progress');
    }
};
