<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class jenisIventaris extends Model
{
    use HasFactory;
    protected $table = 'jenis_iventaris';
    protected $fillable = [
        'jenis_iventaris'
    ];

    public function Barang()
    {
        return $this->hasMany(barangIven::class);
    }
}
