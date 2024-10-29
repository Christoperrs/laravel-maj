<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('maintenances', function (Blueprint $table) {
            $table->enum('approval_status', ['approved', 'no approve'])
                  ->default('no approve')
                  ->nullable();
                  
            $table->unsignedBigInteger('approved_by')->nullable(); // ID pengguna yang meng-approve
            // Jika Anda ingin menambahkan foreign key
            $table->foreign('approved_by')->references('id')->on('users')->onDelete('set null'); 
        });
    }

    public function down()
    {
        Schema::table('maintenances', function (Blueprint $table) {
            $table->dropColumn(['approval_status', 'approved_by']);
        });
    }
};
