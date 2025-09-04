<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pesanan_Progress extends Model
{
    protected $table = 'pesanan_progress';

    protected $primaryKey = 'kd_pesanan_progress';

    public function pesanan()
    {
        return $this->belongsTo(Pesanan::class, 'kd_pesanan', 'kd_pesanan');
    }

    public function karyawan()
    {
        return $this->belongsTo(Karyawan::class, 'kd_karyawan', 'kd_karyawan');
    }

    public function pelanggan()
    {
        return $this->belongsTo(Pelanggan::class, 'kd_pelanggan', 'kd_pelanggan');
    }
}
