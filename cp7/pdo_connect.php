<?php
include_once('constants.php');
 // Connexion, requête et recherche d'erreur
 try{
     // Connexion en passant en paramètres les constantes
     $cnn = new PDO('mysql:host=' .HOST.';dbname=' .DB.';charset=utf8', USER, PASS);
     $cnn->setAttribute(PDO::ATTR_ERRMODE,
                     PDO::ERRMODE_EXCEPTION);
     $cnn->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
    } catch (PDOException $err) {
        echo $err->getMessage();
}