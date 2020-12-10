const myTitreHtml = document.querySelector('h1');
myTitreHtml.style.position = "absolute"; // chaine de caractère car pour le CCS pas de valeur numérique

let myTopPosition=0;
let myDirection=-1;
let myNewPosition='';

function myHorizontalSlide(){
    if(myTopPosition==1500){
    myTopPosition==-400
    myDirection=-1
    }
    myTopPosition+=-2*myDirection;
    myTitreHtml.style.left=myTopPosition+'px';
    requestAnimationFrame(myHorizontalSlide);
}

requestAnimationFrame(myHorizontalSlide);
