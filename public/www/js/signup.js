import { signup } from "./utils/auth.js";

document.getElementById("signup-form").addEventListener("submit", function (e) {
    e.preventDefault();

    const errorMessage = document.getElementById("error-message");

    const form = e.target;
    const formData = new FormData(form);

    signup(formData, errorMessage);
})