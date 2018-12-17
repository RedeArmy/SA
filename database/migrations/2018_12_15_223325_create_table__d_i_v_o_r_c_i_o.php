<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableDIVORCIO extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('DIVORCIO', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('acta_divorcio');
            $table->bigInteger('cui_esposo')->unsigned();
            $table->bigInteger('cui_esposa')->unsigned();
            $table->string('direccion_divorcio',200)->nullable();
            $table->integer('id_muni')->unsigned();
            $table->date('fecha_divorcio');
            $table->timestamps();

            $table->foreign('cui_esposo')
                ->references('cui')->on('PERSONA')
                ->onDelete('cascade');

            $table->foreign('cui_esposa')
                ->references('cui')->on('PERSONA')
                ->onDelete('cascade');

            $table->foreign('id_muni')
                ->references('id_muni')->on('MUNICIPIO')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('DIVORCIO');
    }
}
