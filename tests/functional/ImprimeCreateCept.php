<?php 
$I = new FunctionalTester($scenario);
$I->am('a REVAD user');
$I->wantTo('verify imprime matrimonios view');

$I->amOnPage('/imprime/create');
//When
$I->fillField('cuiHombre','2120002162209');
$I->fillField('cuiMujer','2120002051106');
//And
$I->click('Buscar Matrimonio');
//Then
$I->seeCurrentUrlEquals('/imprime');