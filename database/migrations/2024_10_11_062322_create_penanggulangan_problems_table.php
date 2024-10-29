<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePenanggulanganProblemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('penanggulangan_problems', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('Id_dies'); // Assuming Id_dies is a foreign key
            $table->string('shift_problem');
            $table->string('penanggulangan');
            $table->unsignedBigInteger('item_penggantian');
            $table->integer('qty');
            $table->string('pic');
            $table->string('progres')->nullable();
            $table->string('status')->default('pending');
            $table->timestamps();

            // Foreign key constraint (if applicable)
            // $table->foreign('Id_dies')->references('id')->on('dies')->onDelete('cascade');
            // $table->foreign('item_penggantian')->references('id')->on('parts')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('penanggulangan_problems');
    }
}
