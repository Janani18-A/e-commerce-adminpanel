<?php
include 'config/config.php';
?>

<?php
$current_page = 'settings';
$error_message = '';
$success_message = '';

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'] ?? '';
    $charge = $_POST['charge'] ?? '';
    $time = $_POST['time'] ?? '';
    $status = isset($_POST['status']) ? 'Active' : 'Inactive';
    
    if (empty($name) || empty($charge) || empty($time)) {
        $error_message = 'Please fill in all required fields!';
    } else {
        // In real project: INSERT INTO delivery_methods (name, charge, time, status) VALUES (...)
        $success_message = 'Delivery method "' . $name . '" added successfully!';
        echo '<meta http-equiv="refresh" content="2;url=delivery-method.php">';
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<?php include 'templates/head.php'; ?>
</head>
<body>
     <?php include ('templates/navbar.php'); ?>
   <?php include('templates/sidebar.php'); ?>

    <div class="content-area">
        <div class="settings-container">
            <div class="settings-header" style="display: flex; justify-content: space-between; align-items: center;">
                <div>
                    <h1 style="font-size: 22px; font-weight: 700; color: #1E293B;">🚚 Add Delivery Method</h1>
                    <p style="font-size: 14px; color: #64748B; margin-top: 4px;">Add a new shipping method for your store.</p>
                </div>
                <a href="delivery-method.php" class="btn btn-secondary" style="padding: 8px 20px; border-radius: 8px; font-weight: 600; background: #F1F5F9; color: #1E293B; text-decoration: none; border: none;">
                    <i class="fas fa-arrow-left"></i> Back to Delivery Methods
                </a>
            </div>

            <?php if ($success_message): ?>
                <div class="alert alert-success" style="margin-top: 15px; border-radius: 8px;">
                    <i class="fas fa-check-circle"></i> <?php echo $success_message; ?>
                    <br><small>Redirecting to delivery methods list...</small>
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
                <script>
                    showToast('<?php echo $error_message; ?>', 'error');
                </script>
            <?php endif; ?>

            <div style="background: #FFFFFF; border-radius: 12px; border: 1px solid #DBEAFE; padding: 30px; margin-top: 20px;">
                <form method="POST" action="" onsubmit="return saveDeliveryMethod();">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-bold">Method Name <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="name" placeholder="e.g., Same Day Delivery" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-bold">Charge <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="charge" placeholder="e.g., ₹200" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-bold">Delivery Time <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="time" placeholder="e.g., Same Day" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-bold">Status</label>
                            <div class="form-check mt-2">
                                <input type="checkbox" class="form-check-input" name="status" checked>
                                <label class="form-check-label">Active</label>
                            </div>
                        </div>
                    </div>

                    <div class="d-flex gap-3 mt-3">
                        <button type="submit" class="btn btn-primary" style="padding: 10px 30px; border-radius: 8px; font-weight: 600; background: #2563EB; color: #FFFFFF; border: none;">
                            <i class="fas fa-save"></i> Add Delivery Method
                        </button>
                        <a href="delivery-method.php" class="btn btn-secondary" style="padding: 10px 30px; border-radius: 8px; font-weight: 600; background: #F1F5F9; color: #1E293B; text-decoration: none; border: none;">
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
</body>
</html>