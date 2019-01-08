<?php 
use Faker\Factory as Faker;

$faker = Faker::create();

$I = new FunctionalTester($scenario);
$I->am('a Laravel developer');
$I->wantTo('verify defunciones view');

$I->amOnPage('/defuncion/create');
//When
$I->fillField('cui','2120000031615');
$I->fillField('cuiCompareciente','2120010811308');
$I->fillField('municipio',$faker->numberBetween($min = 1, $max = 338));
$I->fillField('lugarDeDefuncion',$faker->address);
$I->fillField('fechaDeDefuncion',$faker->date($format = 'd-m-Y', $max = 'now'));
$I->fillField('causa',$faker->sentence($nbWords = 3, $variableNbWords = true));
//And
$I->click('Registrar Defuncion');
//Then
$I->seeCurrentUrlEquals('/defuncion');