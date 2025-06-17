<?php

require '../../../vendor/autoload.php';
include '../../utils/database.php';
include '../../utils/methods.php';
include '../../utils/status.php';
include '../../utils/session.php';
include_once '../../models/user.php';
include_once '../../models/article.php';

use App\Utils\Database;
use App\Utils\HttpMethods;
use App\Utils\HttpStatusCode;
use App\Utils\SessionManager;
use App\Models\User;
use App\Models\Article;

header("Content-Type: application/json");

$method = HttpMethods::fromRequest();

if ($method === HttpMethods::GET) {
    if (SessionManager::exists("userId")) {
        $userId = SessionManager::get("userId");

        $documentManager = Database::getDocumentManager();

        $user = $documentManager->getRepository(User::class)->findOneBy(["id" => $userId]);

        $data = [];

        foreach($user->getArticles() as $article) {
            $data[] = [
                "id" => $article->getId(),
                "title" => $article->getTitle(),
                "content" => $article->getContent(),
                "author" => [
                    "id" => $article->getAuthor()->getId(),
                    "username" => $article->getAuthor()->getUsername()
                ],
            ];
        }

        http_response_code(HttpStatusCode::OK);

        echo json_encode([
            "articles" => $data
        ], JSON_PRETTY_PRINT);

        exit;
    } else {
        http_response_code(HttpStatusCode::UNAUTHORIZED);

        echo json_encode([
            "status_code" => HttpStatusCode::UNAUTHORIZED,
            "message" => "Session not found"
        ]);

        exit;
    }
} else if ($method === HttpMethods::POST) {
    if (SessionManager::exists("userId")) {
        $documentManager = Database::getDocumentManager();

        $userId = SessionManager::get("userId");

        $user = $documentManager->getRepository(User::class)->findOneBy(["id" => $userId]);

        if (isset($_FILES["xmlFile"])) {
            $xmlFile = $_FILES["xmlFile"]["tmp_name"];
            $xsdFile = __DIR__ . "/../../schemas/articles.xsd";

            if (file_exists($xmlFile)) {
                libxml_use_internal_errors(true);

                $dom = new DOMDocument();
                $dom->load($xmlFile);

                if ($dom->schemaValidate($xsdFile)) {
                    $xpath = new DOMXPath($dom);
                    $articleNodes = $xpath->query("//article");

                    foreach($articleNodes as $article) {
                        $title = $xpath->query("title", $article)->item(0)->nodeValue;
                        $content = $xpath->query("content", $article)->item(0)->nodeValue;

                        $article = new Article($title, $content, $user);

                        $documentManager->persist($article);
                    }

                    $documentManager->flush();

                    http_response_code(HttpStatusCode::OK);

                    echo json_encode([
                        "status_code" => HttpStatusCode::OK,
                        "message" => "Created"
                    ]);

                    exit;
                } else {
                    $errors = libxml_get_errors();
                    $messages = [];
                    foreach ($errors as $error) {
                        $messages[] = trim($error->message) . " (line {$error->line})";
                    }
                    libxml_clear_errors();

                    http_response_code(HttpStatusCode::UNPROCESSABLE_ENTITY);

                    echo json_encode([
                        "status_code" => HttpStatusCode::UNPROCESSABLE_ENTITY,
                        "message" => "XML validation error"
                    ]);

                    exit;
                }
            }
        } else {
            $title = $_POST["title"];
            $content = $_POST["content"];

            $article = new Article($title, $content, $user);

            $documentManager->persist($article);
            $documentManager->flush();

            http_response_code(HttpStatusCode::OK);

            echo json_encode([
                "article" => [
                    "title" => $article->getTitle(),
                    "description" => $article->getDescription(),
                    "author" => [
                        "id" => $article->getAuthor()->getId(),
                        "username" => $article->getAuthor()->getUsername()
                    ],
                ],
            ]);

            exit;
        }
    } else {
        http_response_code(HttpStatusCode::UNAUTHORIZED);

        echo json_encode([
            "status_code" => HttpStatusCode::UNAUTHORIZED,
            "message" => "Session not found"
        ]);

        exit;
    }
} else if ($method === HttpMethods::DELETE) {
    $documentManager = Database::getDocumentManager();

    $rawData = file_get_contents("php://input");
    $data = json_decode($rawData, true);

    $articleId = $data["id"];

    $article = $documentManager->getRepository(Article::class)->findOneBy(["id" => $articleId]);

    $documentManager->remove($article);
    $documentManager->flush();

    http_response_code(HttpStatusCode::OK);

    echo json_encode([
        "article" => [
            "title" => $article->getTitle(),
            "description" => $article->getDescription(),
            "author" => [
                "id" => $article->getAuthor()->getId(),
                "username" => $article->getAuthor()->getUsername()
            ],
        ],
    ]);

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