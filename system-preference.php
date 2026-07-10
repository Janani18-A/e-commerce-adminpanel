<?php
$current_page = 'settings';
$success_message = '';
$error_message = '';

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get all form values
    $language = $_POST['language'] ?? '';
    $currency = $_POST['currency'] ?? '';
    $timezone = $_POST['timezone'] ?? '';
    $date_format = $_POST['date_format'] ?? '';
    $time_format = $_POST['time_format'] ?? '';
    $region = $_POST['region'] ?? '';

    // In real project: UPDATE settings SET ...
    // For demo, just show success
    $success_message = 'System preferences saved successfully!';
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>System Preference - Settings</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../assets/css/style.css">
</head>

<body>
    <?php include('templates/navbar.php'); ?>
    <?php include('templates/sidebar.php'); ?>

    <div class="content-area">
        <div class="settings-container">
            <!-- Header -->
            <div class="settings-header" style="display: flex; justify-content: space-between; align-items: center;">
                <div>
                    <h1 style="font-size: 22px; font-weight: 700; color: #1E293B;">🌐 System Preference</h1>
                    <p style="font-size: 14px; color: #64748B; margin-top: 4px;">Manage your store's language, currency, timezone, and regional preferences.</p>
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
                    // Show toast notification too
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

            <!-- Form Content -->
            <div style="background: #FFFFFF; border-radius: 12px; border: 1px solid #DBEAFE; padding: 30px; margin-top: 20px;">
                <form method="POST" action="" onsubmit="return saveSystemPreferences();">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-bold">Language</label>
                            <select class="form-control" name="language">
                                <option value="English (US)">English (US)</option>
                                <option value="Hindi">Hindi</option>
                                <option value="Tamil">Tamil</option>
                                <option value="Telugu">Telugu</option>
                            </select>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-bold">Currency</label>
                            <select class="form-control" name="currency">
                                <option value="Indian Rupee (₹)">Indian Rupee (₹)</option>
                                <option value="US Dollar ($)">US Dollar ($)</option>
                                <option value="Euro (€)">Euro (€)</option>
                                <option value="British Pound (£)">British Pound (£)</option>
                            </select>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-bold">Timezone</label>
                            <select class="form-control" name="timezone">
                                <option value="Asia/Kolkata (UTC +5:30)">Asia/Kolkata (UTC +5:30)</option>
                                <option value="Asia/Dubai (UTC +4:00)">Asia/Dubai (UTC +4:00)</option>
                                <option value="America/New_York (UTC -5:00)">America/New_York (UTC -5:00)</option>
                            </select>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-bold">Date Format</label>
                            <select class="form-control" name="date_format">
                                <option value="DD/MM/YYYY">DD/MM/YYYY</option>
                                <option value="MM/DD/YYYY">MM/DD/YYYY</option>
                                <option value="YYYY-MM-DD">YYYY-MM-DD</option>
                            </select>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-bold">Time Format</label>
                            <select class="form-control" name="time_format">
                                <option value="12 Hours (AM/PM)">12 Hours (AM/PM)</option>
                                <option value="24 Hours">24 Hours</option>
                            </select>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-bold">Region</label>
                            <select class="form-control" name="region">
                                <option value="India">India</option>
                                <option value="USA">USA</option>
                                <option value="UK">UK</option>
                                <option value="UAE">UAE</option>
                            </select>
                        </div>
                    </div>
                    <div class="d-flex gap-3 mt-3">
                        <button type="submit" class="btn btn-primary" style="padding: 10px 30px; border-radius: 8px; font-weight: 600; background: #2563EB; color: #FFFFFF; border: none;">
                            <i class="fas fa-save"></i> Save Changes
                        </button>
                        <a href="settings.php" class="btn btn-secondary" style="padding: 10px 30px; border-radius: 8px; font-weight: 600; background: #F1F5F9; color: #1E293B; text-decoration: none; border: none;">
                            Cancel
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="../assets/js/script.js"></script>
</body>

</html>