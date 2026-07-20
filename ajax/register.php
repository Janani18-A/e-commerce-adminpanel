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
$name = trim($_POST['name'] ?? '');
$mobile = trim($_POST['mobile'] ?? '');
$username = trim($_POST['username'] ?? '');
$email = trim($_POST['email'] ?? '');
$password = $_POST['password'] ?? '';
$confirm_password = $_POST['confirm_password'] ?? '';
$phone_full = $_POST['phone']['full'] ?? '';

// If phone_full is provided, use it instead of mobile
if (!empty($phone_full)) {
    $mobile = $phone_full;
}

// Initialize response
$response = [
    'success' => false,
    'message' => '',
    'errors' => []
];

// Validation
$errors = [];

// Name validation
if (empty($name)) {
    $errors['name'] = 'Full name is required';
} elseif (strlen($name) < 2) {
    $errors['name'] = 'Name must be at least 2 characters';
}

// Mobile validation
if (empty($mobile)) {
    $errors['mobile'] = 'Mobile number is required';
} elseif (!preg_match('/^[0-9]{10}$/', $mobile)) {
    $errors['mobile'] = 'Please enter a valid 10-digit mobile number';
}

// Username validation
if (empty($username)) {
    $errors['username'] = 'Username is required';
} elseif (strlen($username) < 3) {
    $errors['username'] = 'Username must be at least 3 characters';
} elseif (!preg_match('/^[a-zA-Z0-9_]+$/', $username)) {
    $errors['username'] = 'Username can only contain letters, numbers, and underscore';
}

// Email validation (optional)
if (!empty($email) && !filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $errors['email'] = 'Please enter a valid email address';
}

// Password validation
if (empty($password)) {
    $errors['password'] = 'Password is required';
} elseif (strlen($password) < 6) {
    $errors['password'] = 'Password must be at least 6 characters';
} elseif (!preg_match('/[A-Z]/', $password)) {
    $errors['password'] = 'Password must contain at least one uppercase letter';
} elseif (!preg_match('/[a-z]/', $password)) {
    $errors['password'] = 'Password must contain at least one lowercase letter';
} elseif (!preg_match('/[0-9]/', $password)) {
    $errors['password'] = 'Password must contain at least one number';
}

// Confirm password
if (empty($confirm_password)) {
    $errors['confirm_password'] = 'Please confirm your password';
} elseif ($password !== $confirm_password) {
    $errors['confirm_password'] = 'Passwords do not match';
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

    // Check if username exists
    $stmt = $conn->prepare("SELECT id FROM users WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result->num_rows > 0) {
        $response['message'] = 'Username already exists';
        $response['errors']['username'] = 'Username already taken';
        echo json_encode($response);
        exit;
    }
    $stmt->close();

    // Check if mobile exists
    $stmt = $conn->prepare("SELECT id FROM users WHERE mobile = ?");
    $stmt->bind_param("s", $mobile);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result->num_rows > 0) {
        $response['message'] = 'Mobile number already registered';
        $response['errors']['mobile'] = 'Mobile number already exists';
        echo json_encode($response);
        exit;
    }
    $stmt->close();

    // Check if email exists (if provided)
    if (!empty($email)) {
        $stmt = $conn->prepare("SELECT id FROM users WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result->num_rows > 0) {
            $response['message'] = 'Email already registered';
            $response['errors']['email'] = 'Email already exists';
            echo json_encode($response);
            exit;
        }
        $stmt->close();
    }

    // Hash password
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Insert user
    $stmt = $conn->prepare("INSERT INTO users (name, mobile, username, email, password, role, status) VALUES (?, ?, ?, ?, ?, 'user', 'active')");
    $stmt->bind_param("sssss", $name, $mobile, $username, $email, $hashed_password);

    if ($stmt->execute()) {
        $user_id = $stmt->insert_id;
        $stmt->close();
        $conn->close();

        // Auto-login after registration
        $_SESSION['user_id'] = $user_id;
        $_SESSION['username'] = $username;
        $_SESSION['name'] = $name;

        $response['success'] = true;
        $response['message'] = 'Registration successful! Welcome ' . $name;
        $response['redirectUrl'] = APP_URL . '/index.php';
        $response['user'] = [
            'id' => $user_id,
            'name' => $name,
            'username' => $username,
            'email' => $email,
            'mobile' => $mobile
        ];

        echo json_encode($response);
    } else {
        $response['message'] = 'Registration failed: ' . $stmt->error;
        echo json_encode($response);
    }
} catch (Exception $e) {
    $response['message'] = 'Database error: ' . $e->getMessage();
    echo json_encode($response);
}
