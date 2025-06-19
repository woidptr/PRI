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
    $articleId = $_GET["articleId"] ?? "";

    $documentManager = Database::getDocumentManager();

    http_response_code(HttpStatusCode::OK);

    if ($articleId === "") {
        $builder = $documentManager->createAggregationBuilder(Article::class)->hydrate(Article::class);
        $results = $builder->sample(5)->execute()->toArray();

        $data = [];

        foreach($results as $article) {
            $data[] = [
                "id" => $article->getId(),
                "title" => $article->getTitle(),
                "content" => $article->getContent(),
                "createdAt" => $article->getCreatedAt(),
                "author" => [
                    "id" => $article->getAuthor()->getId(),
                    "username" => $article->getAuthor()->getUsername()
                ],
            ];
        }

        echo json_encode([
            "articles" => $data
        ], JSON_PRETTY_PRINT);

        exit;
    } else {
        $article = $documentManager->getRepository(Article::class)->findOneBy(["id" => $articleId]);

        echo json_encode([
            "articles" => [
                "id" => $article->getId(),
                "title" => $article->getTitle(),
                "content" => $article->getContent(),
                "createdAt" => $article->getCreatedAt(),
                "author" => [
                    "id" => $article->getAuthor()->getId(),
                    "username" => $article->getAuthor()->getUsername()
                ],
            ],
        ]);

        exit;
    }
} else {
    http_response_code(HttpStatusCode::METHOD_NOT_ALLOWED);

    echo json_encode([
        "status_code" => HttpStatusCode::METHOD_NOT_ALLOWED,
        "message" => "Method not allowed"
    ]);

    exit;
}

?>