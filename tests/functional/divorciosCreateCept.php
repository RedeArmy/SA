<?php 
$I = new FunctionalTester($scenario);
$I->am('a Laravel developer');
$I->wantTo('verify divorcios view');

$I->amOnPage('/divorcio/create');

//When
$I->fillField('cuiHombre','2120000031615');
$I->fillField('cuiMujer','2120010811308');
$I->fillField('municipio','1');
$I->fillField('lugarDivorcio','guatemala');
$I->fillField('fechaDivorcio','05/01/2019');
//And
$I->click('Registrar Divorcio');
//Then
$I->seeCurrentUrlEquals('/divorcio');

