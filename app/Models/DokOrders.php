<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DokOrders extends Model
{
    use HasFactory;
    protected $fillable = [
        'id_orders',
        'nama_file',
        'path'
    ];

}
