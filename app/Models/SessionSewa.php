<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SessionSewa extends Model
{
    use HasFactory;
    protected $table = 'session_sewas';
    protected $fillable = [
        'session',
    ];
}
