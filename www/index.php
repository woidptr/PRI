<?php
require __DIR__ . '/vendor/autoload.php';

use Surreal\Surreal;

try {
    $db = new Surreal("http://127.0.0.1:8000/rpc");

    echo "Connected to SurrealDB";
} catch (Exception $e) {
    die("Error " . $e->getMessage());
}

echo "Hello, World!";
?>
