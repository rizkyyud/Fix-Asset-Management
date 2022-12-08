<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class viaBayar extends Model
{
    use HasFactory;
    protected $table = 'via_bayar';
    protected $fillable = [
        'keterangan',
    ];
}
