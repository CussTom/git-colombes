<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des centres de vaccination</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
</head>
<body class="container">  
    <h1>Centres de vaccination par départements</h1>
        <?php
        // liste des départements
        $depts = json_decode(file_get_contents('https://geo.api.gouv.fr/departements'));
        $html = '<select id="depts" class="form-control">';
        $html .= '<option value="00"> -- Choisir un département -- </option>';
            foreach ($depts as $dept) {
                $html .= '<option value="'.$dept->code. '">'.$dept->nom.'</option>';
            }
        $html .= '</select>';
        echo $html;
        ?>
        <div id="centers" class="mt-5">
        </div>
        <script src="vaccine-centers.js"></script>
</body>
</html>