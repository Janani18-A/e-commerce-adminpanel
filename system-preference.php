<?php
include 'config/config.php';
?>


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
     <?php include 'head.php'; ?>
</head>

<body>
    <?php include('templates/navbar.php'); ?>
    <?php include('templates/sidebar.php'); ?>

    <div class="content-area">
        <div class="settings-container bg-white border rounded-4 overflow-hidden">
            <!-- Header -->
            <div class="settings-header p-4 border-bottom d-flex flex-wrap justify-content-between align-items-center">
                <div>
                    <h1 class="fs-4 fw-bold text-dark mb-0">🌐 System Preference</h1>
                    <p class="text-secondary small mb-0">Manage your store's language, currency, timezone, and regional preferences.</p>
                </div>
                <a href="settings.php" class="btn btn-light border mt-2 mt-sm-0">
                    <i class="fas fa-arrow-left"></i> Back to Settings
                </a>
            </div>

            <!-- Success Message -->
            <?php if ($success_message): ?>
                <div class="alert alert-success m-3 rounded-3">
                    <i class="fas fa-check-circle"></i> <?php echo $success_message; ?>
                </div>
                <script>
                    // Show toast notification too
                    setTimeout(function() {
                        if (typeof showToast === 'function') {
                            showToast('<?php echo $success_message; ?>', 'success');
                        }
                    }, 500);
                </script>
            <?php endif; ?>

            <?php if ($error_message): ?>
                <div class="alert alert-danger m-3 rounded-3">
                    <i class="fas fa-exclamation-circle"></i> <?php echo $error_message; ?>
                </div>
            <?php endif; ?>

            <!-- Form Content -->
            <div class="bg-white border rounded-3 p-4 m-3">
                <form method="POST" action="" onsubmit="return saveSystemPreferences();">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label fw-semibold small">Language</label>
                            <select class="form-select" name="language">
                                <option value="English (US)">English (US)</option>
                                <option value="Hindi">Hindi</option>
                                <option value="Tamil">Tamil</option>
                                <option value="Telugu">Telugu</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold small">Currency</label>
                            <select class="form-select" name="currency">
                                <option value="Indian Rupee (₹)">Indian Rupee (₹)</option>
                                <option value="US Dollar ($)">US Dollar ($)</option>
                                <option value="Euro (€)">Euro (€)</option>
                                <option value="British Pound (£)">British Pound (£)</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold small">Timezone</label>
                            <select class="form-select" name="timezone">
                                <option value="Asia/Kolkata (UTC +5:30)">Asia/Kolkata (UTC +5:30)</option>
                                <option value="Asia/Dubai (UTC +4:00)">Asia/Dubai (UTC +4:00)</option>
                                <option value="America/New_York (UTC -5:00)">America/New_York (UTC -5:00)</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold small">Date Format</label>
                            <select class="form-select" name="date_format">
                                <option value="DD/MM/YYYY">DD/MM/YYYY</option>
                                <option value="MM/DD/YYYY">MM/DD/YYYY</option>
                                <option value="YYYY-MM-DD">YYYY-MM-DD</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold small">Time Format</label>
                            <select class="form-select" name="time_format">
                                <option value="12 Hours (AM/PM)">12 Hours (AM/PM)</option>
                                <option value="24 Hours">24 Hours</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold small">Region</label>
                            <select class="form-select" name="region">
                                <option value="India">India</option>
                                <option value="USA">USA</option>
                                <option value="UK">UK</option>
                                <option value="UAE">UAE</option>
                            </select>
                        </div>
                    </div>
                    <div class="d-flex gap-3 mt-4">
                        <button type="submit" class="btn btn-primary px-4 py-2">
                            <i class="fas fa-save"></i> Save Changes
                        </button>
                        <a href="settings.php" class="btn btn-light border px-4 py-2">
                            Cancel
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>

   <!-- Bootstrap JS Bundle (Latest Stable) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
 <script src="<?= APP_URL; ?>/assets/js/script.js"></script>

    <script>
    function saveSystemPreferences() {
        // Get all form values
        const language = document.querySelector('select[name="language"]')?.value;
        const currency = document.querySelector('select[name="currency"]')?.value;
        const timezone = document.querySelector('select[name="timezone"]')?.value;
        const dateFormat = document.querySelector('select[name="date_format"]')?.value;
        const timeFormat = document.querySelector('select[name="time_format"]')?.value;
        const region = document.querySelector('select[name="region"]')?.value;

        // Validate
        if (!language) {
            if (typeof showToast === 'function') {
                showToast('Please select a language', 'warning');
            } else {
                alert('Please select a language');
            }
            return false;
        }

        // Show success toast
        if (typeof showToast === 'function') {
            showToast('✅ System preferences saved successfully!', 'success');
        }

        // Return true to allow form submission
        return true;
    }
    </script>
</body>

</html>