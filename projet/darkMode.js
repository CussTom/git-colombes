// on charge tout le doc pour que tous les objets soient dans le DOM
window.onload = function(){

const themeBtn = document.getElementById('darkMode');
let imgReplace = document.getElementById('banner_articles');
let toggle = 0;
themeBtn.innerHTML = 'light off';
    
themeBtn.addEventListener('click', () => {
    if(toggle === 0) {
        // thème clair
        document.documentElement.style.setProperty('--text', '#1D1D22');
        document.documentElement.style.setProperty('--background', '#fffff');
        document.documentElement.style.setProperty('--hr', '#ECEDEF');
        document.documentElement.style.setProperty('--btn', 'red');
        document.documentElement.style.setProperty('--border', 'red');
        imgReplace.src = 'newslab1.png';
        imgReplace.style.visibility = 'visible';
        toggle++
        themeBtn.innerHTML = `dark mode`;
        console.log(toggle);
    } else {
        // thème sombre
        document.documentElement.style.setProperty('--text', '#f1f1f1');
        document.documentElement.style.setProperty('--background', '#000000');
        document.documentElement.style.setProperty('--hr', '#f1f1f1');
        document.documentElement.style.setProperty('--btn', 'green');
        document.documentElement.style.setProperty('--border', 'green');
        imgReplace.src = 'newslab2.png';
        imgReplace.style.visibility = 'visible';
        toggle--;
        themeBtn.innerHTML = `light mode`;
        console.log(toggle);
        }
    })
} 