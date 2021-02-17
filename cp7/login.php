<?php
// 1. Vérif et sécurisation des variables $_POST
if (isset($_POST['mail']) && !empty($_POST['mail'])){
    $mail = htmlspecialchars($_POST['mail']);
}
if (isset($_POST['pass']) && !empty($_POST['pass'])){
    $pass = htmlspecialchars($_POST['pass']);
} 

// 2.Crypter l'adresse mail et le mdp
// mail en MD5 / pass SHA2 et SHA1 et MD5
$mail = MD5($mail);
$pass = hash('sha512', sha1($pass) . $mail);

// 3. Tester via connexion PDO si l'utilisateur existe
try{
    // Import
    include_once('constants.php');
    // Connexion
    $cnn = new PDO(
        'mysql:host=' .HOST. ';dbname=' .DB.';charset=utf8',
        USER,
        PASS, 
        array(
            PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE=> PDO::FETCH_ASSOC
        )
    );

    // Préparation et execution de la requête
    $sql = "
        SELECT * FROM users
        WHERE mail = ? AND pass = ?"
        ;
    $qry = $cnn->prepare($sql);
    $vals = array($mail, $pass);
    $qry->execute($vals);
    // 3a. Tester si user reconnu alors router(header) vers bo.php
    if ($qry->rowCount() === 1){
        // Démarrage session et stockage variables de session
        session_start();
        $row = $qry->fetch();
        $_SESSION['connected'] = true;
        $_SESSION['session_id'] = session_id();
        $_SESSION['fname'] = $row['fname'];
        $_SESSION['mail'] = $_POST['mail']; // récuperation de la saisie du mail via $_POST
        // Route vers bo.php
        header('location:bo.php');
        // 3b. Sinon router vers index.php avec variable dans querystring -> afficher message dans index.php
    } else {
        // Route vers index.php avec message
        header('location:index.php?cnn=1'); // 1: login ou mdp incorrect
    }
} catch(PDOException $err){
    echo $err->getMessage();
}

unset($cnn);