<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderAma extends Model
{
    use HasFactory;
    protected $table = 'order_list';
    protected $fillable = [
        'id_cart',
        'id_pembeli',
    ];
}
