<?php

namespace App\Utils;

enum HttpMethods: string {
    case GET = "GET";
    case POST = "POST";
    case PUT = "PUT";
    case DELETE = "DELETE";
    case PATCH = "PATCH";
    case OPTIONS = "OPTIONS";
    case HEAD = "HEAD";

    public static function fromRequest(): ?self {
        return self::tryFrom($_SERVER["REQUEST_METHOD"] ?? "");
    }
}

?>