<?php

namespace Database\Seeders;

//use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('categories')->insert([
            ['nama' => 'Elektronik', 'created_at' => now(), 'updated_at' => now()],
            ['nama' => 'Pakaian', 'created_at' => now(), 'updated_at' => now()],
            ['nama' => 'Makanan', 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}
