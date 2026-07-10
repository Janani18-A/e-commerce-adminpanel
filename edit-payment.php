<?php
$current_page = 'settings';
$error_message = '';
$success_message = '';

// Get ID from URL
$id = isset($_GET['id']) ? intval($_GET['id']) : 0;

// In real project: SELECT * FROM payment_methods WHERE id = $id
// For demo, use sample data
$paymentMethods = [
    1 => [
        'id' => 1,
        'name' => 'Bank Transfer',
        'enabled' => false,
        'type' => 'bank',
        'details' => [
            'accountNumber' => '1234567890',
            'ifscCode' => 'SBIN0001234',
            'beneficiaryName' => 'My Store Pvt Ltd',
            'bankName' => 'State Bank of India',
            'branchName' => 'Main Branch',
            'accountType' => 'Current'
        ]
    ],
    2 => [
        'id' => 2,
        'name' => 'PayPal',
        'enabled' => false,
        'type' => 'paypal',
        'details' => [
            'email' => 'paypal@mystore.com',
            'merchantId' => 'PP-123456789',
            'clientId' => 'Abc123XYZ789',
            'secret' => '••••••••••••••'
        ]
    ],
    3 => [
        'id' => 3,
        'name' => 'PhonePe',
        'enabled' => false,
        'type' => 'phonepe',
        'details' => [
            'merchantId' => 'PHONEPE123',
            'apiKey' => '••••••••••••••',
            'upiId' => 'store@phonepe'
        ]
    ],
    4 => [
        'id' => 4,
        'name' => 'Google Pay',
        'enabled' => false,
        'type' => 'gpay',
        'details' => [
            'upiId' => 'store@gpay',
            'merchantId' => 'GP123456789'
        ]
    ],
    5 => [
        'id' => 5,
        'name' => 'Credit Card',
        'enabled' => true,
        'type' => 'card',
        'details' => [
            'gateway' => 'Razorpay',
            'merchantId' => 'RZP123456',
            'apiKey' => 'rzp_live_xxxxxxxxxxxx',
            'secret' => '••••••••••••••',
            'acceptedCards' => 'Visa, Mastercard, Amex, RuPay'
        ]
    ],
    6 => [
        'id' => 6,
        'name' => 'Cash',
        'enabled' => false,
        'type' => 'cash',
        'details' => [
            'note' => 'Cash on delivery available'
        ]
    ]
];

$method = $paymentMethods[$id] ?? null;

if (!$method) {
    header('Location: payments.php');
    exit;
}

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['method_name'] ?? '';
    $enabled = isset($_POST['enabled']) ? 1 : 0;
    
    // Build details based on type
    $details = [];
    switch ($method['type']) {
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
    
    // In real project: UPDATE payment_methods SET ...
    $success_message = 'Payment method "' . $name . '" updated successfully!';
    
    // Redirect after 2 seconds
    echo '<meta http-equiv="refresh" content="2;url=payments.php">';
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Payment Method</title>
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
                    <h1 class="fs-4 fw-bold text-dark mb-0">Edit Payment Method</h1>
                    <p class="text-secondary small mb-0">Update payment method details.</p>
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
                
                <!-- Method Name -->
                <div class="mb-3">
                    <label class="form-label fw-semibold small">Method Name <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" name="method_name" value="<?php echo htmlspecialchars($method['name']); ?>" required>
                </div>

                <!-- Dynamic Form Fields -->
                <div id="formFields">
                    <?php if ($method['type'] == 'bank'): ?>
                        <hr>
                        <h6 class="fw-semibold text-dark mb-3">Bank Transfer Details</h6>
                        <div class="mb-3">
                            <label class="form-label small">Account Number <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="bank_account" value="<?php echo htmlspecialchars($method['details']['accountNumber'] ?? ''); ?>" placeholder="Enter account number">
                        </div>
                        <div class="mb-3">
                            <label class="form-label small">IFSC Code <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="bank_ifsc" value="<?php echo htmlspecialchars($method['details']['ifscCode'] ?? ''); ?>" placeholder="Enter IFSC code">
                        </div>
                        <div class="mb-3">
                            <label class="form-label small">Beneficiary Name <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="bank_beneficiary" value="<?php echo htmlspecialchars($method['details']['beneficiaryName'] ?? ''); ?>" placeholder="Enter beneficiary name">
                        </div>
                        <div class="mb-3">
                            <label class="form-label small">Bank Name <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="bank_name" value="<?php echo htmlspecialchars($method['details']['bankName'] ?? ''); ?>" placeholder="Enter bank name">
                        </div>
                        <div class="mb-3">
                            <label class="form-label small">Branch Name</label>
                            <input type="text" class="form-control" name="bank_branch" value="<?php echo htmlspecialchars($method['details']['branchName'] ?? ''); ?>" placeholder="Enter branch name">
                        </div>
                        <div class="mb-3">
                            <label class="form-label small">Account Type</label>
                            <select class="form-select" name="bank_account_type">
                                <option value="Current" <?php echo ($method['details']['accountType'] ?? '') == 'Current' ? 'selected' : ''; ?>>Current</option>
                                <option value="Savings" <?php echo ($method['details']['accountType'] ?? '') == 'Savings' ? 'selected' : ''; ?>>Savings</option>
                            </select>
                        </div>
                    <?php elseif ($method['type'] == 'paypal'): ?>
                        <hr>
                        <h6 class="fw-semibold text-dark mb-3">PayPal Details</h6>
                        <div class="mb-3">
                            <label class="form-label small">PayPal Email <span class="text-danger">*</span></label>
                            <input type="email" class="form-control" name="paypal_email" value="<?php echo htmlspecialchars($method['details']['email'] ?? ''); ?>" placeholder="Enter PayPal email">
                        </div>
                        <div class="mb-3">
                            <label class="form-label small">Merchant ID</label>
                            <input type="text" class="form-control" name="paypal_merchant_id" value="<?php echo htmlspecialchars($method['details']['merchantId'] ?? ''); ?>" placeholder="Enter merchant ID">
                        </div>
                        <div class="mb-3">
                            <label class="form-label small">Client ID</label>
                            <input type="text" class="form-control" name="paypal_client_id" value="<?php echo htmlspecialchars($method['details']['clientId'] ?? ''); ?>" placeholder="Enter client ID">
                        </div>
                        <div class="mb-3">
                            <label class="form-label small">Secret</label>
                            <input type="password" class="form-control" name="paypal_secret" value="<?php echo htmlspecialchars($method['details']['secret'] ?? ''); ?>" placeholder="Enter secret">
                        </div>
                    <?php elseif ($method['type'] == 'phonepe'): ?>
                        <hr>
                        <h6 class="fw-semibold text-dark mb-3">PhonePe Details</h6>
                        <div class="mb-3">
                            <label class="form-label small">Merchant ID <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="phonepe_merchant_id" value="<?php echo htmlspecialchars($method['details']['merchantId'] ?? ''); ?>" placeholder="Enter merchant ID">
                        </div>
                        <div class="mb-3">
                            <label class="form-label small">API Key</label>
                            <input type="password" class="form-control" name="phonepe_api_key" value="<?php echo htmlspecialchars($method['details']['apiKey'] ?? ''); ?>" placeholder="Enter API key">
                        </div>
                        <div class="mb-3">
                            <label class="form-label small">UPI ID <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="phonepe_upi" value="<?php echo htmlspecialchars($method['details']['upiId'] ?? ''); ?>" placeholder="Enter UPI ID">
                        </div>
                    <?php elseif ($method['type'] == 'gpay'): ?>
                        <hr>
                        <h6 class="fw-semibold text-dark mb-3">Google Pay Details</h6>
                        <div class="mb-3">
                            <label class="form-label small">UPI ID <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="gpay_upi" value="<?php echo htmlspecialchars($method['details']['upiId'] ?? ''); ?>" placeholder="Enter UPI ID">
                        </div>
                        <div class="mb-3">
                            <label class="form-label small">Merchant ID</label>
                            <input type="text" class="form-control" name="gpay_merchant_id" value="<?php echo htmlspecialchars($method['details']['merchantId'] ?? ''); ?>" placeholder="Enter merchant ID">
                        </div>
                    <?php elseif ($method['type'] == 'card'): ?>
                        <hr>
                        <h6 class="fw-semibold text-dark mb-3">Credit Card Details</h6>
                        <div class="mb-3">
                            <label class="form-label small">Gateway <span class="text-danger">*</span></label>
                            <select class="form-select" name="card_gateway">
                                <option value="Razorpay" <?php echo ($method['details']['gateway'] ?? '') == 'Razorpay' ? 'selected' : ''; ?>>Razorpay</option>
                                <option value="Stripe" <?php echo ($method['details']['gateway'] ?? '') == 'Stripe' ? 'selected' : ''; ?>>Stripe</option>
                                <option value="PayU" <?php echo ($method['details']['gateway'] ?? '') == 'PayU' ? 'selected' : ''; ?>>PayU</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label small">Merchant ID</label>
                            <input type="text" class="form-control" name="card_merchant_id" value="<?php echo htmlspecialchars($method['details']['merchantId'] ?? ''); ?>" placeholder="Enter merchant ID">
                        </div>
                        <div class="mb-3">
                            <label class="form-label small">API Key</label>
                            <input type="text" class="form-control" name="card_api_key" value="<?php echo htmlspecialchars($method['details']['apiKey'] ?? ''); ?>" placeholder="Enter API key">
                        </div>
                        <div class="mb-3">
                            <label class="form-label small">Secret</label>
                            <input type="password" class="form-control" name="card_secret" value="<?php echo htmlspecialchars($method['details']['secret'] ?? ''); ?>" placeholder="Enter secret">
                        </div>
                        <div class="mb-3">
                            <label class="form-label small">Accepted Cards</label>
                            <input type="text" class="form-control" name="card_accepted" value="<?php echo htmlspecialchars($method['details']['acceptedCards'] ?? ''); ?>" placeholder="e.g., Visa, Mastercard, Amex">
                        </div>
                    <?php elseif ($method['type'] == 'cash'): ?>
                        <hr>
                        <h6 class="fw-semibold text-dark mb-3">Cash Details</h6>
                        <div class="mb-3">
                            <label class="form-label small">Note</label>
                            <input type="text" class="form-control" name="cash_note" value="<?php echo htmlspecialchars($method['details']['note'] ?? ''); ?>" placeholder="Cash on delivery available">
                        </div>
                    <?php endif; ?>
                </div>

                <!-- Enabled Status -->
                <div class="mb-3 mt-3">
                    <div class="form-check">
                        <input type="checkbox" class="form-check-input" name="enabled" id="enabled" <?php echo $method['enabled'] ? 'checked' : ''; ?>>
                        <label class="form-check-label small" for="enabled">Enable this payment method</label>
                    </div>
                </div>

                <!-- Buttons -->
                <div class="d-flex gap-3 mt-4">
                    <button type="submit" class="btn btn-primary px-4 py-2">
                        <i class="fas fa-save"></i> Update Payment Method
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
</body>
</html>