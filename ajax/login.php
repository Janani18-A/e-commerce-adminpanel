<?php
// Error reporting for debugging
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Load configuration
require_once __DIR__ . '/../config/config.php';

// Set headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Allow-Headers: Content-Type, X-Requested-With");

// Check if it's a POST request
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo json_encode([
        'success' => false,
        'message' => 'Method not allowed'
    ]);
    exit;
}

// Get form data
$step = $_POST['step'] ?? '';
$username = trim($_POST['username'] ?? '');
$password = $_POST['password'] ?? '';
$remember = $_POST['remember'] ?? '';

// Initialize response
$response = [
    'success' => false,
    'message' => '',
    'errors' => []
];

// Validation
$errors = [];

// Username validation
if (empty($username)) {
    $errors['username'] = 'Username is required';
} elseif (strlen($username) < 3) {
    $errors['username'] = 'Username must be at least 3 characters';
}

// Password validation
if (empty($password)) {
    $errors['password'] = 'Password is required';
} elseif (strlen($password) < 6) {
    $errors['password'] = 'Password must be at least 6 characters';
}

// If there are validation errors
if (!empty($errors)) {
    $response['message'] = 'Please fix the errors below';
    $response['errors'] = $errors;
    echo json_encode($response);
    exit;
}

// Database connection
try {
    $conn = getDBConnection();

    if (!$conn) {
        throw new Exception("Database connection failed");
    }

    // Check if user exists in database
    $stmt = $conn->prepare("SELECT id, username, name, password, status FROM users WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 0) {
        $response['message'] = 'Invalid username or password';
        $response['errors']['username'] = 'Invalid credentials';
        echo json_encode($response);
        exit;
    }

    $user = $result->fetch_assoc();
    $stmt->close();

    // Check if user is active
    if ($user['status'] !== 'active') {
        $response['message'] = 'Your account is inactive. Please contact admin.';
        echo json_encode($response);
        exit;
    }

    // Verify password
    if (!password_verify($password, $user['password'])) {
        $response['message'] = 'Invalid username or password';
        $response['errors']['password'] = 'Incorrect password';
        echo json_encode($response);
        exit;
    }

    // Update last login
    $updateStmt = $conn->prepare("UPDATE users SET last_login = NOW() WHERE id = ?");
    $updateStmt->bind_param("i", $user['id']);
    $updateStmt->execute();
    $updateStmt->close();

    // Close connection
    $conn->close();

    // Set session
    $_SESSION['user_id'] = $user['id'];
    $_SESSION['username'] = $user['username'];
    $_SESSION['name'] = $user['name'];
    $_SESSION['login_time'] = time();

    // Remember me (7 days)
    if ($remember === 'on') {
        setcookie('remember_username', $username, time() + (86400 * 7), '/');
    }

    // Success response
    $response['success'] = true;
    $response['message'] = 'Login successful! Welcome ' . $user['name'];
    $response['redirectUrl'] = APP_URL . '/index.php';
    $response['user'] = [
        'id' => $user['id'],
        'username' => $user['username'],
        'name' => $user['name']
    ];

    echo json_encode($response);

} catch (Exception $e) {
    $response['message'] = 'Database error: ' . $e->getMessage();
    echo json_encode($response);
}
?>