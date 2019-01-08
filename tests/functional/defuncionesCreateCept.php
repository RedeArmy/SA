<?php 
$I = new FunctionalTester($scenario);
$I->am('a Laravel developer');
$I->wantTo('verify defunciones view');

$I->amOnPage('/defuncion/create');
//When
$I->fillField('cui','2120000031615');
$I->fillField('cuiCompareciente','2120010811308');
$I->fillField('municipio','1');
$I->fillField('lugarDeDefuncion','guatemala');
$I->fillField('fechaDeDefuncion','05/01/2019');
$I->fillField('causa','murio por causas naturales');
//And
$I->click('Registrar Defuncion');
//Then
$I->seeCurrentUrlEquals('/defuncion');
