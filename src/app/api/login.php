<?php

require_once __DIR__ . '/../../vendor/autoload.php';
include '../utils/session.php';
include '../utils/database.php';
include '../utils/methods.php';
include '../utils/status.php';
include '../models/user.php';

use App\Utils\SessionManager;
use App\Utils\HttpMethods;
use App\Utils\HttpStatusCode;
use App\Utils\Database;
use App\Models\User;

header("Content-Type: application/json");

$method = HttpMethods::fromRequest();

if ($method === HttpMethods::GET) {
    if (SessionManager::exists("username")) {
        http_response_code(HttpStatusCode::OK);

        echo json_encode([
            "username" => SessionManager::get("username")
        ]);

        exit;
    } else {
        http_response_code(HttpStatusCode::UNAUTHORIZED);

        echo json_encode([
            "message" => "Session not found"
        ]);

        exit;
    }
} else if ($method === HttpMethods::POST) {
    $username = htmlspecialchars(trim($_POST["username"]));
    $password = $_POST["password"];

    $documentManager = Database::getDocumentManager();

    $user = $documentManager->getRepository(User::class)->findOneBy(["username" => $username]);

    if ($user && password_verify($password, $user->getPasswordHash())) {
        SessionManager::start();
        SessionManager::set("userId", $user->getId());
        SessionManager::set("username", $user->getUsername());

        http_response_code(HttpStatusCode::OK);

        echo json_encode([
            "redirect" => "/index.html"
        ]);

        exit;
    } else {
        http_response_code(HttpStatusCode::UNAUTHORIZED);

        echo json_encode([
            "message" => "Username or password is incorrect"
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