// LIGHT/DARK THEME 

let ropeTrigger = document.querySelector('.switch img');
let sun = document.querySelector('.sun');
let moon = document.querySelector('.moon');
let darkLogo = document.querySelector('.logo-wrapper .dark');
let darkLogoS = document.querySelector('.logo-wrapper-s .dark');
let lightLogo = document.querySelector('.logo-wrapper .light');
let lightLogoS = document.querySelector('.logo-wrapper-s .light');
let body = document.body;
let signinbtn = document.querySelector('.signin-btn');

function changeTheme() {
    if(body.style.backgroundColor != 'rgb(6, 7, 54)') {
        //change to dark theme;
        sun.style.visibility = 'hidden';
        moon.style.visibility = 'visible';
        if (darkLogo !== null) {
          darkLogo.style.display = 'none';
        } else {
          darkLogoS.style.display = 'none';
        }
        if (lightLogo !== null) {
          lightLogo.style.display = 'inline';
        } else {
          lightLogoS.style.display = 'inline';
        }
        body.style.backgroundColor = 'rgb(6, 7, 54)';
        body.style.color = 'rgb(0, 255, 0)';
        signinbtn.style.color = 'rgb(6, 7, 54)';
        signinbtn.style.backgroundColor = 'white';
    } else if (body.style.backgroundColor != '#00b4ff') {
        //change to light theme;
        moon.style.visibility = 'hidden';
        sun.style.visibility = 'visible';
        if(lightLogo !== null) {
          lightLogo.style.display = 'none';
        } else {
          lightLogoS.style.display = 'none';
        }
        if (darkLogo !== null) {
          darkLogo.style.display = 'inline'; 
        } else {
          darkLogoS.style.display = 'inline';
        }
        body.style.backgroundColor = '#00b4ff';
        body.style.color = 'rgb(6, 7, 54)';
    }
}

ropeTrigger.addEventListener('click', changeTheme);

//AJAX LOAD GAMES LIST

let categoriesContainer = document.getElementById("categoriesContainer");
let contentContainer = document.getElementById("gameslist-container");
let categoryLinks = document.getElementsByClassName("category-link");
let backButton = document.getElementById("backButton");
backButton.style.display = 'none';

for (let i = 0; i < categoryLinks.length; i++) {
  categoryLinks[i].addEventListener("click", function() {
    let clickedButton = this.id;
    loadContent(clickedButton);
    hideCategoryLinks(clickedButton);
    backButton.style.display = '';
  });
}

// Make an AJAX request to the server
function loadContent(clickedButton) {
  fetch("load_content.php?button=" + clickedButton)
    .then(response => response.text())
    .then(data => {
      contentContainer.style.display = '';
      contentContainer.innerHTML = data;
    })
    .catch(error => {
      console.log("Error:", error);
    });
}

// Hide category links except for the clicked one
function hideCategoryLinks(clickedButton) {
  for (let i = 0; i < categoryLinks.length; i++) {
    let link = categoryLinks[i];
    if (link.id !== clickedButton) {
      link.parentElement.parentElement.style.display = "none";
    }
  }
}

// Show all category links again
function showCategoryLinks() {
  for (let i = 0; i < categoryLinks.length; i++) {
    categoryLinks[i].parentElement.parentElement.style.display = "";
  }
}



backButton.addEventListener("click", function() {
  showCategoryLinks();
  contentContainer.style.display = 'none';
  backButton.style.display = 'none';
});



