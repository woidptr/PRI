<?php

require '../../vendor/autoload.php';
include '../utils/database.php';
include '../utils/methods.php';
include_once '../models/user.php';
include_once '../models/article.php';

use App\Utils\Database;
use App\Utils\HttpMethods;
use App\Models\User;
use App\Models\Article;

$method = HttpMethods::fromRequest();

if ($method === HttpMethods::GET) {
    $documentManager = Database::getDocumentManager();

    $user = $documentManager->getRepository(User::class)->findOneBy(["username" => "test"]);

    $article = new Article("Test title", "Test description", "Test content", $user);
    $user->addArticle($article);

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

    echo json_encode(["articles" => $data], JSON_PRETTY_PRINT);

    exit;
}

?>