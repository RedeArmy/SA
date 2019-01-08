<?php 
use Faker\Factory as Faker;

$faker = Faker::create();

$I = new FunctionalTester($scenario);
$I->am('a REVAD user');
$I->wantTo('verify divorcios view');

$I->amOnPage('/divorcio/create');

//When
$I->fillField('cuiHombre','2120000031615');
$I->fillField('cuiMujer','2120010811308');
$I->fillField('municipio',$faker->numberBetween($min = 1, $max = 338));
$I->fillField('lugarDivorcio',$faker->address);
$I->fillField('fechaDivorcio',$faker->date($format = 'd-m-Y', $max = 'now'));
//And
$I->click('Registrar Divorcio');
//Then
$I->seeCurrentUrlEquals('/divorcio');