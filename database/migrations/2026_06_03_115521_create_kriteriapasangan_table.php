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
        Schema::create('kriteriapasangan', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('email');
            $table->char('kriteriaumur', 25)->nullable();
            $table->char('kriteriatinggi', 25)->nullable();
            $table->char('kriteriaberat', 25)->nullable();
            $table->text('kriteriaumum')->nullable();
            $table->string('kriteriasuku')->nullable();
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
        Schema::dropIfExists('kriteriapasangan');
    }
};
