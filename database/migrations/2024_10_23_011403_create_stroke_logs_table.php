<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStrokeLogsTable extends Migration
{
    public function up()
    {
        Schema::create('stroke_logs', function (Blueprint $table) {
            $table->id();
            $table->string('part_no');
            $table->string('machine');
            $table->string('process');
            $table->integer('current_stroke');
            $table->integer('accumulative_stroke');
            $table->date('log_date');  // Menyimpan tanggal log
            $table->timestamps();
            $table->string('status')->nullable();
        });
    }

    public function down()
    {
        Schema::dropIfExists('stroke_logs');
    }
}

