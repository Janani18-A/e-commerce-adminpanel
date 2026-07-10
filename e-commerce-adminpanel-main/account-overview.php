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
        <div class="settings-container">
            <!-- Header -->
            <div class="settings-header" style="display: flex; justify-content: space-between; align-items: center;">
                <div>
                    <h1 style="font-size: 22px; font-weight: 700; color: #1E293B;">👤 Account Overview</h1>
                    <p style="font-size: 14px; color: #64748B; margin-top: 4px;">View account status, balance, upgrade options, and visibility settings.</p>
                </div>
                <a href="settings.php" class="btn btn-secondary" style="padding: 8px 20px; border-radius: 8px; font-weight: 600; background: #F1F5F9; color: #1E293B; text-decoration: none; border: none;">
                    <i class="fas fa-arrow-left"></i> Back to Settings
                </a>
            </div>

            <!-- Content -->
            <div style="background: #FFFFFF; border-radius: 12px; border: 1px solid #DBEAFE; padding: 30px; margin-top: 20px;">
                <div class="row">
                    <div class="col-md-6">
                        <div style="padding: 15px; background: #F8FAFC; border-radius: 10px; margin-bottom: 12px; display: flex; justify-content: space-between; align-items: center;">
                            <span style="color: #64748B; font-size: 14px;">Account Status</span>
                            <span style="color: #10B981; font-weight: 600; font-size: 14px;">🟢 Active</span>
                        </div>
                        <div style="padding: 15px; background: #F8FAFC; border-radius: 10px; margin-bottom: 12px; display: flex; justify-content: space-between; align-items: center;">
                            <span style="color: #64748B; font-size: 14px;">Plan</span>
                            <span style="color: #1E293B; font-weight: 600; font-size: 14px;">Business Pro</span>
                        </div>
                        <div style="padding: 15px; background: #F8FAFC; border-radius: 10px; margin-bottom: 12px; display: flex; justify-content: space-between; align-items: center;">
                            <span style="color: #64748B; font-size: 14px;">Account Balance</span>
                            <span style="color: #1E293B; font-weight: 700; font-size: 16px;">₹12,500.00</span>
                        </div>
                        <div style="padding: 15px; background: #F8FAFC; border-radius: 10px; margin-bottom: 12px; display: flex; justify-content: space-between; align-items: center;">
                            <span style="color: #64748B; font-size: 14px;">Member Since</span>
                            <span style="color: #1E293B; font-weight: 600; font-size: 14px;">15 Jan 2024</span>
                        </div>
                        <div style="padding: 15px; background: #F8FAFC; border-radius: 10px; margin-bottom: 12px; display: flex; justify-content: space-between; align-items: center;">
                            <span style="color: #64748B; font-size: 14px;">Account Type</span>
                            <span style="color: #1E293B; font-weight: 600; font-size: 14px;">Admin</span>
                        </div>
                        <div style="padding: 15px; background: #F8FAFC; border-radius: 10px; margin-bottom: 12px; display: flex; justify-content: space-between; align-items: center;">
                            <span style="color: #64748B; font-size: 14px;">Last Login</span>
                            <span style="color: #1E293B; font-weight: 600; font-size: 14px;">Today, 10:30 AM</span>
                        </div>
                    </div>
                    <div class="col-md-6" style="display: flex; flex-direction: column; gap: 12px; justify-content: center;">
                        <button class="btn btn-primary" onclick="upgradePlan()" style="padding: 12px; border-radius: 8px; font-weight: 600; background: #2563EB; color: #FFFFFF; border: none; width: 100%;">
                            🚀 Upgrade Plan
                        </button>
                        <button class="btn btn-warning" onclick="rechargeBalance()" style="padding: 12px; border-radius: 8px; font-weight: 600; background: #F59E0B; color: #FFFFFF; border: none; width: 100%;">
                            💰 Recharge Balance
                        </button>
                        <button class="btn btn-secondary" onclick="viewHistory()" style="padding: 12px; border-radius: 8px; font-weight: 600; background: #F1F5F9; color: #1E293B; border: none; width: 100%;">
                            📄 View History
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="../assets/js/script.js"></script>
</body>
</html>