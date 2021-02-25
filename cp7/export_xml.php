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
        $root = new SimpleXMLElement("<$t/>");
        while ($row = $qry->fetch()) {
            $child = $root->addChild(substr($t, 0, strlen($t) - 1));
            foreach ($row as $key => $val) {
                $child->addChild(strtolower($key), $val);
            }
        }
        // Fermeture fichier et connexion
        unset($cnn);
        header('Content-type: text/xml');
        echo $root->asXML();
    } catch (PDOException $err) {
        echo $err->getMessage();
    }
} else {
    echo 'Aucune table trouvée !';
}
