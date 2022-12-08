<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ModelB extends Model
{
    use HasFactory;
    protected $table = 'tbl_model';
    protected $fillable = [
        'model'
    ];
}
