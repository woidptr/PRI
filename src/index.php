<?php

use App\Models\User;
use App\Utils\Database;

if (!isset($_SERVER["HTTP_X_FRONTEND_REQUEST"]) || $_SERVER["HTTP_X_FRONTEND_REQUEST"] !== "true") {
    http_response_code(403);
    echo json_encode(["error" => "Unauthorized direct access"]);
    exit;
}

$documentManager = Database::getDocumentManager();

?>