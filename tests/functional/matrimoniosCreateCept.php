<?php 
$I = new FunctionalTester($scenario);
$I->am('a REVAD user');
$I->wantTo('verify matrimonios create view');

$I->amOnPage('/matrimonio/create');
//When
$I->fillField('cuiHombre','2120000031615');
$I->fillField('cuiMujer','2120010811308');
$I->fillField('municipio','1');
$I->fillField('lugarMatrimonio','guatemala');
$I->fillField('fechaMatrimonio','05/01/2019');
$I->fillField('regimenMatrimonial','bienes mancomunados');
//And
$I->click('Registrar Matrimonio');
//Then
$I->seeCurrentUrlEquals('/matrimonio');