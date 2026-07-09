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
        <div class="settings-container">
            <!-- Header -->
            <div class="settings-header" style="display: flex; justify-content: space-between; align-items: center;">
                <div>
                    <h1 style="font-size: 22px; font-weight: 700; color: #1E293B;">📱 SMS OTP</h1>
                    <p style="font-size: 14px; color: #64748B; margin-top: 4px;">Enable secure phone verification and one-time password authentication for customers.</p>
                </div>
                <a href="settings.php" class="btn btn-secondary" style="padding: 8px 20px; border-radius: 8px; font-weight: 600; background: #F1F5F9; color: #1E293B; text-decoration: none; border: none;">
                    <i class="fas fa-arrow-left"></i> Back to Settings
                </a>
            </div>

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

            <form method="POST" action="" onsubmit="return saveSmsSettings();">
                <div style="background: #FFFFFF; border-radius: 12px; border: 1px solid #DBEAFE; padding: 30px; margin-top: 20px;">
                    
                    <!-- Enable SMS OTP - Main Toggle -->
                    <div class="toggle-group" style="display: flex; align-items: center; gap: 12px; padding: 12px 16px; background: #F8FAFC; border-radius: 10px; margin-bottom: 10px;">
                        <label class="toggle-switch" style="position: relative; width: 48px; height: 26px; flex-shrink: 0; cursor: pointer;">
                            <input type="checkbox" name="enable_sms" value="1" checked 
                                   style="opacity: 0; width: 0; height: 0; position: absolute;" 
                                   onchange="toggleSmsMain(this)">
                            <span style="position: absolute; cursor: pointer; top: 0; left: 0; right: 0; bottom: 0; background: #2563EB; border-radius: 34px; transition: 0.3s;">
                                <span style="position: absolute; height: 20px; width: 20px; left: 3px; bottom: 3px; background: #FFFFFF; border-radius: 50%; transition: 0.3s; transform: translateX(22px);"></span>
                            </span>
                        </label>
                        <div>
                            <div style="font-size: 14px; color: #1E293B; font-weight: 500;">Enable SMS OTP</div>
                            <div style="font-size: 12px; color: #94A3B8; margin-top: 2px;">Enable phone verification for customers</div>
                        </div>
                        <span id="smsMainStatus" style="margin-left: auto; font-size: 12px; color: #10B981; font-weight: 500;">Enabled</span>
                    </div>

                    <!-- OTP Content - Hidden when main toggle is OFF -->
                    <div id="otpContent">
                        <!-- Enable Login OTP -->
                        <div class="toggle-group" style="display: flex; align-items: center; gap: 12px; padding: 12px 16px; background: #F8FAFC; border-radius: 10px; margin-bottom: 10px;">
                            <label class="toggle-switch" style="position: relative; width: 48px; height: 26px; flex-shrink: 0; cursor: pointer;">
                                <input type="checkbox" name="enable_login_otp" value="1" 
                                       style="opacity: 0; width: 0; height: 0; position: absolute;" 
                                       onchange="toggleOtpSub(this, 'login')">
                                <span style="position: absolute; cursor: pointer; top: 0; left: 0; right: 0; bottom: 0; background: #CBD5E1; border-radius: 34px; transition: 0.3s;">
                                    <span style="position: absolute; height: 20px; width: 20px; left: 3px; bottom: 3px; background: #FFFFFF; border-radius: 50%; transition: 0.3s;"></span>
                                </span>
                            </label>
                            <div>
                                <div style="font-size: 14px; color: #1E293B; font-weight: 500;">Enable Login OTP</div>
                                <div style="font-size: 12px; color: #94A3B8; margin-top: 2px;">Require OTP for customer login</div>
                            </div>
                            <span id="loginStatus" style="margin-left: auto; font-size: 12px; color: #94A3B8; font-weight: 500;">Disabled</span>
                        </div>

                        <!-- Enable Checkout OTP -->
                        <div class="toggle-group" style="display: flex; align-items: center; gap: 12px; padding: 12px 16px; background: #F8FAFC; border-radius: 10px; margin-bottom: 20px;">
                            <label class="toggle-switch" style="position: relative; width: 48px; height: 26px; flex-shrink: 0; cursor: pointer;">
                                <input type="checkbox" name="enable_checkout_otp" value="1" 
                                       style="opacity: 0; width: 0; height: 0; position: absolute;" 
                                       onchange="toggleOtpSub(this, 'checkout')">
                                <span style="position: absolute; cursor: pointer; top: 0; left: 0; right: 0; bottom: 0; background: #CBD5E1; border-radius: 34px; transition: 0.3s;">
                                    <span style="position: absolute; height: 20px; width: 20px; left: 3px; bottom: 3px; background: #FFFFFF; border-radius: 50%; transition: 0.3s;"></span>
                                </span>
                            </label>
                            <div>
                                <div style="font-size: 14px; color: #1E293B; font-weight: 500;">Enable Checkout OTP</div>
                                <div style="font-size: 12px; color: #94A3B8; margin-top: 2px;">Require OTP for high-value orders</div>
                            </div>
                            <span id="checkoutStatus" style="margin-left: auto; font-size: 12px; color: #94A3B8; font-weight: 500;">Disabled</span>
                        </div>

                        <!-- OTP Expiry Time -->
                        <div class="mb-3">
                            <label class="form-label fw-bold">OTP Expiry Time</label>
                            <input type="number" class="form-control" name="otp_expiry" value="5" placeholder="Enter minutes" style="max-width: 200px;">
                            <small style="color: #94A3B8;">Minutes</small>
                        </div>

                        <!-- SMS Provider -->
                        <div class="mb-3">
                            <label class="form-label fw-bold">SMS Provider</label>
                            <select class="form-control" name="sms_provider" onchange="showProviderConfig(this.value)" style="max-width: 300px;">
                                <option value="twilio">Twilio</option>
                                <option value="msg91">MSG91</option>
                                <option value="textlocal">TextLocal</option>
                                <option value="fast2sms">Fast2SMS</option>
                            </select>
                        </div>

                        <!-- Provider Configurations -->
                        <div id="twilioConfig" class="provider-config" style="background: #F8FAFC; border-radius: 10px; padding: 15px; margin-bottom: 15px;">
                            <h6 style="font-weight: 600; color: #1E293B; margin-bottom: 12px;">Twilio Configuration</h6>
                            <div class="mb-3">
                                <label class="form-label">Account SID</label>
                                <input type="text" class="form-control" name="account_sid" value="ACxxxxxxxxxxxxxxxxxxxxxxxx" placeholder="Enter Account SID">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Auth Token</label>
                                <input type="password" class="form-control" name="auth_token" value="••••••••••••••" placeholder="Enter Auth Token">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">From Number</label>
                                <input type="tel" class="form-control" name="from_number" value="+1234567890" placeholder="Enter from number">
                            </div>
                        </div>

                        <div id="msg91Config" class="provider-config" style="display:none; background: #F8FAFC; border-radius: 10px; padding: 15px; margin-bottom: 15px;">
                            <h6 style="font-weight: 600; color: #1E293B; margin-bottom: 12px;">MSG91 Configuration</h6>
                            <div class="mb-3">
                                <label class="form-label">Auth Key</label>
                                <input type="text" class="form-control" value="••••••••••••••" placeholder="Enter Auth Key">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Sender ID</label>
                                <input type="text" class="form-control" value="MYSTORE" placeholder="Enter Sender ID">
                            </div>
                        </div>

                        <div id="textlocalConfig" class="provider-config" style="display:none; background: #F8FAFC; border-radius: 10px; padding: 15px; margin-bottom: 15px;">
                            <h6 style="font-weight: 600; color: #1E293B; margin-bottom: 12px;">TextLocal Configuration</h6>
                            <div class="mb-3">
                                <label class="form-label">API Key</label>
                                <input type="text" class="form-control" value="••••••••••••••" placeholder="Enter API Key">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Sender</label>
                                <input type="text" class="form-control" value="MYSTORE" placeholder="Enter Sender">
                            </div>
                        </div>

                        <div id="fast2smsConfig" class="provider-config" style="display:none; background: #F8FAFC; border-radius: 10px; padding: 15px; margin-bottom: 15px;">
                            <h6 style="font-weight: 600; color: #1E293B; margin-bottom: 12px;">Fast2SMS Configuration</h6>
                            <div class="mb-3">
                                <label class="form-label">API Key</label>
                                <input type="text" class="form-control" value="••••••••••••••" placeholder="Enter API Key">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Sender ID</label>
                                <input type="text" class="form-control" value="MYSTORE" placeholder="Enter Sender ID">
                            </div>
                        </div>

                        <!-- Message Template -->
                        <div class="mb-3">
                            <label class="form-label fw-bold">Message Template</label>
                            <textarea class="form-control" name="message_template" rows="2">Your OTP for {store_name} is {otp}. Valid for {expiry} minutes.</textarea>
                        </div>
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