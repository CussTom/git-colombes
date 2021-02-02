<?php

require_once('functions.php');

/**
 * Batterie de tests pour la fonction AGE
 */

echo '<p>Test 1 : ' . age('12/31/2005', '1997-05-14');
echo '<p>Test 2 : ' . age('123456', '987654');
echo '<p>Test 3 : ' . age('toto', 'tata');

/**
 * Batterie de tests pour la fonction IS_DATE
 */


echo '<p>Test 4 : ' . is_date('12/31/2005');
echo '<p>Test 5 : ' . is_date('Toto aime le coco');
echo '<p>Test 6 : ' . is_date(1234323);
echo '<p>Test 7 : ' . is_date("29/02/2021");

/**
 * Batterie de tests pour la fonction TTC
 */

// echo '<p>Test 8 : ' . ttc(100, 0.2);
// echo '<p>Test 9 : ' . ttc('coucou', 0.2);
// echo '<p>Test 10 : ' . ttc(100, 0.13);

/**
 * Batterie de test pour ma fonciton GENRATEPASSWORD
 */

 echo '<p>Test 13 : ' . generatePassword();
 echo '<p>Test 14 : ' . generatePassword(18);
 echo '<p>Test 15 : ' . generatePassword(5);

/**
 * Batterie de test pour ma fonciton GENRATEPASSWORD2
 */

echo '<p>Test 16 : ' . generatePassword();
echo '<p>Test 17 : ' . generatePassword(18);
echo '<p>Test 18 : ' . generatePassword(5);
echo '<p>Test 19 : ' . generatePassword(70);

/**
 * Test de la fonciton MAKESELECT
 */
echo '<p>Test 20 : ' . makeSelect(array(1, 2, 3, 0, "1998-07-12", "Allez les bleus"));
// echo '<p>Test 21 : ' . makeSelect("Toto aime le maquereau");

/**
 * Batterie de test pour ma fonciton AVERAGE
 */

echo '<p>Test 22 : ' . average(10, 20, 30);
echo '<p>Test 23 : ' . average(rand(1,9), rand(10,99), rand(100, 999));
echo '<p>Test 24 : ' . average(10, '20', '2020-11-02', 'Toto fait du vélo');
echo '<p>Test 25 : ' . average(10, array(20, 30));
echo '<p>Test 26 : ' . average(array(20, 30));

?>

