<?php
$current_page = 'settings';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Account Overview - Settings</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>
    <?php include ('templates/navbar.php'); ?>
    <?php include('templates/sidebar.php'); ?>

    <div class="content-area">
        <div class="settings-container bg-white border rounded-4 overflow-hidden">
            <!-- Header -->
            <div class="settings-header p-4 border-bottom d-flex flex-wrap justify-content-between align-items-center">
                <div>
                    <h1 class="fs-4 fw-bold text-dark mb-0">👤 Account Overview</h1>
                    <p class="text-secondary small mb-0">View account status, balance, upgrade options, and visibility settings.</p>
                </div>
                <a href="settings.php" class="btn btn-light border mt-2 mt-sm-0">
                    <i class="fas fa-arrow-left"></i> Back to Settings
                </a>
            </div>

            <!-- Content -->
            <div class="bg-white border rounded-3 p-4 mt-3">
                <div class="row g-3">
                    <div class="col-md-6">
                        <div class="bg-light rounded-3 p-3 d-flex justify-content-between align-items-center">
                            <span class="text-secondary small">Account Status</span>
                            <span class="text-success fw-semibold small">🟢 Active</span>
                        </div>
                        <div class="bg-light rounded-3 p-3 d-flex justify-content-between align-items-center mt-2">
                            <span class="text-secondary small">Plan</span>
                            <span class="text-dark fw-semibold small">Business Pro</span>
                        </div>
                        <div class="bg-light rounded-3 p-3 d-flex justify-content-between align-items-center mt-2">
                            <span class="text-secondary small">Account Balance</span>
                            <span class="text-dark fw-bold">₹12,500.00</span>
                        </div>
                        <div class="bg-light rounded-3 p-3 d-flex justify-content-between align-items-center mt-2">
                            <span class="text-secondary small">Member Since</span>
                            <span class="text-dark fw-semibold small">15 Jan 2024</span>
                        </div>
                        <div class="bg-light rounded-3 p-3 d-flex justify-content-between align-items-center mt-2">
                            <span class="text-secondary small">Account Type</span>
                            <span class="text-dark fw-semibold small">Admin</span>
                        </div>
                        <div class="bg-light rounded-3 p-3 d-flex justify-content-between align-items-center mt-2">
                            <span class="text-secondary small">Last Login</span>
                            <span class="text-dark fw-semibold small">Today, 10:30 AM</span>
                        </div>
                    </div>
                    <div class="col-md-6 d-flex flex-column gap-3 justify-content-center">
                        <button class="btn btn-primary py-3 w-100" onclick="upgradePlan()">
                        Upgrade Plan
                        </button>
                        <button class="btn btn-warning text-white py-3 w-100" onclick="rechargeBalance()">
                             Recharge Balance
                        </button>
                        <button class="btn btn-light border py-3 w-100" onclick="viewHistory()">
                            View History
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="../assets/js/script.js"></script>

    <script>
    // Keep your existing functions
    function upgradePlan() {
        if (typeof upgradePlan === 'function') {
            // Your existing function from script.js
        } else {
            alert('Upgrade Plan clicked!');
        }
    }

    function rechargeBalance() {
        if (typeof rechargeBalance === 'function') {
            // Your existing function from script.js
        } else {
            alert('Recharge Balance clicked!');
        }
    }

    function viewHistory() {
        if (typeof viewHistory === 'function') {
            // Your existing function from script.js
        } else {
            alert('View History clicked!');
        }
    }
    </script>
</body>
</html>