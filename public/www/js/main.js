window.onload = function() {
    checkLogin();
    
    fetch("/backend/api/articles")
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                for (let article of data.articles) {
                    console.log(article.id);
                }
            }
        })
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

document.getElementById("logoutBtn").addEventListener("click", function(event) {
    event.preventDefault();

    logout();
})

async function logout() {
    const response = await fetch("/backend/api/logout", {
        "method": "POST"
    });

    const data = await response.json();

    if (response.status === 200) {
        window.location.href = data.redirect;
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