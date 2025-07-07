<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Transaction;

class TransactionController extends Controller
{
    public function index()
    {
        $transactions = Transaction::with([
            'user:id,name',
            'product',
            'category'
        ])->get();

        return view('components.form', ['event' => 'indexTrans', 'message' => $transactions]);
    }

    public function show($id)
    {
        $id = (int) $id;
        $transaction = Transaction::findOrFail($id);
        return view('components.form',  ['event' => 'showTrans', 'message' => $transaction]);
    }

    public function edit()
    {
        $transactions = Transaction::with(['user', 'product', 'category'])
        ->where('id_penjual', auth()->id())
        ->orderBy('created_at', 'desc')
        ->get();


        return view('components.form', ['event' => 'editTrans', 'message' => $transactions]);
    }

    public function create()
    {
        $products = Product::all();
        $categories = Category::all();
        return view('components.form', [
            'event' => 'createTrans',
            'products'=> $products,
            'categories' => $categories
        ]);
    }

    public function store(Request $request)
    {

        $request->validate([
        'id_product' => 'required|exists:products,id',
        'quantity'   => 'required|integer|min:1',
        'category' => 'required|exists:categories,id'
        ]);

        $product = Product::find($request->id_product);
        if ($product->stock < $request->quantity ) {
            return back()->with('error', 'Stok tidak mencukupi!');
        }

        $product->stock -= $request->quantity;
        $product->save();

        Transaction::create([
            'id_penjual' => auth()->id(),
            'id_product' => $product->id,
            'id_category' => $request->category,
            'jumlah_pembelian' => $request->quantity,
        ]);

        return back()->with('success', 'Transaksi berhasil!');

    }

    public function update(Request $request, $id)
    {
        $id = (int)$id;
        $request->validate([
            /* id_product dan category tidak bisa diubah karena sistem butuh product id sebelumnya
            * dan karena produk sama, otomatis category juga harus sama */

            /* 'id_product' => 'required|exists:products,id', */
            'quantity'   => 'required|integer|min:1',
            /* 'category' => 'required|exists:categories,id' */
        ]);

        $transaction = Transaction::findOrFail($id);
        $product = Product::findOrFail($transaction->id_product);

        // Hitung selisih stok
        $selisih = $request->quantity - $transaction->jumlah_pembelian;

        // Cek stok jika jumlah pembelian bertambah
        if ($selisih > 0 && $product->stock < $selisih) {
            return back()->with('error', 'Stok tidak mencukupi untuk update!');
        }

        // Update stok produk
        $product->stock -= $selisih;
        $product->save();

        // Update transaksi
        $transaction->update([
            'jumlah_pembelian' => $request->quantity,
        ]);

        return back()->with('success', 'Transaksi berhasil diupdate!');
    }

    public function destroy($id)
    {
        $id = (int) $id;
        $transaction = Transaction::findOrFail($id);
        $product = Product::findOrFail($transaction->id_product);

        // Kembalikan stok produk
        $product->stock += $transaction->jumlah_pembelian;
        $product->save();

        // Hapus transaksi
        $transaction->delete();

        return back()->with('success', 'Transaksi berhasil dihapus!');
    }

}
