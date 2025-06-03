import { Auth, logout } from "./utils/auth.js";
import { Articles } from "./utils/articles.js";

window.onload = function() {
    const loggedIn = Auth.checkLogin();

    // Articles.loadArticles();

    Articles.getSuggested();
}

document.getElementById("logoutBtn").addEventListener("click", function(event) {
    event.preventDefault();

    logout();
})

// document.getElementById("articlesButton").addEventListener("click", function(event) {
//     event.preventDefault();

//     const form = event.target;
//     const formData = new FormData(form);

//     // getSuggestedArticles(formData);
// })

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
