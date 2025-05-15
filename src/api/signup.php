<?php

include '../utils/database.php';
include '../models/user.php';

use App\Utils\Database;
use App\Models\User;

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $documentManager = Database::getDocumentManager();

    $username = $_POST["username"];
    $email = $_POST["email"];
    $password_hash = password_hash($_POST["password"], PASSWORD_DEFAULT);

    $user = $documentManager->getRepository(User::class)->findOneBy(["username" => $username]);

    if ($user) {
        echo "User found";
    } else {
        $newUser = new User($username, $email, $password_hash);

        $documentManager->persist($newUser);
        $documentManager->flush();
    }
}

?>