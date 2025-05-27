import { getUserArticles } from "./articles/user.js";
import { checkLogin } from "./utils/auth.js";

window.onload = function() {
    checkLogin();

    getUserArticles();
}

document.addEventListener("DOMContentLoaded", () => {
    let articleToDelete = null;

    // Open confirmation modal on delete
    document.querySelectorAll(".delete-btn").forEach(btn => {
        btn.addEventListener("click", (e) => {
            articleToDelete = btn.dataset.id;
            document.getElementById("confirmModal").style.display = "flex";
        });
    });

    // Handle delete confirmation
    document.getElementById("confirmDeleteBtn").addEventListener("click", () => {
        if (articleToDelete) {
            // Do your actual delete logic here (e.g. API call)
            console.log("Deleting article ID:", articleToDelete);
            const articleElement = document.getElementById(articleToDelete)?.closest(".article");
            if (articleElement) articleElement.remove();

            articleToDelete = null;
        }
        document.getElementById("confirmModal").style.display = "none";
    });

    // Cancel deletion
    document.getElementById("cancelDeleteBtn").addEventListener("click", () => {
        document.getElementById("confirmModal").style.display = "none";
        articleToDelete = null;
    });

    // Optional: handle edit
    document.querySelectorAll(".edit-btn").forEach(btn => {
        btn.addEventListener("click", () => {
            const articleId = btn.dataset.id;
            // Redirect to edit page or open modal
            window.location.href = `/edit-article.html?id=${articleId}`;
        });
    });
});