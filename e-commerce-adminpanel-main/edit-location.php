<?php
$current_page = 'settings';
$error_message = '';
$success_message = '';

// Get ID from URL
$id = isset($_GET['id']) ? intval($_GET['id']) : 0;

// Sample data (in real project, fetch from database)
$locations = [
    1 => ['id' => 1, 'name' => 'Main Warehouse', 'address' => '123, Main St', 'city' => 'Chennai', 'status' => 'Active', 'type' => 'warehouse'],
    2 => ['id' => 2, 'name' => 'Branch Office', 'address' => '456, Anna Nagar', 'city' => 'Chennai', 'status' => 'Active', 'type' => 'warehouse'],
    3 => ['id' => 3, 'name' => 'Store Pickup', 'address' => 'Shop #5, Mall', 'city' => 'Chennai', 'status' => 'Active', 'type' => 'pickup']
];

$location = $locations[$id] ?? null;

if (!$location) {
    header('Location: locations.php');
    exit;
}

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
        // In real project: UPDATE locations SET ...
        $success_message = 'Location "' . $name . '" updated successfully!';
        echo '<meta http-equiv="refresh" content="2;url=locations.php">';
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Location</title>
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
                    <h1 style="font-size: 22px; font-weight: 700; color: #1E293B;">✏️ Edit Location</h1>
                    <p style="font-size: 14px; color: #64748B; margin-top: 4px;">Update location details.</p>
                </div>
                <a href="locations.php" class="btn btn-secondary" style="padding: 8px 20px; border-radius: 8px; font-weight: 600; background: #F1F5F9; color: #1E293B; text-decoration: none; border: none;">
                    <i class="fas fa-arrow-left"></i> Back to Locations
                </a>
            </div>

            <?php if ($success_message): ?>
                <div class="alert alert-success" style="margin-top: 15px; border-radius: 8px;">
                    <i class="fas fa-check-circle"></i> <?php echo $success_message; ?>
                    <br><small>Redirecting to locations list...</small>
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
                <form method="POST" action="" onsubmit="return updateLocation();">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-bold">Location Name <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="name" value="<?php echo htmlspecialchars($location['name']); ?>" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-bold">City <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="city" value="<?php echo htmlspecialchars($location['city']); ?>" required>
                        </div>
                        <div class="col-md-12 mb-3">
                            <label class="form-label fw-bold">Address <span class="text-danger">*</span></label>
                            <textarea class="form-control" name="address" rows="2" required><?php echo htmlspecialchars($location['address']); ?></textarea>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-bold">Location Type</label>
                            <select class="form-control" name="type">
                                <option value="warehouse" <?php echo $location['type'] == 'warehouse' ? 'selected' : ''; ?>>🏢 Warehouse</option>
                                <option value="pickup" <?php echo $location['type'] == 'pickup' ? 'selected' : ''; ?>>📍 Pickup Location</option>
                            </select>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-bold">Status</label>
                            <div class="form-check mt-2">
                                <input type="checkbox" class="form-check-input" name="status" <?php echo $location['status'] == 'Active' ? 'checked' : ''; ?>>
                                <label class="form-check-label">Active</label>
                            </div>
                        </div>
                    </div>

                    <div class="d-flex gap-3 mt-3">
                        <button type="submit" class="btn btn-primary" style="padding: 10px 30px; border-radius: 8px; font-weight: 600; background: #2563EB; color: #FFFFFF; border: none;">
                            <i class="fas fa-save"></i> Update Location
                        </button>
                        <a href="locations.php" class="btn btn-secondary" style="padding: 10px 30px; border-radius: 8px; font-weight: 600; background: #F1F5F9; color: #1E293B; text-decoration: none; border: none;">
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