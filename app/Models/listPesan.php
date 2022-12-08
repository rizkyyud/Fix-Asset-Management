<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class listPesan extends Model
{
    use HasFactory;
    protected $table = 'list_pesanan';
    protected $fillable = [
        'kode',
        'id_pemilik',
        'status',
        'kode'
    ];
}
