<?php
include_once('constants.php');
include_once('singleton.class.php');
include_once('model.class.php');

// Renvoie les commandes passées sous la forme d'un objet JSON
Singleton::setConfiguration(HOST, 3306, DB, USER, PASS);
$sql = "SELECT CONCAT(co.NO_COMMANDE, ' - ', cl.SOCIETE) AS title,
        co.DATE_COMMANDE AS start,
        IFNULL(co.DATE_ENVOI, co.DATE_COMMANDE) AS end
        FROM commandes co
        JOIN clients cl
        ON co.CODE_CLIENT = cl.CODE_CLIENT";
        echo Singleton::getAllData($sql);
