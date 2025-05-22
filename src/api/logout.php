<?php

include '../utils/session.php';
include '../utils/methods.php';

use App\Utils\SessionManager;
use App\Utils\HttpMethods;

$method = HttpMethods::fromRequest();

if ($method === HttpMethods::POST) {
    SessionManager::destroy();

    echo json_encode([
        "success" => true,
        "redirect" => "/"
    ]);

    exit;
}

?>