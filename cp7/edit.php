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
    <title>Northwind Traders</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css">
</head>

<body class="container">
    <?php
    // Message si pas d'info dans l'URL
    if (!isset($_GET['t']) || empty($_GET['t']) || !isset($_GET['k']) && empty($_GET['k']) || !isset($_GET['id']) || empty($_GET['id'])) {
        echo '<p class="alert alert-warning"><strong>Attention !</strong> Aucune donnée à afficher : <a href="bo.php">retour au back-office</a></p>';
        exit();
    }
    // Affiche les titres
    $t = $_GET['t'];
    $k = $_GET['k'];
    $id = $_GET['id'];
    echo '<h1>Base de données : ' . DB . '</h1>';
    echo '<h2>Table : ' . $t . '</h2>';
    ?>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="index.php">Accueil</a></li>
            <li class="breadcrumb-item"><a href="bo.php">Back-Office</a></li>
            <li class="breadcrumb-item"><a href="<?php echo 'list.php?t=' . $t . '&k=' . $k; ?>">Liste</a></li>
            <li class="breadcrumb-item active" aria-current="page">Edition</li>
        </ol>
    </nav>

    <form action="list.php" method="post">
        <div class="form-group">
        
    </form>

</body>

</html>