let Individu = function(lePrenom, leNom){
// Le mot clé this désigne le constructeur
// Je pourrai écrire Individu.nom = leNom
this.prenom = lePrenom;
this.nom = leNom;

}
// Création de la méthode
Individu.prototype.direBonjour = function(){
    alert("Bonjour, je suis la méthode de " + this.prenom + " " +this.nom);
};

function declareInstance(){
    let personne01 = new Individu();    
    alert('Instance personn01');
    let personne02 = new Individu();
    alert('Instance personne02');
}

function declarePropiete(){
    let personne01 = new Individu('Alice', '');
    alert('Propriete de :' +personne01.prenom + personne01.nom);
    let personne02 = new Individu('Antoine', '');
    alert('Propriete de :' +personne02.prenom + personne01.nom);
}

function declareMethode(){
    let personne01 = new Individu('Charlotte', 'Dupuis');
    personne01.direBonjour();
    let personne02 = new Individu('Jean', 'Martin');
    personne02.direBonjour();
}
