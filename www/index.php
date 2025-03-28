<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Library Showcase</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #111;
            color: #fff;
            margin: 0;
            padding: 20px;
            text-align: center;
        }
        .container {
            max-width: 800px;
            margin: 0 auto;
        }
        .book {
            background-color: #222;
            padding: 15px;
            margin: 10px 0;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(255, 255, 255, 0.1);
        }
        .book h2 {
            margin: 0;
            font-size: 1.5em;
        }
        .book p {
            margin: 5px 0;
            font-size: 1em;
            color: #bbb;
        }
        .login-btn {
            display: inline-block;
            background-color: #fff;
            color: #111;
            padding: 10px 20px;
            margin-bottom: 20px;
            border-radius: 5px;
            text-decoration: none;
            font-weight: bold;
        }
        .navbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            background-color: #222;
            padding: 15px 20px;
            box-shadow: 0 2px 10px rgba(255, 255, 255, 0.1);
        }
        .navbar h1 {
            margin: 0;
            font-size: 1.8em;
        }
    </style>
</head>
<body>
    <div class="navbar">
        <h1>Library Showcase</h1>
        <a href="login.php" class="login-btn">Login</a>
    </div>
    <div class="container">
        <?php
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
