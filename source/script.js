let ropeTrigger = document.querySelector('.switch img');
let sun = document.querySelector('.sun');
let moon = document.querySelector('.moon');
let darkLogo = document.querySelector('.logo-wrapper .dark');
let lightLogo = document.querySelector('.logo-wrapper .light');
let body = document.body;
let signinbtn = document.querySelector('.signin-btn');

function changeTheme() {
    if(body.style.backgroundColor != 'rgb(6, 7, 54)') {
        //change to dark theme;
        sun.style.visibility = 'hidden';
        moon.style.visibility = 'visible';
        darkLogo.style.display = 'none';
        lightLogo.style.display = 'inline';
        body.style.backgroundColor = 'rgb(6, 7, 54)';
        body.style.color = 'rgb(0, 255, 0)';
        signinbtn.style.color = 'rgb(6, 7, 54)';
        signinbtn.style.backgroundColor = 'white';
    } else if (body.style.backgroundColor != '#00b4ff') {
        //change to light theme;
        moon.style.visibility = 'hidden';
        sun.style.visibility = 'visible';
        lightLogo.style.display = 'none';
        darkLogo.style.display = 'inline';
        body.style.backgroundColor = '#00b4ff';
        body.style.color = 'rgb(6, 7, 54)';
    }
}

ropeTrigger.addEventListener('click', changeTheme);