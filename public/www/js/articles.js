import { Articles } from "./utils/articles.js";
import { Auth } from "./utils/auth.js";

window.onload = async function() {
    const loggedIn = await Auth.checkLogin();

    if (loggedIn) {
        Articles.getUserSpecific();
    } else {
        window.location.href = "/index.html";
    }
}

document.getElementById("createArticleBtn").addEventListener("click", () => {
    window.location.href = "/articles/editor.html";
})

document.getElementById("importArticleBtn").addEventListener("click", () => {
    document.getElementById("xmlFileInput").click();
})

document.getElementById("xmlFileInput").addEventListener("change", (event) => {
    event.preventDefault();

    const file = event.target.files[0];

    Articles.publishFromXML(file);
})

document.addEventListener("click", (event) => {
    if (event.target.classList.contains("delete-btn")) {
        const articleId = event.target.dataset.id;

        Articles.delete(articleId);
    } else if (event.target.classList.contains("edit-btn")) {
        const articleId = event.target.dataset.id;

        window.location.href = `/articles/editor.html?id=${articleId}`;
    } else {
        let article = event.target.closest("A");

        if (article != null && article.getAttribute("href") === "article") {
            event.preventDefault();

            const articleId = article.dataset.id;

            console.log(articleId);

            // Articles.loadArticleById(articleId);
        }
    }
})
