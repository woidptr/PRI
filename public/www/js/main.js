import { Auth, logout } from "./utils/auth.js";
import { Articles } from "./utils/articles.js";

window.onload = function() {
    const loggedIn = Auth.checkLogin();

    Articles.getSuggested();
}

document.getElementById("logoutBtn").addEventListener("click", function(event) {
    event.preventDefault();

    logout();
})

document.addEventListener("click", function(event) {
    let article = event.target.closest("A");
    if (article != null && article.getAttribute("href") === "article") {
        event.preventDefault();

        const articleId = article.dataset.id;

        console.log(articleId);

        Articles.loadArticleById(articleId);
    }
})
