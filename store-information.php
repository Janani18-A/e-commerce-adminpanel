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
    <?php include 'head.php'; ?>
</head>
<body>
    <?php include ('templates/navbar.php'); ?>
    <?php include('templates/sidebar.php'); ?>

    <div class="content-area">
        <div class="settings-container bg-white border rounded-4 overflow-hidden">
            <!-- Header -->
            <div class="settings-header p-4 border-bottom d-flex flex-wrap justify-content-between align-items-center">
                <div>
                    <h1 class="fs-4 fw-bold text-dark mb-0">🏪 Store Information</h1>
                    <p class="text-secondary small mb-0">Update your store details including name, contact, address, and branding.</p>
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

            <!-- Form Content -->
            <div class="bg-white border rounded-3 p-4 m-3">
                <form method="POST" action="" onsubmit="return saveStoreInformation();">
                    <div class="row g-3">
                        <div class="col-md-12">
                            <label class="form-label fw-semibold small">Store Name</label>
                            <input type="text" class="form-control" name="store_name" value="My E-Shop" placeholder="Enter store name">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold small">Store Email</label>
                            <input type="email" class="form-control" name="store_email" value="admin@eshop.com" placeholder="Enter store email">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold small">Phone Number</label>
                            <input type="tel" class="form-control" name="phone" value="+91 9876543210" placeholder="Enter phone number">
                        </div>
                        <div class="col-md-12">
                            <label class="form-label fw-semibold small">Address</label>
                            <textarea class="form-control" name="address" rows="2" placeholder="Enter complete address">123, Main Street, Chennai - 600001</textarea>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label fw-semibold small">City</label>
                            <input type="text" class="form-control" name="city" value="Chennai" placeholder="Enter city">
                        </div>
                        <div class="col-md-4">
                            <label class="form-label fw-semibold small">State</label>
                            <input type="text" class="form-control" name="state" value="Tamil Nadu" placeholder="Enter state">
                        </div>
                        <div class="col-md-4">
                            <label class="form-label fw-semibold small">Pincode</label>
                            <input type="text" class="form-control" name="pincode" value="600001" placeholder="Enter pincode">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold small">Country</label>
                            <input type="text" class="form-control" name="country" value="India" placeholder="Enter country">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold small">GST Number</label>
                            <input type="text" class="form-control" name="gst" value="22AAAAA0000A1Z5" placeholder="Enter GST number">
                        </div>
                    </div>
                    <div class="d-flex gap-3 mt-4">
                        <button type="submit" class="btn btn-primary px-4 py-2">
                            <i class="fas fa-save"></i> Save Changes
                        </button>
                        <a href="settings.php" class="btn btn-light border px-4 py-2">
                            Cancel
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>

   <!-- Bootstrap JS Bundle (Latest Stable) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
 <script src="<?= APP_URL; ?>/assets/js/script.js"></script>

    <script>
    function saveStoreInformation() {
        // Get all form values
        const storeName = document.querySelector('input[name="store_name"]')?.value;
        const storeEmail = document.querySelector('input[name="store_email"]')?.value;
        const phone = document.querySelector('input[name="phone"]')?.value;
        const address = document.querySelector('textarea[name="address"]')?.value;
        const city = document.querySelector('input[name="city"]')?.value;
        const state = document.querySelector('input[name="state"]')?.value;
        const pincode = document.querySelector('input[name="pincode"]')?.value;
        const country = document.querySelector('input[name="country"]')?.value;
        const gst = document.querySelector('input[name="gst"]')?.value;

        // Validate
        if (!storeName) {
            if (typeof showToast === 'function') {
                showToast('Please enter store name', 'warning');
            } else {
                alert('Please enter store name');
            }
            return false;
        }

        if (!storeEmail) {
            if (typeof showToast === 'function') {
                showToast('Please enter store email', 'warning');
            } else {
                alert('Please enter store email');
            }
            return false;
        }

        // Show success toast
        if (typeof showToast === 'function') {
            showToast('✅ Store information saved successfully!', 'success');
        }

        // Return true to allow form submission
        return true;
    }
    </script>
</body>
</html>