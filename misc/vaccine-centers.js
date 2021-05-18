/**
 * Ecouteur d'événements qui lance une requête Ajax pour renvoyer les centres du départements choisi
 */
document.querySelector('#depts').addEventListener(
    'change',
    function(){
        let xhr = new XMLHttpRequest();
        xhr.open('get', 'vaccine-centers-getlist.php?dept='+this.value, true);
        xhr.send();
        xhr.addEventListener(
            'readystatechange',
            function (){
                if (xhr.readyState === 4 && (xhr.status === 0 || xhr.status === 200)){
                    document.querySelector('#centers').innerHTML = xhr.responseText;
                } else {
                    document.querySelector('.spinner-border');
                    innerHTML = '<div class=".spinner-border"><span class="sr-only">Loading...</span><div>';
                }
            }
        );
    }
);