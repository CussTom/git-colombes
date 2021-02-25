<?php
// Imports
include_once('test_session.php');
include_once('pdo_connect.php');

// Récupère la table à exporter
if (isset($_GET['t']) && !empty($_GET['t'])) {
    // Accès aux data
    try {
        // Ouvre un flux
        header('Content-Type: text/csv');
        header('Content-Disposition: attachment; filename="export.csv"');
        $stream = fopen('php://output', 'w');
        // Exécute requête
        $t = $_GET['t'];
        $sql = "SELECT * FROM $t";
        $qry = $cnn->query($sql);
        // Lit et écrit les noms de colonne
        $row = [];
        for ($i = 0; $i < $qry->columnCount(); $i++) {
            $meta = $qry->getColumnMeta($i);
            $row[] = $meta['name'];
        }
        fputcsv($stream, $row, ';');
        // Lit et écrit les data
        while ($row = $qry->fetch()) {
            fputcsv($stream, $row, ';');
        }
        // Fermeture fichier et connexion
        fclose($stream);
        unset($cnn);
    } catch (PDOException $err) {
        echo $err->getMessage();
    }
} else {
    echo 'Aucune table trouvée !';
}