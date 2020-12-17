// Scipt qui va écouter plusieur div et leurs contenu

let compteur = 0;
let nomElement = "";
let conteneurHtml = document.getElementById('conteneur');
let tblClique = Array.from(document.querySelectorAll(".myDiv"));

for(compteur = 0; compteur < tblClique.length; compteur++){
    tblClique[compteur].addEventListener('click', onClick)
};

// Cette fonciton est appelée à chaue clic sur un élement du CONTENEUR 
// identifié par la boucle d'itération précédente
function onClick(e){
    let indice = tblClique.indexOf(e.currentTarget);
    // On test que la variale INDICE est bien une valeur positive.myDiv
    if(indice != -1){
        nomElement = tblClique[indice].textContent;
        alert('Element cliqué : ' + nomElement);
    }
};