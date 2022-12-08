<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PembayaranVilla extends Model
{
    use HasFactory;
    protected $table = 'pembayaran_villa';
    protected $fillable = [
        'kode_reservasi',
        'nominal',
    ];
}
