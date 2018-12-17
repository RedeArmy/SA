<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableMATRIMONIO extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('MATRIMONIO', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('acta_matrimonio');
            $table->bigInteger('cui_esposo')->unsigned();
            $table->bigInteger('cui_esposa')->unsigned();
            $table->integer('id_muni')->unsigned();
            $table->string('direccion_matri',200);
            $table->string('regimen_eco',100);
            $table->date('fecha_matri');
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
        Schema::dropIfExists('MATRIMONIO');
    }
}
