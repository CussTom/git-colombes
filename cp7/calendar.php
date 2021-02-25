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
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Northwind Traders</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
    <link rel="stylesheet" href="calendar/main.min.css">
</head>

<body class="container">
    <div class="jumbotron">
        <h1 class="display-4">Calendrier des commmandes</h1>
    </div>

    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="index.php">Accueil</a></li>
            <li class="breadcrumb-item active" aria-current="page">Calendrier des commandes</li>
        </ol>
    </nav>

    <nav>
        <div class="btn-group" role="group" aria-label="Basic example">
            <a href="new_order.php" class="btn btn-secondary">Prendre une commande</a>
            <a href="bo.php" class="btn btn-secondary">Back-Office</a>
        </div>
    </nav>

    <div id="calendar">
        <script src="calendar/main.min.js"></script>
        <script src="calendar.js"></script>
    </div>



</body>

</html>