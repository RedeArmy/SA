<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ProjectTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testExample()
    {
        $this->assertTrue(true);
    }



    /** @test */
    function valida_CUI_nac_tester() 
    {
      $this->assertTrue(ServNacimientoController)->valida_CUI_Nacimiento(2954728550101);
    }

    /** @test */
    function formar_CUI_sum_tester() 
    {
      $this->assertTrue(ServNacimientoController)->FormarCUISumatoria(29547285) == 228;
    }

    /** @test */
    function obtener_ultimo_dig_tester() 
    {
      $this->assertTrue(ServNacimientoController)->ObtenerUltimoDigito(29547285) == 5;
    }

    /** @test */
    function valida_ultimo_val_tester() 
    {
      $this->assertTrue(ServNacimientoController)->ValidarUltimoValor(228,5);
    }

    /** @test */
    function valor_entero_tester() 
    {
      $this->assertTrue(ServNacimientoController)->valor_entero() == 24;
    }

}
