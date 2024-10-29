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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('line');
            $table->string('barcode')->nullable(); 
            $table->string('image')->nullable();
            $table->string('customer')->nullable(); 
            $table->string('model')->nullable(); 
            $table->string('part_no')->nullable(); 
            $table->string('no_job')->nullable(); 
            $table->string('process')->nullable(); 
            $table->string('machine')->nullable();
            $table->integer('frequency_production')->nullable();
            $table->string('tension')->nullable();
            $table->integer('status')->nullable(); 
            $table->timestamps();
            $table->foreignId('created_by')->constrained('users')->onDelete('cascade'); // Foreign key to users table
            $table->foreignId('updated_by')->constrained('users')->onDelete('cascade'); // Foreign key to users table
        });
    }
    

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};