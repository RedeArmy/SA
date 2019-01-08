<?php 
$I = new FunctionalTester($scenario);
$I->am('a Laravel developer');
$I->wantTo('verify nacimientos view');

$I->amOnPage('/servicionacimiento/create');

//When
$I->fillField('nombre','Espiriberto');
$I->fillField('apellido','Justiniano');
$I->fillField('genero','1');
$I->fillField('fechanacimiento','05/01/2019');
$I->fillField('municipio','1');
$I->fillField('lugarNacimiento','calle 1, hospital roosevelt');
$I->fillField('cuiPadre','2120000031615');
$I->fillField('cuiMadre','2120010811308');
//And
$I->click('Registrar Nacimiento');
//Then
$I->seeCurrentUrlEquals('/servicionacimiento');
