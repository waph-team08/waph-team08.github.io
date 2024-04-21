
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mini Facebook</title>
    <link rel="stylesheet" type="text/css" href="form_styles.css">
</head>
<body>
    <div class="container">
        <h1>Registration Form</h1>
        <form action="addnewuser.php" method="POST">
            <input type="text" class="text_field" name="name" placeholder="name" required pattern="\w+" title="Please enter a valid name">
            <input type="text" class="text_field" name="username" placeholder="Username" required pattern="\w+" title="Please enter a valid username">
            <input type="email" class="text_field" name="email" placeholder="Your email address" required pattern="^[\w.-]+@[\w-]+(.[\w-]+)*$" title="Please enter a valid email">
            <input type="password" class="text_field" name="password" placeholder="Password" required pattern="^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[!@#$%^&*])[a-zA-Z\d!@#$%^&*]{8,}$" title="Password must have at least 8 characters with at least one lowercase, one uppercase, one number, and one special character">
            <input type="password" class="text_field" name="confirm_password" placeholder="Confirm Password" required pattern="^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[!@#$%^&*])[a-zA-Z\d!@#$%^&*]{8,}$" title="Password must match">
            <button type="submit" class="button">Register</button>

        </form>
    </div>
</body>
</html>
