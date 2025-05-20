window.onload = function() {
    fetch("/backend/api/login.php")
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                document.getElementById("loginButton").style.display = "none";
                var userSection = document.getElementById("userSection");
                // userSection.innerHTML = `
                //     <div class="user-info">
                //         <img src="https://cdn0.iconfinder.com/data/icons/communication-456/24/account_profile_user_contact_person_avatar_placeholder-512.png" alt="Avatar">
                //         <span>${data.username}</span>
                //     </div>
                // `;
            } else {
                document.getElementById("loginButton").style.display = "flex";
            }
        })
}


// function fetchUser() {
//     fetch("/src/user.php")
//         .then(response => response.json())
//         .then(data => {
//             document.getElementById("navigation").innerHTML = `<h1>Library Showcase</h1>`;
//         })
//         .catch(error => console.error("Error: ", error))
// }
