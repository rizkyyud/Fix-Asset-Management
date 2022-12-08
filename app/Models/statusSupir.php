<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class statusSupir extends Model
{
    use HasFactory;
    protected $table = 'status_supir';
    protected $fillable = [
        'status'
    ];
}
