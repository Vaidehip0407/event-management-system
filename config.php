
<?php
$db_host = "localhost";   // Changed from $host to $db_host
$db_user = "root";      // Changed from $username to $db_user
$db_pass = "";         // Changed from $password to $db_pass
$db_name = "event";     // Changed from $database to $db_name

$conn = mysqli_connect($db_host,$db_user, $db_pass, $db_name );

try {
    $pdo = new PDO("mysql:host=$db_host;dbname=$db_name;charset=utf8", $db_user, $db_pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    error_log("Database connection failed: " . $e->getMessage());
    die("Database connection failed. Please check your configuration.");
}
?>