<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BarangIn extends Model
{
    use HasFactory;
    protected $table = 'barang_in';
    protected $fillable = [
        'id_orders',
        'id_lokasi',
        'status'
    ];
}
