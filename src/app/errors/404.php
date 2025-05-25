<?php

header('Content-Type: application/json');

http_response_code(404);

echo json_encode([
    "status_code" => 404,
    "message" => "Resource not found"
]);

?>