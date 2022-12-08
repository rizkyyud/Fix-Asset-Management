<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KlasB extends Model
{
    use HasFactory;
    protected $table = 'klasifikasi_b';
    protected $fillable = [
        'klasifikasi'
    ];
}
