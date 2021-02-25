<?php
// Imports
include_once('test_session.php');
include_once('pdo_connect.php');

// Test 1 : Vérif si les variables T, K et ID sont présentes
// et si T et K ne sont pas vides
if (isset($_GET['t']) && !empty($_GET['t']) && isset($_GET['k']) && !empty($_GET['k']) && isset($_GET['id'])) {

    $t = $_GET['t'];
    $k = $_GET['k'];
    $id = $_GET['id'];
    $cols = [];
    $vals = [];

    if (empty($_GET['id'])) {
        // Test 2 : Vérif si la variable ID est vide
        // Alors génère la requête SQL pour INSERT
        $sql = "INSERT INTO $t(%s) VALUES(%s)";
        foreach ($_POST as $key => $val) {
            $cols[] = $key;
            $vals[":$key"] = htmlspecialchars($val);
        }
        $sql = sprintf(
            $sql,
            implode(',', $cols),
            implode(',', array_keys($vals))
        );
    } else {
        // Sinon UPDATE
        $sql = "UPDATE $t SET %s WHERE $k=:newid";
        foreach ($_POST as $key => $val) {
            $cols[] = $key . '=:' . $key;
            $vals[":$key"] = $val;
        }
        $vals[':newid'] = $id;
        $sql = sprintf(
            $sql,
            implode(',', $cols)
        );
    }

    // Prépare et exécute la requête
    try {
        $qry = $cnn->prepare($sql);
        $qry->execute($vals);
        unset($cnn);
        header("location:list.php?t=$t&k=$k");
    } catch (PDOException $err) {
        echo $err->getMessage();
    }
}