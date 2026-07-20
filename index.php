<?php
// Include config
require_once 'config/config.php';

// Check if user is logged in
if (!isLoggedIn()) {
    // If not logged in, redirect to login page
    redirect('auth/login');
    exit;
}

// If logged in, show dashboard
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php include 'templates/head.php'; ?>
</head>

<body>
    <?php include 'templates/navbar.php'; ?>
    <?php include 'templates/sidebar.php'; ?>
    <?php include 'templates/dashboard.php'; ?>
    <!-- Include Logout Modal -->
    <?php include 'logout-modal.php'; ?>

    <!-- Bootstrap JS -->
    <!-- Bootstrap JS Bundle (Latest Stable) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Common JS -->
    <script src="<?= APP_URL; ?>/assets/js/script.js"></script>
</body>

</html>