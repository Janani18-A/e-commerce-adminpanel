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
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delivery Method - Settings</title>
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
                    <h1 style="font-size: 22px; font-weight: 700; color: #1E293B;">🚚 Delivery Method</h1>
                    <p style="font-size: 14px; color: #64748B; margin-top: 4px;">Configure shipping methods, delivery charges, and service areas.</p>
                </div>
                <a href="settings.php" class="btn btn-secondary" style="padding: 8px 20px; border-radius: 8px; font-weight: 600; background: #F1F5F9; color: #1E293B; text-decoration: none; border: none;">
                    <i class="fas fa-arrow-left"></i> Back to Settings
                </a>
            </div>

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

            <form method="POST" action="" onsubmit="return saveDeliverySettings();">
                <div style="background: #FFFFFF; border-radius: 12px; border: 1px solid #DBEAFE; padding: 30px; margin-top: 20px;">
                    
                    <!-- Enable Shipping Toggle -->
                    <div class="toggle-group" style="display: flex; align-items: center; gap: 12px; padding: 12px 16px; background: #F8FAFC; border-radius: 10px; margin-bottom: 20px;">
                        <label class="toggle-switch" style="position: relative; width: 48px; height: 26px; flex-shrink: 0; cursor: pointer;">
                            <input type="checkbox" name="enable_shipping" value="1" checked 
                                   style="opacity: 0; width: 0; height: 0; position: absolute;" 
                                   onchange="toggleDeliveryToggle(this)">
                            <span style="position: absolute; cursor: pointer; top: 0; left: 0; right: 0; bottom: 0; background: #2563EB; border-radius: 34px; transition: 0.3s;">
                                <span style="position: absolute; height: 20px; width: 20px; left: 3px; bottom: 3px; background: #FFFFFF; border-radius: 50%; transition: 0.3s; transform: translateX(22px);"></span>
                            </span>
                        </label>
                        <div>
                            <div style="font-size: 14px; color: #1E293B; font-weight: 500;">Enable Shipping</div>
                            <div style="font-size: 12px; color: #94A3B8; margin-top: 2px;">Enable shipping for orders</div>
                        </div>
                        <span id="shippingStatus" style="margin-left: auto; font-size: 12px; color: #10B981; font-weight: 500;">Enabled</span>
                    </div>

                    <!-- Shipping Methods Table -->
                    <h6 style="font-weight: 600; color: #1E293B; margin-bottom: 15px;">Shipping Methods</h6>
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead style="background: #F8FAFC;">
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
                                        <a href="edit-delivery.php?id=<?php echo $method['id']; ?>" class="btn btn-sm btn-primary" style="padding: 3px 8px; margin-right: 3px;">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <a href="delivery-method.php?toggle=1&id=<?php echo $method['id']; ?>" class="btn btn-sm <?php echo $method['status'] == 'Active' ? 'btn-warning' : 'btn-success'; ?>" style="padding: 3px 8px; margin-right: 3px;" onclick="return confirm('Change status?')">
                                            <i class="fas <?php echo $method['status'] == 'Active' ? 'fa-pause' : 'fa-play'; ?>"></i>
                                        </a>
                                        <a href="delivery-method.php?delete=1&id=<?php echo $method['id']; ?>" class="btn btn-sm btn-danger" style="padding: 3px 8px;" onclick="return confirm('Are you sure you want to delete this delivery method?')">
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
                        <label class="form-label fw-bold">Free Shipping Threshold</label>
                        <input type="text" class="form-control" name="free_shipping" value="₹1000" placeholder="Enter threshold amount" style="max-width: 300px;">
                    </div>

                    <!-- Add Method Button -->
                    <a href="add-delivery.php" class="btn btn-primary" style="padding: 8px 20px; border-radius: 8px; font-weight: 600; background: #2563EB; color: #FFFFFF; border: none;">
                        <i class="fas fa-plus"></i> Add Method
                    </a>

                    <!-- Buttons -->
                    <div class="d-flex gap-3 mt-4">
                        <button type="submit" class="btn btn-primary" style="padding: 10px 30px; border-radius: 8px; font-weight: 600; background: #2563EB; color: #FFFFFF; border: none;">
                            <i class="fas fa-save"></i> Save Changes
                        </button>
                        <a href="settings.php" class="btn btn-secondary" style="padding: 10px 30px; border-radius: 8px; font-weight: 600; background: #F1F5F9; color: #1E293B; text-decoration: none; border: none;">
                            Cancel
                        </a>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="../assets/js/script.js"></script>
</body>
</html>