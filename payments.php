<?php
$current_page = 'settings';
// Simulate data from database
$paymentMethods = [
    [ 
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
    [ 
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
    [ 
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
    [ 
        'id' => 4, 
        'name' => 'Google Pay', 
        'enabled' => false, 
        'type' => 'gpay',
        'details' => [
            'upiId' => 'store@gpay',
            'merchantId' => 'GP123456789'
        ]
    ],
    [ 
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
    [ 
        'id' => 6, 
        'name' => 'Cash', 
        'enabled' => false, 
        'type' => 'cash',
        'details' => [
            'note' => 'Cash on delivery available'
        ]
    ]
];

// Handle Delete
if (isset($_GET['delete']) && isset($_GET['id'])) {
    $deleteId = $_GET['id'];
    foreach ($paymentMethods as $key => $method) {
        if ($method['id'] == $deleteId) {
            unset($paymentMethods[$key]);
            break;
        }
    }
    $paymentMethods = array_values($paymentMethods);
    $success_message = 'Payment method deleted successfully!';
}

// Handle Toggle
if (isset($_GET['toggle']) && isset($_GET['id'])) {
    $toggleId = $_GET['id'];
    foreach ($paymentMethods as $key => $method) {
        if ($method['id'] == $toggleId) {
            $paymentMethods[$key]['enabled'] = !$method['enabled'];
            $status = $paymentMethods[$key]['enabled'] ? 'enabled' : 'disabled';
            $success_message = $method['name'] . ' ' . $status . ' successfully!';
            break;
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payments - Settings</title>
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
                    <h1 class="fs-4 fw-bold text-dark mb-0">💳 Payments</h1>
                    <p class="text-secondary small mb-0">Configure payment gateways and manage how customers pay for orders.</p>
                </div>
                <a href="settings.php" class="btn btn-light border mt-2 mt-sm-0">
                    <i class="fas fa-arrow-left"></i> Back to Settings
                </a>
            </div>

            <?php if (isset($success_message)): ?>
                <div class="alert alert-success m-3 rounded-3">
                    <i class="fas fa-check-circle"></i> <?php echo $success_message; ?>
                </div>
            <?php endif; ?>

            <form method="POST" action="" class="p-3">
                <div class="bg-white border rounded-3 p-4">
                    
                    <!-- Enable Payment Gateways Toggle -->
                    <div class="bg-light rounded-3 p-3 d-flex align-items-center gap-3 mb-3">
                        <div class="form-check form-switch mb-0">
                            <input class="form-check-input" type="checkbox" name="enable_gateways" value="1" checked 
                                   style="width:48px; height:26px; cursor:pointer;" 
                                   onchange="togglePaymentGateways(this)">
                        </div>
                        <div class="flex-grow-1">
                            <div class="fw-medium text-dark small">Enable Payment Gateways</div>
                            <div class="text-secondary small">Enable online payments</div>
                        </div>
                    </div>

                    <!-- Default Gateway -->
                    <div class="mb-3">
                        <label class="form-label fw-semibold small">Default Gateway</label>
                        <select class="form-select" name="default_gateway" onchange="showGatewayConfig(this.value)">
                            <option value="razorpay">Razorpay</option>
                            <option value="paypal">PayPal</option>
                            <option value="stripe">Stripe</option>
                            <option value="instamojo">Instamojo</option>
                        </select>
                    </div>

                    <!-- Razorpay Config -->
                    <div id="razorpayConfig" class="gateway-config bg-light rounded-3 p-3 mb-3">
                        <h6 class="fw-semibold text-dark mb-3">Razorpay Configuration</h6>
                        <div class="mb-3">
                            <label class="form-label small">Key ID</label>
                            <input type="text" class="form-control" name="razorpay_key" value="rzp_live_xxxxxxxxxxxx" placeholder="Enter Key ID">
                        </div>
                        <div class="mb-3">
                            <label class="form-label small">Key Secret</label>
                            <input type="password" class="form-control" name="razorpay_secret" value="••••••••••••••" placeholder="Enter Key Secret">
                        </div>
                    </div>

                    <!-- PayPal Config -->
                    <div id="paypalConfig" class="gateway-config bg-light rounded-3 p-3 mb-3" style="display:none;">
                        <h6 class="fw-semibold text-dark mb-3">PayPal Configuration</h6>
                        <div class="mb-3">
                            <label class="form-label small">Client ID</label>
                            <input type="text" class="form-control" name="paypal_client" value="••••••••••••••" placeholder="Enter Client ID">
                        </div>
                        <div class="mb-3">
                            <label class="form-label small">Secret</label>
                            <input type="password" class="form-control" name="paypal_secret" value="••••••••••••••" placeholder="Enter Secret">
                        </div>
                    </div>

                    <!-- Stripe Config -->
                    <div id="stripeConfig" class="gateway-config bg-light rounded-3 p-3 mb-3" style="display:none;">
                        <h6 class="fw-semibold text-dark mb-3">Stripe Configuration</h6>
                        <div class="mb-3">
                            <label class="form-label small">Publishable Key</label>
                            <input type="text" class="form-control" name="stripe_publishable" value="pk_live_xxxxxxxxxxxx" placeholder="Enter Publishable Key">
                        </div>
                        <div class="mb-3">
                            <label class="form-label small">Secret Key</label>
                            <input type="password" class="form-control" name="stripe_secret" value="sk_live_xxxxxxxxxxxx" placeholder="Enter Secret Key">
                        </div>
                    </div>

                    <!-- UPI QR -->
                    <div class="border border-2 border-dashed rounded-3 p-4 text-center bg-light mb-3">
                        <img src="https://api.qrserver.com/v1/create-qr-code/?size=150x150&data=upi://pay?pa=store@upi&pn=MyStore" alt="UPI QR" style="width: 120px; height: 120px;">
                        <p class="mt-2 small text-secondary">UPI ID: store@upi</p>
                    </div>

                    <!-- COD Toggle -->
                    <div class="bg-light rounded-3 p-3 d-flex align-items-center gap-3 mb-3">
                        <div class="form-check form-switch mb-0">
                            <input class="form-check-input" type="checkbox" name="enable_cod" value="1" checked 
                                   style="width:48px; height:26px; cursor:pointer;">
                        </div>
                        <div class="flex-grow-1">
                            <div class="fw-medium text-dark small">COD (Cash on Delivery)</div>
                            <div class="text-secondary small">Enable Cash on Delivery</div>
                        </div>
                    </div>

                    <!-- Payment Methods List -->
                    <div class="bg-light rounded-3 p-3 mt-3">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <h6 class="fw-semibold text-dark mb-0">Additional Payment Methods</h6>
                            <a href="add-payment.php" class="btn btn-primary btn-sm">
                                <i class="fas fa-plus"></i> Add Method
                            </a>
                        </div>
                        <div id="paymentMethodsList">
                            <?php foreach ($paymentMethods as $method): ?>
                                <?php 
                                $typeLabel = [
                                    'bank' => '🏦',
                                    'paypal' => '💳',
                                    'phonepe' => '📱',
                                    'gpay' => '🔵',
                                    'card' => '💳',
                                    'cash' => '💵'
                                ][$method['type']] ?? '📌';
                                
                                $detailPreview = '';
                                if ($method['type'] == 'bank') {
                                    $detailPreview = $method['details']['bankName'] . ' - ' . $method['details']['accountNumber'];
                                } else if ($method['type'] == 'paypal') {
                                    $detailPreview = $method['details']['email'];
                                } else if ($method['type'] == 'phonepe' || $method['type'] == 'gpay') {
                                    $detailPreview = $method['details']['upiId'];
                                } else if ($method['type'] == 'card') {
                                    $detailPreview = $method['details']['gateway'];
                                } else {
                                    $detailPreview = $method['details']['note'] ?? '';
                                }
                                ?>
                                <div class="bg-white border rounded-3 p-3 d-flex align-items-center gap-3 mb-2">
                                    <div class="form-check form-switch mb-0">
                                        <input class="form-check-input" type="checkbox" <?php echo $method['enabled'] ? 'checked' : ''; ?> 
                                               style="width:48px; height:26px; cursor:pointer;"
                                               onchange="window.location.href='payments.php?toggle=1&id=<?php echo $method['id']; ?>'">
                                    </div>
                                    <div class="flex-grow-1">
                                        <div class="fw-medium text-dark small"><?php echo $typeLabel . ' ' . $method['name']; ?></div>
                                        <div class="text-secondary small" style="font-size: 11px;"><?php echo $detailPreview; ?></div>
                                    </div>
                                    <div class="d-flex gap-1">
                                        <a href="edit-payment.php?id=<?php echo $method['id']; ?>" class="btn btn-primary btn-sm">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <a href="payments.php?delete=1&id=<?php echo $method['id']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this payment method?')">
                                            <i class="fas fa-trash"></i>
                                        </a>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>

                    <!-- Save Button -->
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
    function togglePaymentGateways(checkbox) {
        // Your existing toggle logic
        console.log('Payment gateways toggled:', checkbox.checked);
    }

    function showGatewayConfig(value) {
        document.querySelectorAll('.gateway-config').forEach(el => {
            el.style.display = 'none';
        });
        const selected = document.getElementById(value + 'Config');
        if (selected) {
            selected.style.display = 'block';
        }
    }
    </script>
</body>
</html>