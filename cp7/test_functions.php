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

?>