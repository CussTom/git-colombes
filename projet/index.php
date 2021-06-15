<?php

include_once('constants.php');
include_once('pdoConnect.php');

session_start();
$connected = false;
if (isset($_SESSION['connected']) && $_SESSION['connected']) {
    $connected = $_SESSION['connected'];
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Science Daily</title>
    <meta name="description" content="Retrouvez toute l'actualité scientifique : articles, vidéos et photos.">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous" defer></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <!-- <script src="https://code.jquery.com/jquery-1.12.4.js"></script> -->
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <link rel="stylesheet" href="css/main.css">
</head>
<body class="container">
<header>
<div class="jumbotron">
      <div class="connect">
        <div class="site-name">
          <h1>Science Today !</h1>
          <p class="slogan">Votre dose d'actualités !</p>
        </div>
      <div class="buttons_home">
          <span style="display:<?php echo ($connected ? '' : 'none'); ?>">
                <a class="btn btn-outline-info btn-sm" href="articles.php" role="button">Articles</a>
		        <a class="btn btn-outline-danger btn-sm" href="deconnexion.php" role="button">Déconnexion</a>
          </span>
          <span style="display:<?php echo (!$connected ? '' : 'none'); ?>">
              <a class="btn btn-outline-info btn-sm" href="#" role="button" data-toggle="modal" data-target="#connexion">Connexion</a>
              <a class="btn btn-outline-danger btn-sm" href="#" role="button" data-toggle="modal" data-target="#register">Inscription</a>
          </span>
        </div>
      </div>
      <button class="btn btn-outline-light btn-sm" id="darkMode"></button>
      <!-- <div id="logo"></div> -->

          <!-- Modal Déconnexion -->
    <div class="modal" id="deconnexion" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
            <form action="deconnexion.php" method="post">
                <div class="modal-header">
                    <h5 class="modal-title">Déconnexion</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            <div class="modal-body">
                <p>Etes vous sûr de vouloir vous déconnecter ?</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
                <a class="btn btn-primary" href="deconnexion.php" role="button">Déconnexion</a>
            </div>
            </form>
            </div>
        </div>
    </div>

      <?php
    // CAPTCHA : Erreur code
    if (isset($_GET['captcha']) && !empty($_GET['captcha'])) {
        if ($_GET['captcha'] === 'w') {
            $html = '
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>Erreur !</strong> Le code est incorrect, veuillez recommencer.
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
                </div>';            
            echo $html;
        }
    }
    // SUCCES : User créé
    if (isset($_GET['user']) && !empty($_GET['user'])) {
        if ($_GET['user'] === 'ok') {
            $html = '
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>Félicitations !</strong> votre compte a été créé avec succès.
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
                </div>';
            echo $html;
        }
         // AVERTISSEMENT : User existe déjà
         elseif ($_GET['user'] == 'ko') {
            $html = '
                <div class="alert alert-warning alert-dismissible fade show" role="alert">
                <strong>Attention ce compte existe déjà !</strong>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
                </div>';
            echo $html;
      }
    }
    if (isset($_GET['cnn']) && !empty($_GET['cnn'])) {
        // ECHEC : Connexion KO
        if ($_GET['cnn'] == 1) {
            $html = '
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>Attention !</strong> login ou mot de passe incorrect.
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
                </div>';
            echo $html;
        }
        // AVERTISSEMENT : Déconnexion OK
        elseif ($_GET['user'] == 2) {
            $html = '
                <div class="alert alert-warning alert-dismissible fade show" role="alert">
                <strong>Avertissement !</strong> Connexion échue.
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
                </div>';
            echo $html;
        }      
    }
    ?>

    <!-- Modal Connexion -->
    <div class="modal fade" id="connexion" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="connexion.php" method="post">
                    <div class="modal-header">
                        <h5 class="modal-title" id="staticBackdropLabel">Connexion</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="mail">Email :</label>
                            <input type="email" name="mail" id="mail" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="pass">Mot de passe :</label>
                            <input type="password" name="pass" id="pass" pattern="[A-Za-z0-9@$*!? ]{8,}" class="form-control" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
                        <input type="submit" value="Valider" class="btn btn-primary">
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal Inscription -->
    <div class="modal fade" id="register" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="register.php" method="post">
                    <div class="modal-header">
                        <h5 class="modal-title" id="staticBackdropLabel" class="text-dark">Inscription</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="fname">Prénom :</label>
                            <input type="text" name="fname" id="fname" pattern="[a-zA-Z\u00C0-\u00FF '\-]{1,30}" required class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="mail">Email :</label>
                            <input type="email" name="mail" id="mail" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="pass">Mot de passe :</label>
                            <input type="password" name="pass" id="pass" pattern="[A-Za-z0-9@$*!? ]{8,}" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="check">Vérification mot de passe :</label>
                            <input type="password" id="check" pattern="[A-Za-z0-9@$*!? ]{8,}" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="land">Pays :</label>
                            <select name="land" id="land" class="form-control">
                                <?php
                                $json = file_get_contents('https://restcountries.eu/rest/v2/lang/fr?fields=translations;alpha2Code');
                                $obj = json_decode($json);
                                $html = '';
                                foreach ($obj as $val) {
                                    $html .= '<option value="' . $val->alpha2Code . '">' . $val->translations->fr . '</option>';
                                }
                                echo $html;
                                ?>
                            </select>
                            <div class="form-group captcha">
                                    <label class="label-captcha" for="captcha" style="margin-top: .5rem;">Code de vérification :</label>
                                    <input type="text"  name="captcha" class="form-control"required>
                                    <span class="input-group-addon">
                                        <img src="captcha.php" id="captcha" alt="Captcha" class="rounded-sm" style="margin-top: .5rem;">
                                    </span>                                
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
                        <input type="submit" value="Valider" class="btn btn-primary">
                    </div>
                </form>
            </div>
        </div>
    </div>

  <!--<hr class="my-6">-->
  <div class="banner">
    <img class="rounded" src="bandeau2.png">
  </div>
  <!--<hr class="my-6">-->
  <h4 class="h4_title">Vous trouverez ici les dernières actualités scientifiques.</h4>
</header>

<section id="popular">
<h4>En vedette :</h4>
   
<div id="carousel" class="carousel slide" data-ride="carousel">
  <ol class="carousel-indicators">
    <li data-target="#carousel" data-slide-to="0" class="active"></li>
    <li data-target="#carousel" data-slide-to="1"></li>
    <li data-target="#carousel" data-slide-to="2"></li>
  </ol>
  <div class="carousel-inner">
    <div class="carousel-item active">
      <img src="galaxies.jpg" class="d-block w-100" alt="La voie lactée">
      <div class="carousel-caption d-none d-md-block">
        <h5>Voie lactée</h5>
        <p>L’âge des étoiles éclaire les débuts de la Voie lactée</p>
      </div>
    </div>
    <div class="carousel-item">
      <img src="timelapse.jpg" class="d-block w-100" alt="Google Timelapse">
      <div id="caption" class="carousel-caption d-none d-md-block">
        <h5>Web</h5>
        <p>Avec Timelapse, Google Earth permet désormais de remonter le temps.</p>
      </div>
    </div>
    <div class="carousel-item">
      <img src="bières.png" class="d-block w-100" alt="...">
      <div id="description" class="carousel-caption d-none d-md-block">
        <h5>FONDAMENTAL</h5>
        <p>Jusqu'à 1,5 million de bulles dans un verre de bière.</p>
      </div>
    </div>
  </div>
  <a class="carousel-control-prev" href="#carouselExampleCaptions" role="button" data-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="sr-only">Previous</span>
  </a>
  <a class="carousel-control-next" href="#carouselExampleCaptions" role="button" data-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="sr-only">Next</span>
  </a>
</div>
</section>
<hr class="my-6">
    
</body>

<footer>
        <div>
            <p class="footer">© 2021 Science Today</p>
        </div>
</footer>
    <script type="text/javascript" src="darkMode.js"></script>
</html>