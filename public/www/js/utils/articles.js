export class Articles {
    static async loadArticles() {
        const [xmlRes, xslRes] = await Promise.all([
            fetch('/articles.xml'),
            fetch('/articles.xsl')
        ]);
        const xmlText = await xmlRes.text();
        const xslText = await xslRes.text();
  
        const parser = new DOMParser();
        const xml = parser.parseFromString(xmlText, "application/xml");
        const xsl = parser.parseFromString(xslText, "application/xml");
  
        const xsltProcessor = new XSLTProcessor();
        xsltProcessor.importStylesheet(xsl);
  
        const result = xsltProcessor.transformToFragment(xml, document);
        document.getElementById('articlesContainer').innerHTML = '';
        document.getElementById('articlesContainer').appendChild(result);
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

    static async delete() {
        let formData = new FormData();

        formData.append("id", 123456789);

        const response = await fetch("/backend/api/user/articles", {
            "method": "DELETE",
            "body": formData
        });
    }
}