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
        <div class="settings-container">
            <!-- Header -->
            <div class="settings-header" style="display: flex; justify-content: space-between; align-items: center;">
                <div>
                    <h1 style="font-size: 22px; font-weight: 700; color: #1E293B;">📍 Locations</h1>
                    <p style="font-size: 14px; color: #64748B; margin-top: 4px;">Manage warehouse, pickup, and store locations used for fulfillment.</p>
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

            <form method="POST" action="" onsubmit="return saveLocations();">
                <div style="background: #FFFFFF; border-radius: 12px; border: 1px solid #DBEAFE; padding: 30px; margin-top: 20px;">
                    
                    <!-- Warehouse Locations -->
                    <h6 style="font-weight: 600; color: #1E293B; margin-bottom: 15px;">🏢 Warehouse Locations</h6>
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead style="background: #F8FAFC;">
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
                                            <a href="edit-location.php?id=<?php echo $loc['id']; ?>" class="btn btn-sm btn-primary" style="padding: 3px 8px; margin-right: 3px;">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <a href="locations.php?toggle=1&id=<?php echo $loc['id']; ?>" class="btn btn-sm <?php echo $loc['status'] == 'Active' ? 'btn-warning' : 'btn-success'; ?>" style="padding: 3px 8px; margin-right: 3px;" onclick="return confirm('Change status?')">
                                                <i class="fas <?php echo $loc['status'] == 'Active' ? 'fa-pause' : 'fa-play'; ?>"></i>
                                            </a>
                                            <a href="locations.php?delete=1&id=<?php echo $loc['id']; ?>" class="btn btn-sm btn-danger" style="padding: 3px 8px;" onclick="return confirm('Are you sure you want to delete this location?')">
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
                    <h6 style="font-weight: 600; color: #1E293B; margin: 25px 0 15px;">📍 Pickup Locations</h6>
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead style="background: #F8FAFC;">
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
                                            <a href="edit-location.php?id=<?php echo $loc['id']; ?>" class="btn btn-sm btn-primary" style="padding: 3px 8px; margin-right: 3px;">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <a href="locations.php?toggle=1&id=<?php echo $loc['id']; ?>" class="btn btn-sm <?php echo $loc['status'] == 'Active' ? 'btn-warning' : 'btn-success'; ?>" style="padding: 3px 8px; margin-right: 3px;" onclick="return confirm('Change status?')">
                                                <i class="fas <?php echo $loc['status'] == 'Active' ? 'fa-pause' : 'fa-play'; ?>"></i>
                                            </a>
                                            <a href="locations.php?delete=1&id=<?php echo $loc['id']; ?>" class="btn btn-sm btn-danger" style="padding: 3px 8px;" onclick="return confirm('Are you sure you want to delete this location?')">
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
                    <a href="add-location.php" class="btn btn-primary" style="padding: 8px 20px; border-radius: 8px; font-weight: 600; background: #2563EB; color: #FFFFFF; border: none; margin-top: 10px;">
                        <i class="fas fa-plus"></i> Add Location
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