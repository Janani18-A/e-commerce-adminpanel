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
        <div class="settings-container bg-white border rounded-4 overflow-hidden">
            <!-- Header -->
            <div class="settings-header p-4 border-bottom d-flex flex-wrap justify-content-between align-items-center">
                <div>
                    <h1 class="fs-4 fw-bold text-dark mb-0">👨‍💼 Staff Management</h1>
                    <p class="text-secondary small mb-0">Control staff access, permissions, and administrative roles.</p>
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

            <form method="POST" action="" class="p-3">
                <div class="bg-white border rounded-3 p-4">
                    
                    <!-- Enable Staff Management Toggle -->
                    <div class="bg-light rounded-3 p-3 d-flex align-items-center gap-3 mb-3">
                        <div class="form-check form-switch mb-0">
                            <input class="form-check-input" type="checkbox" name="enable_staff" value="1" checked 
                                   style="width:48px; height:26px; cursor:pointer;" 
                                   onchange="toggleStaffManagement(this)" id="staffToggle">
                        </div>
                        <div class="flex-grow-1">
                            <div class="fw-medium text-dark small">Enable Staff Management</div>
                            <div class="text-secondary small">Allow staff management features</div>
                        </div>
                        <span id="staffStatus" class="text-success fw-medium small">Enabled</span>
                    </div>

                    <!-- Staff Content - Hidden when disabled -->
                    <div id="staffContent">
                        <!-- Staff List -->
                        <h6 class="fw-semibold text-dark mb-3">Staff List</h6>
                        <div class="table-responsive">
                            <table class="table table-bordered table-hover">
                                <thead class="table-light">
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
                                            <a href="edit-staff.php?id=<?php echo $staff['id']; ?>" class="btn btn-primary btn-sm">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <a href="staff-management.php?toggle=1&id=<?php echo $staff['id']; ?>" class="btn btn-sm <?php echo $staff['status'] == 'Active' ? 'btn-warning' : 'btn-success'; ?>" onclick="return confirm('Change status?')">
                                                <i class="fas <?php echo $staff['status'] == 'Active' ? 'fa-pause' : 'fa-play'; ?>"></i>
                                            </a>
                                            <a href="staff-management.php?delete=1&id=<?php echo $staff['id']; ?>" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this staff member?')">
                                                <i class="fas fa-trash"></i>
                                            </a>
                                        </td>
                                    </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>

                        <!-- Add New Staff Form -->
                        <h6 class="fw-semibold text-dark mt-4 mb-3">Add New Staff</h6>
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label fw-semibold small">Name <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="staff_name" placeholder="Enter name" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-semibold small">Email <span class="text-danger">*</span></label>
                                <input type="email" class="form-control" name="staff_email" placeholder="Enter email" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-semibold small">Role</label>
                                <select class="form-select" name="staff_role">
                                    <option value="Admin">Admin</option>
                                    <option value="Manager">Manager</option>
                                    <option value="Staff" selected>Staff</option>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-semibold small">Password <span class="text-danger">*</span></label>
                                <input type="password" class="form-control" name="staff_password" placeholder="Enter password" required>
                            </div>
                        </div>
                        <button type="submit" name="add_staff" class="btn btn-primary mt-3">
                            <i class="fas fa-plus"></i> Add Staff
                        </button>
                    </div>

                    <!-- Buttons -->
                    <div class="d-flex gap-3 mt-4">
                        <button type="submit" name="save_settings" class="btn btn-primary px-4 py-2">
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
    // Toggle Staff Management
    function toggleStaffManagement(checkbox) {
        const statusElement = document.getElementById('staffStatus');
        const contentEl = document.getElementById('staffContent');
        
        if (checkbox.checked) {
            // ENABLED - Show all staff content
            if (statusElement) {
                statusElement.textContent = 'Enabled';
                statusElement.className = 'text-success fw-medium small';
            }
            if (contentEl) {
                contentEl.style.display = 'block';
                contentEl.style.opacity = '1';
                contentEl.style.pointerEvents = 'auto';
                // Enable all inputs inside
                const inputs = contentEl.querySelectorAll('input, select');
                inputs.forEach(input => {
                    input.disabled = false;
                    input.style.opacity = '1';
                    input.style.background = '#FFFFFF';
                });
            }
        } else {
            // DISABLED - Hide all staff content
            if (statusElement) {
                statusElement.textContent = 'Disabled';
                statusElement.className = 'text-secondary fw-medium small';
            }
            if (contentEl) {
                contentEl.style.display = 'none';
                contentEl.style.opacity = '0.5';
                contentEl.style.pointerEvents = 'none';
                // Disable all inputs inside
                const inputs = contentEl.querySelectorAll('input, select');
                inputs.forEach(input => {
                    input.disabled = true;
                    input.style.opacity = '0.5';
                    input.style.background = '#F1F5F9';
                });
            }
        }
    }

    // Initialize on page load - ensure content is visible
    document.addEventListener('DOMContentLoaded', function() {
        const mainCheckbox = document.getElementById('staffToggle');
        if (mainCheckbox && mainCheckbox.checked) {
            document.getElementById('staffContent').style.display = 'block';
        }
    });
    </script>
</body>
</html>