<?php
include 'config/config.php';
?>



<?php
$current_page = 'settings';
$success_message = '';
$error_message = '';

// Sample delivery methods data
$deliveryMethods = [
    ['id' => 1, 'name' => 'Standard', 'charge' => '₹50', 'time' => '3-5 Days', 'status' => 'Active'],
    ['id' => 2, 'name' => 'Express', 'charge' => '₹150', 'time' => '1-2 Days', 'status' => 'Active'],
    ['id' => 3, 'name' => 'Overnight', 'charge' => '₹300', 'time' => 'Next Day', 'status' => 'Inactive']
];

// Handle Delete
if (isset($_GET['delete']) && isset($_GET['id'])) {
    $deleteId = $_GET['id'];
    // In real project: DELETE FROM delivery_methods WHERE id = $deleteId
    $success_message = 'Delivery method deleted successfully!';
}

// Handle Toggle
if (isset($_GET['toggle']) && isset($_GET['id'])) {
    $toggleId = $_GET['id'];
    // In real project: UPDATE delivery_methods SET status = 
    $success_message = 'Delivery method status updated successfully!';
}

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $enable_shipping = isset($_POST['enable_shipping']) ? 1 : 0;
    $free_shipping = $_POST['free_shipping'] ?? '₹1000';
    $success_message = 'Delivery settings saved successfully!';
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
            <!-- Header -->
            <div class="settings-header p-4 border-bottom d-flex flex-wrap justify-content-between align-items-center">
                <div>
                    <h1 class="fs-4 fw-bold text-dark mb-0">🚚 Delivery Method</h1>
                    <p class="text-secondary small mb-0">Configure shipping methods, delivery charges, and service areas.</p>
                </div>
                <a href="settings.php" class="btn btn-light border mt-2 mt-sm-0">
                    <i class="fas fa-arrow-left"></i> Back to Settings
                </a>
            </div>

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

            <form method="POST" action="" onsubmit="return saveDeliverySettings();" class="p-3">
                <div class="bg-white border rounded-3 p-4">
                    
                    <!-- Enable Shipping Toggle -->
                    <div class="bg-light rounded-3 p-3 d-flex align-items-center gap-3 mb-3">
                        <label class="position-relative d-inline-block" style="width:48px; height:26px; flex-shrink:0; cursor:pointer;">
                            <input type="checkbox" name="enable_shipping" value="1" checked 
                                   class="opacity-0 position-absolute w-100 h-100" 
                                   style="z-index:2; cursor:pointer;" 
                                   onchange="toggleDeliveryToggle(this)">
                            <span class="position-absolute top-0 start-0 end-0 bottom-0 rounded-pill transition" 
                                  style="background:#2563EB; transition:0.3s;">
                                <span class="position-absolute bg-white rounded-circle" 
                                      style="height:20px; width:20px; left:3px; bottom:3px; transition:0.3s; transform:translateX(22px);"></span>
                            </span>
                        </label>
                        <div class="flex-grow-1">
                            <div class="fw-medium text-dark small">Enable Shipping</div>
                            <div class="text-secondary small">Enable shipping for orders</div>
                        </div>
                        <span id="shippingStatus" class="text-success fw-medium small">Enabled</span>
                    </div>

                    <!-- Shipping Methods Table -->
                    <h6 class="fw-semibold text-dark mb-3">Shipping Methods</h6>
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover">
                            <thead class="table-light">
                                <tr>
                                    <th>Method</th>
                                    <th>Charge</th>
                                    <th>Delivery Time</th>
                                    <th>Status</th>
                                    <th style="width: 150px;">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($deliveryMethods as $method): ?>
                                <tr>
                                    <td><strong><?php echo $method['name']; ?></strong></td>
                                    <td><?php echo $method['charge']; ?></td>
                                    <td><?php echo $method['time']; ?></td>
                                    <td>
                                        <span class="badge <?php echo $method['status'] == 'Active' ? 'bg-success' : 'bg-secondary'; ?>">
                                            <?php echo $method['status']; ?>
                                        </span>
                                    </td>
                                    <td>
                                        <a href="edit-delivery.php?id=<?php echo $method['id']; ?>" class="btn btn-primary btn-sm">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <a href="delivery-method.php?toggle=1&id=<?php echo $method['id']; ?>" class="btn btn-sm <?php echo $method['status'] == 'Active' ? 'btn-warning' : 'btn-success'; ?>" onclick="return confirm('Change status?')">
                                            <i class="fas <?php echo $method['status'] == 'Active' ? 'fa-pause' : 'fa-play'; ?>"></i>
                                        </a>
                                        <a href="delivery-method.php?delete=1&id=<?php echo $method['id']; ?>" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this delivery method?')">
                                            <i class="fas fa-trash"></i>
                                        </a>
                                    </td>
                                </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>

                    <!-- Free Shipping Threshold -->
                    <div class="mb-3">
                        <label class="form-label fw-semibold small">Free Shipping Threshold</label>
                        <input type="text" class="form-control" name="free_shipping" value="₹1000" placeholder="Enter threshold amount" style="max-width: 300px;">
                    </div>

                    <!-- Add Method Button -->
                    <a href="add-delivery.php" class="btn btn-primary">
                        <i class="fas fa-plus"></i> Add Method
                    </a>

                    <!-- Buttons -->
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

   <!-- Bootstrap JS Bundle (Latest Stable) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
 <script src="<?= APP_URL; ?>/assets/js/script.js"></script>

    <script>
    // Toggle delivery shipping
    function toggleDeliveryToggle(checkbox) {
        const statusElement = document.getElementById('shippingStatus');
        const toggleSpan = checkbox.parentElement.querySelector('span:first-child');
        const circleSpan = toggleSpan.querySelector('span');
        
        if (checkbox.checked) {
            // Enabled
            toggleSpan.style.background = '#2563EB';
            circleSpan.style.transform = 'translateX(22px)';
            if (statusElement) {
                statusElement.textContent = 'Enabled';
                statusElement.className = 'text-success fw-medium small';
            }
        } else {
            // Disabled
            toggleSpan.style.background = '#CBD5E1';
            circleSpan.style.transform = 'translateX(0)';
            if (statusElement) {
                statusElement.textContent = 'Disabled';
                statusElement.className = 'text-secondary fw-medium small';
            }
        }
    }

    // Save delivery settings
    function saveDeliverySettings() {
        // Your existing save logic
        return true; // Allow form submission
    }

    // Initialize toggle on page load
    document.addEventListener('DOMContentLoaded', function() {
        const checkbox = document.querySelector('input[name="enable_shipping"]');
        if (checkbox && checkbox.checked) {
            const statusElement = document.getElementById('shippingStatus');
            const toggleSpan = checkbox.parentElement.querySelector('span:first-child');
            const circleSpan = toggleSpan.querySelector('span');
            
            if (statusElement) {
                statusElement.textContent = 'Enabled';
                statusElement.className = 'text-success fw-medium small';
            }
            if (toggleSpan) {
                toggleSpan.style.background = '#2563EB';
                if (circleSpan) {
                    circleSpan.style.transform = 'translateX(22px)';
                }
            }
        }
    });
    </script>
</body>
</html>