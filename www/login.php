<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #111;
            color: #fff;
            margin: 0;
            padding: 0;
            text-align: center;
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
        .container {
            max-width: 400px;
            margin: 50px auto;
            padding: 20px;
            background-color: #222;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(255, 255, 255, 0.1);
        }
        input[type="text"], input[type="password"] {
            width: calc(100% - 20px);
            padding: 10px;
            margin: 10px 0;
            border: none;
            border-radius: 5px;
            background-color: #333;
            color: #fff;
            text-align: left;
        }
        .login-btn {
            width: 100%;
            padding: 10px;
            margin-top: 10px;
            border: none;
            border-radius: 5px;
            background-color: #fff;
            color: #111;
            font-weight: bold;
            cursor: pointer;
            text-align: center;
            display: block;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Login</h2>
        <form action="authenticate.php" method="POST">
            <input type="text" name="username" placeholder="Username" required>
            <input type="password" name="password" placeholder="Password" required>
            <button type="submit" class="login-btn">Login</button>
        </form>
    </div>
</body>
</html>