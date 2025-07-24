<?php
namespace App\Models;

use App\Notifications\PelangganVerifyEmailQueued;
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
        'nama_perusahaan',
        'telp_pelanggan',
        'username',
        'alamat_pelanggan',
        'foto',
        'email',
        'password',
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
    
    public function sendEmailVerificationNotification()
    {
        $this->notify(new PelangganVerifyEmailQueued());
    }
}