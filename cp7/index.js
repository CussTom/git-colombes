// Branche l'événement SUBMIT au seul formulaire de la page INDEX

document.getElementsByTagName('form')[0].addEventListener(
    'submit',
    function(evt){
        // Interrompt l'évenement en cours
        evt.preventDefault();
        // Teste si les MDP sont équivalents
        if(document.getElementById('pass').value === document.getElementById('check').value){
            this.submit();
        }else {
            alert('Les mots de passe ne correspondent pas !')
        }
    },
    false
);
