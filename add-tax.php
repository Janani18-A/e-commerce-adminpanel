<?php
$current_page = 'settings';
$error_message = '';
$success_message = '';

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $category = $_POST['category'] ?? '';
    $tax_percent = $_POST['tax_percent'] ?? '';
    $applicable = $_POST['applicable'] ?? '';
    
    if (empty($category) || empty($tax_percent) || empty($applicable)) {
        $error_message = 'Please fill in all required fields!';
    } else {
        // In real project: INSERT INTO tax_rules (category, tax, applicable) VALUES (...)
        $success_message = 'Tax rule "' . $category . '" added successfully!';
        
        // Redirect after 2 seconds
        echo '<meta http-equiv="refresh" content="2;url=taxes.php">';
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Tax Rule</title>
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
                    <h1 class="fs-4 fw-bold text-dark mb-0">➕ Add Tax Rule</h1>
                    <p class="text-secondary small mb-0">Add a new tax rule for your store.</p>
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
                <form method="POST" action="" onsubmit="return saveTaxRule();">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label fw-semibold small">Category <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="category" placeholder="e.g., Electronics" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold small">Tax Percentage <span class="text-danger">*</span></label>
                            <select class="form-select" name="tax_percent" required>
                                <option value="">Select Tax %</option>
                                <option value="0%">0%</option>
                                <option value="5%">5%</option>
                                <option value="12%">12%</option>
                                <option value="18%">18%</option>
                                <option value="28%">28%</option>
                            </select>
                        </div>
                        <div class="col-md-12">
                            <label class="form-label fw-semibold small">Applicable <span class="text-danger">*</span></label>
                            <select class="form-select" name="applicable" required>
                                <option value="">Select Applicable Region</option>
                                <option value="All States">All States</option>
                                <option value="Tamil Nadu">Tamil Nadu</option>
                                <option value="Kerala">Kerala</option>
                                <option value="Karnataka">Karnataka</option>
                                <option value="Andhra Pradesh">Andhra Pradesh</option>
                                <option value="Telangana">Telangana</option>
                                <option value="Maharashtra">Maharashtra</option>
                                <option value="Gujarat">Gujarat</option>
                                <option value="Rajasthan">Rajasthan</option>
                                <option value="Delhi">Delhi</option>
                                <option value="Uttar Pradesh">Uttar Pradesh</option>
                                <option value="West Bengal">West Bengal</option>
                            </select>
                        </div>
                    </div>

                    <!-- Buttons -->
                    <div class="d-flex gap-3 mt-4">
                        <button type="submit" class="btn btn-primary px-4 py-2">
                            <i class="fas fa-save"></i> Add Tax Rule
                        </button>
                        <a href="taxes.php" class="btn btn-light border px-4 py-2">
                            Cancel
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="../assets/js/script.js"></script>

    <script>
    function saveTaxRule() {
        // Your existing save logic
        // Validate form if needed
        return true; // Allow form submission
    }
    </script>
</body>
</html>