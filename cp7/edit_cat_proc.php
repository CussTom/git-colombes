<?php
// var_dump($_POST);

// Sécurité : step 2
// protège les saisies d'une éventuelle injection
$params = [];
foreach ($_POST as $key => $value) {
    if(isset($_POST[$key]) && !empty($_POST[$key])){
        $params[] = htmlspecialchars($_POST[$key]);
    } else {
        $params[] = null;
    }
}

// Connection à la base de donnée via MySQLI et vérif
$cnn = mysqli_connect('localhost', 'root', 'greta', 'northwind');
if (mysqli_connect_errno()){
    printf("Erreur de connexion : %s", mysqli_connect_error());
    exit();
}

// Récuperation de l'image a téléverser
var_dump($_FILES);
if (isset($_FILES['PHOTO']) && $_FILES['PHOTO']['error'] !== UPLOAD_ERR_NO_FILE){
    // Variables du fichier à stocker
    $file_exts = array('gif','jpeg', 'png', 'webp');
    $file_ext = strtolower(substr($_FILES['PHOTO']['type'], strpos($_FILES['PHOTO']['type'], '/')+1)); // pour récuperer l'extension du fichier
    $file_size = $_FILES['PHOTO']['size'];
    $file_temp = $_FILES['PHOTO']['tmp_name'];
    // Teste si pas d'erreurs
    $errors = [];
    if (!in_array($file_ext, $file_exts)){
        $_errors[] = '<p>Extension du fichier non autorisée : '. implode(',', $file_exts);
    }
    if ($file_size > (int) $_POST['MAX_FILE_SIZE']){
        $errors[] = '<p>Fichier trop lourd : '.($_POST['MAX_FILE_SIZE']/1024). ' Ko minimum';
    }
    // Si pas d'erreurs
        if (empty($errors)){
            // Lire le contenu du fihier à stocker
            $bin = file_get_contents($file_temp);
            $base64 = 'data:' .$file_ext . ';base64,' . base64_encode($bin);
            $params[3] = $base64;
        } else {
            foreach ($errors as $error) {
                echo $error;
            }
            echo '<a href="edit_cat_form.php">Retour au formulaire</a>';
            exit();
        }
    } else {
        $params[3] = $_POST['TEST'];
    }
    // Teste si UPDATE ou INSERT
    if(isset($_GET['k']) && !empty($_GET['k'])){
        $update = true;
    } else{
        $update = false; // INSERT
    }
    

    // Sécurité : step 3
    // préparation de la requête
    $qry = mysqli_stmt_init($cnn);
    if ($update){
        $sql = "UPDATE categories SET CODE_CATEGORIE = ?, NOM_CATEGORIE=?, DESCRIPTION=?, PHOTO=? WHERE CODE_CATEGORIE=?";
    } else {
        $sql = "INSERT INTO categories(CODE_CATEGORIE, NOM_CATEGORIE, DESCRIPTION ,PHOTO) VALUES(?, ?, ?, ?)";
    }
    
    if(mysqli_stmt_prepare($qry,$sql)){
        //lie les paremètre a la requète preparée
        if ($update){
            mysqli_stmt_bind_param($qry, "isssi", $params[0], $params[1], $params[2], $params[3], $_GET['k']);
        } else {
            mysqli_stmt_bind_param($qry, "isss", $params[0], $params[1], $params[2], $params[3]);
        }                           // i pour int, s string et s pour le blob car chaine de caractère
        // exécute la requête
        mysqli_stmt_execute($qry);
        // ferme le statement
        mysqli_stmt_close($qry);

mysqli_close($cnn);
}

// Renvoie vers la liste
header('location:edit_cat_list.php');