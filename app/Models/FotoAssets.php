<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FotoAssets extends Model
{
    use HasFactory;
    protected $table = 'foto_assets';
    protected $fillable = [
        'id_assets',
        'path'
    ];
}
