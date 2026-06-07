<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Progress extends Model
{
    use HasFactory;

    protected $table = 'progress';
    protected $guarded = [];

    public function karyawanAuth()
    {
        return $this->belongsTo(Karyawan::class, 'email_auth', 'email');
    }

    public function karyawanProfile()
    {
        return $this->belongsTo(Karyawan::class, 'email_profile', 'email');
    }
}
