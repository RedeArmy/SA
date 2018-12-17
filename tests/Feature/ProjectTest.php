<?php

namespace Tests\Feature;

use app\Http\Contollers\ServNacimientoController;
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
    public $service;
    
  
    public function testExample()
    {
        $this->assertTrue(true);
    }

    /** @test */
    function sev_nacimiento_getPrueba_tester() 
    {
      $this->get('/api/v1/nacs')
        ->assertStatus(200);
    }

    /** @test */
    function imprimir_nac_tester() 
    {
      $this->get('/api/v1/imprimirNacimiento/2')
        ->assertStatus(200);
    }


    /** @test */
    function valida_CUI_nac_tester() 
    {
     
      $this->assertTrue(app('App\Http\Controllers\ServNacimientoController')->valida_CUI_Nacimiento(256461546));
    }

    /** @test */
    function formar_CUI_sum_tester() 
    {
      $this->assertTrue(app('App\Http\Controllers\ServNacimientoController')->FormarCUISumatoria(256461546) == 182);
    }

    /** @test */
    function obtener_ultimo_dig_tester() 
    {
      
      $this->assertTrue(app('App\Http\Controllers\ServNacimientoController')->ObtenerUltimoDigito(295472855) == 5);
    }

    /** @test */
    function valida_ultimo_val_tester() 
    {
      
      
      $this->assertTrue(app('App\Http\Controllers\ServNacimientoController')->ValidarUltimoValor(182,6));
    }

    /** @test */
    function valor_entero_tester() 
    {
      $this->assertTrue(app('App\Http\Controllers\ServNacimientoController')->valor_entero() == 24);
    }

}
