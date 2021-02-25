
<?php
// Imports
include_once('test_session.php');
include_once('pdo_connect.php');

if (isset($_GET['t']) && !empty($_GET['t']) && isset($_GET['k']) && !empty($_GET['k']) && isset($_GET['id']) && !empty($_GET['id'])) {
    try {
        // Prépare et exécute la requête
        $t = $_GET['t'];
        $k = $_GET['k'];
        $id = $_GET['id'];
        $sql = "DELETE FROM $t WHERE $k=?";
        $qry = $cnn->prepare($sql);
        $qry->execute(array($id));
        // Renvoie vers la liste
        header("location:list.php?t=$t&k=$k");
        echo 'succès';
    } catch (PDOException $err) {
        echo $err->getMessage();
    }
}