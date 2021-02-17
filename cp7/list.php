<?php
// Imports
include_once('test_session.php');
include_once('pdo_connect.php');
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Northwhind Traders</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/main.css">
    
</head>
<body class="container">
    <?php
        // Affiche les titres
        $t = $_GET['t'];
        echo '<h1>Base de données : '.DB.'</h1>';
        echo '<h2>Table : '.$t.'</h2>';
        // Exécute et lit la requête
        try{
            $sql = 'SELECT * FROM '. $t;
            $qry = $cnn->prepare($sql);
            $qry->execute();
        } catch (PDOException $err){
            echo '<p class="alert alert-danger">'.$err->getMessage(). '</p>';
        }
    ?>
<!-- breadcrumb -->
<table class="table table-striped">
    <thead>
    <tr>
        <?php
            // Affiche le nom des colonnes
            $html = '';
            for ($i=0;$i<$qry->columnCount();$i++){ // utiliser for pour les colonnes
                $meta = $qry->getColumnMeta($i);
                $html .= '<th>' .$meta['name'].'</th>';
            }
            echo $html;
        ?>
    </tr>
    </thead>
    <tbody>
        <?php
            foreach ($meta['name'] as $ligne) {
                $html = '<tr>';
                $html .= $ligne;
            }
        ?>
    </tbody>
</table>
</body>
</html>