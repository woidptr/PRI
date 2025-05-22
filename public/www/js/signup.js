document.getElementById("signup-form").addEventListener("submit", function (e) {
    e.preventDefault();

    const errorMessage = document.getElementById("error-message");

    const form = e.target;
    const formData = new FormData(form);

    fetch('/backend/api/signup.php', {
        method: 'POST',
        body: formData
    })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                window.location.href = data.redirect;
            } else {
                errorMessage.textContent = data.message;
                errorMessage.style.display = "block";
            }
        })
})