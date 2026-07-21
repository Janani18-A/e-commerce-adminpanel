<?php
// Fix: Go up one level to root, then into config folder
require_once __DIR__ . '/../config/config.php';

// Redirect if already logged in
if (isset($_SESSION['user_id'])) {
    header('Location: ' . APP_URL . '/index.php');
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Admin Panel</title>

    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <!-- Toastr CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">

    <style>
        body {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        .login-card {
            background: white;
            border-radius: 20px;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3);
            padding: 40px;
            width: 100%;
            max-width: 420px;
            animation: slideUp 0.6s ease-out;
        }

        @keyframes slideUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .login-header {
            text-align: center;
            margin-bottom: 30px;
        }

        .login-header .icon {
            width: 80px;
            height: 80px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border-radius: 50%;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 15px;
        }

        .login-header .icon i {
            font-size: 40px;
            color: white;
        }

        .login-header h3 {
            color: #333;
            font-weight: 700;
            margin-bottom: 5px;
        }

        .login-header p {
            color: #888;
            font-size: 14px;
            margin: 0;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            font-weight: 600;
            color: #555;
            font-size: 14px;
            margin-bottom: 5px;
        }

        .input-group-text {
            background: #f8f9fa;
            border-right: none;
        }

        .form-control {
            border-left: none;
            padding: 12px 15px;
        }

        .form-control:focus {
            box-shadow: none;
            border-color: #667eea;
        }

        .form-control.is-invalid {
            border-color: #dc3545;
        }

        .form-control.is-valid {
            border-color: #28a745;
        }

        .btn-login {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border: none;
            padding: 12px;
            font-weight: 600;
            font-size: 16px;
            border-radius: 10px;
            transition: all 0.3s ease;
            width: 100%;
            color: white;
        }

        .btn-login:hover:not(:disabled) {
            transform: translateY(-2px);
            box-shadow: 0 10px 30px rgba(102, 126, 234, 0.4);
            color: white;
        }

        .btn-login:disabled {
            opacity: 0.7;
            cursor: not-allowed;
        }

        .login-footer {
            text-align: center;
            margin-top: 20px;
            color: #888;
            font-size: 13px;
        }

        .login-footer a {
            color: #667eea;
            text-decoration: none;
            font-weight: 600;
        }

        .login-footer a:hover {
            text-decoration: underline;
        }

        .demo-credentials {
            background: #f8f9fa;
            border-radius: 10px;
            padding: 15px;
            margin-top: 20px;
            font-size: 13px;
        }

        .demo-credentials strong {
            color: #333;
        }

        .form-check-label {
            font-size: 14px;
            color: #666;
        }

        .password-toggle {
            cursor: pointer;
            position: absolute;
            right: 15px;
            top: 50%;
            transform: translateY(-50%);
            color: #888;
            z-index: 10;
            background: transparent;
            border: none;
        }

        .password-toggle:hover {
            color: #333;
        }

        .input-group.position-relative .form-control {
            padding-right: 45px;
        }

        .invalid-feedback {
            font-size: 12px;
        }

        @media (max-width: 480px) {
            .login-card {
                padding: 30px 20px;
                margin: 15px;
            }
        }
    </style>
</head>

<body>
    <div class="login-card">
        <!-- Header -->
        <div class="login-header">
            <div class="icon">
                <i class="fas fa-store"></i>
            </div>
            <h3>Admin Panel</h3>
            <p>Sign in to access the dashboard</p>
        </div>

        <!-- Login Form -->
        <form id="loginForm" novalidate>
            <div class="form-group">
                <label for="username">Username</label>
                <div class="input-group">
                    <span class="input-group-text">
                        <i class="fas fa-user"></i>
                    </span>
                    <input type="text" class="form-control" id="username" name="username"
                        placeholder="Enter username" required autofocus>
                </div>
                <div class="invalid-feedback"></div>
            </div>

            <div class="form-group">
                <label for="password">Password</label>
                <div class="input-group position-relative">
                    <span class="input-group-text">
                        <i class="fas fa-lock"></i>
                    </span>
                    <input type="password" class="form-control" id="password" name="password"
                        placeholder="Enter password" required>
                    <button type="button" class="password-toggle" id="togglePassword">
                        <i class="fas fa-eye"></i>
                    </button>
                </div>
                <div class="invalid-feedback"></div>
            </div>

            <div class="form-group d-flex justify-content-between align-items-center">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" id="remember" name="remember">
                    <label class="form-check-label" for="remember">
                        Remember me
                    </label>
                </div>
                <a href="#" style="font-size: 14px; color: #667eea; text-decoration: none;">
                    Forgot password?
                </a>
            </div>

            <button type="submit" class="btn btn-login" id="loginBtn">
                <i class="fas fa-sign-in-alt me-2"></i>Sign In
            </button>
        </form>

        <!-- Demo Credentials -->
        <div class="demo-credentials">
            <p class="mb-0 text-center">
                <i class="fas fa-info-circle me-1" style="color: #667eea;"></i>
                <strong>Demo Credentials:</strong><br>
                <span class="badge bg-light text-dark me-1">Username: qwe</span>
                <span class="badge bg-light text-dark">Password: Test@123</span>
            </p>
        </div>

        <div class="login-footer">
            Don't have an account? <a href="<?php echo APP_URL; ?>/auth/register">Register Here</a>
        </div>
    </div>

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

    <!-- Bootstrap 5 JS Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Toastr JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

    <!-- Pass APP_URL to JavaScript -->
    <script>
        var APP_URL = "<?php echo APP_URL; ?>";
    </script>

    <!-- Custom Login JS -->
    <script src="<?php echo APP_URL; ?>/assets/js/login.js"></script>
</body>

</html>