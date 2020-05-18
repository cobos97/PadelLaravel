<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePistasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pistas', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->unsignedBigInteger('complejo_id');

            $table->string('nPista')->default('1');
            $table->string('foto');
            $table->string('descripcion', 1000);


            $table->timestamps();

            $table->foreign('complejo_id')->references('id')->on('complejos')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pistas');
    }
}
