<?php
// Imports
include_once('test_session.php');
include_once('pdo_connect.php');

// Récupère la table à exporter
if (isset($_GET['t']) && !empty($_GET['t'])) {
    // Accès aux data
    try {
        // Exécute requête
        $t = $_GET['t'];
        $sql = "SELECT * FROM $t";
        $qry = $cnn->query($sql);
        // Lit et renvoie les data
        $obj = $qry->fetchAll(PDO::FETCH_OBJ);
        header('Content-Type: application/json');
        echo json_encode($obj, JSON_NUMERIC_CHECK);
        // Fermeture connexion
        unset($cnn);
    } catch (PDOException $err) {
        echo $err->getMessage();
    }
} else {
    echo 'Aucune table trouvée !';
}