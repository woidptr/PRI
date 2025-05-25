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

    $builder = $documentManager->createAggregationBuilder(Article::class);
    $results = $builder
    ->sample(5)
    ->execute()
    ->toArray();

    $data = [];

    foreach($results as $article) {
        $data[] = [
            "title" => $article["title"],
            "content" => $article["content"]
        ];
    }

    http_response_code(HttpStatusCode::OK);

    echo json_encode([
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