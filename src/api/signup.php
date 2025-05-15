<?php

include '../utils/database.php';
include '../models/user.php';

use App\Utils\Database;
use App\Models\User;

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $documentManager = Database::getDocumentManager();

    $username = $_POST["username"];
    $password_hash = password_hash($_POST["password"], PASSWORD_DEFAULT);

    $newUser = new User($username, $password_hash);

    $documentManager->persist($newUser);
    $documentManager->flush();

    echo "Signed up successfully";
}

?>