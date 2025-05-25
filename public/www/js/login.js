document.getElementById("login-form").addEventListener("submit", function (e) {
    e.preventDefault();

    const errorMessage = document.getElementById("error-message");

    const form = e.target;
    const formData = new FormData(form);

    login(formData, errorMessage);
})

async function login(formData, errorMessage) {
    const response = await fetch("/backend/api/login", {
        method: "POST",
        body: formData
    });

    const data = await response.json();

    if (response.status === 200) {
        window.location.href = data.redirect;
    } else if (response.status === 401) {
        errorMessage.textContent = data.message;
        errorMessage.style.display = "block";
    }
}