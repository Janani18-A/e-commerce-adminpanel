<?php
// Database Configuration
define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', ''); // Your MySQL password
define('DB_NAME', 'ecommerce');

// Application URL
define('APP_URL', 'http://localhost/e-commerce-adminpanel');
define('BASE_PATH', dirname(__DIR__));

// Session Configuration
ini_set('session.cookie_httponly', 1);
ini_set('session.use_only_cookies', 1);
session_start();

// Error Reporting
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Database Connection Function - ADD THIS
function getDBConnection()
{
    $conn = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }
    mysqli_set_charset($conn, "utf8mb4");
    return $conn;
}

// Helper Functions
function isLoggedIn()
{
    return isset($_SESSION['user_id']) && !empty($_SESSION['user_id']);
}

function redirect($path)
{
    header('Location: ' . APP_URL . '/' . ltrim($path, '/'));
    exit;
}

function sanitizeInput($data)
{
    return htmlspecialchars(strip_tags(trim($data)));
}
