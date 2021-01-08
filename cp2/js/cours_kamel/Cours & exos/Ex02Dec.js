/*
Exercice: 
Ecrire une fonction, qui prend une chaîne de caractère en argument, et qui va
créer et retourner un tableau où chaque élément correspond à une ligne de la chaîne.
*/

const commaSeparateValues = "dzdzd,dzdzdz,dzdzd,zddzdz\nvrvfrv,vzvrrz,vrzvr,vrvrv\nfddf,gdgf,ggger,gggjj";

function myFunction(str){
    return str.split("\n");
};  
commaSeparateValues.split("\n");

/*
Exercice: 
Ecrire une fonction, qui prend une chaîne de caractère en argument, et qui va
créer et retourner un tableau où chaque élément correspond à une ligne de la chaîne.
*/

/*
Exercice (version) 2:
ecrire une fonction qui prend une chaîne de caractères en argument au format csv, et qui 
retourne un tableau de tableaux t, où pour accéder au troisième mot de la deuxième ligne
il suffirait de faire t[1][2].
*/


/*
Exercice 3:
Ecrire une fonction qui fait la même chose que split, mais sans utiliser split ou
les autres méthodes utilitaires des strings. On pourra accéder aux différents caractères
via la syntaxe message[i]
*/