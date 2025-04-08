<?php

use App\Utils\SessionManager;

SessionManager::destroy();
echo json_encode(["message" => "Logged out successfully"]);

?>