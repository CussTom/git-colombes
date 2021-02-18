<?php
// Vérification si session est ouverte ou non
// Démarre ou restore une session
session_start();
// Teste si une connexion
if (!isset($_SESSION['connected']) || !$_SESSION['connected']) {
    header('location:index.php?cnn=2');
    exit(); // assure la sortie
}
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
    <div class="jumbotron jumbotron-fluid">
        <div class="container">
            <h1 class="display-4">Back-Office</h1>
        </div>
    </div>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="index.php">Accueil</a></li>
            <li class="breadcrumb-item active" aria-current="page">Back-office</li>
        </ol>
    </nav>



    <section class="row">
        <?php
        include_once('constants.php');
        // Connexion, requête et recherche d'erreur
        try {
            // Connexion en passant en paramètres les constantes
            $cnn = new PDO('mysql:host=' . HOST . ';dbname=' . DB . ';charset=utf8', USER, PASS);
            $cnn->setAttribute(
                PDO::ATTR_ERRMODE,
                PDO::ERRMODE_EXCEPTION
            );
            $cnn->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
            // Préparation de la requête
            $sql = "
                SELECT t.TABLE_NAME, t.TABLE_ROWS, c.COLUMN_NAME
                FROM information_schema.tables t
                JOIN information_schema.columns c
                ON t.TABLE_SCHEMA = c.TABLE_SCHEMA
                AND t.TABLE_NAME = c.TABLE_NAME
                WHERE t.TABLE_SCHEMA = ?
                AND c.COLUMN_KEY = ?
                AND t.TABLE_ROWS < ?";
            $qry = $cnn->prepare($sql);
            $vals = array(DB, 'PRI', 1000);
            $qry->execute($vals);
            // Parcours du dataset
            $html = '';
            while ($row = $qry->fetch()) {
                $html .= '
                <div class="card m-3" style="width: 14rem; box-shadow: 0.1rem 0.2rem #000">
                    <img src="database.jpg" class="card-img-top" alt="image header">
                    <div class="card-body">
                        <h5 class="card-title" style="text-decoration: underline">' . strtoupper($row['TABLE_NAME']) . '</h5>
                        <p class="card-text"><strong >Clé primaire : </strong>' . $row['COLUMN_NAME'] . '</p>
                        <p class="card-text"><strong>Nb de lignes : </strong>' . $row['TABLE_ROWS'] . '</p>
                        <a href="list.php?t=' . $row['TABLE_NAME'] . '&k=' . $row['COLUMN_NAME'] . '" class="btn btn-primary">Détails</a>
                    </div>
                </div>';
            }
            echo $html;
            // Déconnexion
            unset($cnn);
            // En cas d'erreur(s)
        } catch (PDOException $err) {
            echo '<p class="alert alert-danger">' . $err->getMessage() . '</p>';
        }
        ?>
    </section>
</body>