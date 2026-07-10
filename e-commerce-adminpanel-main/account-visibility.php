<?php
$current_page = 'settings';
$success_message = '';
$error_message = '';

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get all form values
    $public_profile = isset($_POST['public_profile']) ? 1 : 0;
    $show_email = isset($_POST['show_email']) ? 1 : 0;
    $show_phone = isset($_POST['show_phone']) ? 1 : 0;
    $activity_status = isset($_POST['activity_status']) ? 1 : 0;
    
    // In real project: UPDATE visibility_settings SET ...
    // For demo, just show success
    $success_message = 'Account visibility settings saved successfully!';
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Account Visibility - Settings</title>
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
                    <h1 style="font-size: 22px; font-weight: 700; color: #1E293B;">👀 Account Visibility</h1>
                    <p style="font-size: 14px; color: #64748B; margin-top: 4px;">Control who can see your account and profile information.</p>
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
            <form method="POST" action="" onsubmit="return saveVisibility();">
                <div style="background: #FFFFFF; border-radius: 12px; border: 1px solid #DBEAFE; padding: 30px; margin-top: 20px;">
                    
                    <!-- Public Profile -->
                    <div class="toggle-group" style="display: flex; align-items: center; gap: 12px; padding: 12px 16px; background: #F8FAFC; border-radius: 10px; margin-bottom: 10px;">
                        <label class="toggle-switch" style="position: relative; width: 48px; height: 26px; flex-shrink: 0; cursor: pointer;">
                            <input type="checkbox" name="public_profile" value="1" checked 
                                   style="opacity: 0; width: 0; height: 0; position: absolute;" 
                                   onchange="toggleVisibility(this, 'public')">
                            <span style="position: absolute; cursor: pointer; top: 0; left: 0; right: 0; bottom: 0; background: #2563EB; border-radius: 34px; transition: 0.3s;">
                                <span style="position: absolute; height: 20px; width: 20px; left: 3px; bottom: 3px; background: #FFFFFF; border-radius: 50%; transition: 0.3s; transform: translateX(22px);"></span>
                            </span>
                        </label>
                        <div>
                            <div style="font-size: 14px; color: #1E293B; font-weight: 500;">Public Profile</div>
                            <div style="font-size: 12px; color: #94A3B8; margin-top: 2px;">Show your profile publicly</div>
                        </div>
                        <span id="publicStatus" style="margin-left: auto; font-size: 12px; color: #10B981; font-weight: 500;">Enabled</span>
                    </div>

                    <!-- Show Email -->
                    <div class="toggle-group" style="display: flex; align-items: center; gap: 12px; padding: 12px 16px; background: #F8FAFC; border-radius: 10px; margin-bottom: 10px;">
                        <label class="toggle-switch" style="position: relative; width: 48px; height: 26px; flex-shrink: 0; cursor: pointer;">
                            <input type="checkbox" name="show_email" value="1" checked 
                                   style="opacity: 0; width: 0; height: 0; position: absolute;" 
                                   onchange="toggleVisibility(this, 'email')">
                            <span style="position: absolute; cursor: pointer; top: 0; left: 0; right: 0; bottom: 0; background: #2563EB; border-radius: 34px; transition: 0.3s;">
                                <span style="position: absolute; height: 20px; width: 20px; left: 3px; bottom: 3px; background: #FFFFFF; border-radius: 50%; transition: 0.3s; transform: translateX(22px);"></span>
                            </span>
                        </label>
                        <div>
                            <div style="font-size: 14px; color: #1E293B; font-weight: 500;">Show Email</div>
                            <div style="font-size: 12px; color: #94A3B8; margin-top: 2px;">Display email in profile</div>
                        </div>
                        <span id="emailStatus" style="margin-left: auto; font-size: 12px; color: #10B981; font-weight: 500;">Enabled</span>
                    </div>

                    <!-- Show Phone -->
                    <div class="toggle-group" style="display: flex; align-items: center; gap: 12px; padding: 12px 16px; background: #F8FAFC; border-radius: 10px; margin-bottom: 10px;">
                        <label class="toggle-switch" style="position: relative; width: 48px; height: 26px; flex-shrink: 0; cursor: pointer;">
                            <input type="checkbox" name="show_phone" value="1" 
                                   style="opacity: 0; width: 0; height: 0; position: absolute;" 
                                   onchange="toggleVisibility(this, 'phone')">
                            <span style="position: absolute; cursor: pointer; top: 0; left: 0; right: 0; bottom: 0; background: #CBD5E1; border-radius: 34px; transition: 0.3s;">
                                <span style="position: absolute; height: 20px; width: 20px; left: 3px; bottom: 3px; background: #FFFFFF; border-radius: 50%; transition: 0.3s;"></span>
                            </span>
                        </label>
                        <div>
                            <div style="font-size: 14px; color: #1E293B; font-weight: 500;">Show Phone</div>
                            <div style="font-size: 12px; color: #94A3B8; margin-top: 2px;">Display phone number</div>
                        </div>
                        <span id="phoneStatus" style="margin-left: auto; font-size: 12px; color: #94A3B8; font-weight: 500;">Disabled</span>
                    </div>

                    <!-- Activity Status -->
                    <div class="toggle-group" style="display: flex; align-items: center; gap: 12px; padding: 12px 16px; background: #F8FAFC; border-radius: 10px; margin-bottom: 10px;">
                        <label class="toggle-switch" style="position: relative; width: 48px; height: 26px; flex-shrink: 0; cursor: pointer;">
                            <input type="checkbox" name="activity_status" value="1" checked 
                                   style="opacity: 0; width: 0; height: 0; position: absolute;" 
                                   onchange="toggleVisibility(this, 'activity')">
                            <span style="position: absolute; cursor: pointer; top: 0; left: 0; right: 0; bottom: 0; background: #2563EB; border-radius: 34px; transition: 0.3s;">
                                <span style="position: absolute; height: 20px; width: 20px; left: 3px; bottom: 3px; background: #FFFFFF; border-radius: 50%; transition: 0.3s; transform: translateX(22px);"></span>
                            </span>
                        </label>
                        <div>
                            <div style="font-size: 14px; color: #1E293B; font-weight: 500;">Activity Status</div>
                            <div style="font-size: 12px; color: #94A3B8; margin-top: 2px;">Show online/offline status</div>
                        </div>
                        <span id="activityStatus" style="margin-left: auto; font-size: 12px; color: #10B981; font-weight: 500;">Enabled</span>
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