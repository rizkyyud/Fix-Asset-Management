<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $table = 'orders';
    protected $fillable = [
        'id_barang',
        'alasan',
        'jumlah',
        'harga',
        'id_assets',
        'id_subAsset',
    ];
}
