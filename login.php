<?php
session_start();
require_once "database.php"; // Include the database connection

if (isset($_POST['username']) && isset($_POST['password'])) {
    // Check credentials against the database
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Validate credentials (You need to implement this part)

    // Assuming validation passes and user is super user
    $_SESSION['super_user'] = true;

    // Store superuser credentials if not already present
    if (!isSuperUserStored($username)) {
        storeSuperUserCredentials($username, $password);
    }

    header("Location: dashboard.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f2f5;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .container {
            background-color: #fff;
            border-radius: 20px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            padding: 30px;
            width: 400px;
            margin: auto;
            border: 3px solid #1877f2; /* Facebook blue color */
        }

        h2 {
            font-size: 24px;
            margin-bottom: 20px;
            text-align: center;
            color: #1877f2; /* Facebook blue color */
        }

        form {
            margin-top: 20px;
        }

        input[type="text"],
        input[type="password"],
        button {
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        button {
            background-color: #1877f2; /* Facebook blue color */
            color: #fff;
            font-size: 16px;
            cursor: pointer;
        }

        button:hover {
            background-color: #166fe5; /* Darker shade of Facebook blue color */
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Welcome, Superuser!</h2>
        <form method="POST" action="">
            <input type="text" name="username" placeholder="Username" required><br><br>
            <input type="password" name="password" placeholder="Password" required><br><br>
            <button type="submit">Login</button>
        </form>
    </div>
</body>
</html>
v