<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReservasiVilla extends Model
{
    use HasFactory;
    protected $table = 'reservasi_villa';
    protected $fillable = [
        'kode_reservasi',
        'id_penyewa',
        'id_villa',
        'check_in',
        'check_out',
        'status',
        'lunas'
    ];
}
