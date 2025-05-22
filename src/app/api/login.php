<?php

require_once __DIR__ . '/../../vendor/autoload.php';
include '../utils/session.php';
include '../utils/database.php';
include '../utils/methods.php';
include '../models/user.php';

use App\Utils\SessionManager;
use App\Utils\HttpMethods;
use App\Utils\Database;
use App\Models\User;

header("Content-Type: application/json");

$method = HttpMethods::fromRequest();

if ($method === HttpMethods::GET) {
    if (SessionManager::exists("username")) {
        echo json_encode([
            "success" => true,
            "username" => SessionManager::get("username")
        ]);

        exit;
    } else {
        echo json_encode([
            "success" => false
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

        echo json_encode([
            "success" => true,
            "redirect" => "/index.html"
        ]);

        exit;
    } else {
        echo json_encode([
            "success" => false
        ]);
    }
}

?>