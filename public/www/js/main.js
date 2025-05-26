window.onload = function() {
    checkLogin();

    getSuggestedArticles();
}

async function checkLogin() {
    const response = await fetch("/backend/api/login");

    const data = await response.json();

    if (response.status === 200) {
        document.getElementById("loginButton").style.display = "none";
        document.getElementById("username").textContent = data.username;
        document.getElementById("userButton").style.display = "flex";
    } else if (response.status === 401) {
        document.getElementById("userButton").style.display = "none";
        document.getElementById("loginButton").style.display = "flex";
    }
}

async function getSuggestedArticles(formData) {
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

document.getElementById("logoutBtn").addEventListener("click", function(event) {
    event.preventDefault();

    logout();
})

async function logout(formData) {
    const response = await fetch("/backend/api/logout", {
        "method": "POST"
    });

    const data = await response.json();

    if (response.status === 200) {
        window.location.href = data.redirect;
    }
}

document.getElementById("articlesButton").addEventListener("click", function(event) {
    event.preventDefault();

    const form = event.target;
    const formData = new FormData(form);

    // getSuggestedArticles(formData);
})

document.addEventListener("click", function(event) {
    let article = event.target.closest("A");
    if (article != null && article.getAttribute("href") === "article") {
        event.preventDefault();


    }
})

async function loadArticle(articleId) {
    const formData = new FormData();
    formData.append("article_id", articleId);

    const response = fetch("/backend/api/articles", {
        "method": "GET",
        "body": formData
    });

    const data = await response.json();

    if (response.status === 200) {
        
    }
}

document.addEventListener('DOMContentLoaded', function() {
    const userDropdown = document.getElementById('userDropdown');
    const userButton = document.getElementById('userButton');
    
    if (userButton && userDropdown) {
        userButton.addEventListener('click', function(event) {
            event.stopPropagation();
            userDropdown.classList.toggle('active');
            // Update aria-expanded for accessibility
            userButton.setAttribute(
                'aria-expanded',
                userDropdown.classList.contains('active') ? 'true' : 'false'
            );
        });
        
        // Close the dropdown when clicking outside
        document.addEventListener('click', function(event) {
            if (!userDropdown.contains(event.target)) {
                userDropdown.classList.remove('active');
                userButton.setAttribute('aria-expanded', 'false');
            }
        });
    }
});