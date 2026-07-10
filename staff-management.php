<?php
$current_page = 'settings';
$success_message = '';
$error_message = '';

// Sample staff data
$staffList = [
    ['id' => 1, 'name' => 'John Doe', 'email' => 'john@email.com', 'role' => 'Admin', 'status' => 'Active'],
    ['id' => 2, 'name' => 'Jane Smith', 'email' => 'jane@email.com', 'role' => 'Manager', 'status' => 'Active'],
    ['id' => 3, 'name' => 'Bob Wilson', 'email' => 'bob@email.com', 'role' => 'Staff', 'status' => 'Inactive']
];

// Handle Delete
if (isset($_GET['delete']) && isset($_GET['id'])) {
    $deleteId = $_GET['id'];
    $success_message = 'Staff member deleted successfully!';
}

// Handle Toggle
if (isset($_GET['toggle']) && isset($_GET['id'])) {
    $toggleId = $_GET['id'];
    $success_message = 'Staff status updated successfully!';
}

// Handle Add Staff
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add_staff'])) {
    $name = $_POST['staff_name'] ?? '';
    $email = $_POST['staff_email'] ?? '';
    $role = $_POST['staff_role'] ?? 'Staff';
    $password = $_POST['staff_password'] ?? '';
    
    if (empty($name) || empty($email) || empty($password)) {
        $error_message = 'Please fill in all required fields!';
    } else {
        $success_message = 'Staff "' . $name . '" added successfully!';
        // In real project: INSERT INTO staff (name, email, role, password, status) VALUES (...)
        // Reset form after success
    }
}

// Handle Save Settings
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['save_settings'])) {
    $enable_staff = isset($_POST['enable_staff']) ? 1 : 0;
    $success_message = 'Staff settings saved successfully!';
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Staff Management - Settings</title>
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
                    <h1 style="font-size: 22px; font-weight: 700; color: #1E293B;">👨‍💼 Staff Management</h1>
                    <p style="font-size: 14px; color: #64748B; margin-top: 4px;">Control staff access, permissions, and administrative roles.</p>
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

            <?php if ($error_message): ?>
                <div class="alert alert-danger" style="margin-top: 15px; border-radius: 8px;">
                    <i class="fas fa-exclamation-circle"></i> <?php echo $error_message; ?>
                </div>
                <script>
                    showToast('<?php echo $error_message; ?>', 'error');
                </script>
            <?php endif; ?>

            <form method="POST" action="">
                <div style="background: #FFFFFF; border-radius: 12px; border: 1px solid #DBEAFE; padding: 30px; margin-top: 20px;">
                    
                    <!-- Enable Staff Management Toggle -->
                    <div class="toggle-group" style="display: flex; align-items: center; gap: 12px; padding: 12px 16px; background: #F8FAFC; border-radius: 10px; margin-bottom: 20px;">
                        <label class="toggle-switch" style="position: relative; width: 48px; height: 26px; flex-shrink: 0; cursor: pointer;">
                            <input type="checkbox" name="enable_staff" value="1" checked 
                                   style="opacity: 0; width: 0; height: 0; position: absolute;" 
                                   onchange="toggleStaffManagement(this)">
                            <span style="position: absolute; cursor: pointer; top: 0; left: 0; right: 0; bottom: 0; background: #2563EB; border-radius: 34px; transition: 0.3s;">
                                <span style="position: absolute; height: 20px; width: 20px; left: 3px; bottom: 3px; background: #FFFFFF; border-radius: 50%; transition: 0.3s; transform: translateX(22px);"></span>
                            </span>
                        </label>
                        <div>
                            <div style="font-size: 14px; color: #1E293B; font-weight: 500;">Enable Staff Management</div>
                            <div style="font-size: 12px; color: #94A3B8; margin-top: 2px;">Allow staff management features</div>
                        </div>
                        <span id="staffStatus" style="margin-left: auto; font-size: 12px; color: #10B981; font-weight: 500;">Enabled</span>
                    </div>

                    <!-- Staff Content - Hidden when disabled -->
                    <div id="staffContent">
                        <!-- Staff List -->
                        <h6 style="font-weight: 600; color: #1E293B; margin-bottom: 15px;">Staff List</h6>
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead style="background: #F8FAFC;">
                                    <tr>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Role</th>
                                        <th>Status</th>
                                        <th style="width: 150px;">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($staffList as $staff): ?>
                                    <tr>
                                        <td><strong><?php echo $staff['name']; ?></strong></td>
                                        <td><?php echo $staff['email']; ?></td>
                                        <td><span class="badge bg-primary"><?php echo $staff['role']; ?></span></td>
                                        <td>
                                            <span class="badge <?php echo $staff['status'] == 'Active' ? 'bg-success' : 'bg-secondary'; ?>">
                                                <?php echo $staff['status']; ?>
                                            </span>
                                        </td>
                                        <td>
                                            <a href="edit-staff.php?id=<?php echo $staff['id']; ?>" class="btn btn-sm btn-primary" style="padding: 3px 8px; margin-right: 3px;">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <a href="staff-management.php?toggle=1&id=<?php echo $staff['id']; ?>" class="btn btn-sm <?php echo $staff['status'] == 'Active' ? 'btn-warning' : 'btn-success'; ?>" style="padding: 3px 8px; margin-right: 3px;" onclick="return confirm('Change status?')">
                                                <i class="fas <?php echo $staff['status'] == 'Active' ? 'fa-pause' : 'fa-play'; ?>"></i>
                                            </a>
                                            <a href="staff-management.php?delete=1&id=<?php echo $staff['id']; ?>" class="btn btn-sm btn-danger" style="padding: 3px 8px;" onclick="return confirm('Are you sure you want to delete this staff member?')">
                                                <i class="fas fa-trash"></i>
                                            </a>
                                        </td>
                                    </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>

                        <!-- Add New Staff Form -->
                        <h6 style="font-weight: 600; color: #1E293B; margin: 25px 0 15px;">Add New Staff</h6>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-bold">Name <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="staff_name" placeholder="Enter name" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-bold">Email <span class="text-danger">*</span></label>
                                <input type="email" class="form-control" name="staff_email" placeholder="Enter email" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-bold">Role</label>
                                <select class="form-control" name="staff_role">
                                    <option value="Admin">Admin</option>
                                    <option value="Manager">Manager</option>
                                    <option value="Staff" selected>Staff</option>
                                </select>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-bold">Password <span class="text-danger">*</span></label>
                                <input type="password" class="form-control" name="staff_password" placeholder="Enter password" required>
                            </div>
                        </div>
                        <button type="submit" name="add_staff" class="btn btn-primary" style="padding: 8px 20px; border-radius: 8px; font-weight: 600; background: #2563EB; color: #FFFFFF; border: none;">
                            <i class="fas fa-plus"></i> Add Staff
                        </button>
                    </div>

                    <!-- Buttons -->
                    <div class="d-flex gap-3 mt-4">
                        <button type="submit" name="save_settings" class="btn btn-primary" style="padding: 10px 30px; border-radius: 8px; font-weight: 600; background: #2563EB; color: #FFFFFF; border: none;">
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