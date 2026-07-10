<?php
$current_page = 'settings';
$success_message = '';
$error_message = '';

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $enable_sms = isset($_POST['enable_sms']) ? 1 : 0;
    $enable_login_otp = isset($_POST['enable_login_otp']) ? 1 : 0;
    $enable_checkout_otp = isset($_POST['enable_checkout_otp']) ? 1 : 0;
    $otp_expiry = $_POST['otp_expiry'] ?? '5';
    $sms_provider = $_POST['sms_provider'] ?? 'Twilio';
    $account_sid = $_POST['account_sid'] ?? '';
    $auth_token = $_POST['auth_token'] ?? '';
    $from_number = $_POST['from_number'] ?? '';
    $message_template = $_POST['message_template'] ?? '';
    
    $success_message = 'SMS OTP settings saved successfully!';
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SMS OTP - Settings</title>
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
                    <h1 class="fs-4 fw-bold text-dark mb-0">SMS OTP</h1>
                    <p class="text-secondary small mb-0">Enable secure phone verification and one-time password authentication for customers.</p>
                </div>
                <a href="settings.php" class="btn btn-light border mt-2 mt-sm-0">
                    <i class="fas fa-arrow-left"></i> Back to Settings
                </a>
            </div>

            <?php if ($success_message): ?>
                <div class="alert alert-success m-3 rounded-3">
                    <i class="fas fa-check-circle"></i> <?php echo $success_message; ?>
                </div>
            <?php endif; ?>

            <form method="POST" action="" onsubmit="return saveSmsSettings();" class="p-3">
                <div class="bg-white border rounded-3 p-4">
                    
                    <!-- Enable SMS OTP - Main Toggle -->
                    <div class="bg-light rounded-3 p-3 d-flex align-items-center gap-3 mb-2">
                        <div class="form-check form-switch mb-0">
                            <input class="form-check-input" type="checkbox" name="enable_sms" value="1" checked 
                                   style="width:48px; height:26px; cursor:pointer;" 
                                   onchange="toggleSmsMain(this)" id="smsMainToggle">
                        </div>
                        <div class="flex-grow-1">
                            <div class="fw-medium text-dark small">Enable SMS OTP</div>
                            <div class="text-secondary small">Enable phone verification for customers</div>
                        </div>
                        <span id="smsMainStatus" class="text-success fw-medium small">Enabled</span>
                    </div>

                    <!-- OTP Content -->
                    <div id="otpContent">
                        <!-- Enable Login OTP -->
                        <div class="bg-light rounded-3 p-3 d-flex align-items-center gap-3 mb-2">
                            <div class="form-check form-switch mb-0">
                                <input class="form-check-input" type="checkbox" name="enable_login_otp" value="1" 
                                       style="width:48px; height:26px; cursor:pointer;" 
                                       onchange="toggleOtpSub(this, 'login')" id="loginOtpToggle">
                            </div>
                            <div class="flex-grow-1">
                                <div class="fw-medium text-dark small">Enable Login OTP</div>
                                <div class="text-secondary small">Require OTP for customer login</div>
                            </div>
                            <span id="loginStatus" class="text-secondary fw-medium small">Disabled</span>
                        </div>

                        <!-- Enable Checkout OTP -->
                        <div class="bg-light rounded-3 p-3 d-flex align-items-center gap-3 mb-3">
                            <div class="form-check form-switch mb-0">
                                <input class="form-check-input" type="checkbox" name="enable_checkout_otp" value="1" 
                                       style="width:48px; height:26px; cursor:pointer;" 
                                       onchange="toggleOtpSub(this, 'checkout')" id="checkoutOtpToggle">
                            </div>
                            <div class="flex-grow-1">
                                <div class="fw-medium text-dark small">Enable Checkout OTP</div>
                                <div class="text-secondary small">Require OTP for high-value orders</div>
                            </div>
                            <span id="checkoutStatus" class="text-secondary fw-medium small">Disabled</span>
                        </div>

                        <!-- OTP Expiry Time -->
                        <div class="mb-3">
                            <label class="form-label fw-semibold small">OTP Expiry Time</label>
                            <input type="number" class="form-control" name="otp_expiry" value="5" placeholder="Enter minutes" style="max-width: 200px;">
                            <small class="text-secondary" style="font-size: 11px;">Minutes</small>
                        </div>

                        <!-- SMS Provider -->
                        <div class="mb-3">
                            <label class="form-label fw-semibold small">SMS Provider</label>
                            <select class="form-select" name="sms_provider" onchange="showProviderConfig(this.value)" style="max-width: 300px;">
                                <option value="twilio">Twilio</option>
                                <option value="msg91">MSG91</option>
                                <option value="textlocal">TextLocal</option>
                                <option value="fast2sms">Fast2SMS</option>
                            </select>
                        </div>

                        <!-- Provider Configurations -->
                        <div id="twilioConfig" class="provider-config bg-light rounded-3 p-3 mb-3">
                            <h6 class="fw-semibold text-dark mb-3">Twilio Configuration</h6>
                            <div class="mb-3">
                                <label class="form-label small">Account SID</label>
                                <input type="text" class="form-control" name="account_sid" value="ACxxxxxxxxxxxxxxxxxxxxxxxx" placeholder="Enter Account SID">
                            </div>
                            <div class="mb-3">
                                <label class="form-label small">Auth Token</label>
                                <input type="password" class="form-control" name="auth_token" value="••••••••••••••" placeholder="Enter Auth Token">
                            </div>
                            <div class="mb-3">
                                <label class="form-label small">From Number</label>
                                <input type="tel" class="form-control" name="from_number" value="+1234567890" placeholder="Enter from number">
                            </div>
                        </div>

                        <div id="msg91Config" class="provider-config bg-light rounded-3 p-3 mb-3" style="display:none;">
                            <h6 class="fw-semibold text-dark mb-3">MSG91 Configuration</h6>
                            <div class="mb-3">
                                <label class="form-label small">Auth Key</label>
                                <input type="text" class="form-control" value="••••••••••••••" placeholder="Enter Auth Key">
                            </div>
                            <div class="mb-3">
                                <label class="form-label small">Sender ID</label>
                                <input type="text" class="form-control" value="MYSTORE" placeholder="Enter Sender ID">
                            </div>
                        </div>

                        <div id="textlocalConfig" class="provider-config bg-light rounded-3 p-3 mb-3" style="display:none;">
                            <h6 class="fw-semibold text-dark mb-3">TextLocal Configuration</h6>
                            <div class="mb-3">
                                <label class="form-label small">API Key</label>
                                <input type="text" class="form-control" value="••••••••••••••" placeholder="Enter API Key">
                            </div>
                            <div class="mb-3">
                                <label class="form-label small">Sender</label>
                                <input type="text" class="form-control" value="MYSTORE" placeholder="Enter Sender">
                            </div>
                        </div>

                        <div id="fast2smsConfig" class="provider-config bg-light rounded-3 p-3 mb-3" style="display:none;">
                            <h6 class="fw-semibold text-dark mb-3">Fast2SMS Configuration</h6>
                            <div class="mb-3">
                                <label class="form-label small">API Key</label>
                                <input type="text" class="form-control" value="••••••••••••••" placeholder="Enter API Key">
                            </div>
                            <div class="mb-3">
                                <label class="form-label small">Sender ID</label>
                                <input type="text" class="form-control" value="MYSTORE" placeholder="Enter Sender ID">
                            </div>
                        </div>

                        <!-- Message Template -->
                        <div class="mb-3">
                            <label class="form-label fw-semibold small">Message Template</label>
                            <textarea class="form-control" name="message_template" rows="2">Your OTP for {store_name} is {otp}. Valid for {expiry} minutes.</textarea>
                        </div>
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

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="../assets/js/script.js"></script>

    <script>
    // Toggle main SMS OTP
    function toggleSmsMain(checkbox) {
        const statusElement = document.getElementById('smsMainStatus');
        const otpContent = document.getElementById('otpContent');
        
        if (checkbox.checked) {
            if (statusElement) {
                statusElement.textContent = 'Enabled';
                statusElement.className = 'text-success fw-medium small';
            }
            if (otpContent) {
                otpContent.style.display = 'block';
                otpContent.style.opacity = '1';
                otpContent.style.pointerEvents = 'auto';
                // Enable all inputs inside
                const inputs = otpContent.querySelectorAll('input, select, textarea');
                inputs.forEach(input => {
                    input.disabled = false;
                    input.style.opacity = '1';
                    input.style.background = '#FFFFFF';
                });
            }
        } else {
            if (statusElement) {
                statusElement.textContent = 'Disabled';
                statusElement.className = 'text-secondary fw-medium small';
            }
            if (otpContent) {
                otpContent.style.display = 'none';
                otpContent.style.opacity = '0.5';
                otpContent.style.pointerEvents = 'none';
                // Disable all inputs inside
                const inputs = otpContent.querySelectorAll('input, select, textarea');
                inputs.forEach(input => {
                    input.disabled = true;
                    input.style.opacity = '0.5';
                    input.style.background = '#F1F5F9';
                });
            }
        }
    }

    // Toggle OTP sub options
    function toggleOtpSub(checkbox, type) {
        const statusMap = {
            'login': 'loginStatus',
            'checkout': 'checkoutStatus'
        };
        
        const statusElement = document.getElementById(statusMap[type]);
        
        if (checkbox.checked) {
            if (statusElement) {
                statusElement.textContent = 'Enabled';
                statusElement.className = 'text-success fw-medium small';
            }
        } else {
            if (statusElement) {
                statusElement.textContent = 'Disabled';
                statusElement.className = 'text-secondary fw-medium small';
            }
        }
    }

    // Show provider configuration
    function showProviderConfig(value) {
        document.querySelectorAll('.provider-config').forEach(el => {
            el.style.display = 'none';
        });
        const selected = document.getElementById(value + 'Config');
        if (selected) {
            selected.style.display = 'block';
        }
    }

    // Save SMS settings
    function saveSmsSettings() {
        const enabled = document.querySelector('input[name="enable_sms"]')?.checked;
        const loginOtp = document.querySelector('input[name="enable_login_otp"]')?.checked;
        const checkoutOtp = document.querySelector('input[name="enable_checkout_otp"]')?.checked;
        
        const enabledFeatures = [];
        if (enabled) {
            enabledFeatures.push('SMS OTP');
            if (loginOtp) enabledFeatures.push('Login OTP');
            if (checkoutOtp) enabledFeatures.push('Checkout OTP');
        }
        
        if (typeof showToast === 'function') {
            if (enabledFeatures.length > 0) {
                showToast('SMS OTP settings saved! (' + enabledFeatures.join(', ') + ')', 'success');
            } else {
                showToast(' SMS OTP disabled!', 'info');
            }
        }
        
        return true;
    }

    // Initialize on page load
    document.addEventListener('DOMContentLoaded', function() {
        // Show Twilio config by default
        showProviderConfig('twilio');
        
        // Set initial state for main toggle
        const mainCheckbox = document.querySelector('input[name="enable_sms"]');
        if (mainCheckbox && mainCheckbox.checked) {
            document.getElementById('otpContent').style.display = 'block';
        }
    });
    </script>
</body>
</html>