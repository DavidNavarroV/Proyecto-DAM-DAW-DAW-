<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePartidasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('partidas', function (Blueprint $table) {
            //Opciones de tabla
            $table->charset = 'utf8';
            $table->collation = 'utf8_unicode_ci';

            //Columnas
            $table->tinyIncrements('id')->autoIncrement();
            $table->string('jugador', 16)->nullable(false)->default("");
            $table->integer('puntos')->nullable();
            $table->integer('tiempo')->nullable();
            $table->dateTime('fecha')->nullable();


            //Columnas created_at y updated_at
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
        Schema::dropIfExists('partidas');
    }
}
