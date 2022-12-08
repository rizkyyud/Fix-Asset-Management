<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class tanggalSession extends Model
{
    use HasFactory;
    protected $table = 'tanggal_sessions';
    protected $fillable = [
        'tanggal_masuk',
        'tanggal_akhir'
    ];
}
