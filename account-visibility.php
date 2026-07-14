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

  < <?php include 'templates/head.php'; ?>

</head>
<body>
    <?php include ('templates/navbar.php'); ?>
    <?php include('templates/sidebar.php'); ?>

    <div class="content-area">
        <div class="settings-container bg-white border rounded-4 overflow-hidden">
            <!-- Header -->
            <div class="settings-header p-4 border-bottom d-flex flex-wrap justify-content-between align-items-center">
                <div>
                    <h1 class="fs-4 fw-bold text-dark mb-0">👀 Account Visibility</h1>
                    <p class="text-secondary small mb-0">Control who can see your account and profile information.</p>
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

            <!-- Content -->
            <form method="POST" action="" onsubmit="return saveVisibility();" class="p-4">
                <div class="bg-white border rounded-3 p-4">
                    
                    <!-- Public Profile -->
                    <div class="bg-light rounded-3 p-3 d-flex align-items-center gap-3 mb-2">
                        <label class="position-relative d-inline-block" style="width:48px; height:26px; flex-shrink:0; cursor:pointer;">
                            <input type="checkbox" name="public_profile" value="1" checked 
                                   class="opacity-0 position-absolute w-100 h-100" 
                                   style="z-index:2; cursor:pointer;" 
                                   onchange="toggleVisibility(this, 'public')">
                            <span class="position-absolute top-0 start-0 end-0 bottom-0 rounded-pill transition" 
                                  style="background:#2563EB; transition:0.3s;">
                                <span class="position-absolute bg-white rounded-circle" 
                                      style="height:20px; width:20px; left:3px; bottom:3px; transition:0.3s; transform:translateX(22px);"></span>
                            </span>
                        </label>
                        <div class="flex-grow-1">
                            <div class="fw-medium text-dark small">Public Profile</div>
                            <div class="text-secondary small">Show your profile publicly</div>
                        </div>
                        <span id="publicStatus" class="text-success fw-medium small">Enabled</span>
                    </div>

                    <!-- Show Email -->
                    <div class="bg-light rounded-3 p-3 d-flex align-items-center gap-3 mb-2">
                        <label class="position-relative d-inline-block" style="width:48px; height:26px; flex-shrink:0; cursor:pointer;">
                            <input type="checkbox" name="show_email" value="1" checked 
                                   class="opacity-0 position-absolute w-100 h-100" 
                                   style="z-index:2; cursor:pointer;" 
                                   onchange="toggleVisibility(this, 'email')">
                            <span class="position-absolute top-0 start-0 end-0 bottom-0 rounded-pill transition" 
                                  style="background:#2563EB; transition:0.3s;">
                                <span class="position-absolute bg-white rounded-circle" 
                                      style="height:20px; width:20px; left:3px; bottom:3px; transition:0.3s; transform:translateX(22px);"></span>
                            </span>
                        </label>
                        <div class="flex-grow-1">
                            <div class="fw-medium text-dark small">Show Email</div>
                            <div class="text-secondary small">Display email in profile</div>
                        </div>
                        <span id="emailStatus" class="text-success fw-medium small">Enabled</span>
                    </div>

                    <!-- Show Phone -->
                    <div class="bg-light rounded-3 p-3 d-flex align-items-center gap-3 mb-2">
                        <label class="position-relative d-inline-block" style="width:48px; height:26px; flex-shrink:0; cursor:pointer;">
                            <input type="checkbox" name="show_phone" value="1" 
                                   class="opacity-0 position-absolute w-100 h-100" 
                                   style="z-index:2; cursor:pointer;" 
                                   onchange="toggleVisibility(this, 'phone')">
                            <span class="position-absolute top-0 start-0 end-0 bottom-0 rounded-pill transition" 
                                  style="background:#CBD5E1; transition:0.3s;">
                                <span class="position-absolute bg-white rounded-circle" 
                                      style="height:20px; width:20px; left:3px; bottom:3px; transition:0.3s;"></span>
                            </span>
                        </label>
                        <div class="flex-grow-1">
                            <div class="fw-medium text-dark small">Show Phone</div>
                            <div class="text-secondary small">Display phone number</div>
                        </div>
                        <span id="phoneStatus" class="text-secondary fw-medium small">Disabled</span>
                    </div>

                    <!-- Activity Status -->
                    <div class="bg-light rounded-3 p-3 d-flex align-items-center gap-3 mb-2">
                        <label class="position-relative d-inline-block" style="width:48px; height:26px; flex-shrink:0; cursor:pointer;">
                            <input type="checkbox" name="activity_status" value="1" checked 
                                   class="opacity-0 position-absolute w-100 h-100" 
                                   style="z-index:2; cursor:pointer;" 
                                   onchange="toggleVisibility(this, 'activity')">
                            <span class="position-absolute top-0 start-0 end-0 bottom-0 rounded-pill transition" 
                                  style="background:#2563EB; transition:0.3s;">
                                <span class="position-absolute bg-white rounded-circle" 
                                      style="height:20px; width:20px; left:3px; bottom:3px; transition:0.3s; transform:translateX(22px);"></span>
                            </span>
                        </label>
                        <div class="flex-grow-1">
                            <div class="fw-medium text-dark small">Activity Status</div>
                            <div class="text-secondary small">Show online/offline status</div>
                        </div>
                        <span id="activityStatus" class="text-success fw-medium small">Enabled</span>
                    </div>

                    <!-- Buttons -->
                    <div class="d-flex gap-3 mt-4">
                        <button type="submit" class="btn btn-primary px-4 py-2">
                            <i class="fas fa-save"></i> Save Changes
                        </button>
                        <a href="settings.php" class="btn btn-light border px-4 py-2">
                            Cancel
                        </a>
                    </div>
                </div>
            </form>
        </div>
    </div>

   <!-- Bootstrap JS Bundle (Latest Stable) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
 <script src="<?= APP_URL; ?>/assets/js/script.js"></script>

    <script>
    // Toggle visibility function
    function toggleVisibility(checkbox, type) {
        const statusMap = {
            'public': 'publicStatus',
            'email': 'emailStatus',
            'phone': 'phoneStatus',
            'activity': 'activityStatus'
        };
        
        const statusElement = document.getElementById(statusMap[type]);
        const toggleSpan = checkbox.parentElement.querySelector('span:first-child');
        const circleSpan = toggleSpan.querySelector('span');
        
        if (checkbox.checked) {
            // Enabled
            toggleSpan.style.background = '#2563EB';
            circleSpan.style.transform = 'translateX(22px)';
            if (statusElement) {
                statusElement.textContent = 'Enabled';
                statusElement.className = 'text-success fw-medium small';
            }
        } else {
            // Disabled
            toggleSpan.style.background = '#CBD5E1';
            circleSpan.style.transform = 'translateX(0)';
            if (statusElement) {
                statusElement.textContent = 'Disabled';
                statusElement.className = 'text-secondary fw-medium small';
            }
        }
    }

    // Save visibility function
    function saveVisibility() {
        // Your existing save logic
        return true; // Allow form submission
    }

    // Initialize toggles on page load
    document.addEventListener('DOMContentLoaded', function() {
        document.querySelectorAll('input[type="checkbox"]').forEach(function(checkbox) {
            if (checkbox.checked) {
                const type = checkbox.name.replace('_', '');
                const statusMap = {
                    'publicprofile': 'publicStatus',
                    'showemail': 'emailStatus',
                    'showphone': 'phoneStatus',
                    'activitystatus': 'activityStatus'
                };
                const statusElement = document.getElementById(statusMap[checkbox.name]);
                const toggleSpan = checkbox.parentElement.querySelector('span:first-child');
                const circleSpan = toggleSpan.querySelector('span');
                
                if (statusElement) {
                    statusElement.textContent = 'Enabled';
                    statusElement.className = 'text-success fw-medium small';
                }
                if (toggleSpan && checkbox.checked) {
                    toggleSpan.style.background = '#2563EB';
                    if (circleSpan) {
                        circleSpan.style.transform = 'translateX(22px)';
                    }
                }
            }
        });
    });
    </script>
</body>
</html>