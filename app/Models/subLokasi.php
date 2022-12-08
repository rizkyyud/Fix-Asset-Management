<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class subLokasi extends Model
{
    use HasFactory;
    protected $table = 'sub_lokasi';
    protected $fillable = [
        'id_lokasi',
        'nama_subL'
    ];

    public function Lokasi()
    {
        return $this->belongsTo(Lokasi::class);
    }
}
