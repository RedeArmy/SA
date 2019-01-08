<?php 
use Faker\Factory as Faker;

$faker = Faker::create();

$I = new FunctionalTester($scenario);
$I->am('a REVAD user');
$I->wantTo('verify matrimonios create view');

$I->amOnPage('/matrimonio/create');
//When
$I->fillField('cuiHombre','2120000031615');
$I->fillField('cuiMujer','2120010811308');
$I->fillField('municipio',$faker->numberBetween($min = 1, $max = 338));
$I->fillField('lugarMatrimonio',$faker->address);
$I->fillField('fechaMatrimonio',$faker->date($format = 'd-m-Y', $max = 'now'));
$I->fillField('regimenMatrimonial',$faker->sentence($nbWords = 3, $variableNbWords = true));
//And
$I->click('Registrar Matrimonio');
//Then
$I->seeCurrentUrlEquals('/matrimonio');