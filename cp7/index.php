<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Northwhind Traders</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/main.css">
    
</head>
<body class="container">

<div class="jumbotron">
  <h1 class="display-4">Northwind traders</h1>
  <p class="lead">Projet fil rouge en HTML, CSS, Javascript, PHP et MySQL basé sur le jeu de données Northwind.
    <?php
        include_once('team.php');
        $diff = (strtotime(date('Y-m-d'))-strtotime('2020-11-02'))/60/60/24;
        echo 'Développé par '.PRENOM. ', Daron Coder depuis ' .$diff. ' jours.';
    ?>
    </p>
  <hr class="my-4">
  <p>Cliquer sur le bouton ci-dessous pour acccéder au back-office (user et mot de passe requis) :</p>
  <a class="btn btn-success btn-lg" href="login.php" role="button">Connexion</a>
  <a class="btn btn-warning btn-lg" href="register.php" role="button">Inscription</a>
</div>

<h2>Membres de l'équipe</h2>

<section id="team" class="d-flex flex-wrap justify-content-around">
<?php
$html = '';
for ($i=0; $i<count($members); $i++){
    $html .='<div class="card mb-4 '.($members[$i][2] === 'F' ? 'girl':'boy').'" style="width: 18rem;">';
    $html .='<div class="card-body">';
    $html .='<h5 class="card-title">' .$members[$i][0]. '</h5>';
    $html .='<p class="card-text">' . $members[$i][1].' ans</p>';
    $html .='<p class="card-text">' .($members[$i][3] ? ($members[$i][2] === 'F' ? 'Mariée' : 'Marié'):'Célibataire') . '</p>';
    $html .='</div></div>';
}
echo $html;
?>

</section>
<h2>Nos références</h2>
<section id="projects">
  <?php
  include_once('project.php');
  ?>
</section>


<div id="bo">
  <h2>Back_Office</h2>
  <section id="tables">
    <?php
      $cnn = mysqli_connect('localhost', 'root', 'greta', 'information_schema');
      $res = mysqli_query($cnn, "SELECT TABLE_NAME, TABLE_ROWS FROM TABLES WHERE TABLE_SCHEMA = 'northwind'");
      $html .= '';
        while ($row = mysqli_fetch_assoc($res)) {
          $html .= '<a class="btn btn-info m-3" href="' . $row['TABLE_NAME'] . '.php">' . $row['TABLE_NAME'] . ' <span class="badge badge-light">' . $row['TABLE_ROWS'] . '</span></a>';
        }
        echo $html;
        mysqli_close($cnn);
    ?>
    </section>

</body>
</html>


