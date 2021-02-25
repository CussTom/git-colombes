<?php
//Imports
include_once('model.class.php');
include_once('constants.php');
$order=new Model(HOST, 3306, DB, USER, PASS, 'commandes');
$order->insert($_POST);
header('location:calendar.php');