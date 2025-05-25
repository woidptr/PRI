window.onload = function() {
    fetch("/backend/api/login.php")
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                document.getElementById("loginButton").style.display = "none";
                document.getElementById("username").textContent = data.username;
                document.getElementById("userButton").style.display = "flex";
            } else {
                document.getElementById("userButton").style.display = "none";
                document.getElementById("loginButton").style.display = "flex";
            }
        })
    
    fetch("/backend/api/articles.php")
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                for (let article of data.articles) {
                    console.log(article.id);
                }
            }
        })
}

document.getElementById("logoutBtn").addEventListener("click", function(event) {
    event.preventDefault();

    fetch("/backend/api/logout.php", {
        "method": "POST"
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            window.location.href = data.redirect;
        }
    })
})

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