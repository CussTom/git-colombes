<?php

/**
 * Renvoie l'âge en année entre deux dates passées en paramètres
 * @param {string} $date1 - une date au format texte ('dd/mm/yyyy' ou 'yyyy-mm-dd')
 * @param {string} $date2 - une 2e date au format texte
 * @return {int} âge en années
 */

function age($date1, $date2):int {

    // Teste si les arguments sont bien des dates
    if (!is_date($date1) || !is_date($date2)){
        trigger_error("L'un des arguments n'est pas une date", E_USER_WARNING);
    }

    // Trasnforme les dates de string en timestamp
    $d1 = strtotime($date1);
    $d2 = strtotime($date2);

    // Cherche la date la plus forme vs la plus faible
    if ($d1>$d2){
        $diff = $d1 - $d2;
    } elseif ($d2>$d1){
        $diff= $d2 - $d1;
    }  else {
        $diff = 0;
    }

    // Renvoie le résultat
    return floor($diff)/60/60/24/365.25;
};

/**
 * Renvoie true si la chaine passée en paramètre est une date
 * @param {string} $arg - argument à tester
 * @return {boolean}
 */

 function is_date($arg):bool {
    return (bool) strtotime($arg);
 }

 // fonction TTC qui convertit un montant HT en TTC avec 2 arguments 
 // $mt : réel positif ou null
 // $taux : réel valant

 function ttc($mt, $taux):int { 
    $mt = abs();
     $taux = ;
     return $mt*$taux;
 }