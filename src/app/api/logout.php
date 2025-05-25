<?php

include '../../vendor/autoload.php';
include '../utils/session.php';
include '../utils/methods.php';
include '../utils/status.php';

use App\Utils\SessionManager;
use App\Utils\HttpMethods;
use App\Utils\HttpStatusCode;

header("Content-Type: application/json");

$method = HttpMethods::fromRequest();

if ($method === HttpMethods::POST) {
    SessionManager::destroy();

    http_response_code(HttpStatusCode::OK);

    echo json_encode([
        "redirect" => "/"
    ]);

    exit;
} else {
    http_response_code(HttpStatusCode::METHOD_NOT_ALLOWED);

    echo json_encode([
        "status_code" => HttpStatusCode::METHOD_NOT_ALLOWED,
        "message" => "Method not allowed"
    ]);

    exit;
}

?>