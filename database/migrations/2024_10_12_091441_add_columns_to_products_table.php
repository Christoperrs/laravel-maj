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
        Schema::table('products', function (Blueprint $table) {
            $table->string('no_job')->nullable();           // No Job
            $table->string('projek')->nullable();           // Project
            $table->string('die')->nullable();              // Die
            $table->string('process')->nullable();          // Process
            $table->string('die_dimensi')->nullable();      // Die Dimensions
            $table->string('frekuensi_perbaikan')->nullable(); // Frequency of repair
            $table->string('customer')->nullable();         // Customer
            $table->string('status')->default('active');    // Status
            $table->unsignedBigInteger('created_by')->nullable(); // Created by user ID
            $table->unsignedBigInteger('updated_by')->nullable(); // Updated by user ID

            // Optional: Set up foreign key relationships if needed
            // $table->foreign('created_by')->references('id')->on('users')->onDelete('set null');
            // $table->foreign('updated_by')->references('id')->on('users')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('products', function (Blueprint $table) {
            $table->dropColumn([
                'no_job', 
                'projek', 
                'die', 
                'process', 
                'die_dimensi', 
                'frekuensi_perbaikan', 
                'customer', 
                'status', 
                'created_by', 
                'updated_by'
            ]);
        });
    }
};
