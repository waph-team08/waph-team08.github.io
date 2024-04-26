<?php
require "session_auth.php";

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Handle regular user login
    require_once "database.php";

    $username = $_POST['username'];
    $password = $_POST['password'];

    // Check if the user exists and is enabled
    // Check if the user exists and is enabled
    if (isset($_POST["username"]) && isset($_POST["password"])) {
    // Validate login
    $username = $_POST["username"];
    $password = $_POST["password"];
    $user = getUserInfo($username);

    if ($user && $user['status'] == 1 && checklogin_mysql($username, $password)) {
        // User is enabled and credentials are correct, proceed with login
        $_SESSION["authenticated"] = TRUE;
        $_SESSION["username"] = $username;
        $_SESSION["browser"] = $_SERVER['HTTP_USER_AGENT'];
        header("Location: index.php"); // Redirect to index.php or any desired page
        exit();
    } elseif ($user && $user['status'] == 0) {
        // User is disabled, show error message
        $error_message = "Oops, your account is disabled. Please contact the administrator for assistance. You can reach out to this email: <a href='mailto:venagaci@mail.uc.edu'>venagaci@mail.uc.edu</a>";
    } else {
        // Invalid username or password, show error message
        session_destroy();
        echo "<script>alert('Invalid username/password');window.location='form.php';</script>";
        die();
    }
}
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Mini Facebook</title>
    <link rel="stylesheet" type="text/css" href="style.css">

    <script type="text/javascript">
        function displayTime() {
            document.getElementById('digit-clock').innerHTML = "Current time:" + new Date();
        }
        setInterval(displayTime, 500);
    </script>
</head>
<body>
    <div class="container">
        <h1>Welcome to Mini Facebook Application</h1>
        <form action="form.php" method="POST" class="form login">
            <input type="text" class="text_field" name="username" placeholder="Username" required pattern="\w+" title="Please enter a valid username">
            <input type="password" class="text_field" name="password" placeholder="Password" required pattern="^(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}$" title="Password must have at least 8 characters with at least one number, one lowercase, and one uppercase letter">
            <button class="button" type="submit">Login</button>
            <?php if(isset($error_message)) { ?>
            <p class="error"><?php echo $error_message; ?></p>
            <?php } ?>
        </form>

        <form action="registrationform.php" method="GET">
            <button type="submit">Sign Up</button>
        </form>
        <form action="login.php" method="GET">
            <button type="submit">Are you a super user?</button>
        </form>
    </div>
</body>
</html>
