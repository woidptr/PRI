export async function getUserArticles() {
    const response = await fetch("/backend/api/user/articles");

    const data = await response.json();

    if (response.status === 200) {
        let articlesHTML = ``;

        for (const article of data.articles) {
            articlesHTML += `
                <div class="article">
                    <a href="article" id="${article.id}">
                        <h2>${article.title}</h2>
                        <p>Explore callbacks, promises, and async/await in this beginner-friendly guide.</p>
                    </a>
                </div>
                <div class="article-actions">
                    <button class="edit-btn" data-id="${article.id}">✏️ Edit</button>
                    <button class="delete-btn" data-id="${article.id}">🗑️ Delete</button>
                </div>`
        }

        document.getElementById("articlesContainer").innerHTML = articlesHTML;
    }
}