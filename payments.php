<?php
$current_page = 'settings';
// Simulate data from database - in real project, fetch from DB
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
    // In real project: DELETE FROM payment_methods WHERE id = $deleteId
    // For demo, we'll just remove from array
    foreach ($paymentMethods as $key => $method) {
        if ($method['id'] == $deleteId) {
            unset($paymentMethods[$key]);
            break;
        }
    }
    $paymentMethods = array_values($paymentMethods); // Re-index
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
        <div class="settings-container">
            <div class="settings-header" style="display: flex; justify-content: space-between; align-items: center;">
                <div>
                    <h1 style="font-size: 22px; font-weight: 700; color: #1E293B;">💳 Payments</h1>
                    <p style="font-size: 14px; color: #64748B; margin-top: 4px;">Configure payment gateways and manage how customers pay for orders.</p>
                </div>
                <a href="settings.php" class="btn btn-secondary" style="padding: 8px 20px; border-radius: 8px; font-weight: 600; background: #F1F5F9; color: #1E293B; text-decoration: none; border: none;">
                    <i class="fas fa-arrow-left"></i> Back to Settings
                </a>
            </div>

            <?php if (isset($success_message)): ?>
                <div class="alert alert-success" style="margin-top: 15px; border-radius: 8px;">
                    <i class="fas fa-check-circle"></i> <?php echo $success_message; ?>
                </div>
            <?php endif; ?>

            <!-- Main Settings Form -->
            <form method="POST" action="" style="background: #FFFFFF; border-radius: 12px; border: 1px solid #DBEAFE; padding: 30px; margin-top: 20px;">
                
                <!-- Enable Payment Gateways Toggle -->
                <div style="display: flex; align-items: center; gap: 12px; padding: 12px 16px; background: #F8FAFC; border-radius: 10px; margin-bottom: 20px;">
                    <div style="position: relative; width: 48px; height: 26px; flex-shrink: 0;">
                        <input type="hidden" name="enable_gateways" value="0">
                        <input type="checkbox" name="enable_gateways" value="1" checked 
                               style="opacity: 0; width: 0; height: 0; position: absolute;" 
                               onchange="togglePaymentGateways(this)">
                        <span style="position: absolute; cursor: pointer; top: 0; left: 0; right: 0; bottom: 0; background: #2563EB; border-radius: 34px; transition: 0.3s;"></span>
                        <span style="position: absolute; height: 20px; width: 20px; left: 3px; bottom: 3px; background: #FFFFFF; border-radius: 50%; transition: 0.3s; transform: translateX(22px);"></span>
                    </div>
                    <div>
                        <div style="font-size: 14px; color: #1E293B; font-weight: 500;">Enable Payment Gateways</div>
                        <div style="font-size: 12px; color: #94A3B8; margin-top: 2px;">Enable online payments</div>
                    </div>
                </div>

                <!-- Default Gateway -->
                <div class="mb-3">
                    <label class="form-label fw-bold">Default Gateway</label>
                    <select class="form-control" name="default_gateway" onchange="showGatewayConfig(this.value)">
                        <option value="razorpay">Razorpay</option>
                        <option value="paypal">PayPal</option>
                        <option value="stripe">Stripe</option>
                        <option value="instamojo">Instamojo</option>
                    </select>
                </div>

                <!-- Razorpay Config -->
                <div id="razorpayConfig" class="gateway-config" style="background: #F8FAFC; border-radius: 10px; padding: 15px; margin-bottom: 15px;">
                    <h6 style="font-weight: 600; color: #1E293B; margin-bottom: 12px;">Razorpay Configuration</h6>
                    <div class="mb-3">
                        <label class="form-label">Key ID</label>
                        <input type="text" class="form-control" name="razorpay_key" value="rzp_live_xxxxxxxxxxxx" placeholder="Enter Key ID">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Key Secret</label>
                        <input type="password" class="form-control" name="razorpay_secret" value="••••••••••••••" placeholder="Enter Key Secret">
                    </div>
                </div>

                <!-- PayPal Config -->
                <div id="paypalConfig" class="gateway-config" style="display:none; background: #F8FAFC; border-radius: 10px; padding: 15px; margin-bottom: 15px;">
                    <h6 style="font-weight: 600; color: #1E293B; margin-bottom: 12px;">PayPal Configuration</h6>
                    <div class="mb-3">
                        <label class="form-label">Client ID</label>
                        <input type="text" class="form-control" name="paypal_client" value="••••••••••••••" placeholder="Enter Client ID">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Secret</label>
                        <input type="password" class="form-control" name="paypal_secret" value="••••••••••••••" placeholder="Enter Secret">
                    </div>
                </div>

                <!-- Stripe Config -->
                <div id="stripeConfig" class="gateway-config" style="display:none; background: #F8FAFC; border-radius: 10px; padding: 15px; margin-bottom: 15px;">
                    <h6 style="font-weight: 600; color: #1E293B; margin-bottom: 12px;">Stripe Configuration</h6>
                    <div class="mb-3">
                        <label class="form-label">Publishable Key</label>
                        <input type="text" class="form-control" name="stripe_publishable" value="pk_live_xxxxxxxxxxxx" placeholder="Enter Publishable Key">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Secret Key</label>
                        <input type="password" class="form-control" name="stripe_secret" value="sk_live_xxxxxxxxxxxx" placeholder="Enter Secret Key">
                    </div>
                </div>

                <!-- UPI QR -->
                <div style="border: 2px dashed #DBEAFE; border-radius: 12px; padding: 20px; text-align: center; background: #F8FAFC; margin-bottom: 15px;">
                    <img src="https://api.qrserver.com/v1/create-qr-code/?size=150x150&data=upi://pay?pa=store@upi&pn=MyStore" alt="UPI QR" style="width: 120px; height: 120px;">
                    <p style="margin-top: 8px; font-size: 13px; color: #64748B;">UPI ID: store@upi</p>
                </div>

                <!-- COD Toggle -->
                <div style="display: flex; align-items: center; gap: 12px; padding: 12px 16px; background: #F8FAFC; border-radius: 10px; margin-bottom: 20px;">
                    <div style="position: relative; width: 48px; height: 26px; flex-shrink: 0;">
                        <input type="hidden" name="enable_cod" value="0">
                        <input type="checkbox" name="enable_cod" value="1" checked 
                               style="opacity: 0; width: 0; height: 0; position: absolute;">
                        <span style="position: absolute; cursor: pointer; top: 0; left: 0; right: 0; bottom: 0; background: #2563EB; border-radius: 34px; transition: 0.3s;"></span>
                        <span style="position: absolute; height: 20px; width: 20px; left: 3px; bottom: 3px; background: #FFFFFF; border-radius: 50%; transition: 0.3s; transform: translateX(22px);"></span>
                    </div>
                    <div>
                        <div style="font-size: 14px; color: #1E293B; font-weight: 500;">COD (Cash on Delivery)</div>
                        <div style="font-size: 12px; color: #94A3B8; margin-top: 2px;">Enable Cash on Delivery</div>
                    </div>
                </div>

                <!-- Payment Methods List -->
                <div style="margin-top:15px; padding:15px; background:#F8FAFC; border-radius:10px;">
                    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 15px;">
                        <h6 style="margin:0; font-weight:600; color:#1E293B;">Additional Payment Methods</h6>
                        <a href="add-payment.php" class="btn btn-primary btn-sm" style="background: #2563EB; color: #FFFFFF; border: none; padding: 6px 15px; border-radius: 6px; text-decoration: none;">
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
                            <div class="toggle-group" style="display: flex; align-items: center; gap: 15px; padding: 12px; background: #FFFFFF; border-radius: 8px; margin-bottom: 10px; border: 1px solid #E2E8F0;">
                                <label class="toggle-switch" style="position: relative; width: 48px; height: 26px; flex-shrink: 0;">
                                    <input type="checkbox" <?php echo $method['enabled'] ? 'checked' : ''; ?> 
                                           onchange="window.location.href='payments.php?toggle=1&id=<?php echo $method['id']; ?>'"
                                           style="opacity: 0; width: 0; height: 0; position: absolute;">
                                    <span style="position: absolute; cursor: pointer; top: 0; left: 0; right: 0; bottom: 0; background: <?php echo $method['enabled'] ? '#2563EB' : '#CBD5E1'; ?>; border-radius: 34px; transition: 0.3s;">
                                        <span style="position: absolute; height: 20px; width: 20px; left: 3px; bottom: 3px; background: #FFFFFF; border-radius: 50%; transition: 0.3s; transform: <?php echo $method['enabled'] ? 'translateX(22px)' : 'translateX(0)'; ?>;"></span>
                                    </span>
                                </label>
                                <div style="flex:1;">
                                    <div style="font-size: 14px; color: #1E293B; font-weight: 500;"><?php echo $typeLabel . ' ' . $method['name']; ?></div>
                                    <div style="font-size: 11px; color: #94A3B8;"><?php echo $detailPreview; ?></div>
                                </div>
                                <div>
                                    <a href="edit-payment.php?id=<?php echo $method['id']; ?>" class="btn btn-sm btn-primary" style="padding: 4px 10px; border-radius: 6px; background: #2563EB; color: #FFFFFF; border: none; text-decoration: none;">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <a href="payments.php?delete=1&id=<?php echo $method['id']; ?>" class="btn btn-sm btn-danger" style="padding: 4px 10px; border-radius: 6px; background: #EF4444; color: #FFFFFF; border: none; text-decoration: none;" onclick="return confirm('Are you sure you want to delete this payment method?')">
                                        <i class="fas fa-trash"></i>
                                    </a>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>

                <!-- Save Button -->
                <div class="d-flex gap-3 mt-4">
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

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="../assets/js/script.js"></script>
  
</body>
</html>