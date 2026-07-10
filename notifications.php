<?php
$current_page = 'settings';
$success_message = '';
$error_message = '';

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get all form values
    $push_notifications = isset($_POST['push_notifications']) ? 1 : 0;
    $email_notifications = isset($_POST['email_notifications']) ? 1 : 0;
    $order_updates = isset($_POST['order_updates']) ? 1 : 0;
    $promotional_updates = isset($_POST['promotional_updates']) ? 1 : 0;
    
    // In real project: UPDATE notification_settings SET ...
    // For demo, just show success
    $success_message = 'Notification settings saved successfully!';
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Notifications - Settings</title>
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
                    <h1 style="font-size: 22px; font-weight: 700; color: #1E293B;">🔔 Notifications</h1>
                    <p style="font-size: 14px; color: #64748B; margin-top: 4px;">Manage push notifications, email alerts, and subscription preferences.</p>
                </div>
                <a href="settings.php" class="btn btn-secondary" style="padding: 8px 20px; border-radius: 8px; font-weight: 600; background: #F1F5F9; color: #1E293B; text-decoration: none; border: none;">
                    <i class="fas fa-arrow-left"></i> Back to Settings
                </a>
            </div>

            <!-- Success Message -->
            <?php if ($success_message): ?>
                <div class="alert alert-success" style="margin-top: 15px; border-radius: 8px;">
                    <i class="fas fa-check-circle"></i> <?php echo $success_message; ?>
                </div>
                <script>
                    setTimeout(function() {
                        showToast('<?php echo $success_message; ?>', 'success');
                    }, 500);
                </script>
            <?php endif; ?>

            <?php if ($error_message): ?>
                <div class="alert alert-danger" style="margin-top: 15px; border-radius: 8px;">
                    <i class="fas fa-exclamation-circle"></i> <?php echo $error_message; ?>
                </div>
            <?php endif; ?>

            <!-- Content -->
            <form method="POST" action="" onsubmit="return saveNotifications();">
                <div style="background: #FFFFFF; border-radius: 12px; border: 1px solid #DBEAFE; padding: 30px; margin-top: 20px;">
                    
                    <!-- Push Notifications -->
                    <div class="toggle-group" style="display: flex; align-items: center; gap: 12px; padding: 12px 16px; background: #F8FAFC; border-radius: 10px; margin-bottom: 10px;">
                        <label class="toggle-switch" style="position: relative; width: 48px; height: 26px; flex-shrink: 0; cursor: pointer;">
                            <input type="checkbox" name="push_notifications" value="1" checked 
                                   style="opacity: 0; width: 0; height: 0; position: absolute;" 
                                   onchange="toggleNotification(this, 'push')">
                            <span style="position: absolute; cursor: pointer; top: 0; left: 0; right: 0; bottom: 0; background: #2563EB; border-radius: 34px; transition: 0.3s;">
                                <span style="position: absolute; height: 20px; width: 20px; left: 3px; bottom: 3px; background: #FFFFFF; border-radius: 50%; transition: 0.3s; transform: translateX(22px);"></span>
                            </span>
                        </label>
                        <div>
                            <div style="font-size: 14px; color: #1E293B; font-weight: 500;">Push Notifications</div>
                            <div style="font-size: 12px; color: #94A3B8; margin-top: 2px;">Receive notifications on your phone</div>
                        </div>
                        <span id="pushStatus" style="margin-left: auto; font-size: 12px; color: #10B981; font-weight: 500;">Enabled</span>
                    </div>

                    <!-- Email Notifications -->
                    <div class="toggle-group" style="display: flex; align-items: center; gap: 12px; padding: 12px 16px; background: #F8FAFC; border-radius: 10px; margin-bottom: 10px;">
                        <label class="toggle-switch" style="position: relative; width: 48px; height: 26px; flex-shrink: 0; cursor: pointer;">
                            <input type="checkbox" name="email_notifications" value="1" checked 
                                   style="opacity: 0; width: 0; height: 0; position: absolute;" 
                                   onchange="toggleNotification(this, 'email')">
                            <span style="position: absolute; cursor: pointer; top: 0; left: 0; right: 0; bottom: 0; background: #2563EB; border-radius: 34px; transition: 0.3s;">
                                <span style="position: absolute; height: 20px; width: 20px; left: 3px; bottom: 3px; background: #FFFFFF; border-radius: 50%; transition: 0.3s; transform: translateX(22px);"></span>
                            </span>
                        </label>
                        <div>
                            <div style="font-size: 14px; color: #1E293B; font-weight: 500;">Email Notifications</div>
                            <div style="font-size: 12px; color: #94A3B8; margin-top: 2px;">Receive notifications on your email</div>
                        </div>
                        <span id="emailStatus" style="margin-left: auto; font-size: 12px; color: #10B981; font-weight: 500;">Enabled</span>
                    </div>

                    <!-- Order Updates -->
                    <div class="toggle-group" style="display: flex; align-items: center; gap: 12px; padding: 12px 16px; background: #F8FAFC; border-radius: 10px; margin-bottom: 10px;">
                        <label class="toggle-switch" style="position: relative; width: 48px; height: 26px; flex-shrink: 0; cursor: pointer;">
                            <input type="checkbox" name="order_updates" value="1" 
                                   style="opacity: 0; width: 0; height: 0; position: absolute;" 
                                   onchange="toggleNotification(this, 'order')">
                            <span style="position: absolute; cursor: pointer; top: 0; left: 0; right: 0; bottom: 0; background: #CBD5E1; border-radius: 34px; transition: 0.3s;">
                                <span style="position: absolute; height: 20px; width: 20px; left: 3px; bottom: 3px; background: #FFFFFF; border-radius: 50%; transition: 0.3s;"></span>
                            </span>
                        </label>
                        <div>
                            <div style="font-size: 14px; color: #1E293B; font-weight: 500;">Order Updates</div>
                            <div style="font-size: 12px; color: #94A3B8; margin-top: 2px;">Receive order status updates</div>
                        </div>
                        <span id="orderStatus" style="margin-left: auto; font-size: 12px; color: #94A3B8; font-weight: 500;">Disabled</span>
                    </div>

                    <!-- Promotional Updates -->
                    <div class="toggle-group" style="display: flex; align-items: center; gap: 12px; padding: 12px 16px; background: #F8FAFC; border-radius: 10px; margin-bottom: 10px;">
                        <label class="toggle-switch" style="position: relative; width: 48px; height: 26px; flex-shrink: 0; cursor: pointer;">
                            <input type="checkbox" name="promotional_updates" value="1" checked 
                                   style="opacity: 0; width: 0; height: 0; position: absolute;" 
                                   onchange="toggleNotification(this, 'promo')">
                            <span style="position: absolute; cursor: pointer; top: 0; left: 0; right: 0; bottom: 0; background: #2563EB; border-radius: 34px; transition: 0.3s;">
                                <span style="position: absolute; height: 20px; width: 20px; left: 3px; bottom: 3px; background: #FFFFFF; border-radius: 50%; transition: 0.3s; transform: translateX(22px);"></span>
                            </span>
                        </label>
                        <div>
                            <div style="font-size: 14px; color: #1E293B; font-weight: 500;">Promotional Updates</div>
                            <div style="font-size: 12px; color: #94A3B8; margin-top: 2px;">Receive promotional emails and offers</div>
                        </div>
                        <span id="promoStatus" style="margin-left: auto; font-size: 12px; color: #10B981; font-weight: 500;">Enabled</span>
                    </div>

                    <!-- Buttons -->
                    <div class="d-flex gap-3 mt-4">
                        <button type="submit" class="btn btn-primary" style="padding: 10px 30px; border-radius: 8px; font-weight: 600; background: #2563EB; color: #FFFFFF; border: none;">
                            <i class="fas fa-save"></i> Save Changes
                        </button>
                        <a href="settings.php" class="btn btn-secondary" style="padding: 10px 30px; border-radius: 8px; font-weight: 600; background: #F1F5F9; color: #1E293B; text-decoration: none; border: none;">
                            Cancel
                        </a>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="../assets/js/script.js"></script>
</body>
</html>