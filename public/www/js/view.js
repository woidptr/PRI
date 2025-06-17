import { Articles } from "./utils/articles.js";
import { marked } from "https://cdn.jsdelivr.net/npm/marked/lib/marked.esm.js";

window.onload = async function() {
    const params = new URLSearchParams(window.location.search);

    const articleId = params.get("id");

    if (articleId !== null) {
        const article = await Articles.loadArticleById(articleId);

        document.getElementById("articleTitle").textContent = article.title;
        document.getElementById("articleAuthor").textContent = article.author.username;
        document.getElementById("articleContent").innerHTML = marked(article.content);
    }
}