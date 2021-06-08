<?php

include_once('constants.php');
include_once('pdoConnect.php');

session_start();

$random = md5(mt_rand()); // plus rapide que rand()
$code = substr($random, 0, 8);

$_SESSION["code"] = $code;
$image = imagecreatetruecolor(100, 38);
$background = imagecolorallocate($image, 231, 100, 18); 
$forground = imagecolorallocate($image, 255, 255, 255);
imagefill($image, 0, 0, $background);
imagestring($image, 5, 15, 10,  $code, $forground);
header("Cache-Control: no-cache, must-revalidate");
header('Content-type: image/png'); // affiche le contenu en php
imagepng($image); // rednu final de l'image
imagedestroy($image); // libère la mémoire allouée
?>