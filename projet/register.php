<?php
include_once('constants.php');
include_once('pdoConnect.php');

// var_dump($_POST);
// var_dump($_SESSION['code']);
// var_dump($_POST["captcha"]);

session_start();

// on vérifie que captcha est défini et non vide, puis on le compare avec le code renseigné par le user
if(isset($_POST["captcha"]) && $_POST["captcha"] != " " && $_SESSION["code"] == $_POST["captcha"]) {
  // header('location: index.php?user=ok');
} else  {  
  header('Location: index.php?captcha=w');
  exit;
}

// Tester avec MYSQLI si le user est reconnu ou pas :
// requête préparée pour vérifier si mail trouvé
$sql = 'SELECT COUNT(*) AS nb FROM users WHERE mail=?';
$qry = $cnn->prepare($sql);
$hash = MD5(htmlspecialchars($_POST['mail']));
$qry->execute(array($hash));
$row = $qry->fetch();

if ($row['nb'] == 1) {
  // si OUI routage vers index.html avec alerte user créé
  header('location: index.php?user=ko');
}  
elseif ($row['nb'] == 0) { 
  // si NON alors créer un nouvel user avec role app_read
  $pass = hash(
    'sha512',
    sha1(htmlspecialchars($_POST['pass']), false) . $hash,
    false);
  $fname = strtolower(htmlspecialchars($_POST['fname']));
  $land = htmlspecialchars($_POST['land']);
  $active = 0;
  $sql = 'INSERT INTO users(mail, fname, pass, land, active) VALUES(?, ?, ?, ?, ?)';
  $qry = $cnn->prepare($sql);
  $res = $qry->execute(array($hash, $fname, $pass, $land, $active));
  // routage vers index.html avec alerte user créé
  header('location: index.php?user=ok');
 }
