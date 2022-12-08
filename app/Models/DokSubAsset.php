<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DokSubAsset extends Model
{
    use HasFactory;
    protected $table = 'dok_sub_asset';
    protected $fillable = [
        'id_subAsset',
        'path',
        'nama_file'
    ];
}
