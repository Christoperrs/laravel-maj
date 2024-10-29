<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRequestStockTable extends Migration
{
    public function up()
    {
        Schema::create('request_stock', function (Blueprint $table) {
            $table->id(); // Auto-incrementing ID
            $table->foreignId('id_part')->constrained('parts')->onDelete('cascade'); // Foreign key to parts table
            $table->integer('qty_order'); // Quantity ordered
            $table->integer('status')->default(1);; 
            $table->timestamps(); // created_at and updated_at
            $table->foreignId('created_by')->constrained('users')->onDelete('cascade'); // Foreign key to users table
            $table->foreignId('updated_by')->constrained('users')->onDelete('cascade'); // Foreign key to users table
        });
    }

    public function down()
    {
        Schema::dropIfExists('request_stock');
    }
}