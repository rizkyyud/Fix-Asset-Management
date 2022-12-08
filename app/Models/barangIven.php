<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class barangIven extends Model
{
    use HasFactory;
    protected $table = 'barang_iven';
    protected $fillable = [
        'id_barangIven',
        'nama_barang',
        'id_jenisIven'
    ];
    public function Jenis()
    {
        return $this->belongsTo(jenisIventaris::class);
    }
}
