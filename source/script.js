// light/dark theme functionality

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



//categories list games
// Get a reference to the content container
let contentContainer = document.getElementById("gameslist-container");

// Get references to the elements you want to listen for clicks on
let biology = document.getElementById("biology");
let astronomy = document.getElementById("astronomy");
let math = document.getElementById("math");
let history = document.getElementById("history");
let english = document.getElementById("english");
let geography = document.getElementById("geography");

// Add click event listeners to the buttons
biology.addEventListener("click", function() {
  loadContent("biology");
});
astronomy.addEventListener("click", function() {
  loadContent("astronomy");
});
math.addEventListener("click", function() {
    loadContent("math");
});
history.addEventListener("click", function() {
    loadContent("history");
});
english.addEventListener("click", function() {
    loadContent("english");
  });
geography.addEventListener("click", function() {
    loadContent("geography");
});

// Make an AJAX request to the server
function loadContent(clickedButton) {
  fetch("load_content.php?button=" + clickedButton)
    .then(response => response.text())
    .then(data => {
      // Update the content container with the loaded content
      contentContainer.innerHTML = data;
    })
    .catch(error => {
      console.log("Error:", error);
    });
}

// Call the loadContent function to initially load the content
//loadContent();