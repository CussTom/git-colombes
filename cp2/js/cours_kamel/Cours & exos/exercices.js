// remarque : deux syntaxes d'accès au membre d'un objet:
// -1 l'opératuer d'indirection "."
// 2- Les []
// la difference étant que les crochets permette d'avoir des noms de variables valident


// EXERCICE
// Ecrire le corps de la fonction qui prend en argument un tableau, un élément et une position et qui retourne un nouveau tableau ou l'élement à été insérer à la position donnée.
//const insererDansTableau = (tab, elem, pos){
    //const aRetourner = [];

    //je veux obtenir obtenir : [3, 11, 1, 7]


const insererDansTableau = (tab, elem, pos) => {
    const aRetourner = [];
    for (let i = 0; i < tab.length; i++){
       if(i == pos) aRetourner.push(elem);
        aRetourner.push(tab[i]);
    }
    return aRetourner;
};




// Ecrire une fonction, qui lorsqu'on l'appelle en lui passant un tableau , nous renvoi un nouveau tableau contenant les éléments du 1er, mais en ordre inverse

// si je fais inverseur([6, 3, 9, 90]);
// je veux obtenir : [90, 9, 3, 6]

const inverseur = (tab) => {
    const aRetourner = [];
    for (let i = 0; i < tab.length; i++){
       aRetourner.shift(tab[i]);
    }
    return aRetourner;
};

// dans la console inverseur([2, 4, 6, 8]);
// retournera [8, 6, 4, 2];

/* Ecrire une fonction (qu'on nommera askUser) qui ne prend pas d'argument et qui demande à l'utilisateur avec des prompts successifs son nom, prénom, age, code postal, qui retourne un objet contenant ces données.
Exemple d'objet retourné :
    nom: "Berbiche",
    prenom : "Kamel",
    age : 37,
    codePostale : 75019
    
    à l'usage elle donnerait:
    const userData = askUser()
    
    */

   function askUser() {
       const user = {
            nom : prompt("Quel est votre nom ?"),
            prenom : prompt("Quel est votre prénom ?"),
            age : Number(prompt("Quel est votre age ?")),
            postCode : Number(prompt("Quel est votre code postal ?")),
       }
        return user;
    };

    ///Methode2
function askUser2() {
    return {
        nom : prompt("Donnez votre nom"),
        prenom : prompt("Donnez votre prenom"),
        age : Number(prompt("Donnez votre age")),
        postCode : Number(prompt("Donnez votre Code postale")),
    }
}

    // Methode 3 //
    function askUser3( {
        const user = {};
        user.nom = prompt("Quel est votre nom ?"),
        user.prenom : prompt("Quel est votre prénom ?"),
        user.age = Number(prompt("Quel est votre age ?")),
        user.postCode = Number(prompt("Quel est votre code postal ?"));
        return user;
    }

    // Methode 4 //
    function askUser() {
        const user = {
            nom: "",
            prenom: "",
            age: 0,
            postCode: 0
        };
        user.nom = prompt("Quel est votre nom ?"),
        user.prenom : prompt("Quel est votre prénom ?"),
        user.age = Number(prompt("Quel est votre age ?")),
        user.postCode = Number(prompt("Quel est votre code postal ?"));
        return user;
        
    }