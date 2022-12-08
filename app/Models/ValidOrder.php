<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ValidOrder extends Model
{
    use HasFactory;
    protected $table = 'vorder';
    protected $fillable = [
        'id_car',
        'id_validator',
        'divisi_valid',
        'nama_valid'
    ];
}
