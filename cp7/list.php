<?php
// Imports
include_once('test_session.php');
include_once('pdo_connect.php');

// Récupère la page active si existe
if(isset($_GET['pg']) && !empty($_GET['pg'])){
    $pg = (int) $_GET['pg'];
} else {
    $pg = 1;
}

// Récupère le nombre de ligne actif si existe
if(isset($_GET['nb']) && !empty($_GET['nb'])){
    $nb = (int) $_GET['nb'];
} else {
    $nb = 10;
}
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Northwind Traders</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css">
</head>

<body class="container">
    <?php
    // Affiche les titres
    $t = $_GET['t'];
    $k = $_GET['k'];
    echo '<h1>Base de données : ' . DB . '</h1>';
    echo '<h2>Table : ' . $t . '</h2>';
    // Exécute et lit la requête
    try {
        $start = ($pg -1) * $nb;
        $sql = 'SELECT * FROM ' . $t. ' LIMIT ' . $start .',' . $nb;
        $qry = $cnn->prepare($sql);
        $qry->execute();
    } catch (PDOException $err) {
        echo '<p class="alert alert-danger">' . $err->getMessage() . '</p>';
    }
    ?>
    <!-- breadcrumb -->
    <table class="table table-striped">
        <thead>
            <tr>
                <?php
                // Affiche le nom des colonnes
                $html = '';
                $type = [];
                for ($i = 0; $i < $qry->columnCount(); $i++) {
                    // Récupère les infos de la colonne
                    $meta = $qry->getColumnMeta($i);
                    // Affiche le nom de colonne
                    $html .= '<th>' . $meta['name'] . '</th>';
                    // Stocke le type de données de la colonne
                    $types[$meta['name']]=$meta['native_type'];                   
                }
                echo $html;
                ?>
            </tr>
        </thead>
        <tbody>
            <?php
            // Affiche les data
            $html = '';
            while ($row = $qry->fetch()) {
                $html .= '<tr>';
                foreach ($row as $key => $val) {
                    // Alignement selon le type de colonne
                    switch($types[$key]){
                        case 'LONG':
                        case 'NEWDECIMAL':
                            $align = 'right';
                            break;
                        case 'DATE';
                            $align = 'center';
                            break;
                        default:
                            $align = 'left';
                    }
                    // Selon BLOB ou TEXT
                    if ($types[$key]=='BLOB'){
                        $html .= '<td><img style="width:15rem" src="'.$val.'"/></td>';
                    } else {
                        $html .= '<td align="'.$align.'">' . $val . '</td>';
                    }
                }
                $html .= '</tr>';
            }
            echo $html;
            ?>
        </tbody>
    </table>
        <nav>
            <ul class="pagination flex-wrap justify-content-center">
                <?php
                // Calcule et affiche la pagination
                $res = $cnn->query("SELECT COUNT(*) AS total FROM $t");
                $row = $res->fetch();
                $pgs = ceil($row['total']/$nb);
                // Affiche la pagination
                $html = '';
                for ($i = 1; $i <= $pgs; $i++) {
                $href = $_SERVER['PHP_SELF'] . '?t=' .$t . '&k=' . $k . '&pg=' . $i. '&nb='. $nb;
                $html .= '<li class="page-item ' . ($pg === $i ? 'active' : '') . '"><a class="page-link" href="' . $href . '">' . $i . '</a></li>';
                }
                echo $html;
                unset($cnn);
                ?>    
            </ul>
        </nav>
</body>

</html>