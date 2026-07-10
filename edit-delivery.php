<?php
$current_page = 'settings';
$error_message = '';
$success_message = '';

// Get ID from URL
$id = isset($_GET['id']) ? intval($_GET['id']) : 0;

// Sample data (in real project, fetch from database)
$deliveryMethods = [
    1 => ['id' => 1, 'name' => 'Standard', 'charge' => '₹50', 'time' => '3-5 Days', 'status' => 'Active'],
    2 => ['id' => 2, 'name' => 'Express', 'charge' => '₹150', 'time' => '1-2 Days', 'status' => 'Active'],
    3 => ['id' => 3, 'name' => 'Overnight', 'charge' => '₹300', 'time' => 'Next Day', 'status' => 'Inactive']
];

$method = $deliveryMethods[$id] ?? null;

if (!$method) {
    header('Location: delivery-method.php');
    exit;
}

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'] ?? '';
    $charge = $_POST['charge'] ?? '';
    $time = $_POST['time'] ?? '';
    $status = isset($_POST['status']) ? 'Active' : 'Inactive';
    
    if (empty($name) || empty($charge) || empty($time)) {
        $error_message = 'Please fill in all required fields!';
    } else {
        // In real project: UPDATE delivery_methods SET ...
        $success_message = 'Delivery method "' . $name . '" updated successfully!';
        echo '<meta http-equiv="refresh" content="2;url=delivery-method.php">';
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Delivery Method</title>
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
                    <h1 class="fs-4 fw-bold text-dark mb-0">Edit Delivery Method</h1>
                    <p class="text-secondary small mb-0">Update delivery method details.</p>
                </div>
                <a href="delivery-method.php" class="btn btn-light border mt-2 mt-sm-0">
                    <i class="fas fa-arrow-left"></i> Back to Delivery Methods
                </a>
            </div>

            <?php if ($success_message): ?>
                <div class="alert alert-success m-3 rounded-3">
                    <i class="fas fa-check-circle"></i> <?php echo $success_message; ?>
                    <br><small class="text-secondary">Redirecting to delivery methods list...</small>
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
                <script>
                    if (typeof showToast === 'function') {
                        showToast('<?php echo $error_message; ?>', 'error');
                    }
                </script>
            <?php endif; ?>

            <div class="bg-white border rounded-3 p-4 m-3">
                <form method="POST" action="" onsubmit="return updateDeliveryMethod();">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label fw-semibold small">Method Name <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="name" value="<?php echo htmlspecialchars($method['name']); ?>" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold small">Charge <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="charge" value="<?php echo htmlspecialchars($method['charge']); ?>" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold small">Delivery Time <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="time" value="<?php echo htmlspecialchars($method['time']); ?>" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold small">Status</label>
                            <div class="form-check mt-2">
                                <input type="checkbox" class="form-check-input" name="status" <?php echo $method['status'] == 'Active' ? 'checked' : ''; ?>>
                                <label class="form-check-label small">Active</label>
                            </div>
                        </div>
                    </div>

                    <div class="d-flex gap-3 mt-4">
                        <button type="submit" class="btn btn-primary px-4 py-2">
                            <i class="fas fa-save"></i> Update Delivery Method
                        </button>
                        <a href="delivery-method.php" class="btn btn-light border px-4 py-2">
                            Cancel
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="../assets/js/script.js"></script>

    <script>
    function updateDeliveryMethod() {
        // Your existing update logic
        // Validate form if needed
        return true; // Allow form submission
    }
    </script>
</body>
</html>