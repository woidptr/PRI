import { login } from "./utils/auth.js";

document.getElementById("login-form").addEventListener("submit", function (e) {
    e.preventDefault();

    const errorMessage = document.getElementById("error-message");

    const form = e.target;
    const formData = new FormData(form);

    login(formData, errorMessage);
})