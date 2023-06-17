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



// Get a reference to the categories container
let categoriesContainer = document.getElementById("categoriesContainer");
// Get a reference to the content container
let contentContainer = document.getElementById("gameslist-container");
// Get references to the category links
let categoryLinks = document.getElementsByClassName("category-link");
// Add a back button event listener
let backButton = document.getElementById("backButton");
backButton.style.display = 'none';

// Add click event listeners to the category links
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
      // Update the content container with the loaded content
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
// Call the loadContent function to initially load the content
//loadContent();