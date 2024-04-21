<?php
require "session_auth.php";
?> 

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>Mini Facebook -Change password</title>
  <link rel="stylesheet" type="text/css" href="changepassword.css">
  <script type="text/javascript">
    function validateForm() {
      var newPassword = document.getElementById('newpassword').value;
      // Client-side validation for password criteria
      if (newPassword.length < 8) {
        alert('Password must be at least 8 characters long.');
        return false;
      }
      // You can add more validation criteria as needed
      return true;
    }
  </script>
</head>
<body>
  <div class="container">
    <h1>Change password</h1>
    <div id="digit-clock"></div>  
    <?php
      echo "Visited time: " . date("Y-m-d h:i:sa");
      $rand = bin2hex(openssl_random_pseudo_bytes(16));
      $_SESSION['nocsrftoken'] = $rand;
    ?>
    <form action="changepassword.php" method="POST" class="form login" onsubmit="return validateForm()">
      <label for="username">Username:</label> 
      <span><?php echo htmlentities($_SESSION['username']); ?></span> <br>
      <label for="newpassword">New Password:</label>
      <input type="password" class="text_field" name="newpassword" id="newpassword" required /> <br>
      <input type="hidden" class="text_field" name="nocsrftoken" value="<?php echo $rand; ?>" />
      <button class="button" type="submit">Change Password</button>
      
    </form>
  </div>
</body>
</html>
