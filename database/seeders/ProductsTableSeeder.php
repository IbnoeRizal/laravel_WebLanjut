<?php

namespace Database\Seeders;

//use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductsTableseeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('products')->insert([
            ['nama' => 'Laptop', 'harga' => 10000000, 'stock' => 10, 'created_at' => now(), 'updated_at' => now()],
            ['nama' => 'Kaos', 'harga' => 50000, 'stock' => 100, 'created_at' => now(), 'updated_at' => now()],
            ['nama' => 'Snack', 'harga' => 15000, 'stock' => 200, 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}
