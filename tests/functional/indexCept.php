<?php 
$I = new FunctionalTester($scenario);
$I->am('a Laravel developer');
$I->wantTo('verify index view');

$I->amOnPage('/');
$I->see('SISTEMA DE CONSULTAS POR DEPARTAMENTO');
