<?php
require "session_auth.php";
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
        <form action="index.php" method="POST" class="form login">
            <input type="text" class="text_field" name="username" placeholder="Username" required pattern="\w+" title="Please enter a valid username">
            <input type="password" class="text_field" name="password" placeholder="Password" required pattern="^(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}$" title="Password must have at least 8 characters with at least one number, one lowercase, and one uppercase letter">
            <button class="button" type="submit">Login</button>
        </form>

        <form action="registrationform.php" method="GET">
            <button type="submit">Sign Up</button>
        </form>
    </div>
</body>
</html>
