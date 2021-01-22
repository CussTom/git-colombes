/**
 * Renvoie l'âge en année entre deux dates passées en paramètres
 * @param {string} d1 - 1ere date
 * @param {string} d2 - 2nd date
 * @return {number}
 */

 function datediff(d1,d2){
     let iResult = 0;
     let date1 = new Date(d1);
     let date2 = new Date(d2);
     
     if (date2 > date1){
         iResult = date2 - date1;
        } else {
             iResult = date1 - date2;
        }
        
        // Le résultat est en millisecondes, il faut le convertir
        iResult = iResult / 1000 / 60 / 60 / 24 / 365.25;
        return Math.floor(iResult);
 }


// Affiche l'âge quand on change la date de naissance
 document.getElementById('dob').addEventListener(
     'blur', // 'blur' est plus propre pendant la saisie que 'change' mais fonctionne aussi
     function(){
        document.getElementById('age').value = datediff(this.value, new Date());
        // 'this' fait réf a "document.getElementByID('dob')"
     },
     false
 );



 /**
  * Masque l'alert sur les cookies
  */

document.getElementById('stay').addEventListener(
    'click',
    function(evt){
        evt.preventDefault();
        document.getElementById('cAlert').style.display='none';
    },
    false
);
