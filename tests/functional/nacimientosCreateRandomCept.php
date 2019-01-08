<?php 
use Faker\Factory as Faker;

$faker = Faker::create();

$I = new FunctionalTester($scenario);
$I->am('a revad user');
$I->wantTo('verify nacimientos view');

$I->amOnPage('/servicionacimiento/create');

//When
$I->fillField('nombre',$faker->firstNameMale);
$I->fillField('apellido',$faker->lastName);
$I->fillField('genero','1');
$I->fillField('fechanacimiento',$faker->date($format = 'd-m-Y', $max = 'now'));
$I->fillField('municipio',$faker->numberBetween($min = 1, $max = 338));
$I->fillField('lugarNacimiento',$faker->address);
$I->fillField('cuiPadre','2120000031615');
$I->fillField('cuiMadre','2120010811308');
//And
$I->click('Registrar Nacimiento');
//Then
$I->seeCurrentUrlEquals('/servicionacimiento');