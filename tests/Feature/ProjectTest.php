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
    function sev_deptos_getPrueba_tester() 
    {
      $this->get('/api/v1/dptos')
        ->assertStatus(200);
    }

    /** @test */
    function sev_muni_getPrueba_tester() 
    {
      $this->get('/api/v1/muni/{"idDepartamento":20}')
        ->assertStatus(500);
    }

    /** @test */
    function seeServ_muni_getPrueba_tester() 
    {
      $this->get('/api/v1/muni/{"idDepartamento":20}')
        ->assertSee('{"mensaje":"Lista de municipios recuperada con exito","codigoMensaje":"1","Municipios":[{"idMunicipio":304,"municipio":"Chiquimula"},{"idMunicipio":305,"municipio":"San Jos\u00e9 La Arada"},{"idMunicipio":306,"municipio":"San Juan Ermita"},{"idMunicipio":307,"municipio":"Jocot\u00e1n"},{"idMunicipio":308,"municipio":"Camot\u00e1n"},{"idMunicipio":309,"municipio":"Olopa"},{"idMunicipio":310,"municipio":"Esquipulas"},{"idMunicipio":311,"municipio":"Concepci\u00f3n Las Minas"},{"idMunicipio":312,"municipio":"Quetzaltepeque"},{"idMunicipio":313,"municipio":"San Jacinto"},{"idMunicipio":314,"municipio":"Ipala"}]}');
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
      $this->assertTrue(app('App\Http\Controllers\ServNacimientoController')->FormarCUISumatoria(256461546) == 180);
    }

    /** @test */
    function sumatoriaCUI_tester() 
    {      
      $this->assertFalse(app('App\Http\Controllers\ServNacimientoController')->FormarCUISumatoria(256461546) == 2);
      //$this->assertTrue(app('App\Http\Controllers\MunicipioController')->existeDpto(20) == true);
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
