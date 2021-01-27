<?php
$projects = 
    array ('NRJ' => array (
        "name" => "Energies renouvelables",
        "budget" => "400 000",
        "technos" => array (
            "Web" => array (
                "Html", "Css", "JS"),
            "Mobile" => array (
                "React Native"))
            ),
    'H2O' => array (
        "name" => "Traitement des eaux usées",
        "budget" => "750 000",
        "technos" => array (
            "Client riche" => array (
                    "Java", "Oracle"),
                "RWD" => array (
                    "Mongo DB", "Node", "Angular"))
                ),
            
    'RDC' => array (
            "name" => "Gestion des maraudes des restos du coeur",
            "technos" => array (
                "Web static" => array (
                        "Html", "Css", "JS"),
                    )
                ),
        
);
// echo "<pre>";
// print_r($projects);
// echo "</pre>";

// Génère un tableau HTML affichant le contenu de l'array projects
$html = '<table class="table table-striped">';
$html .= '<thead><tr><th>Projets</th><th>Budget</th><th>Technologies</th></tr></thead><tbody></tbody>';

foreach ($projects as $key => $val){
    $html .= '<tr>';
    $html .= '<td>' . $key . ' - '. $projects[$key]['name'] .'</td>';
    $html .= '<td>' . (array_key_exists('budget', $projects[$key]) ? $projects[$key]['budget'] : '' ) .'</td>';
    $html .= '<td><ul>';
    foreach($projects[$key]['technos'] as $key2 => $val2){
        $html.='<li>'. $key2 .'<ol>';
        foreach ($projects[$key]['technos'][$key2] as $val3){
            $html .= '<li>' . $val3 . '</li>';
        }
        $html .=  '</ol></li>';
    }
    $html .= '</ul></td>';
    $html .= '</tr>';
}

$html .= '</tbody></table>';
echo $html;
?>

