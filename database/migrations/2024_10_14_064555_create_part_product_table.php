<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('part_product', function (Blueprint $table) {
            $table->id(); // Kolom auto-increment sebagai primary key.
            $table->foreignId('product_id')->constrained()->onDelete('cascade'); // Kolom untuk foreign key dari tabel 'products', yang menghubungkan setiap part dengan produk terkait.
            $table->foreignId('part_id')->constrained()->onDelete('cascade'); // Kolom untuk foreign key dari tabel 'parts', yang menghubungkan produk dengan bagian-bagian terkait.
            $table->integer('qty'); // Kolom yang menyimpan jumlah (quantity) part yang digunakan untuk produk tertentu.
         
            $table->timestamps(); // Kolom untuk mencatat waktu create dan update record di pivot table.
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('part_product');
    }
};
