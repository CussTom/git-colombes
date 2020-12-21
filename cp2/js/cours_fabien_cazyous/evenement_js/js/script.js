// Script JS pour gestion des évenements

let etatDiv01 = false;
let etatDiv02 = false;

document.getElementById('bloc02').addEventListener("click", Div02);
// ça écoute le Bloc02, et si il y a un click ça créer la Div02

function Div02(e){ // e correpsond a addEventListener
    if(etatDiv02 == false){
        e.target.className ="divNoire";
        etatDiv02 = true;
    }else{
        e.target.className ="myDiv";
        etatDiv02 = false;
    }
}

function Div01(moiMeme){    // this fait reference a id="bloc01" et à moiMeme dans le JS
    if(etatDiv01 == false){
        moiMeme.className="divNoire";
        // change la classe du Bloc01
        etatDiv01 = true;
    }else{
        moiMeme.className="myDiv"
        // change la class du Bloc01
        etatDiv01 = false;
    }
}