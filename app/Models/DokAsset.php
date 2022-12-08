<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DokAsset extends Model
{
    use HasFactory;
    protected $table = 'foto_assets';
    protected $fillable = [
        'id_assets',
        'path',
        'nama_file'
    ];
}
