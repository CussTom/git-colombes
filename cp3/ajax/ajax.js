// Branche l'évennement LOAD a WINDOW

window.addEventListener(
    'load',
    function(){
        // Step 1: instanciation de la requête AJAX
        let oXHR = new XMLHttpRequest;
        // Step 2: ouverture requête AJAX
        oXHR.open('get', 'https://restcountries.eu/rest/v2/all', true)
        // Step 3: envoi de la requête AJAX
        oXHR.send();
        // Step 4: traitement retour du serveur
        oXHR.addEventListener(
            'readystatechange',
            function(){
                if(oXHR.status === 200 && oXHR.readyState === 4)
                {
                    // Transforme la réponse texte en objet
                    let oData = JSON.parse(oXHR.responseText);
                    // Pour chaque pays de l'objet réponse
                    let oOption;
                    for (let i=0; i<oData.length; i++){
                        // Crée un élement HTM option
                        oOption = document.createElement('option');
                        // Affection de la valeur
                        oOption.value = oData[i].alpha2Code;
                        // Sélectionne FR par défaut
                        if (oOption.value === 'FR'){
                            oOption.selected = true;
                        }
                        // Affichage
                        oOption.textContent = oData[i].name;
                        oOption.textContent = oData[i].translations['fr'];
                        // Attache l'enfant OPTION à son parent SELECT
                        document.getElementById('land').appendChild(oOption);
                    }
                } 
            },
            false
        );
    },
    false
);

// Récupère la commune correspondant au code pays et au code postal passés en paramètres
function getCity(){
    document.getElementById('city').value = '';
    let sLand = document.getElementById('land').value;
    let sZip = document.getElementById('zip').value;
    let oXHR = new XMLHttpRequest;
    oXHR.open('get', 'https://api.zippopotam.us/'+ sLand + '/' + sZip, true);
    oXHR.send();
    oXHR.addEventListener(
        'readystatechange',
        function(){
            if (oXHR.readyState === 4 && oXHR.status === 200){
              let oData = JSON.parse(oXHR.responseText);
                document.getElementById('city').value = oData.places[0]['place name'];
            }
        },
        false
        );
}

document.getElementById('land').addEventListener(
    'change',
    function(){
       getCity();
    },
    false
);


document.getElementById('zip').addEventListener(
    'blur',
    function(){
        getCity();
    },
    false
);