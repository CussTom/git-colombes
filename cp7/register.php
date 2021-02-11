<?php
// Tester avec MYSQLI si le user est reconnu ou pas :
include_once('constants.php');

// 1. connexion a BDD
$cnn = mysqli_connect(HOST, USER, PASS, DB);
if (mysqli_connect_errno()){
    printf("Erreur de connexion : %s", mysqli_connect_error());
    exit();
}
// 2. créer une requête prépaprée si mail + pass trouvés
$qry = mysqli_stmt_init($cnn);
$sql = 'SELECT COUNT(*) AS nb FROM users WHERE mail =?'; // ? pour n'importe quelle adresse @ saisie
if (mysqli_stmt_prepare($qry, $sql)){
    $hash = MD5(htmlspecialchars($_POST['mail']));
    // lie les paramètres à la requête préparée
    mysqli_stmt_bind_param($qry, 's', $hash);
    mysqli_stmt_bind_result($qry, $nb); // execute et va envoyer resultat dans la 1ere variable
    mysqli_stmt_fetch($qry);
    mysqli_stmt_close($qry);
}

// 2a. si oui afficher message d'erreur
if($nb === 1){
    echo 'Ce compte existe déjà : '. $_POST['mail'];

} else {
    echo 'Ce compte n\'existe pas';
    // 2b. si non alors créer un nouvel user avec role app_read
    $qry = mysqli_stmt_init($cnn);
    $sql = 'INSERT INTO users(mail, fname, pass, land, active) VALUES(?, ?, ?, ?, ?)';
    if(mysqli_stmt_prepare($qry, $sql)){
        $mail = MD5(htmlspecialchars($_POST['mail']));
        $fname = strtolower(htmlspecialchars($_POST['fname']));
        $pass = hash('sha512', sha1(htmlspecialchars($_POST['pass']), false) . $mail, false);
        $land = htmlspecialchars($_POST['land']);
        $active = 0;
        mysqli_stmt_bind_param($qry, 'ssssi', $mail, $fname, $pass, $land, $active);
        $res = mysqli_stmt_execute($qry);
        mysqli_stmt_close($qry);

        // Envoie d'un mail pour confirmation si succès
        if ($res){
            // Corps du mail
            $html = '<h1>Inscription Northwind Traders</h1>';
            $html .= '<p>Bonjour ' . $_POST['fname'] . 'et bienvenu(e) sur notre site';
            $html .= '<p>Clique sur le lien suivant pour valider ton inscritption : http://' . $_SERVER['HTTP_HOST'] . '/colombes/cp7/register2.php?m=' . $mail;
            $html .= '<p>A très bientôt';  
            // En-tête du mail
            $header = "MIME-Version: 1.0 \n"; // Version MIME
            $header .= "Content-type: text/html; charset=utf-8 \n"; // Format du mail
            $header .= "From: marie@noelle.fr \n"; // Expéditeur
            $header .= "Reply-to: manu@elysees.gouv.fr \n"; // Destinataire
            $header .= "Disposition-Notification-To: tomt75633@gmail.com \n"; // Accusé de réception
            $header .= "X-Priority: 1 \n"; // Activation importante
            $header .= "X-MSMail-Priority: High \n"; // Microsoft
            // Envoi du mail
            // Pour Linux installer un utilitaire de messagerie : http://www.postfix.org/
            // ini_set('SMTP', 'smtp-relay.gmail.com');
            // ini_set('sendmail_from', 'tomt75633@gmail.com'); // Windows only
            ini_set('sendmail_path', '/chemin sendmail.exe'); // Linux only
            $res2 = mail($_POST['mail'], 'Northwind Traders', $html, $header,);
            echo($res2 ? 'Succès' : 'Echec');
        } else {
            echo 'Echec dans l\'ajout du user';
        }
    }
}


mysqli_close($cnn);