<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddProductIdToPartsTable extends Migration
{
    public function up()
    {
        Schema::table('parts', function (Blueprint $table) {
            // Hanya tambahkan jika kolom belum ada
            if (!Schema::hasColumn('parts', 'product_id')) {
                $table->unsignedBigInteger('product_id')->nullable()->after('id');
                $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
            }
        });
    }

    public function down()
    {
        Schema::table('parts', function (Blueprint $table) {
            // Pastikan foreign key ada sebelum dihapus
            if (Schema::hasColumn('parts', 'product_id')) {
                $table->dropForeign(['product_id']);
                $table->dropColumn('product_id');
            }
        });
    }
}


