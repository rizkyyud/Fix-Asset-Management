<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class jnsTransport extends Model
{
    use HasFactory;
    protected $table = 'jns_transports';
    protected $fillable = [
        'id',
        'jns_kendaraan'
    ];
}
