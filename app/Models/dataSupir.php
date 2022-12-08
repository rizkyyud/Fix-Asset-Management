<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class dataSupir extends Model
{
    use HasFactory;
    protected $table = 'data_supirs';
    protected $fillable = [
        'id',
        'nama_supir'
    ];
}
