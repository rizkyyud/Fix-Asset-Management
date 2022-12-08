<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class subAssets extends Model
{
    use HasFactory;
    protected $table = 'sub_assets';
    protected $fillable = [
        'id_assets',
        'nama_subAsset'
    ];
}
