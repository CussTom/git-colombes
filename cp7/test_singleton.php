<?php
// Imports
include_once('singleton.class.php');
include_once('constants.php');
include_once('model.class.php');

/**
 * Test sur Singleton
 */

// Test 1 : Connexion
Singleton::setConfiguration(HOST, 3306, DB, USER, PASS);

// Test 2 : Connexion et Composant select
echo Singleton::getHtmlSelect('prod', 'SELECT * FROM produits WHERE NO_FOURNISSEUR = ?', array(2));

// Test 3 : Composant SELECT
echo Singleton::getHtmlTable('SELECT * FROM commandes WHERE DATE_COMMANDE BETWEEN ? AND ?', array('2019-01-01', '2019-01-05'));

/**
 * Test sur Model
 */

// Test 4 : Instanciation
$produits = new Model(HOST, 3306, DB, USER, PASS, 'produits');

// Test 5 :  getRows
// var_dump($produits->getRows());

// Test 6 :  getRow
var_dump($produits->getRow('REF_PRODUIT', 11));

// Test 7 : insert
$cat = new Model(HOST, 3306, DB, USER, PASS, 'categories');
$cat->insert(array(
    'CODE_CATEGORIE'=> 667,
    'NOM_CATEGORIE'=> 'Devil Cream',
    'DESCRIPTION' => ' Diaboliquement bon'
));


// Test 8 : update
$cat->update(array(
    'CODE_CATEGORIE'=> 998,
    'NOM_CATEGORIE'=> 'Devil Creamy',
    'DESCRIPTION' => ' Diaboliquement good'
), 'CODE_CATEGORIE', '667');

// Test 9 : delete
$cat->delete('CODE_CATEGORIE', 998);

var_dump($cat->getRows());