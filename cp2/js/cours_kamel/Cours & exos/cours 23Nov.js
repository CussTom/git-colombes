alert ("hello world");


// Inversement de valeurs de variables

let thomas = 0;
let cusse = 10;
let cusstom = thomas;
thomas = cusse;
cusse = cusstom;

console.log("La valeur de la 1ere variable est " + thomas);
console.log("La valeur de la 2nd variable est " + cusse);

const test = "Michu";
const message = `Bonjour ${test}!`;
console.log(message);

// SWITCH

let choix = 7;
switch(choix){
    case 0:
        console.log("case 0");
        break;
    case 1:
        console.log("case 1");
        break;
    case 3:
        console.log("case 3");
        break;
    case 7:
        console.log("case 7");
        break;
    default:
        console.log("default");
};


// TYPE REFERENCE
let t1 = [];
let t2 = t1;
t1.push("coucou");
console.log(t2);





// FONCTIONS


// fonction simple qui permet de faire une multiplication entre plusieurs arguments

function multi(a,b){
    return (a*b);
}
console.log(multi(2,2));

// utiliser une fonction dans une autre

function puiss(x=1,y=0){
    let result = 1;
    for(let i=0; i<y; i++){
        resultat = multi(result,x);
    }
    return result;
}
console.log(puiss);

const mult2 = (x,y) => x*y;



// fonction qui des fonction
// ex avec un multiplieur

const creerUnMultiplieur = (fonction)=>{
    const aRetourner = (x)=>{
        return (x*fonction);
    };
    return aRetourner;
}
const doubleur = creerUnMultiplieur(2);
console.log(doubleur(7));

// ex personnallisation d'un log

const logPerso = (prefixe) => {
    const aRetourner = (message)=>{
        console.log(prefixe + message);
    }
    return aRetourner;
}
const myAppLog = logPerso("myApp");
myAppLog("Hello");

// code simplifié
const logPerso = prefixe => (message) => console.log(prefixe + message);




// LES TABLEAUX

    // loop //
const t = ["Hello", "chacun", "chacune", "!"];

for(let i = 0; i < t.length; i++){
     console.log(t[i]);
}

    // function //
const t = ["Hello", "chacun", "chacune", "!"];

const tab = (t)=>{
    for(let i = 0; i < t.length; i++){
        console.log(t[i]);
    }
}

    // nouvelle fonction qui double la valeur du tableau initial dans un 2nd tableau //
const t = [1, 2, 3, 4];
const t2 = [];

const tab = (t)=>{
    for(let i = 0; i < t.length; i++){
        console.log(t[i]);
    }
    tab(t2);
}

/////// Cours lundi 30 novembre ///////

// boucle avec for....of

const ttt = [1, 3, 5];

for (element of ttt){
    console.log(element);
};

// meme chose mais dans une fonction 
const f2 = (t) =>{;
for (element of ttt){
    console.log(element);
    }
};

/// taille de tableau
ttt.length

// ajouter un élement à la fin
const element = 11;
ttt.push(element);

// enlever un élement à la fin en le récupérant:
const elem = ttt.pop();

// enlever un élement du début du tableau
const elem2 = ttt.unshift();

// accès a un élement
const elem3 = ttt[0];
ttt[0] = 62;

// remarque : deux syntaxes d'accès au membre d'un objet:
// -1 l'opératuer d'indirection "."
// 2- Les []
// la difference étant que les crochets permette d'avoir des noms de variables valident


// EXERCICE
// Ecrire le corps de la fonction qui prend en argument un tableau, un élément et une position et qui retourne un nouveau tableau ou l'élement à été insérer à la position donnée.
//const insererDansTableau = (tab, elem, pos){
    //const aRetourner = [];

    //je veux obtenir obtenir : [3, 11, 1, 7]



// Fonction Map() \\

// La fonction Map prend en argument une fonction qui effectue un traitement pour un seul element, et retourne un nouveau tableau ayant pour valeur les résultats obtenus en passant chaque élement du tableau à gauche du "."
// Map est une fonction qui permet d'obtenir un noub-veau tableau en transformant une à une les valeurs de l'ancien tableau, par une fonction qu'on passe en argument à map
// Map est à utiliser avec des fonctions sans effet de bord, si on voulait pour chaque élement exécuter une fonction avec effet de bord (comme console.log) on aurait à appeler forEach

// a gauche de map doit se trouver un tableau et a droite une foncion. Elle passe un tableau par un autre tableau, qui lui va être renvoyé dans son nouvel état, donc selon la fonction voulue  \\

/* Si l'on veut filterer les valeurs d'un tableau selon un certain critère:
1- on définit une fonction qui retourne true quand le critère est vérifié et false sinon
2- j'utilise la fonction filter en lui passant ma fonction de test/critère
*/

const supA5 = (x) => x > 5;
 var.filter(supA5); // fonction qui va filtrer dans un tableau selon critère

