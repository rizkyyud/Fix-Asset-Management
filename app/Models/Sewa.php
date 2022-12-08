<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sewa extends Model
{
    use HasFactory;
    protected $table = 'sewa';
    protected $fillable = [
        'id_sewa',
        'nama_penyewa',
        'divisi_penyewa'
    ];
}
