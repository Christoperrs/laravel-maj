<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePartsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('parts', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('description')->nullable();
            $table->integer('qty')->nullable();
            $table->integer('qty_minimum')->nullable();
            $table->integer('qty_order')->nullable();
            $table->integer('status')->nullable(); // New status column
            $table->string('created_by')->nullable(); // Change to string (varchar)
            $table->string('updated_by')->nullable(); // Change to string (varchar)
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('parts');
    }
}
