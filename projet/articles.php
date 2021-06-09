<?php
session_start();
$connected = false;
if (isset($_SESSION['connected']) && $_SESSION['connected']) {
    $connected = $_SESSION['connected'];
}

include_once('constants.php');
include_once('pdoConnect.php');

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
    <!-- <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script> -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous" defer></script>
    <link rel="stylesheet" href="css/main.css">
</head>
<body class="container">
<header>
<div class="jumbotron">
      <div class="connect">
        <div class="site-name">
          <h1>Science Today !</h1>
          <p class="slogan_articles">Votre dose d'actualités !</p>
        </div>
      <div class="buttons">
          <span style="display:<?php echo ($connected ? '' : 'none'); ?>">
            <a class="btn btn-outline-info btn-sm" href="index.php" role="button">Accueil</a>
            <a class="btn btn-outline-danger btn-sm" href="#" role="button" data-toggle="modal" data-target="#deconnexion">Deconnexion</a>
          </span>
        </div>
      </div>
      <div class="btn btn-outline-light btn-sm" id="darkMode">light mode</div>

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


      <hr class="my-6">
  <div class="banner">
    <img id="banner_articles" class="rounded" src="black_banner.png" >
  </div>
  <hr class="my-6">
  <p class="news_title">Les actus du <?php setlocale(LC_TIME, 'fr_FR');
    date_default_timezone_set('Europe/Paris');
    echo utf8_encode(strftime('%A %d %B %Y'));?></p>
</header>

<section id="articles">
    <?php 
    $cats = [["id"=>1, "nom"=>"science"], ["id"=>2, "nom"=>"technology"]];
    ?>

    <select id="cats">
        <?php 
            foreach ($cats as $key => $value): ?>
        <option value="<?php echo $value["nom"];?>"><?php echo $value["nom"];?></option>     
        
        <?php endforeach;?>
    </select>

<?php
    // SCIENCE
    $urlSc = 'https://newsapi.org/v2/top-headlines?country=fr&category=science&apiKey=e847ffb86d8147d6a065b4690860cd60';
    $respSc = file_get_contents($urlSc);
    $newsDataSc = json_decode($respSc);
?>

    <div id ="art" class='container-fluid news'>
        <?php
            foreach ($newsDataSc->articles as $news){  
        ?>
        <div class="row col-md-12 articles">
                <h4 class="title">
                    <a class="link" href=<?php echo $news->url ?> target="blank">
                    <?php echo $news->title ?>
                </h4>
                <img src="<?php echo $news->urlToImage ?>" alt="Vignette de l'article" id="noImg" class="rounded noIMg">
                <h5 class="description"> <?php echo $news->description ?></h5>
                <p> <?php echo $news->content ?></p>
                <h6>Auteur : <?php echo $news->author ?></h6>
                <h6>Publié le : <?php echo $news->publishedAt ?></h6>
                <hr class="md-6 sep_articles">
        </div>

            <?php
            } 
            ?>
    </div>

</section>

<footer>
        <div class="footer">
            <p>© 2021 Science Today</p>
        </div>
</footer>


<script>
$(function() {
    $('#cats').on('change', function(){
        let choice = this.value;
        let newUrl = 'https://newsapi.org/v2/top-headlines?country=fr&category='+choice+'&apiKey=e847ffb86d8147d6a065b4690860cd60';
        let art = $('#art');
        let errorImg = document.createElement('img');
        errorImg.src = "no-image.jpg";
        let newImg = document.getElementById('noImg');
        $.get(newUrl, function(data){
            $('#art').empty();
            $.each(data.articles, function(id, article){
                art.append(`<h4 class="title">
                        <a class="link" href="${article.url}" target="blank">${article.title}</a>
                        </h4>`)
                        if (art.urlToImage !== null){
                            art.append(`<img src="${article.urlToImage}" alt="Image de l'article" id="noImg" class="rounded">`)                          
                        } else {
                            document.getElementById('noImg').style.dipslay="none";
                            //newImg.appendChild(errorImg); 
                            };
                        art.append(`<h5 class="description">${article.description}</h5>`)
                        art.append(`<p>${article.content}</p>`)
                        art.append(`<h6 >Auteur : ${article.author}</h6>`)
                        art.append(`<h6 id="endArt">Publié le : ${article.publishedAt}</h6>`)
            })
        });
    })
})
</script>

<script type="text/javascript" src="darkMode.js"></script>

</body>
</html>