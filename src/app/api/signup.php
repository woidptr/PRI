<?php

include '../../vendor/autoload.php';
include '../utils/database.php';
include '../utils/session.php';
include '../models/user.php';

use App\Utils\Database;
use App\Utils\SessionManager;
use App\Models\User;

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $documentManager = Database::getDocumentManager();

    $username = $_POST["username"];
    $email = $_POST["email"];
    $password_hash = password_hash($_POST["password"], PASSWORD_DEFAULT);

    $check_email = $documentManager->getRepository(User::class)->findOneBy(["email" => $email]);

    if ($check_email) {
        echo json_encode([
            "success" => false,
            "message" => "This email is already registered!"
        ]);

        exit;
    } else {
        $check_username = $documentManager->getRepository(User::class)->findOneBy(["username" => $username]);

        if ($check_username) {
            echo json_encode([
                "success" => false,
                "message" => "Username already taken!"
            ]);

            exit;
        }

        $newUser = new User($username, $email, $password_hash);

        $documentManager->persist($newUser);
        $documentManager->flush();

        SessionManager::start();
        SessionManager::set("userId", $newUser->getId());
        SessionManager::set("username", $newUser->getUsername());

        echo json_encode([
            "success" => true,
            "redirect" => "/index.html"
        ]);

        exit;
    }
}

?>