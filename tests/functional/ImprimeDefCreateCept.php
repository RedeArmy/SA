<?php 
use Faker\Factory as Faker;

$faker = Faker::create();

$I = new FunctionalTester($scenario);
$I->am('a REVAD user');
$I->wantTo('verify imprime matrimonios view');

$I->amOnPage('/imprimeDef/create');
//When
$I->fillField('idPais',$faker->numberBetween($min = 1, $max = 5));
$I->fillField('cui','2120002162209');
//And
$I->click('Buscar Defuncion');
//Then
$I->seeCurrentUrlEquals('/imprimeDef');