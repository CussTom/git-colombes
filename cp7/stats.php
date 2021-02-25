<?php
// Imports
include_once('test_session.php');
include_once('constants.php');
include_once('singleton.class.php');
include_once('model.class.php');
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Northwind Traders</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
    <link rel="stylesheet" href="css/main.css">
</head>

<body class="container">
    <div class="jumbotron">
        <h1 class="display-4">Statistiques des ventes</h1>
    </div>

        <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="index.php">Accueil</a></li>
            <li class="breadcrumb-item"><a href="bo.php">Back-Office</a></li>
            <li class="breadcrumb-item active" aria-current="page">Statistiques des ventes</li>
        </ol>
    </nav>

        <div class="form-group">
            <label for="year">Année :</label>
            <?php
                Singleton::setConfiguration(HOST, 3306, DB, USER, PASS);
                echo Singleton::getHtmlSelect('year', 'SELECT DISTINCT YEAR (DATE_COMMANDE) AS année FROM commandes');
            ?>
            </select>
        </div>
        <div class="form-group">
            <label for="emp">Vendeur :</label>
            <?php
                echo Singleton::getHtmlSelect('emp', "SELECT NO_EMPLOYE, CONCAT(PRENOM, ' ', NOM) AS employe FROM employes");
            ?>
            </select>
        </div>

        <div class="form-group">
            <img src="chart.php" id="chart" style="display:block;margin:auto;" alt="Stats des ventes">
        </div>
        <script src="stats.js"></script>

</body>

</html>