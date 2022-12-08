<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lokasi extends Model
{
    use HasFactory;
    protected $table = 'lokasi';
    protected $fillable = [
        'nama_lokasi',
        'alamat_lokasi'
    ];

    public function subLokasi()
    {
        return $this->hasMany(subLokasi::class);
    }
}
