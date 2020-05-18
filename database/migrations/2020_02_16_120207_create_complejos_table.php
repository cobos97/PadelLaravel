<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateComplejosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('complejos', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->string('lugar');
            $table->string('direccion');
            $table->string('foto');
            $table->string('descripcion', 1000);
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
        Schema::dropIfExists('complejos');
    }
}
