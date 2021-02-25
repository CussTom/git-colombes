// Auchargement de la page : associe les buttons suppr à l'événement CLICK
window.addEventListener(
    'load',
    function(){
        // Tableau d'élements HTML : boutons SUPPR
        let aBtns = document.querySelectorAll('table a.delete')
        // Parcours tous les élements d'un tableau
        for (let i=0; i<aBtns.length; i++){
            aBtns[i].addEventListener(
                'click',
                function (evt){
                    // Arrête l'hyperlien
                    evt.preventDefault();
                    // Affiche un modal de type CONFIRM
                    let bChoice = confirme('Voulez-vous vraiment supprimer cette ligne ?');
                    if (bChoice){
                        window.location = this.href; // OU evt.target.href
                    }
                },
                false
            );
        }
    },
    false
    );