<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    //
    use HasFactory;

    protected $table = 'products';

    protected $fillable = [
        'nama',
        'harga',
        'stock',
    ];

    public function transactions()
    {
        return $this->hasMany(Transaction::class, 'id_product');
    }
}
