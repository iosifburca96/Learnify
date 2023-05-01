let switchBtn = document.getElementById("theme-btn");
let body = document.querySelector("body");

function changeBackground() {
    if(body.style.backgroundColor == 'white') {
        body.style.backgroundColor = 'darkblue';
        body.style.color = 'yellow';
    } else {
        body.style.backgroundColor = 'white';
        body.style.color = 'black';
    } 
};

switchBtn.addEventListener("click", changeBackground);