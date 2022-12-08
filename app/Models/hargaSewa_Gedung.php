<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class hargaSewa_Gedung extends Model
{
    use HasFactory;
    protected $table = 'harga_sewaGdg';
    protected $fillable = [
        'id_assets',
        'harga_jam'
    ];
}
