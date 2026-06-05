<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Ambil collation dari tabel karyawan kolom email
        $karyawanCollation = DB::select("SHOW FULL COLUMNS FROM karyawan LIKE 'email'")[0]->Collation;
        $karyawanCharset = explode('_', $karyawanCollation)[0];

        // Terapkan collation yang sama ke tabel pendaftaran_edukasi dan konsultasi
        if (Schema::hasTable('pendaftaran_edukasi')) {
            DB::statement("ALTER TABLE pendaftaran_edukasi MODIFY karyawan_email VARCHAR(255) CHARACTER SET {$karyawanCharset} COLLATE {$karyawanCollation} NOT NULL");
        }
        
        if (Schema::hasTable('konsultasi')) {
            DB::statement("ALTER TABLE konsultasi MODIFY karyawan_email VARCHAR(255) CHARACTER SET {$karyawanCharset} COLLATE {$karyawanCollation} NOT NULL");
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // 
    }
};
