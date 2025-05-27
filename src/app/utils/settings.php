<?php

namespace App\Utils;

require_once __DIR__ . "/../../vendor/autoload.php";

use Dotenv\Dotenv;

$dotenv = Dotenv::createImmutable(__DIR__ . "/../../");
$dotenv->load();

class Settings {
    public static string $mongoUser;
    public static string $mongoPassword;

    public static function load() {
        self::$mongoUser = $_ENV["MONGO_USER"];
        self::$mongoPassword = $_ENV["MONGO_PASSWORD"];
    }
}

Settings::load();

?>