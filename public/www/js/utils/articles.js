export class Articles {


    static async loadArticles() {
        fetch('/articles.xml')
        .then(response => response.text())
        .then(xmlText => {
            // Parse the XML
            const parser = new DOMParser();
            const xmlDoc = parser.parseFromString(xmlText, "application/xml");

            // Get all <article> elements
            const articles = xmlDoc.getElementsByTagName('article');
            console.log(articles);
            // Loop through and print each <title>
            for (let i = 0; i < articles.length; i++) {
                const titleElement = articles[i].getElementsByTagName('title')[0];
                const titleText = titleElement ? titleElement.textContent : '[No Title]';
                console.log(`Article ${i + 1}: ${titleText}`);
            }
        })
        .catch(error => {
            console.error('Failed to load or parse XML:', error);
        });
    }

    static async getSuggested(formData) {
        const response = await fetch("/backend/api/articles");

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
                    </div>`
            }

            document.getElementById("articlesContainer").innerHTML = articlesHTML;
        }
    }

    static async getUserSpecific() {
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

    static async publish(title, content) {
        let formData = new FormData();

        formData.append("title", title);
        formData.append("content", content);

        const response = await fetch("/backend/api/user/articles", {
            "method": "POST",
            "body": formData
        });

        if (response.status === 200) {
            window.location.href = "/articles/index.html";
        } else if (response.status === 401) {
            window.location.href = "index.html";
        }
    }

    static async publishFromXML(file) {
        let formData = new FormData();
        formData.append("xmlFile", file);

        const response = await fetch("/backend/api/user/articles", {
            "method": "POST",
            "body": formData
        });

        if (response.status === 200) {
            // window.location.href = "index.html";
        }
    }

    static async delete(articleId) {
        let formData = new FormData();

        formData.append("id", articleId);

        const response = await fetch("/backend/api/user/articles", {
            "method": "DELETE",
            "headers": {
                "Content-Type": "application/json"
            },
            "body": JSON.stringify({"id": articleId})
        });

        if (response.status === 200) {
            window.location.href = "/articles/index.html";
        }
    }
}