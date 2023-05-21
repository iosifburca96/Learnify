let ropeTrigger = document.querySelector('.switch img');
let sun = document.querySelector('.sun');
let moon = document.querySelector('.moon');
let darkLogo = document.querySelector('.logo-wrapper .dark');
let lightLogo = document.querySelector('.logo-wrapper .light');
let body = document.body;

function changeTheme() {
    if(body.style.backgroundColor != 'rgb(6, 7, 54)') {
        //change to dark theme;
        sun.style.visibility = 'hidden';
        moon.style.visibility = 'visible';
        darkLogo.style.display = 'none';
        lightLogo.style.display = 'inline';
        body.style.backgroundColor = 'rgb(6, 7, 54)';
    } else if (body.style.backgroundColor != 'rgb(59,141,212)') {
        //change to light theme;
        moon.style.visibility = 'hidden';
        sun.style.visibility = 'visible';
        lightLogo.style.display = 'none';
        darkLogo.style.display = 'inline';
        body.style.backgroundColor = 'rgb(59,141,212)';
    }
}

ropeTrigger.addEventListener('click', changeTheme);