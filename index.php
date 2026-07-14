<?php
include 'config/config.php';
?>
<!DOCTYPE html>
<html lang="en">


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