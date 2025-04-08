<?php

include '../../../vendor/autoload.php';
include '../utils/session.php';
include '../utils/database.php';
include '../models/user.php';


use App\Utils\SessionManager;
use App\Utils\Database;
use App\Models\User;

header("Content-Type: application/json");

if ($_SERVER["REQUEST_METHOD"] === "GET") {
    if (SessionManager::exists("username")) {
        echo json_encode(["loggedIn" => true, "username" => SessionManager::get("username")]);
    } else {
        echo json_encode(["loggedIn" => true]);
    }
} else if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // $data = json_encode(file_get_contents("php://input"), true);
    // $username = $data["username"] ?? "";

    $username = htmlspecialchars(trim($_POST["username"]));

    $entityManager = Database::getEntityManager();

    $user = $entityManager->getRepository(User::class)->findOneBy(["username" => $username]);

    if ($user) {
        SessionManager::start();
        SessionManager::set("userid", $user->getId());
        SessionManager::set("username", $user->getUsername());

        echo "Logged in successfully";
    } else {
        echo "User not found";
    }
}

?>