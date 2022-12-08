<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Storage extends Model
{
    use HasFactory;
    protected $table = 'storage';
    protected $fillable = [
        'status',
        'label',
        'stok',
        'id_lokasi',
        'kode_iventori'
    ];
}
