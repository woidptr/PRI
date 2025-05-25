<?php

include "../utils/status.php";

use App\Utils\HttpStatusCode;

header('Content-Type: application/json');

http_response_code(HttpStatusCode::NOT_FOUND);

echo json_encode([
    "status_code" => HttpStatusCode::NOT_FOUND,
    "message" => "Resource not found"
]);

?>