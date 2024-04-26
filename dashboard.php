<?php
session_start();

// Check if the user is logged in as a super user
if (!isset($_SESSION['super_user']) || $_SESSION['super_user'] !== true) {
    // If not, redirect to the login page
    header("Location: login.php");
    exit();
}

require_once "database.php";

// Fetch all user details from the database
$sql = "SELECT * FROM users";
$result = $mysqli->query($sql);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
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
            width: 600px;
            margin: auto;
            border: 3px solid #1877f2; /* Facebook blue color */
        }

        h1 {
            font-size: 24px;
            margin-bottom: 20px;
            text-align: center;
            color: #1877f2; /* Facebook blue color */
        }

        p {
            font-size: 16px;
            margin-bottom: 20px;
            color: #666;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        th, td {
            border: 1px solid #ccc;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }

        td button {
            background-color: #1877f2; /* Facebook blue color */
            color: #fff;
            font-size: 14px;
            cursor: pointer;
            border: none;
            border-radius: 5px;
            padding: 6px 12px;
        }

        td button:hover {
            background-color: #166fe5; /* Darker shade of Facebook blue color */
        }

        a {
            display: block;
            text-align: center;
            color: #1877f2; /* Facebook blue color */
            border: 1px solid #1877f2;
            border-radius: 5px;
            padding: 8px 16px;
            text-decoration: none;
            transition: background-color 0.3s, color 0.3s;
        }

        a:hover {
            background-color: #1877f2; /* Facebook blue color */
            color: #ffffff;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Welcome, Super User!</h1>
        <p>This is your dashboard. Here, you can manage user details.</p>
        <?php if ($result->num_rows > 0) : ?>
            <table>
                <tr>
                    <th>Username</th>
                    <th>Email</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
                <?php while ($row = $result->fetch_assoc()) : ?>
                    <tr>
                        <td><?php echo $row["username"]; ?></td>
                        <td><?php echo $row["email"]; ?></td>
                        <td><?php echo isset($row["status"]) ? ($row["status"] ? "Enabled" : "Disabled") : "Unknown"; ?></td>
                        <td>
                            <?php if (isset($row["status"])) : ?>
                                <form action="enable_disable_user.php" method="post">
                                    <input type="hidden" name="username" value="<?php echo $row["username"]; ?>">
                                    <input type="hidden" name="action" value="<?php echo $row["status"] ? 'disable' : 'enable'; ?>">
                                    <button type="submit"><?php echo $row["status"] ? 'Disable' : 'Enable'; ?></button>
                                </form>
                            <?php else : ?>
                                Status unavailable
                            <?php endif; ?>
                        </td>
                    </tr>
                <?php endwhile; ?>
            </table>
        <?php else : ?>
            <p>No users found.</p>
        <?php endif; ?>
        <a href='logout.php'>Logout</a>
    </div>
</body>
</html>
