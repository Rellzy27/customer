<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pesanan extends Model
{
    use HasFactory;

    protected $table = 'pesanan';
    protected $primaryKey = 'kd_pesanan';
    protected $fillable = [
        'kd_pelanggan',
        'deskripsi_pesanan',
        'tanggal',
        'status',
        'progres',
        'kd_karyawan',
        'dibuat_oleh',
    ];

    public function pelanggan()
    {
        return $this->belongsTo(Pelanggan::class, 'kd_pelanggan', 'kd_pelanggan');
    }

    public function karyawan()
    {
        return $this->belongsTo(Karyawan::class, 'kd_karyawan', 'kd_karyawan');
    }
}