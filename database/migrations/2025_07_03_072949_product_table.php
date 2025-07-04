<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

use function Laravel\Prompts\table;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Tabel categories
        Schema::create('categories', function (Blueprint $table) {
            $table->id();
            $table->string('nama', 50);
            $table->dateTime('created_at')->useCurrent();
            $table->dateTime('updated_at')->useCurrentOnUpdate();
        });

        // Tabel products
        Schema::create("products",
         function(Blueprint $table) {
            $table->id();
            $table->string('nama', 50);
            $table->integer('harga')->length(10);
            $table->integer('stock')->length(10);
            $table->dateTime('created_at')->useCurrent();
            $table->dateTime('updated_at')->useCurrentOnUpdate();
        });

        // Tabel transactions
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_penjual')->nullable()->constrained('users')->nullOnDelete();
            $table->foreignId('id_product')->nullable()->constrained('products')->nullOnDelete();
            $table->foreignId('id_category')->nullable()->constrained('categories')->nullOnDelete();
            $table->integer('jumlah_pembelian')->length(10);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transactions');
        Schema::dropIfExists('products');
        Schema::dropIfExists('categories');
    }
};
