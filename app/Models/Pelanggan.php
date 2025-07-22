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

    protected $fillable = [
        'nama_pelanggan',
        'nama_perusahaan',
        'alamat_pelanggan',
        'telp_pelanggan',
        'nik',
        'username',
        'password',
        'email',
        'role',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
}