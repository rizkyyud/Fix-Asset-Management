<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DokSubLokasi extends Model
{
    use HasFactory;
    protected $table = 'dok_sub_lokasi';
    protected $fillable = [
        'id_subL',
        'path',
        'nama_file'
    ];
}
