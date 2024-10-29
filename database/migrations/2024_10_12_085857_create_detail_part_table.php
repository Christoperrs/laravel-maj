<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDetailPartTable extends Migration
{
    public function up()
    {
        Schema::create('detail_part', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('product_id'); // Pastikan kolom ini ada
            $table->unsignedBigInteger('part_id');    // Pastikan kolom ini ada
            $table->integer('qty')->nullable();                    // Kuantitas part
            $table->string('status')->default('active'); // Status default
            // $table->string('no_gambar');               // Nomor atau kode gambar
            $table->timestamps();                       // Waktu pembuatan dan pembaruan
            $table->unsignedBigInteger('created_by')->nullable(); // Pengguna yang membuat
            $table->unsignedBigInteger('updated_by')->nullable(); // Pengguna yang memperbarui

            // Kunci asing
            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
            $table->foreign('part_id')->references('id')->on('parts')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('detail_part');
    }
}
