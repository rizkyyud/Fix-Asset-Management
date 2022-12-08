<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ruteT extends Model
{
    use HasFactory;
    protected $table = 'rute_t';
    protected $fillable = [
        'rute'
    ];
    
}
