<?php
// Import
include_once('test_session.php');
include_once('pdo_connect.php');

// Récupère les paramètres de l'URL (QUERRY_STRING)
if (isset($_GET['e']) && !empty($_GET['e'])) {
    $e = $_GET['e'];
} else {
    $e = 5; // Pour employé n°5 par ex
}

if (isset($_GET['a']) && !empty($_GET['a'])) {
    $a = $_GET['a'];
} else {
    $a = 2019; // Pour 2019 par ex
}

// Prépare et exécute la requête
$sql = "SELECT e.no_employe,
    e.nom,
    YEAR(c.date_commande) as annee,
    MONTH(c.date_commande) as mois,
    SUM((d.prix_unitaire*d.quantite)*(1-d.remise)) as ca
    FROM employes e
    JOIN commandes c
    ON e.no_employe = c.no_employe
    JOIN details_commandes d
    ON c.no_commande = d.no_commande
    WHERE e.no_employe = ?
    AND YEAR(c.date_commande) = ?
    GROUP BY e.no_employe,
    e.nom,
    YEAR(c.date_commande),
    MONTH(c.date_commande)
    ";
$qry = $cnn->prepare($sql);
$qry->execute(array($e, $a));
$data = $qry->fetchAll();

// Génére la zone de dessin
$w = 800;
$h = 600;
// $img = imagecreatetruecolor($w, $h);
$img = imagecreatefromwebp('space.webp');

// Crayons de couleur
$black = imagecolorallocate($img, 0, 0, 0);
$white = imagecolorallocate($img, 255, 255, 255);
$trans = imagecolorallocatealpha($img, 255, 255, 255, 70);

// Fond transparent
imagefilledrectangle($img, 0, 0, $w, $h, $trans);



if(!$data){
    imagestring($img, 5, 100, 100, $gap, $gap, "Aucune data", $black);
} else {
    // Variables de calcul
    $gap = 20;
    $wbar = ($w - ($gap * 2)) / count($data);
    $hmax = $h - ($gap * 2);
    $val_max = 150000; // CA max

   // Dessine l'histogramme via la requête
for ($i = 0; $i < count($data); $i++) {
    // Barres
    $hbar = round(($data[$i]['ca'] * ($hmax - $gap)) / $val_max);
    $alea = imagecolorallocatealpha($img, rand(0, 255), rand(0, 255), rand(0, 255), 31);
    imagefilledrectangle($img, $gap + ($i * $wbar), $hmax - $hbar, $gap + ($i * $wbar) + $wbar, $h - $gap, $alea);
    imagerectangle($img, $gap + ($i * $wbar), $hmax - $hbar, $gap + ($i * $wbar) + $wbar, $h - $gap, $white);
    // Labels : CA en haut des barres
    imagestring($img, 5, $gap+($i*$wbar)+15, $h-$hbar-(3*$gap), round($data[$i]['ca']/1000).' KE', $white);
    // Graduation en bas des barres
    imagestring($img, 5, $gap+($i*$wbar)+$wbar/2, $h-$gap, $data[$i]['mois'], $black);
    }

     // Axes et titres
     imageline($img, $gap, $h - $gap, $w - $gap, $h - $gap, $black); // Abscisses
     imageline($img, $gap, $gap, $gap, $h - $gap, $black); // Ordonnées
     imagestring($img, 15, $w * .25, $gap, "CA du vendeur $e pour l'annee $a", $black);

}

// Affiche le resultat
header('Content-Type: image/png');
imagepng($img);
imagedestroy($img);
