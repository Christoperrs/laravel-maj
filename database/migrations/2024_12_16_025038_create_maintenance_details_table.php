<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMaintenanceDetailsTable extends Migration
{
    public function up()
    {
        Schema::create('maintenance_details', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('maintenance_id');
            $table->unsignedBigInteger('part_id');
            $table->unsignedBigInteger('description_id');
            $table->string('condition');
            $table->timestamps();

            $table->foreign('maintenance_id')->references('id')->on('maintenances')->onDelete('cascade');
            $table->foreign('part_id')->references('id')->on('parts')->onDelete('cascade');
            $table->foreign('description_id')->references('id')->on('descriptions')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('maintenance_details');
    }
}
