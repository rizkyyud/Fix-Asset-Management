<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class assetsT extends Model
{
    use HasFactory;
    protected $table = 'assets_t';
    protected $fillable = [
        'id',
        'nama_transport',
        'model',
        'merk',
        'warna'
    ];
}
