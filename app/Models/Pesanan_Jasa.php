<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pesanan_Jasa extends Model
{
    protected $table = 'pesanan_jasa';

    protected $primaryKey = 'kd_pesanan_jasa';

    protected $fillable = [
        'kd_pesanan_detail',
        'nama_jasa',
        'harga_jasa',
        'jumlah',
        'subtotal',
    ];
}
