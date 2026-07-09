<?php
$current_page = 'settings';
$success_message = '';
$error_message = '';

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get all form values
    $store_name = $_POST['store_name'] ?? '';
    $store_email = $_POST['store_email'] ?? '';
    $phone = $_POST['phone'] ?? '';
    $address = $_POST['address'] ?? '';
    $city = $_POST['city'] ?? '';
    $state = $_POST['state'] ?? '';
    $pincode = $_POST['pincode'] ?? '';
    $country = $_POST['country'] ?? '';
    $gst = $_POST['gst'] ?? '';
    
    // In real project: UPDATE store_settings SET ...
    // For demo, just show success
    $success_message = 'Store information saved successfully!';
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Store Information - Settings</title>
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
                    <h1 style="font-size: 22px; font-weight: 700; color: #1E293B;">🏪 Store Information</h1>
                    <p style="font-size: 14px; color: #64748B; margin-top: 4px;">Update your store details including name, contact, address, and branding.</p>
                </div>
                <a href="settings.php" class="btn btn-secondary" style="padding: 8px 20px; border-radius: 8px; font-weight: 600; background: #F1F5F9; color: #1E293B; text-decoration: none; border: none;">
                    <i class="fas fa-arrow-left"></i> Back to Settings
                </a>
            </div>

            <!-- Success Message -->
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

            <?php if ($error_message): ?>
                <div class="alert alert-danger" style="margin-top: 15px; border-radius: 8px;">
                    <i class="fas fa-exclamation-circle"></i> <?php echo $error_message; ?>
                </div>
            <?php endif; ?>

            <!-- Form Content -->
            <div style="background: #FFFFFF; border-radius: 12px; border: 1px solid #DBEAFE; padding: 30px; margin-top: 20px;">
                <form method="POST" action="" onsubmit="return saveStoreInformation();">
                    <div class="row">
                        <div class="col-md-12 mb-3">
                            <label class="form-label fw-bold">Store Name</label>
                            <input type="text" class="form-control" name="store_name" value="My E-Shop" placeholder="Enter store name">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-bold">Store Email</label>
                            <input type="email" class="form-control" name="store_email" value="admin@eshop.com" placeholder="Enter store email">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-bold">Phone Number</label>
                            <input type="tel" class="form-control" name="phone" value="+91 9876543210" placeholder="Enter phone number">
                        </div>
                        <div class="col-md-12 mb-3">
                            <label class="form-label fw-bold">Address</label>
                            <textarea class="form-control" name="address" rows="2" placeholder="Enter complete address">123, Main Street, Chennai - 600001</textarea>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label class="form-label fw-bold">City</label>
                            <input type="text" class="form-control" name="city" value="Chennai" placeholder="Enter city">
                        </div>
                        <div class="col-md-4 mb-3">
                            <label class="form-label fw-bold">State</label>
                            <input type="text" class="form-control" name="state" value="Tamil Nadu" placeholder="Enter state">
                        </div>
                        <div class="col-md-4 mb-3">
                            <label class="form-label fw-bold">Pincode</label>
                            <input type="text" class="form-control" name="pincode" value="600001" placeholder="Enter pincode">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-bold">Country</label>
                            <input type="text" class="form-control" name="country" value="India" placeholder="Enter country">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-bold">GST Number</label>
                            <input type="text" class="form-control" name="gst" value="22AAAAA0000A1Z5" placeholder="Enter GST number">
                        </div>
                    </div>
                    <div class="d-flex gap-3 mt-3">
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
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="../assets/js/script.js"></script>
</body>
</html>