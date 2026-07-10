<?php
$current_page = 'settings';
$error_message = '';
$success_message = '';

// Get ID from URL
$id = isset($_GET['id']) ? intval($_GET['id']) : 0;

// Sample data (in real project, fetch from database)
$staffList = [
    1 => ['id' => 1, 'name' => 'John Doe', 'email' => 'john@email.com', 'role' => 'Admin', 'status' => 'Active'],
    2 => ['id' => 2, 'name' => 'Jane Smith', 'email' => 'jane@email.com', 'role' => 'Manager', 'status' => 'Active'],
    3 => ['id' => 3, 'name' => 'Bob Wilson', 'email' => 'bob@email.com', 'role' => 'Staff', 'status' => 'Inactive']
];

$staff = $staffList[$id] ?? null;

if (!$staff) {
    header('Location: staff-management.php');
    exit;
}

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'] ?? '';
    $email = $_POST['email'] ?? '';
    $role = $_POST['role'] ?? 'Staff';
    $status = isset($_POST['status']) ? 'Active' : 'Inactive';
    $password = $_POST['password'] ?? '';
    
    if (empty($name) || empty($email)) {
        $error_message = 'Please fill in all required fields!';
    } else {
        // In real project: UPDATE staff SET name='$name', email='$email', role='$role', status='$status' WHERE id=$id
        $success_message = 'Staff "' . $name . '" updated successfully!';
        echo '<meta http-equiv="refresh" content="2;url=staff-management.php">';
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Staff Member</title>
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
                    <h1 style="font-size: 22px; font-weight: 700; color: #1E293B;">✏️ Edit Staff Member</h1>
                    <p style="font-size: 14px; color: #64748B; margin-top: 4px;">Update staff member details.</p>
                </div>
                <a href="staff-management.php" class="btn btn-secondary" style="padding: 8px 20px; border-radius: 8px; font-weight: 600; background: #F1F5F9; color: #1E293B; text-decoration: none; border: none;">
                    <i class="fas fa-arrow-left"></i> Back to Staff Management
                </a>
            </div>

            <?php if ($success_message): ?>
                <div class="alert alert-success" style="margin-top: 15px; border-radius: 8px;">
                    <i class="fas fa-check-circle"></i> <?php echo $success_message; ?>
                    <br><small>Redirecting to staff list...</small>
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
                <form method="POST" action="" onsubmit="return updateStaffMember();">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-bold">Name <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="name" value="<?php echo htmlspecialchars($staff['name']); ?>" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-bold">Email <span class="text-danger">*</span></label>
                            <input type="email" class="form-control" name="email" value="<?php echo htmlspecialchars($staff['email']); ?>" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-bold">Role</label>
                            <select class="form-control" name="role">
                                <option value="Admin" <?php echo $staff['role'] == 'Admin' ? 'selected' : ''; ?>>Admin</option>
                                <option value="Manager" <?php echo $staff['role'] == 'Manager' ? 'selected' : ''; ?>>Manager</option>
                                <option value="Staff" <?php echo $staff['role'] == 'Staff' ? 'selected' : ''; ?>>Staff</option>
                            </select>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-bold">Password</label>
                            <input type="password" class="form-control" name="password" placeholder="Leave blank to keep current password">
                            <small style="color: #94A3B8; font-size: 12px;">Leave blank to keep current password</small>
                        </div>
                        <div class="col-md-12 mb-3">
                            <label class="form-label fw-bold">Status</label>
                            <div class="form-check mt-2">
                                <input type="checkbox" class="form-check-input" name="status" <?php echo $staff['status'] == 'Active' ? 'checked' : ''; ?>>
                                <label class="form-check-label">Active</label>
                            </div>
                        </div>
                    </div>

                    <div class="d-flex gap-3 mt-3">
                        <button type="submit" class="btn btn-primary" style="padding: 10px 30px; border-radius: 8px; font-weight: 600; background: #2563EB; color: #FFFFFF; border: none;">
                            <i class="fas fa-save"></i> Update Staff
                        </button>
                        <a href="staff-management.php" class="btn btn-secondary" style="padding: 10px 30px; border-radius: 8px; font-weight: 600; background: #F1F5F9; color: #1E293B; text-decoration: none; border: none;">
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