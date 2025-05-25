<?php

require '../../vendor/autoload.php';
include '../utils/database.php';
include '../utils/methods.php';
include '../utils/status.php';
include_once '../models/user.php';
include_once '../models/article.php';

use App\Utils\Database;
use App\Utils\HttpMethods;
use App\Utils\HttpStatusCode;
use App\Models\User;
use App\Models\Article;

header("Content-Type: application/json");

$method = HttpMethods::fromRequest();

if ($method === HttpMethods::GET) {
    $documentManager = Database::getDocumentManager();

    $user = $documentManager->getRepository(User::class)->findOneBy(["username" => "test"]);

    $article = new Article("Test title", "Test description", "Test content", $user);
    $user->addArticle($article);

    $documentManager->persist($user);
    $documentManager->persist($article);
    $documentManager->flush();

    $data = [];

    foreach($user->getArticles() as $article) {
        $data[] = [
            "id" => $article->getId(),
            "title" => $article->getTitle(),
            "description" => $article->getDescription(),
            "author" => [
                "id" => $article->getAuthor()->getId(),
                "username" => $article->getAuthor()->getUsername()
            ],
        ];
    }

    http_response_code(HttpStatusCode::OK);

    echo json_encode([
        "success" => true,
        "articles" => $data
    ], JSON_PRETTY_PRINT);

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