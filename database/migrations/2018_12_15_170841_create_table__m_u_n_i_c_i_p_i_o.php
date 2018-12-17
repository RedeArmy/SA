<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableMUNICIPIO extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('MUNICIPIO', function (Blueprint $table) {

            
            $table->engine = 'InnoDB';
            $table->increments('id_muni');
            $table->string('nombre',100);
            $table->integer('id_dpto')->unsigned();
            $table->timestamps();

            $table->foreign('id_dpto')
                ->references('id_dpto')->on('DEPARTAMENTO')
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
        Schema::dropIfExists('MUNICIPIO');
    }
}
