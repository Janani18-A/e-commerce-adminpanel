<?php
$current_page = 'settings';
$error_message = '';
$success_message = '';

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $type = $_POST['method_type'] ?? 'bank';
    $name = $_POST['method_name'] ?? '';
    $enabled = isset($_POST['enabled']) ? 1 : 0;
    
    // Build details based on type
    $details = [];
    switch ($type) {
        case 'bank':
            $details = [
                'accountNumber' => $_POST['bank_account'] ?? '',
                'ifscCode' => $_POST['bank_ifsc'] ?? '',
                'beneficiaryName' => $_POST['bank_beneficiary'] ?? '',
                'bankName' => $_POST['bank_name'] ?? '',
                'branchName' => $_POST['bank_branch'] ?? '',
                'accountType' => $_POST['bank_account_type'] ?? 'Current'
            ];
            break;
        case 'paypal':
            $details = [
                'email' => $_POST['paypal_email'] ?? '',
                'merchantId' => $_POST['paypal_merchant_id'] ?? '',
                'clientId' => $_POST['paypal_client_id'] ?? '',
                'secret' => $_POST['paypal_secret'] ?? ''
            ];
            break;
        case 'phonepe':
            $details = [
                'merchantId' => $_POST['phonepe_merchant_id'] ?? '',
                'apiKey' => $_POST['phonepe_api_key'] ?? '',
                'upiId' => $_POST['phonepe_upi'] ?? ''
            ];
            break;
        case 'gpay':
            $details = [
                'upiId' => $_POST['gpay_upi'] ?? '',
                'merchantId' => $_POST['gpay_merchant_id'] ?? ''
            ];
            break;
        case 'card':
            $details = [
                'gateway' => $_POST['card_gateway'] ?? 'Razorpay',
                'merchantId' => $_POST['card_merchant_id'] ?? '',
                'apiKey' => $_POST['card_api_key'] ?? '',
                'secret' => $_POST['card_secret'] ?? '',
                'acceptedCards' => $_POST['card_accepted'] ?? 'Visa, Mastercard'
            ];
            break;
        case 'cash':
            $details = [
                'note' => $_POST['cash_note'] ?? 'Cash on delivery available'
            ];
            break;
    }
    
    // In real project: INSERT INTO payment_methods ...
    // For demo, show success
    $success_message = 'Payment method "' . $name . '" added successfully!';
    
    // Redirect after 2 seconds
    echo '<meta http-equiv="refresh" content="2;url=payments.php">';
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Payment Method</title>
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
            <div class="settings-header" style="display: flex; justify-content: space-between; align-items: center;">
                <div>
                    <h1 style="font-size: 22px; font-weight: 700; color: #1E293B;">➕ Add Payment Method</h1>
                    <p style="font-size: 14px; color: #64748B; margin-top: 4px;">Add a new payment method for your store.</p>
                </div>
                <a href="payments.php" class="btn btn-secondary" style="padding: 8px 20px; border-radius: 8px; font-weight: 600; background: #F1F5F9; color: #1E293B; text-decoration: none; border: none;">
                    <i class="fas fa-arrow-left"></i> Back to Payments
                </a>
            </div>

            <?php if ($success_message): ?>
                <div class="alert alert-success" style="margin-top: 15px; border-radius: 8px;">
                    <i class="fas fa-check-circle"></i> <?php echo $success_message; ?>
                    <br><small>Redirecting to payment methods list...</small>
                </div>
            <?php endif; ?>

            <?php if ($error_message): ?>
                <div class="alert alert-danger" style="margin-top: 15px; border-radius: 8px;">
                    <i class="fas fa-exclamation-circle"></i> <?php echo $error_message; ?>
                </div>
            <?php endif; ?>

            <form method="POST" action="" style="background: #FFFFFF; border-radius: 12px; border: 1px solid #DBEAFE; padding: 30px; margin-top: 20px;">
                
                <!-- Method Type -->
                <div class="mb-3">
                    <label class="form-label fw-bold">Payment Method Type <span class="text-danger">*</span></label>
                    <select class="form-control" name="method_type" id="methodType" onchange="showFormFields(this.value)" required>
                        <option value="bank">Bank Transfer</option>
                        <option value="paypal">PayPal</option>
                        <option value="phonepe">PhonePe</option>
                        <option value="gpay">Google Pay</option>
                        <option value="card">Credit Card</option>
                        <option value="cash">Cash</option>
                    </select>
                </div>

                <!-- Method Name -->
                <div class="mb-3">
                    <label class="form-label fw-bold">Method Name <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" name="method_name" placeholder="e.g., Bank Transfer" required>
                </div>

                <!-- Dynamic Form Fields -->
                <div id="formFields">
                    <!-- Bank Transfer Fields -->
                    <div id="bankFields">
                        <hr>
                        <h6 style="font-weight: 600; color: #1E293B; margin-bottom: 15px;">Bank Transfer Details</h6>
                        <div class="mb-3">
                            <label class="form-label">Account Number <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="bank_account" placeholder="Enter account number">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">IFSC Code <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="bank_ifsc" placeholder="Enter IFSC code">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Beneficiary Name <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="bank_beneficiary" placeholder="Enter beneficiary name">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Bank Name <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="bank_name" placeholder="Enter bank name">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Branch Name</label>
                            <input type="text" class="form-control" name="bank_branch" placeholder="Enter branch name">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Account Type</label>
                            <select class="form-control" name="bank_account_type">
                                <option value="Current">Current</option>
                                <option value="Savings">Savings</option>
                            </select>
                        </div>
                    </div>

                    <!-- PayPal Fields -->
                    <div id="paypalFields" style="display:none;">
                        <hr>
                        <h6 style="font-weight: 600; color: #1E293B; margin-bottom: 15px;">PayPal Details</h6>
                        <div class="mb-3">
                            <label class="form-label">PayPal Email <span class="text-danger">*</span></label>
                            <input type="email" class="form-control" name="paypal_email" placeholder="Enter PayPal email">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Merchant ID</label>
                            <input type="text" class="form-control" name="paypal_merchant_id" placeholder="Enter merchant ID">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Client ID</label>
                            <input type="text" class="form-control" name="paypal_client_id" placeholder="Enter client ID">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Secret</label>
                            <input type="password" class="form-control" name="paypal_secret" placeholder="Enter secret">
                        </div>
                    </div>

                    <!-- PhonePe Fields -->
                    <div id="phonepeFields" style="display:none;">
                        <hr>
                        <h6 style="font-weight: 600; color: #1E293B; margin-bottom: 15px;">PhonePe Details</h6>
                        <div class="mb-3">
                            <label class="form-label">Merchant ID <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="phonepe_merchant_id" placeholder="Enter merchant ID">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">API Key</label>
                            <input type="password" class="form-control" name="phonepe_api_key" placeholder="Enter API key">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">UPI ID <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="phonepe_upi" placeholder="Enter UPI ID">
                        </div>
                    </div>

                    <!-- Google Pay Fields -->
                    <div id="gpayFields" style="display:none;">
                        <hr>
                        <h6 style="font-weight: 600; color: #1E293B; margin-bottom: 15px;">Google Pay Details</h6>
                        <div class="mb-3">
                            <label class="form-label">UPI ID <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="gpay_upi" placeholder="Enter UPI ID">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Merchant ID</label>
                            <input type="text" class="form-control" name="gpay_merchant_id" placeholder="Enter merchant ID">
                        </div>
                    </div>

                    <!-- Credit Card Fields -->
                    <div id="cardFields" style="display:none;">
                        <hr>
                        <h6 style="font-weight: 600; color: #1E293B; margin-bottom: 15px;">Credit Card Details</h6>
                        <div class="mb-3">
                            <label class="form-label">Gateway <span class="text-danger">*</span></label>
                            <select class="form-control" name="card_gateway">
                                <option value="Razorpay">Razorpay</option>
                                <option value="Stripe">Stripe</option>
                                <option value="PayU">PayU</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Merchant ID</label>
                            <input type="text" class="form-control" name="card_merchant_id" placeholder="Enter merchant ID">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">API Key</label>
                            <input type="text" class="form-control" name="card_api_key" placeholder="Enter API key">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Secret</label>
                            <input type="password" class="form-control" name="card_secret" placeholder="Enter secret">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Accepted Cards</label>
                            <input type="text" class="form-control" name="card_accepted" placeholder="e.g., Visa, Mastercard, Amex">
                        </div>
                    </div>

                    <!-- Cash Fields -->
                    <div id="cashFields" style="display:none;">
                        <hr>
                        <h6 style="font-weight: 600; color: #1E293B; margin-bottom: 15px;">Cash Details</h6>
                        <div class="mb-3">
                            <label class="form-label">Note</label>
                            <input type="text" class="form-control" name="cash_note" placeholder="Cash on delivery available">
                        </div>
                    </div>
                </div>

                <!-- Enabled Status -->
                <div class="mb-3 mt-3">
                    <div class="form-check">
                        <input type="checkbox" class="form-check-input" name="enabled" id="enabled" checked>
                        <label class="form-check-label" for="enabled">Enable this payment method</label>
                    </div>
                </div>

                <!-- Buttons -->
                <div class="d-flex gap-3 mt-4">
                    <button type="submit" class="btn btn-primary" style="padding: 10px 30px; border-radius: 8px; font-weight: 600; background: #2563EB; color: #FFFFFF; border: none;">
                        <i class="fas fa-save"></i> Add Payment Method
                    </button>
                    <a href="payments.php" class="btn btn-secondary" style="padding: 10px 30px; border-radius: 8px; font-weight: 600; background: #F1F5F9; color: #1E293B; text-decoration: none; border: none;">
                        Cancel
                    </a>
                </div>
            </form>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="../assets/js/script.js"></script>
   
</body>
</html>