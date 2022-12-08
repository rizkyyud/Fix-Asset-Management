<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class viaVilla extends Model
{
    use HasFactory;
    protected $table = 'via_villa';
    protected $fillable = [
        'keterangan',
    ];

}
