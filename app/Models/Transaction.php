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
        'id_penjual',
        'id_product',
        'id_category',
        'jumlah_pembelian',
    ];

    public function product()
    {
        return $this->belongsTo(Product::class, 'id_product');
    }

    public function category()
    {
        return $this->belongsTo(Category::class, 'id_category');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'id_penjual');
    }
}
