export class Auth {
    static async checkLogin() {
        const response = await fetch("/backend/api/login");

        const data = await response.json();

        if (response.status === 200) {
            document.getElementById("loginButton").style.display = "none";
            document.getElementById("username").textContent = data.username;
            document.getElementById("userButton").style.display = "flex";

            return true;
        } else if (response.status === 401) {
            document.getElementById("userButton").style.display = "none";
            document.getElementById("loginButton").style.display = "flex";

            return false;
        }
    }
}

export async function login(formData, errorMessage) {
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

export async function logout(formData) {
    const response = await fetch("/backend/api/logout", {
        "method": "POST"
    });

    const data = await response.json();

    if (response.status === 200) {
        window.location.href = data.redirect;
    }
}

export async function signup(formData, errorMessage) {
    const response = await fetch('/backend/api/signup', {
        method: 'POST',
        body: formData
    });

    const data = await response.json();

    if (response.status === 200) {
        window.location.href = data.redirect;
    } else if (response.status === 409) {
        errorMessage.textContent = data.message;
        errorMessage.style.display = "block";
    }
}