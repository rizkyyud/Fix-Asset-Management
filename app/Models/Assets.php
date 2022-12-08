<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Assets extends Model
{
    use HasFactory;
    protected $table = 'assets';
    protected $fillable = [
        'nama_assets',
        'nilai_assets'
    ];

    public function kategori()
    {
        return $this->belongsTo(Kategori::class);
    }
}
