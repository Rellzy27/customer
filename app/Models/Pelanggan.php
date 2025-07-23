<?php
namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Pelanggan extends Authenticatable implements MustVerifyEmail
{
    use Notifiable;

    protected $table = 'pelanggan';

    protected $primaryKey = 'kd_pelanggan';

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'nama_pelanggan',
        'email',
        'password',
        'nama_perusahaan',
        'telp_pelanggan',
    ];

    /**
     * The attributes that should be hidden for serialization.
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];
}