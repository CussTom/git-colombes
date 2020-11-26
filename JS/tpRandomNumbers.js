//                      JEUX
// - Generer un nombre entier entre 0 et 10
// - Demander à l'usr de deviner (saisir) un nombre
// - Si réponse > résultat on affiche :
//                              "trop grand !"
// - Sinon, si réponse < résultat on affiche :
//                              "Trop petit !"
// - Sinon on affiche :
//                      "Bravo !"



//           PREMIERE SOLUTION

"use strict";

let newGame = true;
while (newGame){

const resultat = Math.floor(Math.random()*100);
let reponse = Number(prompt("Devine le nombre que j'ai généré !"));

while (reponse !== resultat && reponse != null){

    if(reponse > 100){
        reponse = prompt("Ce n'est pas un chiffre entre 0 et 100");
    }
    else if(isNaN(reponse)){
        reponse = prompt("Ce que vous avez tapé n'est pas un nombre");
    }
    if (reponse > resultat){
        reponse = Number(prompt("Trop grand, devine encore !"));
    }
    else if (reponse < resultat){
        reponse = Number(prompt("Trop petit, devine encore !"));
    } 
}
if (reponse == null){
    newGame = false;
    alert("vous avez quitté");
} else if (!confirm("Bravo ! Voulez-vous rejouer ?")){
    newGame = false;
    alert("Bye à bientot !");
}
};







//          DEUXIEME SOLUTION - !! A FINALISER !!

let newGame = true;
while(newGame){

const resultat = Math.floor(Math.random()*100);
let reponse = Number(prompt("Devine le nombre que j'ai généré !"));

while (true){
    if (reponse > resultat){
        reponse = Number(prompt("Trop grand, devine encore !"));
    }
    else if (reponse < resultat){
        reponse = Number(prompt("Trop petit, devine encore !"));
    }
    // else (reponse === resultat)
    //     alert("Bingo !"); 
    }
};
    if (reponse == null){
        newGame = false;
        alert("Vous avez quitté");
    
    } else if(!confirm("Bravo, Voulez-vous rejouer ?")){
        newGame = false;
        alert("See you bye !");
    }








//           TROISIEME SOLUTION


const resultat = Math.floor(Math.random()*100);
let reponse = Number(prompt("Devine le nombre que j'ai généré !"));
let gagné = false;

do{
    if(reponse > resultat){
        reponse = Number(prompt("Trop grand, devine encore !"));
    }
    else if (reponse < resultat){
        reponse = Number(prompt("Trop petit, devine encore !"));
    }
    else{ (gagné = true)
        alert ("BINGO !!");
};
}while(!gagné);   

