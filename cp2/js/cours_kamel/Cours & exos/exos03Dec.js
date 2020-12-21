/*
Exercice: 
Implémenter une fonction qui additionne deux nombres. Cette fonction devra tester 
les valeurs reçues en paramètre et déclenchera une exception si un de ses paramètres
n'est pas un number.
À la suite de ça, faite à la fonction dans un try catch, en gérant la survenue d'erreur.
On fera un premier try catch sans erreur (en passant des nombres), et un deuxième en passant
autre chose que des numbers à votre fonction.
*/

function add(x, y){
    if(typeof x != "number" || typeof y != "number"){
        throw TypeError("Ce n'est pas un nombre !");
    }
  return(x+y);
};

try{
    add("deslettres", "encore des lettres");
} catch(error) {
    console.log(error)
// } finally{
//     console.log("Arrêt de l'execution du code")
} // n'a pas d'utilité ici

const add2 = (x, y) => x*y;

