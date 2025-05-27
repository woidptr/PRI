<?php

include '../../vendor/autoload.php';
include '../utils/database.php';
include '../utils/session.php';
include '../utils/methods.php';
include '../utils/status.php';
include '../models/user.php';

use App\Utils\Database;
use App\Utils\SessionManager;
use App\Utils\HttpMethods;
use App\Utils\HttpStatusCode;
use App\Models\User;

header("Content-Type: application/json");

$method = HttpMethods::fromRequest();

if ($method === HttpMethods::POST) {
    $documentManager = Database::getDocumentManager();

    $username = $_POST["username"];
    $email = $_POST["email"];
    $password_hash = password_hash($_POST["password"], PASSWORD_DEFAULT);

    $check_email = $documentManager->getRepository(User::class)->findOneBy(["email" => $email]);

    if ($check_email) {
        http_response_code(HttpStatusCode::CONFLICT);

        echo json_encode([
            "status_code" => HttpStatusCode::CONFLICT,
            "message" => "This email is already registered!"
        ]);

        exit;
    } else {
        $check_username = $documentManager->getRepository(User::class)->findOneBy(["username" => $username]);

        if ($check_username) {
            http_response_code(HttpStatusCode::CONFLICT);

            echo json_encode([
                "status_code" => HttpStatusCode::CONFLICT,
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

        http_response_code(HttpStatusCode::OK);

        echo json_encode([
            "redirect" => "/index.html"
        ]);

        exit;
    }
} else {
    http_response_code(HttpStatusCode::METHOD_NOT_ALLOWED);

    echo json_encode([
        "status_code" => HttpStatusCode::METHOD_NOT_ALLOWED,
        "message" => "Method not allowed"
    ]);

    exit;
}

?>