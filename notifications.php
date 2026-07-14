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

 <?php include 'templates/head.php'; ?>
</head>
<body>
    <?php include ('templates/navbar.php'); ?>
    <?php include('templates/sidebar.php'); ?>

    <div class="content-area">
        <div class="settings-container bg-white border rounded-4 overflow-hidden">
            <!-- Header -->
            <div class="settings-header p-4 border-bottom d-flex flex-wrap justify-content-between align-items-center">
                <div>
                    <h1 class="fs-4 fw-bold text-dark mb-0">🔔 Notifications</h1>
                    <p class="text-secondary small mb-0">Manage push notifications, email alerts, and subscription preferences.</p>
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
            <form method="POST" action="" onsubmit="return saveNotifications();" class="p-3">
                <div class="bg-white border rounded-3 p-4">
                    
                    <!-- Push Notifications -->
                    <div class="bg-light rounded-3 p-3 d-flex align-items-center gap-3 mb-2">
                        <label class="position-relative d-inline-block" style="width:48px; height:26px; flex-shrink:0; cursor:pointer;">
                            <input type="checkbox" name="push_notifications" value="1" checked 
                                   class="opacity-0 position-absolute w-100 h-100" 
                                   style="z-index:2; cursor:pointer;" 
                                   onchange="toggleNotification(this, 'push')">
                            <span class="position-absolute top-0 start-0 end-0 bottom-0 rounded-pill transition" 
                                  style="background:#2563EB; transition:0.3s;">
                                <span class="position-absolute bg-white rounded-circle" 
                                      style="height:20px; width:20px; left:3px; bottom:3px; transition:0.3s; transform:translateX(22px);"></span>
                            </span>
                        </label>
                        <div class="flex-grow-1">
                            <div class="fw-medium text-dark small">Push Notifications</div>
                            <div class="text-secondary small">Receive notifications on your phone</div>
                        </div>
                        <span id="pushStatus" class="text-success fw-medium small">Enabled</span>
                    </div>

                    <!-- Email Notifications -->
                    <div class="bg-light rounded-3 p-3 d-flex align-items-center gap-3 mb-2">
                        <label class="position-relative d-inline-block" style="width:48px; height:26px; flex-shrink:0; cursor:pointer;">
                            <input type="checkbox" name="email_notifications" value="1" checked 
                                   class="opacity-0 position-absolute w-100 h-100" 
                                   style="z-index:2; cursor:pointer;" 
                                   onchange="toggleNotification(this, 'email')">
                            <span class="position-absolute top-0 start-0 end-0 bottom-0 rounded-pill transition" 
                                  style="background:#2563EB; transition:0.3s;">
                                <span class="position-absolute bg-white rounded-circle" 
                                      style="height:20px; width:20px; left:3px; bottom:3px; transition:0.3s; transform:translateX(22px);"></span>
                            </span>
                        </label>
                        <div class="flex-grow-1">
                            <div class="fw-medium text-dark small">Email Notifications</div>
                            <div class="text-secondary small">Receive notifications on your email</div>
                        </div>
                        <span id="emailStatus" class="text-success fw-medium small">Enabled</span>
                    </div>

                    <!-- Order Updates -->
                    <div class="bg-light rounded-3 p-3 d-flex align-items-center gap-3 mb-2">
                        <label class="position-relative d-inline-block" style="width:48px; height:26px; flex-shrink:0; cursor:pointer;">
                            <input type="checkbox" name="order_updates" value="1" 
                                   class="opacity-0 position-absolute w-100 h-100" 
                                   style="z-index:2; cursor:pointer;" 
                                   onchange="toggleNotification(this, 'order')">
                            <span class="position-absolute top-0 start-0 end-0 bottom-0 rounded-pill transition" 
                                  style="background:#CBD5E1; transition:0.3s;">
                                <span class="position-absolute bg-white rounded-circle" 
                                      style="height:20px; width:20px; left:3px; bottom:3px; transition:0.3s;"></span>
                            </span>
                        </label>
                        <div class="flex-grow-1">
                            <div class="fw-medium text-dark small">Order Updates</div>
                            <div class="text-secondary small">Receive order status updates</div>
                        </div>
                        <span id="orderStatus" class="text-secondary fw-medium small">Disabled</span>
                    </div>

                    <!-- Promotional Updates -->
                    <div class="bg-light rounded-3 p-3 d-flex align-items-center gap-3 mb-2">
                        <label class="position-relative d-inline-block" style="width:48px; height:26px; flex-shrink:0; cursor:pointer;">
                            <input type="checkbox" name="promotional_updates" value="1" checked 
                                   class="opacity-0 position-absolute w-100 h-100" 
                                   style="z-index:2; cursor:pointer;" 
                                   onchange="toggleNotification(this, 'promo')">
                            <span class="position-absolute top-0 start-0 end-0 bottom-0 rounded-pill transition" 
                                  style="background:#2563EB; transition:0.3s;">
                                <span class="position-absolute bg-white rounded-circle" 
                                      style="height:20px; width:20px; left:3px; bottom:3px; transition:0.3s; transform:translateX(22px);"></span>
                            </span>
                        </label>
                        <div class="flex-grow-1">
                            <div class="fw-medium text-dark small">Promotional Updates</div>
                            <div class="text-secondary small">Receive promotional emails and offers</div>
                        </div>
                        <span id="promoStatus" class="text-success fw-medium small">Enabled</span>
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
    // Toggle notification function
    function toggleNotification(checkbox, type) {
        const statusMap = {
            'push': 'pushStatus',
            'email': 'emailStatus',
            'order': 'orderStatus',
            'promo': 'promoStatus'
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

    // Save notifications function
    function saveNotifications() {
        // Your existing save logic
        return true; // Allow form submission
    }

    // Initialize toggles on page load
    document.addEventListener('DOMContentLoaded', function() {
        document.querySelectorAll('input[type="checkbox"]').forEach(function(checkbox) {
            if (checkbox.checked) {
                const typeMap = {
                    'push_notifications': 'push',
                    'email_notifications': 'email',
                    'order_updates': 'order',
                    'promotional_updates': 'promo'
                };
                const type = typeMap[checkbox.name];
                if (type) {
                    const statusMap = {
                        'push': 'pushStatus',
                        'email': 'emailStatus',
                        'order': 'orderStatus',
                        'promo': 'promoStatus'
                    };
                    const statusElement = document.getElementById(statusMap[type]);
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
            }
        });
    });
    </script>
</body>
</html>