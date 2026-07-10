<?php
$current_page = 'settings';
$success_message = '';
$error_message = '';

// Sample location data (in real project, fetch from database)
$locations = [
    ['id' => 1, 'name' => 'Main Warehouse', 'address' => '123, Main St', 'city' => 'Chennai', 'status' => 'Active', 'type' => 'warehouse'],
    ['id' => 2, 'name' => 'Branch Office', 'address' => '456, Anna Nagar', 'city' => 'Chennai', 'status' => 'Active', 'type' => 'warehouse'],
    ['id' => 3, 'name' => 'Store Pickup', 'address' => 'Shop #5, Mall', 'city' => 'Chennai', 'status' => 'Active', 'type' => 'pickup']
];

// Handle Delete
if (isset($_GET['delete']) && isset($_GET['id'])) {
    $deleteId = $_GET['id'];
    // In real project: DELETE FROM locations WHERE id = $deleteId
    $success_message = 'Location deleted successfully!';
}

// Handle Toggle Status
if (isset($_GET['toggle']) && isset($_GET['id'])) {
    $toggleId = $_GET['id'];
    // In real project: UPDATE locations SET status = 
    // For demo, just show success
    $success_message = 'Location status updated successfully!';
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Locations - Settings</title>
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
            <!-- Header -->
            <div class="settings-header p-4 border-bottom d-flex flex-wrap justify-content-between align-items-center">
                <div>
                    <h1 class="fs-4 fw-bold text-dark mb-0">📍 Locations</h1>
                    <p class="text-secondary small mb-0">Manage warehouse, pickup, and store locations used for fulfillment.</p>
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

            <form method="POST" action="" onsubmit="return saveLocations();" class="p-3">
                <div class="bg-white border rounded-3 p-4">
                    
                    <!-- Warehouse Locations -->
                    <h6 class="fw-semibold text-dark mb-3">🏢 Warehouse Locations</h6>
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover">
                            <thead class="table-light">
                                <tr>
                                    <th>Name</th>
                                    <th>Address</th>
                                    <th>City</th>
                                    <th>Status</th>
                                    <th style="width: 150px;">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($locations as $loc): ?>
                                    <?php if ($loc['type'] == 'warehouse'): ?>
                                    <tr>
                                        <td><strong><?php echo $loc['name']; ?></strong></td>
                                        <td><?php echo $loc['address']; ?></td>
                                        <td><?php echo $loc['city']; ?></td>
                                        <td>
                                            <span class="badge <?php echo $loc['status'] == 'Active' ? 'bg-success' : 'bg-secondary'; ?>">
                                                <?php echo $loc['status']; ?>
                                            </span>
                                        </td>
                                        <td>
                                            <a href="edit-location.php?id=<?php echo $loc['id']; ?>" class="btn btn-primary btn-sm">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <a href="locations.php?toggle=1&id=<?php echo $loc['id']; ?>" class="btn btn-sm <?php echo $loc['status'] == 'Active' ? 'btn-warning' : 'btn-success'; ?>" onclick="return confirm('Change status?')">
                                                <i class="fas <?php echo $loc['status'] == 'Active' ? 'fa-pause' : 'fa-play'; ?>"></i>
                                            </a>
                                            <a href="locations.php?delete=1&id=<?php echo $loc['id']; ?>" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this location?')">
                                                <i class="fas fa-trash"></i>
                                            </a>
                                        </td>
                                    </tr>
                                    <?php endif; ?>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>

                    <!-- Pickup Locations -->
                    <h6 class="fw-semibold text-dark mt-4 mb-3">📍 Pickup Locations</h6>
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover">
                            <thead class="table-light">
                                <tr>
                                    <th>Name</th>
                                    <th>Address</th>
                                    <th>City</th>
                                    <th>Status</th>
                                    <th style="width: 150px;">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($locations as $loc): ?>
                                    <?php if ($loc['type'] == 'pickup'): ?>
                                    <tr>
                                        <td><strong><?php echo $loc['name']; ?></strong></td>
                                        <td><?php echo $loc['address']; ?></td>
                                        <td><?php echo $loc['city']; ?></td>
                                        <td>
                                            <span class="badge <?php echo $loc['status'] == 'Active' ? 'bg-success' : 'bg-secondary'; ?>">
                                                <?php echo $loc['status']; ?>
                                            </span>
                                        </td>
                                        <td>
                                            <a href="edit-location.php?id=<?php echo $loc['id']; ?>" class="btn btn-primary btn-sm">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <a href="locations.php?toggle=1&id=<?php echo $loc['id']; ?>" class="btn btn-sm <?php echo $loc['status'] == 'Active' ? 'btn-warning' : 'btn-success'; ?>" onclick="return confirm('Change status?')">
                                                <i class="fas <?php echo $loc['status'] == 'Active' ? 'fa-pause' : 'fa-play'; ?>"></i>
                                            </a>
                                            <a href="locations.php?delete=1&id=<?php echo $loc['id']; ?>" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this location?')">
                                                <i class="fas fa-trash"></i>
                                            </a>
                                        </td>
                                    </tr>
                                    <?php endif; ?>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>

                    <!-- Add Button -->
                    <a href="add-location.php" class="btn btn-primary mt-3">
                        <i class="fas fa-plus"></i> Add Location
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

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="../assets/js/script.js"></script>

    <script>
    function saveLocations() {
        // Your existing save logic
        return true; // Allow form submission
    }
    </script>
</body>
</html>