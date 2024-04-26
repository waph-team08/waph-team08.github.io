<?php
$host = 'localhost';
$dbname = 'waph_team';
$username = 'waph_team08';
$password = 'Pa$$w0rd';

try {
    $db = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}
?>
