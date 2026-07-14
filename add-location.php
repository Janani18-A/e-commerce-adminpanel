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
    $address = $_POST['address'] ?? '';
    $city = $_POST['city'] ?? '';
    $type = $_POST['type'] ?? 'warehouse';
    $status = isset($_POST['status']) ? 'Active' : 'Inactive';
    
    if (empty($name) || empty($address) || empty($city)) {
        $error_message = 'Please fill in all required fields!';
    } else {
        // In real project: INSERT INTO locations (name, address, city, type, status) VALUES (...)
        $success_message = 'Location "' . $name . '" added successfully!';
        echo '<meta http-equiv="refresh" content="2;url=locations.php">';
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
        <div class="settings-container bg-white border rounded-4 overflow-hidden">
            <div class="settings-header p-4 border-bottom d-flex flex-wrap justify-content-between align-items-center">
                <div>
                    <h1 class="fs-4 fw-bold text-dark mb-0">📍 Add Location</h1>
                    <p class="text-secondary small mb-0">Add a new warehouse or pickup location.</p>
                </div>
                <a href="locations.php" class="btn btn-light border mt-2 mt-sm-0">
                    <i class="fas fa-arrow-left"></i> Back to Locations
                </a>
            </div>

            <?php if ($success_message): ?>
                <div class="alert alert-success m-3 rounded-3">
                    <i class="fas fa-check-circle"></i> <?php echo $success_message; ?>
                    <br><small class="text-secondary">Redirecting to locations list...</small>
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
                <form method="POST" action="" onsubmit="return saveLocation();">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label fw-semibold small">Location Name <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="name" placeholder="e.g., New Warehouse" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold small">City <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="city" placeholder="e.g., Chennai" required>
                        </div>
                        <div class="col-md-12">
                            <label class="form-label fw-semibold small">Address <span class="text-danger">*</span></label>
                            <textarea class="form-control" name="address" rows="2" placeholder="Enter complete address" required></textarea>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold small">Location Type</label>
                            <select class="form-select" name="type">
                                <option value="warehouse">🏢 Warehouse</option>
                                <option value="pickup">📍 Pickup Location</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold small">Status</label>
                            <div class="form-check mt-2">
                                <input type="checkbox" class="form-check-input" name="status" checked>
                                <label class="form-check-label small">Active</label>
                            </div>
                        </div>
                    </div>

                    <div class="d-flex gap-3 mt-4">
                        <button type="submit" class="btn btn-primary px-4 py-2">
                            <i class="fas fa-save"></i> Add Location
                        </button>
                        <a href="locations.php" class="btn btn-light border px-4 py-2">
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
    function saveLocation() {
        // Your existing save logic
        // Validate form if needed
        return true; // Allow form submission
    }
    </script>
</body>
</html>