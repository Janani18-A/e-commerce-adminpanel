<?php
include 'config/config.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

    <!-- Load SVG Icons -->
    <link rel="stylesheet" href="<?= APP_URL; ?>/assets/icons/icons.svg">

    <!-- Common Styles -->
    <link rel="stylesheet" href="<?= APP_URL; ?>/assets/css/style.css">


</head>

<body>
    <?php include 'templates/navbar.php'; ?>
     <?php include 'templates/sidebar.php'; ?>
    <?php include 'dashboard.php'; ?>
    <!-- Include Logout Modal -->
    <?php include 'logout-modal.php'; ?>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Common JS -->
    <script src="<?= APP_URL; ?>/assets/js/script.js"></script>

</body>

</html>