<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Orders extends Model
{
    use HasFactory;
    protected $table = 'pesanan';
    protected $fillable = [
        'model',
        'merk',
        'warna',
        'ukuran',
        'foto'
    ];
}
