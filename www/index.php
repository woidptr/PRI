<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Library Showcase</title>
    <link rel="stylesheet" href="css/index.css">
</head>
<body>
    <div class="navbar">
        <h1>Library Showcase</h1>
        <a href="login.php" class="login-btn">Login</a>
    </div>
    <div class="container">
        <?php
        require __DIR__ . '/include/database.php';
        
        $xml = simplexml_load_file('books.xml');
        foreach ($xml->book as $book) {
            echo "<div class='book'>";
            echo "<h2>{$book->title}</h2>";
            echo "<p>Author: {$book->author}</p>";
            echo "<p>Year: {$book->year}</p>";
            echo "</div>";
        }
        ?>
    </div>
</body>
</html>
