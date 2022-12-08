<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vendors extends Model
{
    use HasFactory;
    protected $table = 'vendors';
    protected $fillable = [
        'nama_vendor',
        'alamat_vendor',
        'jenis_usaha',
        'contact_person'
    ];
}
