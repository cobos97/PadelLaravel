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

            $table->string('lugar');
            $table->string('direccion');
            $table->string('nPista')->default('1');
            $table->string('foto');
            $table->string('descripcion');
            $table->string('coorX');
            $table->string('coorY');

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
        Schema::dropIfExists('pistas');
    }
}
