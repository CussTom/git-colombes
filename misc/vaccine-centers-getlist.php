<?php
// Lire le contenu du fichier JSON listant tous les centres de vaccination (3Mo)
$json = file_get_contents('https://www.data.gouv.fr/fr/datasets/r/d0566522-604d-4af6-be44-a26eefa01756');
$json = json_decode($json);

// Filtre par rapport au numéro de département passé en paramètre
if (isset($_GET['dept']) && !empty($_GET['dept'])){
    $html = '<table class="table table-striped">';
    $html .= '<thead><th>Centre</th><th>Adresse</th><th>Téléphone</th></thead><tbody>';
    foreach ($json->features as $feature){
        // Teste si le centre est bien dans le bon département
        if ($_GET['dept'] === substr($feature->properties->c_com_cp, 0, strlen($_GET['dept']))) {
            $html .= '
            <tr>
            <td>'.$feature->properties->c_nom.'</td>
            <td>'.$feature->properties->c_adr_num.' '.$feature->properties->c_adr_voie.' '.$feature->properties->c_com_cp.' '.$feature->properties->c_com_nom.'</td>
            <td>'.$feature->properties->c_rdv_tel.'</td>
            </tr>';
        }
    }
    $html .= '</tbody></table>';
    echo $html;
} else {
    echo '<div class=""alert alert-warning">Aucun département trouvé</div>';
}
