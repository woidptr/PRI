function fetchUser() {
    fetch("/src/user.php")
        .then(response => response.json())
        .then(data => {
            document.getElementById("navigation").innerHTML = `<h1>Library Showcase</h1>`;
        })
        .catch(error => console.error("Error: ", error))
}
