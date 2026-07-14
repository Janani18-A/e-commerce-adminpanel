<?php
include 'config/config.php';
?>

<?php
$current_page = 'settings';
$error_message = '';
$success_message = '';

// Get ID from URL
$id = isset($_GET['id']) ? intval($_GET['id']) : 0;

// In real project: SELECT * FROM tax_rules WHERE id = $id
// For demo, use sample data
$taxRules = [
    1 => ['id' => 1, 'category' => 'Electronics', 'tax' => '18%', 'applicable' => 'All States'],
    2 => ['id' => 2, 'category' => 'Clothing', 'tax' => '5%', 'applicable' => 'All States'],
    3 => ['id' => 3, 'category' => 'Books', 'tax' => '0%', 'applicable' => 'All States']
];

$rule = $taxRules[$id] ?? null;

if (!$rule) {
    header('Location: taxes.php');
    exit;
}

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $category = $_POST['category'] ?? '';
    $tax_percent = $_POST['tax_percent'] ?? '';
    $applicable = $_POST['applicable'] ?? '';
    
    if (empty($category) || empty($tax_percent) || empty($applicable)) {
        $error_message = 'Please fill in all required fields!';
    } else {
        // In real project: UPDATE tax_rules SET ...
        $success_message = 'Tax rule "' . $category . '" updated successfully!';
        
        // Redirect after 2 seconds
        echo '<meta http-equiv="refresh" content="2;url=taxes.php">';
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
            <!-- Header -->
            <div class="settings-header p-4 border-bottom d-flex flex-wrap justify-content-between align-items-center">
                <div>
                    <h1 class="fs-4 fw-bold text-dark mb-0">✏️ Edit Tax Rule</h1>
                    <p class="text-secondary small mb-0">Update tax rule details.</p>
                </div>
                <a href="taxes.php" class="btn btn-light border mt-2 mt-sm-0">
                    <i class="fas fa-arrow-left"></i> Back to Taxes
                </a>
            </div>

            <?php if ($success_message): ?>
                <div class="alert alert-success m-3 rounded-3">
                    <i class="fas fa-check-circle"></i> <?php echo $success_message; ?>
                    <br><small class="text-secondary">Redirecting to tax rules list...</small>
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

            <!-- Form Content -->
            <div class="bg-white border rounded-3 p-4 m-3">
                <form method="POST" action="" onsubmit="return updateTaxRule();">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label fw-semibold small">Category <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="category" value="<?php echo htmlspecialchars($rule['category']); ?>" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold small">Tax Percentage <span class="text-danger">*</span></label>
                            <select class="form-select" name="tax_percent" required>
                                <option value="">Select Tax %</option>
                                <option value="0%" <?php echo $rule['tax'] == '0%' ? 'selected' : ''; ?>>0%</option>
                                <option value="5%" <?php echo $rule['tax'] == '5%' ? 'selected' : ''; ?>>5%</option>
                                <option value="12%" <?php echo $rule['tax'] == '12%' ? 'selected' : ''; ?>>12%</option>
                                <option value="18%" <?php echo $rule['tax'] == '18%' ? 'selected' : ''; ?>>18%</option>
                                <option value="28%" <?php echo $rule['tax'] == '28%' ? 'selected' : ''; ?>>28%</option>
                            </select>
                        </div>
                        <div class="col-md-12">
                            <label class="form-label fw-semibold small">Applicable <span class="text-danger">*</span></label>
                            <select class="form-select" name="applicable" required>
                                <option value="">Select Applicable Region</option>
                                <option value="All States" <?php echo $rule['applicable'] == 'All States' ? 'selected' : ''; ?>>All States</option>
                                <option value="Tamil Nadu" <?php echo $rule['applicable'] == 'Tamil Nadu' ? 'selected' : ''; ?>>Tamil Nadu</option>
                                <option value="Kerala" <?php echo $rule['applicable'] == 'Kerala' ? 'selected' : ''; ?>>Kerala</option>
                                <option value="Karnataka" <?php echo $rule['applicable'] == 'Karnataka' ? 'selected' : ''; ?>>Karnataka</option>
                                <option value="Andhra Pradesh" <?php echo $rule['applicable'] == 'Andhra Pradesh' ? 'selected' : ''; ?>>Andhra Pradesh</option>
                                <option value="Telangana" <?php echo $rule['applicable'] == 'Telangana' ? 'selected' : ''; ?>>Telangana</option>
                                <option value="Maharashtra" <?php echo $rule['applicable'] == 'Maharashtra' ? 'selected' : ''; ?>>Maharashtra</option>
                                <option value="Gujarat" <?php echo $rule['applicable'] == 'Gujarat' ? 'selected' : ''; ?>>Gujarat</option>
                                <option value="Rajasthan" <?php echo $rule['applicable'] == 'Rajasthan' ? 'selected' : ''; ?>>Rajasthan</option>
                                <option value="Delhi" <?php echo $rule['applicable'] == 'Delhi' ? 'selected' : ''; ?>>Delhi</option>
                                <option value="Uttar Pradesh" <?php echo $rule['applicable'] == 'Uttar Pradesh' ? 'selected' : ''; ?>>Uttar Pradesh</option>
                                <option value="West Bengal" <?php echo $rule['applicable'] == 'West Bengal' ? 'selected' : ''; ?>>West Bengal</option>
                            </select>
                        </div>
                    </div>

                    <!-- Buttons -->
                    <div class="d-flex gap-3 mt-4">
                        <button type="submit" class="btn btn-primary px-4 py-2">
                            <i class="fas fa-save"></i> Update Tax Rule
                        </button>
                        <a href="taxes.php" class="btn btn-light border px-4 py-2">
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
    function updateTaxRule() {
        // Your existing update logic
        // Validate form if needed
        return true; // Allow form submission
    }
    </script>
</body>
</html>