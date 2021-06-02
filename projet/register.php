<?php

include_once('constants.php');
include_once('pdoConnect.php');

// Tester avec MYSQLI si le user est reconnu ou pas :
// requête préparée pour vérifier si mail trouvé

$sql = 'SELECT COUNT(*) AS nb FROM users WHERE mail=?';
$qry = $cnn->prepare($sql);
$hash = MD5(htmlspecialchars($_POST['mail']));
$qry->execute(array($hash));
$row = $qry->fetch();

if ($row['mail'] === 1) {
  echo $row;
  // si OUI alors afficher message d'erreur
  echo 'Ce compte existe déjà : ' . $_POST['mail'];
}
} else {
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
}
 

    
//     // Envoi d'un mail pour confirmation si succès
//     if ($res ===) {
//       // Corps du mail
//       $url = 'http://' . $_SERVER['HTTP_HOST'] . '/htdocs/projet/register2.php?m=' . $hash;
//       $html = '
//         <!DOCTYPE html>
//         <html lang="fr">
//         <head>
//         <meta charset="UTF-8">
//         </head>
//         ';
//       $html = '<h1>Inscription a Science Today !</h1>';
//       $html .= '<p>Bonjour ' . $_POST['fname'] . ' et bienvenu(e) sur notre site.';
//       $html .= '<p>Cliquez sur le lien suivant pour valider votre inscription : <a href="' . $url.'">' . $url.'</a>';
//       $html .= '<p>A très bientôt';
//       $html .= '</body></html>';
//       // En-tête du mail
//       $header = "MIME-Version: 1.0 \n"; // Version MIME
//       $header .= "Content-type: text/html; charset=utf-8 \n"; // Format du mail
//       $header .= "From: sciencetoday@gmail.fr \n"; // Expéditeur
//       $header .= "Reply-to: DESTINATAIRE@gmail.fr \n"; // Destinataire de la réponse
//       $header .= "Disposition-Notification-To: tomt75633@gmail.com\n"; // Accusé de réception
//       $header .= "X-Priority: 1 \n"; // Activation importance
//       $header .= "X-MSMail-Priority: High \n"; // MS
//       // Envoi du mail
//       $res2 = mail($_POST['mail'], 'Science Today !', urlencode($html), $header);
//       echo ($res2 ? 'Succès' : 'Echec');
//     } else {
//       echo 'Echec dans l\'ajout du user.';
//     }
//   }
// }

// 4. routage vers index.html
// header('location: index.php?user=ok');