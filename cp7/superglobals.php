<?php
session_start();
$_SESSION['login_time'] = time();
$_SESSION['fname'] = 'Tom';
$_SESSION['admin'] = true;
?>


<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Superglobals</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css">
</head>
<body class='container'>
    <h2>SERVER</h2>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>Clé</th>
                <th>Valeur</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $html = '';
            foreach ($_SERVER as $key => $val) {
                $html.= sprintf('<tr><td>%s</td><td>%s</td></tr>', $key, $val);
            }
            echo $html;
            ?>
        </tbody>
    </table>

    <h2>COOKIE</h2>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>Clé</th>
                <th>Valeur</th>
            </tr>
        </thead>
        <tbody>
            <?php
            setcookie('Granola', 'Toto aime le choco');
            setcookie('Prince', 'Chanteur pop des années 80', time()+365*24*60*60, '/', false, false);
            $html = '';
            foreach ($_COOKIE as $key => $val) {
                $html.= sprintf('<tr><td>%s</td><td>%s</td></tr>', $key, $val);
            }
            echo $html;
            ?>
        </tbody>
    </table>

    <h2>GET</h2>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>Clé</th>
                <th>Valeur</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $html = '';
            foreach ($_GET as $key => $val) {
                $html.= sprintf('<tr><td>%s</td><td>%s</td></tr>', $key, $val);
            }
            echo $html;
            ?>
        </tbody>
    </table>

    <h2>SESSION</h2>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>Clé</th>
                <th>Valeur</th>
            </tr>
        </thead>
        <tbody>
            <?php
            
            $html = '';
            foreach ($_SESSION as $key => $val) {
                $html.= sprintf('<tr><td>%s</td><td>%s</td></tr>', $key, $val);
            }
            echo $html;
            ?>
        </tbody>
    </table>

    
    
</body>
</html>