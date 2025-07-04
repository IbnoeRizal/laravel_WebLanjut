<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TransactionsTableseeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('transactions')->insert([
            [
                'id_penjual' => 1,
                'id_product' => 1,
                'id_category' => 1,
                'jumlah_pembelian' => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_penjual' => 1,
                'id_product' => 2,
                'id_category' => 2,
                'jumlah_pembelian' => 5,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
