<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DokLokasi extends Model
{
    use HasFactory;
    protected $table = 'dok_lokasi';
    protected $fillable = [
        'id_lokasi',
        'nama_file',
        'path'
    ];
}
