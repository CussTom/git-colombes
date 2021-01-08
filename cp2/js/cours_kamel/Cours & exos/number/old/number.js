//     Controle de rattrapage maison:

//     Refaire le jeu "deviner un nombre", sans prompt, sans alert ni confirm. Le refaire
//     de telle sorte que toutes les inputs soient des éléments de la page html.
//     L'interaction viendra ajouter du contenu.
//     Typiquement, l'utilisateur tape un nombre dans un input, la réponse du jeu vient
//     s'afficher après l'input, et au besoin un nouvel input est créé.
//     Bonus: faire en sorte que les inputs précédents (non actuels) soient en mode disabled.    

let btn = document.getElementById('btn');
let output = document.getElementById('output');
let nbrePlayer;

let number = Math.floor(Math.random()*10+1);

btn.addEventListener('click', function(){
    let input = document.getElementById('userInput').value;
    
    if(input > 10){
        output.innerHTML = 'Veuillez recommencer, ceci n\'est pas un chiffre compris entre 0 et 10';
        
    }else if(input == number){
        output.innerHTML = `Vous avez gagné, le bon chiffre est bien le ${number}`;
        
    }else if(input < number){
        output.innerHTML = 'Trop petit, devine encore !';
        
    }if(input > number){
        output.innerHTML = 'Trop grand, devine encore !';
        
    }
    addHistoric(number);
});


function addHistoric(nbrePlayer){
    
    let newDiv = document.createElement('span');
    let newContent = document.createTextNode(`Vous avez déjà essayé ${nbrePlayer}`);
    newDiv.appendChild(newContent);

    let currentDiv = document.getElementById('div1');
    document.body.insertBefore(newDiv, currentDiv);
}
