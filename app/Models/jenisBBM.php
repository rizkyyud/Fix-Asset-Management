<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class jenisBBM extends Model
{
    use HasFactory;
    protected $table = 'jenis_bbm';
    protected $fillable = [
        'jenis_bbm',
        'harga'
    ];
}
