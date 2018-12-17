<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class CreateTablePERSONA extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('PERSONA', function (Blueprint $table) {
            
            $table->engine = 'InnoDB';
            $table->bigInteger('cui')->unsigned();
            $table->string('nombres',200);
            $table->string('apellidos',200);
            $table->integer('genero')->unsigned();
            $table->integer('estado_civil')->unsigned();
            $table->string('huella',200)->nullable();
            $table->string('direccion',200);
            $table->integer('vivo_muerto')->unsigned();
            $table->integer('id_muni')->unsigned();
            $table->timestamps();

            $table->foreign('id_muni')
                ->references('id_muni')->on('MUNICIPIO')
                ->onDelete('cascade');

            $table->primary('cui');
        });

        DB::statement('ALTER TABLE PERSONA ADD CONSTRAINT ck_genero CHECK (genero = 0 OR genero = 1)');
        DB::statement('ALTER TABLE PERSONA ADD CONSTRAINT ck_estado_civil CHECK (estado_civil >= 0 OR estado_civil <= 3)');
        DB::statement('ALTER TABLE PERSONA ADD CONSTRAINT ck_vivo_muerto CHECK (vivo_muerto = 0 OR vivo_muerto = 1)');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('PERSONA');
    }
}
