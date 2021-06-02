<?php
// Vérification si session est ouverte ou non
// Démarre ou restore une session
session_start();
// Teste si une connexion
if (!isset($_SESSION['connected']) || !$_SESSION['connected']){
    header('location:index.php?cnn=2');
    exit(); // assure la sortie
}
?>