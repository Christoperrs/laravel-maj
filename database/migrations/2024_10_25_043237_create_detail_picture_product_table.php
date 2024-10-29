<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDetailPictureProductTable extends Migration
{
    public function up()
    {
        Schema::create('detail_picture_product', function (Blueprint $table) {
            $table->id('id_detail_gambar'); // Auto-incrementing ID
            $table->string('path_gambar'); // Path to the image
            $table->foreignId('id_product')->constrained('products')->onDelete('cascade'); // Foreign key to products
            $table->string('created_by')->nullable(); // Change to string (varchar)
            $table->string('updated_by')->nullable(); 
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('detail_picture_product');
    }
}