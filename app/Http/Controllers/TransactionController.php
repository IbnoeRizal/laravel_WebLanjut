<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Transaction;

class TransactionController extends Controller
{
    public function store(Request $request)
    {

        $request->validate([
        'product_id' => 'required|exists:products,id',
        'quantity'   => 'required|integer|min:1',
        ]);

       $product = Product::find($request->product_id);

        if ($product->stock < $request->quantity) {
            return back()->with('error', 'Stok tidak mencukupi!');
        }

        $product->stock -= $request->quantity;
        $product->save();

        Transaction::create([
            'product_id' => $product->id,
            'quantity' => $request->quantity,
            'total_price' => $product->price * $request->quantity,
        ]);

        return back()->with('success', 'Transaksi berhasil!');
        
    }
}
