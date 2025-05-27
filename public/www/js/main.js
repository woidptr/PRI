import { checkLogin, logout } from "./utils/auth.js";
import { getSuggestedArticles } from "./articles/suggested.js";

window.onload = function() {
    checkLogin();

    getSuggestedArticles();
}

document.getElementById("logoutBtn").addEventListener("click", function(event) {
    event.preventDefault();

    logout();
})

document.getElementById("articlesButton").addEventListener("click", function(event) {
    event.preventDefault();

    const form = event.target;
    const formData = new FormData(form);

    // getSuggestedArticles(formData);
})

document.addEventListener("click", function(event) {
    let article = event.target.closest("A");
    if (article != null && article.getAttribute("href") === "article") {
        event.preventDefault();


    }
})

async function loadArticle(articleId) {
    const formData = new FormData();
    formData.append("articleId", articleId);

    const response = await fetch("/backend/api/articles", {
        "method": "GET",
        "body": formData
    });

    const data = await response.json();

    if (response.status === 200) {

    }
}

document.addEventListener('DOMContentLoaded', function() {
    const userDropdown = document.getElementById('userDropdown');
    const userButton = document.getElementById('userButton');
    
    if (userButton && userDropdown) {
        userButton.addEventListener('click', function(event) {
            event.stopPropagation();
            userDropdown.classList.toggle('active');
            // Update aria-expanded for accessibility
            userButton.setAttribute(
                'aria-expanded',
                userDropdown.classList.contains('active') ? 'true' : 'false'
            );
        });
        
        // Close the dropdown when clicking outside
        document.addEventListener('click', function(event) {
            if (!userDropdown.contains(event.target)) {
                userDropdown.classList.remove('active');
                userButton.setAttribute('aria-expanded', 'false');
            }
        });
    }
});