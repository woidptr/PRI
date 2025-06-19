import { Auth } from "./utils/auth.js";
import { Articles } from "./utils/articles.js";
import { marked } from "https://cdn.jsdelivr.net/npm/marked/lib/marked.esm.js";

window.onload = async function() {
    await Auth.checkLogin();

    const params = new URLSearchParams(window.location.search);

    const articleId = params.get("id");

    if (articleId !== null) {
        const article = await Articles.loadArticleById(articleId);

        const articleCreatedAt = new Date(article.createdAt.date);

        document.getElementById("articleTitle").textContent = article.title;
        document.getElementById("articleAuthor").textContent = article.author.username;
        document.getElementById("articleDatePublished").textContent = articleCreatedAt.toLocaleString('en-US', {
            month: 'long',
            year: 'numeric'
        });
        document.getElementById("articleContent").innerHTML = marked(article.content);

        console.log(article);
    }
}