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
        <div class="settings-container bg-white border rounded-4 overflow-hidden">
            <div class="settings-header p-4 border-bottom d-flex flex-wrap justify-content-between align-items-center">
                <div>
                    <h1 class="fs-4 fw-bold text-dark mb-0">➕ Add Payment Method</h1>
                    <p class="text-secondary small mb-0">Add a new payment method for your store.</p>
                </div>
                <a href="payments.php" class="btn btn-light border mt-2 mt-sm-0">
                    <i class="fas fa-arrow-left"></i> Back to Payments
                </a>
            </div>

            <?php if ($success_message): ?>
                <div class="alert alert-success m-3 rounded-3">
                    <i class="fas fa-check-circle"></i> <?php echo $success_message; ?>
                    <br><small class="text-secondary">Redirecting to payment methods list...</small>
                </div>
            <?php endif; ?>

            <?php if ($error_message): ?>
                <div class="alert alert-danger m-3 rounded-3">
                    <i class="fas fa-exclamation-circle"></i> <?php echo $error_message; ?>
                </div>
            <?php endif; ?>

            <form method="POST" action="" class="bg-white border rounded-3 p-4 m-3">
                
                <!-- Method Type -->
                <div class="mb-3">
                    <label class="form-label fw-semibold small">Payment Method Type <span class="text-danger">*</span></label>
                    <select class="form-select" name="method_type" id="methodType" onchange="showFormFields(this.value)" required>
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
                    <label class="form-label fw-semibold small">Method Name <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" name="method_name" placeholder="e.g., Bank Transfer" required>
                </div>

                <!-- Dynamic Form Fields -->
                <div id="formFields">
                    <!-- Bank Transfer Fields -->
                    <div id="bankFields">
                        <hr>
                        <h6 class="fw-semibold text-dark mb-3">Bank Transfer Details</h6>
                        <div class="mb-3">
                            <label class="form-label small">Account Number <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="bank_account" placeholder="Enter account number">
                        </div>
                        <div class="mb-3">
                            <label class="form-label small">IFSC Code <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="bank_ifsc" placeholder="Enter IFSC code">
                        </div>
                        <div class="mb-3">
                            <label class="form-label small">Beneficiary Name <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="bank_beneficiary" placeholder="Enter beneficiary name">
                        </div>
                        <div class="mb-3">
                            <label class="form-label small">Bank Name <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="bank_name" placeholder="Enter bank name">
                        </div>
                        <div class="mb-3">
                            <label class="form-label small">Branch Name</label>
                            <input type="text" class="form-control" name="bank_branch" placeholder="Enter branch name">
                        </div>
                        <div class="mb-3">
                            <label class="form-label small">Account Type</label>
                            <select class="form-select" name="bank_account_type">
                                <option value="Current">Current</option>
                                <option value="Savings">Savings</option>
                            </select>
                        </div>
                    </div>

                    <!-- PayPal Fields -->
                    <div id="paypalFields" style="display:none;">
                        <hr>
                        <h6 class="fw-semibold text-dark mb-3">PayPal Details</h6>
                        <div class="mb-3">
                            <label class="form-label small">PayPal Email <span class="text-danger">*</span></label>
                            <input type="email" class="form-control" name="paypal_email" placeholder="Enter PayPal email">
                        </div>
                        <div class="mb-3">
                            <label class="form-label small">Merchant ID</label>
                            <input type="text" class="form-control" name="paypal_merchant_id" placeholder="Enter merchant ID">
                        </div>
                        <div class="mb-3">
                            <label class="form-label small">Client ID</label>
                            <input type="text" class="form-control" name="paypal_client_id" placeholder="Enter client ID">
                        </div>
                        <div class="mb-3">
                            <label class="form-label small">Secret</label>
                            <input type="password" class="form-control" name="paypal_secret" placeholder="Enter secret">
                        </div>
                    </div>

                    <!-- PhonePe Fields -->
                    <div id="phonepeFields" style="display:none;">
                        <hr>
                        <h6 class="fw-semibold text-dark mb-3">PhonePe Details</h6>
                        <div class="mb-3">
                            <label class="form-label small">Merchant ID <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="phonepe_merchant_id" placeholder="Enter merchant ID">
                        </div>
                        <div class="mb-3">
                            <label class="form-label small">API Key</label>
                            <input type="password" class="form-control" name="phonepe_api_key" placeholder="Enter API key">
                        </div>
                        <div class="mb-3">
                            <label class="form-label small">UPI ID <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="phonepe_upi" placeholder="Enter UPI ID">
                        </div>
                    </div>

                    <!-- Google Pay Fields -->
                    <div id="gpayFields" style="display:none;">
                        <hr>
                        <h6 class="fw-semibold text-dark mb-3">Google Pay Details</h6>
                        <div class="mb-3">
                            <label class="form-label small">UPI ID <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="gpay_upi" placeholder="Enter UPI ID">
                        </div>
                        <div class="mb-3">
                            <label class="form-label small">Merchant ID</label>
                            <input type="text" class="form-control" name="gpay_merchant_id" placeholder="Enter merchant ID">
                        </div>
                    </div>

                    <!-- Credit Card Fields -->
                    <div id="cardFields" style="display:none;">
                        <hr>
                        <h6 class="fw-semibold text-dark mb-3">Credit Card Details</h6>
                        <div class="mb-3">
                            <label class="form-label small">Gateway <span class="text-danger">*</span></label>
                            <select class="form-select" name="card_gateway">
                                <option value="Razorpay">Razorpay</option>
                                <option value="Stripe">Stripe</option>
                                <option value="PayU">PayU</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label small">Merchant ID</label>
                            <input type="text" class="form-control" name="card_merchant_id" placeholder="Enter merchant ID">
                        </div>
                        <div class="mb-3">
                            <label class="form-label small">API Key</label>
                            <input type="text" class="form-control" name="card_api_key" placeholder="Enter API key">
                        </div>
                        <div class="mb-3">
                            <label class="form-label small">Secret</label>
                            <input type="password" class="form-control" name="card_secret" placeholder="Enter secret">
                        </div>
                        <div class="mb-3">
                            <label class="form-label small">Accepted Cards</label>
                            <input type="text" class="form-control" name="card_accepted" placeholder="e.g., Visa, Mastercard, Amex">
                        </div>
                    </div>

                    <!-- Cash Fields -->
                    <div id="cashFields" style="display:none;">
                        <hr>
                        <h6 class="fw-semibold text-dark mb-3">Cash Details</h6>
                        <div class="mb-3">
                            <label class="form-label small">Note</label>
                            <input type="text" class="form-control" name="cash_note" placeholder="Cash on delivery available">
                        </div>
                    </div>
                </div>

                <!-- Enabled Status -->
                <div class="mb-3 mt-3">
                    <div class="form-check">
                        <input type="checkbox" class="form-check-input" name="enabled" id="enabled" checked>
                        <label class="form-check-label small" for="enabled">Enable this payment method</label>
                    </div>
                </div>

                <!-- Buttons -->
                <div class="d-flex gap-3 mt-4">
                    <button type="submit" class="btn btn-primary px-4 py-2">
                        <i class="fas fa-save"></i> Add Payment Method
                    </button>
                    <a href="payments.php" class="btn btn-light border px-4 py-2">
                        Cancel
                    </a>
                </div>
            </form>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="../assets/js/script.js"></script>

    <script>
    // Show/Hide form fields based on payment method type
    function showFormFields(type) {
        // Hide all field groups
        const fieldGroups = ['bankFields', 'paypalFields', 'phonepeFields', 'gpayFields', 'cardFields', 'cashFields'];
        fieldGroups.forEach(id => {
            const element = document.getElementById(id);
            if (element) {
                element.style.display = 'none';
            }
        });
        
        // Show the selected one
        const selectedGroup = document.getElementById(type + 'Fields');
        if (selectedGroup) {
            selectedGroup.style.display = 'block';
        }
    }

    // Initialize - show bank fields by default
    document.addEventListener('DOMContentLoaded', function() {
        showFormFields('bank');
    });
    </script>
</body>
</html>