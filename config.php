<?php
// config.php - Database configuration
define('DB_HOST', 'localhost');     // Usually 'localhost' for cPanel
define('DB_USER', 'isaaq_isak');  // Your cPanel username
define('DB_PASS', 'nJxz_W]N@]!V}R5u');         // Your database password
define('DB_NAME', 'isaaq_isak');    // Database name (usually cpaneluser_databasename)

// Create connection using MySQLi (object-oriented)
$conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error . " Please check your database credentials in config.php");
}

// Set charset to UTF-8
$conn->set_charset("utf8mb4");

// Optional: Enable error reporting for debugging
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
?>