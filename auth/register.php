<?php
require_once __DIR__ . '/../config/config.php';

// Redirect if already logged in
if (isLoggedIn()) {
    redirect('index.php');
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - Admin Panel</title>

    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Font Awesome -->
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
            padding: 20px;
        }

        .register-card {
            background: white;
            border-radius: 20px;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3);
            padding: 40px;
            width: 100%;
            max-width: 500px;
            animation: slideUp 0.6s ease-out;
            position: relative;
            overflow: hidden;
        }

        .register-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: linear-gradient(90deg, #667eea, #764ba2);
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

        .register-header {
            text-align: center;
            margin-bottom: 30px;
        }

        .register-header .icon {
            width: 80px;
            height: 80px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border-radius: 50%;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 15px;
        }

        .register-header .icon i {
            font-size: 40px;
            color: white;
        }

        .register-header h3 {
            color: #333;
            font-weight: 700;
            margin-bottom: 5px;
        }

        .register-header p {
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

        .form-group label .required {
            color: #dc3545;
            margin-left: 3px;
        }

        .input-group-text {
            background: #f8f9fa;
            border-right: none;
            min-width: 42px;
            justify-content: center;
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

        .input-group.position-relative .form-control {
            padding-right: 45px;
        }

        .password-toggle {
            cursor: pointer;
            position: absolute;
            right: 12px;
            top: 50%;
            transform: translateY(-50%);
            color: #888;
            z-index: 10;
            background: transparent;
            border: none;
            padding: 5px;
        }

        .password-toggle:hover {
            color: #333;
        }

        .btn-register {
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

        .btn-register:hover:not(:disabled) {
            transform: translateY(-2px);
            box-shadow: 0 10px 30px rgba(102, 126, 234, 0.4);
            color: white;
        }

        .btn-register:disabled {
            opacity: 0.7;
            cursor: not-allowed;
        }

        .password-strength {
            height: 4px;
            border-radius: 4px;
            margin-top: 8px;
            background: #e9ecef;
            overflow: hidden;
        }

        .password-strength-bar {
            height: 100%;
            border-radius: 4px;
            transition: all 0.3s ease;
            width: 0%;
        }

        .password-requirements {
            font-size: 12px;
            color: #666;
            margin-top: 5px;
            padding-left: 0;
            list-style: none;
        }

        .password-requirements li {
            padding: 2px 0;
        }

        .password-requirements li i {
            margin-right: 5px;
            font-size: 10px;
        }

        .password-requirements .valid {
            color: #28a745;
        }

        .password-requirements .invalid {
            color: #dc3545;
        }

        .register-footer {
            text-align: center;
            margin-top: 20px;
            color: #888;
            font-size: 14px;
        }

        .register-footer a {
            color: #667eea;
            text-decoration: none;
            font-weight: 600;
        }

        .register-footer a:hover {
            text-decoration: underline;
        }

        .strength-weak {
            background: #dc3545;
            width: 25%;
        }

        .strength-medium {
            background: #ffc107;
            width: 50%;
        }

        .strength-good {
            background: #17a2b8;
            width: 75%;
        }

        .strength-strong {
            background: #28a745;
            width: 100%;
        }

        .invalid-feedback {
            font-size: 12px;
            margin-top: 5px;
        }

        @media (max-width: 480px) {
            .register-card {
                padding: 30px 20px;
                margin: 15px;
            }
        }
    </style>
</head>

<body>
    <div class="register-card">
        <!-- Header -->
        <div class="register-header">
            <div class="icon">
                <i class="fas fa-user-plus"></i>
            </div>
            <h3>Create Account</h3>
            <p>Register to access the admin panel</p>
        </div>

        <!-- Registration Form -->
        <form id="registerForm" novalidate>
            <!-- Full Name -->
            <div class="form-group">
                <label for="name">
                    Full Name <span class="required">*</span>
                </label>
                <div class="input-group">
                    <span class="input-group-text">
                        <i class="fas fa-user"></i>
                    </span>
                    <input type="text" class="form-control" id="name" name="name"
                        placeholder="Enter your full name" required autofocus>
                </div>
                <div class="invalid-feedback"></div>
            </div>

            <!-- Mobile Number -->
            <div class="form-group">
                <label for="mobile">
                    Mobile Number <span class="required">*</span>
                </label>
                <div class="input-group">
                    <span class="input-group-text">
                        <i class="fas fa-phone"></i>
                    </span>
                    <input type="tel" class="form-control" id="mobile" name="mobile"
                        placeholder="Enter 10-digit mobile number" maxlength="10" required>
                </div>
                <div class="invalid-feedback"></div>
            </div>

            <!-- Username -->
            <div class="form-group">
                <label for="username">
                    Username <span >*</span>
                </label>
                <div class="input-group">
                    <span class="input-group-text">
                        <i class="fas fa-user-tag"></i>
                    </span>
                    <input type="text" class="form-control" id="username" name="username"
                        placeholder="Choose a unique username" required>
                </div>
                <div class="invalid-feedback"></div>
                <small class="text-muted">Only letters, numbers, and underscore allowed</small>
            </div>

            <!-- Email (Optional) -->
            <div class="form-group">
                <label for="email">Email Address</label>
                <div class="input-group">
                    <span class="input-group-text">
                        <i class="fas fa-envelope"></i>
                    </span>
                    <input type="email" class="form-control" id="email" name="email"
                        placeholder="Enter email address (optional)">
                </div>
                <div class="invalid-feedback"></div>
            </div>

            <!-- Password -->
            <div class="form-group">
                <label for="password">
                    Password <span class="required">*</span>
                </label>
                <div class="input-group position-relative">
                    <span class="input-group-text">
                        <i class="fas fa-lock"></i>
                    </span>
                    <input type="password" class="form-control" id="password" name="password"
                        placeholder="Create a strong password" required>
                    <button type="button" class="password-toggle">
                        <i class="fas fa-eye"></i>
                    </button>
                </div>

                <!-- Password Strength -->
                <div class="password-strength">
                    <div class="password-strength-bar" id="passwordStrength"></div>
                </div>

                <!-- Password Requirements -->
                <ul class="password-requirements" id="passwordRequirements">
                    <li id="req-length" class="invalid">
                        <i class="fas fa-circle"></i> At least 6 characters
                    </li>
                    <li id="req-uppercase" class="invalid">
                        <i class="fas fa-circle"></i> At least one uppercase letter
                    </li>
                    <li id="req-lowercase" class="invalid">
                        <i class="fas fa-circle"></i> At least one lowercase letter
                    </li>
                    <li id="req-number" class="invalid">
                        <i class="fas fa-circle"></i> At least one number
                    </li>
                </ul>
            </div>

            <!-- Confirm Password -->
            <div class="form-group">
                <label for="confirm_password">
                    Confirm Password <span class="required">*</span>
                </label>
                <div class="input-group position-relative">
                    <span class="input-group-text">
                        <i class="fas fa-check-circle"></i>
                    </span>
                    <input type="password" class="form-control" id="confirm_password"
                        name="confirm_password" placeholder="Confirm your password" required>
                    <button type="button" class="password-toggle">
                        <i class="fas fa-eye"></i>
                    </button>
                </div>
                <div class="invalid-feedback"></div>
            </div>

            <!-- Terms -->
            <div class="form-group">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" id="terms" name="terms" required>
                    <label class="form-check-label" for="terms">
                        I agree to the <a href="#" target="_blank">Terms of Service</a>
                    </label>
                </div>
            </div>

            <button type="button" class="btn btn-register register">
                <i class="fas fa-user-plus me-2"></i>Create Account
            </button>
        </form>

        <!-- Login Link -->
        <div class="register-footer">
            Already have an account? <a href="<?php echo APP_URL; ?>/auth/login">Sign In</a>
        </div>
    </div>

    <!-- ============================================ -->
    <!-- IMPORTANT: Load jQuery FIRST -->
    <!-- ============================================ -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Toastr JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

    <!-- Custom JS - Load THIS LAST -->
    <script src="<?php echo APP_URL; ?>/assets/js/register.js"></script>
</body>

</html>