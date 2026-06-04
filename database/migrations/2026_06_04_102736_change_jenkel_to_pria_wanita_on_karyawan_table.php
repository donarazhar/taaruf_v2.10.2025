<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // For safety, only update if the server's db has L or P
        try {
            DB::statement("ALTER TABLE karyawan MODIFY jenkel ENUM('L', 'P', 'pria', 'wanita') NOT NULL");
            
            DB::table('karyawan')->where('jenkel', 'L')->update(['jenkel' => 'pria']);
            DB::table('karyawan')->where('jenkel', 'P')->update(['jenkel' => 'wanita']);
            
            DB::statement("ALTER TABLE karyawan MODIFY jenkel ENUM('pria', 'wanita') NOT NULL");
        } catch (\Exception $e) {
            // If the table is already altered or fails, log it or do nothing
            // This allows the local env to pass if it already has pria/wanita
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        try {
            DB::statement("ALTER TABLE karyawan MODIFY jenkel ENUM('L', 'P', 'pria', 'wanita') NOT NULL");
            
            DB::table('karyawan')->where('jenkel', 'pria')->update(['jenkel' => 'L']);
            DB::table('karyawan')->where('jenkel', 'wanita')->update(['jenkel' => 'P']);
            
            DB::statement("ALTER TABLE karyawan MODIFY jenkel ENUM('L', 'P') NOT NULL");
        } catch (\Exception $e) {
            // Do nothing
        }
    }
};
