<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Karyawan extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $table = "karyawan";
    protected $primaryKey = 'email';
    public $incrementing = false;
    protected $keyType = 'string';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'id',
        'nama',
        'foto',
    ];

    public function biodata()
    {
        return $this->hasOne(Biodata::class, 'email', 'email');
    }

    public function kriteriapasangan()
    {
        return $this->hasOne(Kriteriapasangan::class, 'email', 'email');
    }

    public function progress()
    {
        return $this->hasMany(Progress::class, 'email_auth', 'email');
    }
}
