// ANIMATION TITLE //

let x = 0;
const textEffect = "Développeur web & web mobile junior";
let container = document.getElementById("effect");

function typingScript(){
    if(x < textEffect.length){
        container.innerHTML += textEffect.charAt(x);
        x++;
        setTimeout(typingScript, 140);
    }
}
typingScript();

// CAROUSEL //

$('.carousel').carousel({
    interval: 20000
});

// PARALLAX //

const parallax = document.querySelector('#figma-frame');

window.addEventListener('scroll', () => {
    parallax.style.iframePositionY = -window.scrollY / 4 + "px";
});