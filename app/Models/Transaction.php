<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    // Jika nama tabel tidak standar, tambahkan: 
    protected $table = 'transactions';
    protected $fillable = [
        'product_id',
        'quantity',
        'total_price',
    ];
}
