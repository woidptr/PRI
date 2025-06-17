import { Articles } from "./utils/articles.js";

window.onload = function() {
    const params = new URLSearchParams(window.location.search);

    const articleId = params.get("id");

    if (articleId !== null) {
        console.log(articleId);
    }
}

document.getElementById('cancelBtn').addEventListener('click', () => {
    window.location.href = "/articles/index.html"; // Go back to the main page
});

document.getElementById('publishBtn').addEventListener('click', () => {
    const title = document.getElementById('articleTitle').value.trim();
    const content = document.getElementById('articleContent').value.trim();

    if (!title || !content) {
        alert("Please fill in both title and content.");
        return;
    }

    Articles.publish(title, content);

    window.location.href = "/articles/index.html";
});