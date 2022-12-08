<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BarangOut extends Model
{
    use HasFactory;
    protected $table = 'pindah_barang';
    protected $fillable = [
        'kode_label',
        'id_formAsset',
        'id_toAsset',
        'id_pemindah',
        'id_penerima',
        'id_formSub',
        'id_toSub',
        'status'
    ];
}
