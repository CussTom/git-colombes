<?php

/** VERIFICATION DU CODE RENSEIGNÉ PAR LE USER */

// lance la session
session_start();

$code = $_POST['code'];

// vérification entre le code généré et celui du user
if($code == $_SESSION["captcha_code"]){
    echo 'valide';
}

?>