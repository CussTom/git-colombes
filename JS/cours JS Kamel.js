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

