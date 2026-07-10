<?php
$current_page = 'settings';
$success_message = '';
$error_message = '';

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $enable_gst = isset($_POST['enable_gst']) ? 1 : 0;
    $gst_percentage = $_POST['gst_percentage'] ?? '18%';
    $enable_state_tax = isset($_POST['enable_state_tax']) ? 1 : 0;
    $include_tax = isset($_POST['include_tax']) ? 1 : 0;
    
    $success_message = 'Tax settings saved successfully!';
}

// Handle Delete
if (isset($_GET['delete']) && isset($_GET['id'])) {
    $deleteId = $_GET['id'];
    // In real project: DELETE FROM tax_rules WHERE id = $deleteId
    $success_message = 'Tax rule deleted successfully!';
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Taxes - Settings</title>
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
                    <h1 style="font-size: 22px; font-weight: 700; color: #1E293B;">🧾 Taxes</h1>
                    <p style="font-size: 14px; color: #64748B; margin-top: 4px;">Set up tax rules, GST settings, and regional tax configurations.</p>
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

            <form method="POST" action="" onsubmit="return saveTaxSettings();">
                <div style="background: #FFFFFF; border-radius: 12px; border: 1px solid #DBEAFE; padding: 30px; margin-top: 20px;">
                    
                    <!-- Enable GST -->
                    <div class="toggle-group" style="display: flex; align-items: center; gap: 12px; padding: 12px 16px; background: #F8FAFC; border-radius: 10px; margin-bottom: 10px;">
                        <label class="toggle-switch" style="position: relative; width: 48px; height: 26px; flex-shrink: 0; cursor: pointer;">
                            <input type="checkbox" name="enable_gst" value="1" checked 
                                   style="opacity: 0; width: 0; height: 0; position: absolute;" 
                                   onchange="toggleTaxToggle(this, 'gst')">
                            <span style="position: absolute; cursor: pointer; top: 0; left: 0; right: 0; bottom: 0; background: #2563EB; border-radius: 34px; transition: 0.3s;">
                                <span style="position: absolute; height: 20px; width: 20px; left: 3px; bottom: 3px; background: #FFFFFF; border-radius: 50%; transition: 0.3s; transform: translateX(22px);"></span>
                            </span>
                        </label>
                        <div>
                            <div style="font-size: 14px; color: #1E293B; font-weight: 500;">Enable GST</div>
                            <div style="font-size: 12px; color: #94A3B8; margin-top: 2px;">Enable GST tax calculation</div>
                        </div>
                        <span id="gstStatus" style="margin-left: auto; font-size: 12px; color: #10B981; font-weight: 500;">Enabled</span>
                    </div>

                    <!-- GST Percentage - Disabled when GST is OFF -->
                    <div id="gstField" class="mb-3" style="padding-left: 64px;">
                        <label class="form-label fw-bold">GST Percentage</label>
                        <select class="form-control" name="gst_percentage" style="max-width: 200px;">
                            <option value="18%">18%</option>
                            <option value="12%">12%</option>
                            <option value="5%">5%</option>
                            <option value="0%">0%</option>
                        </select>
                    </div>

                    <!-- Enable State Tax -->
                    <div class="toggle-group" style="display: flex; align-items: center; gap: 12px; padding: 12px 16px; background: #F8FAFC; border-radius: 10px; margin-bottom: 10px;">
                        <label class="toggle-switch" style="position: relative; width: 48px; height: 26px; flex-shrink: 0; cursor: pointer;">
                            <input type="checkbox" name="enable_state_tax" value="1" 
                                   style="opacity: 0; width: 0; height: 0; position: absolute;" 
                                   onchange="toggleTaxToggle(this, 'state')">
                            <span style="position: absolute; cursor: pointer; top: 0; left: 0; right: 0; bottom: 0; background: #CBD5E1; border-radius: 34px; transition: 0.3s;">
                                <span style="position: absolute; height: 20px; width: 20px; left: 3px; bottom: 3px; background: #FFFFFF; border-radius: 50%; transition: 0.3s;"></span>
                            </span>
                        </label>
                        <div>
                            <div style="font-size: 14px; color: #1E293B; font-weight: 500;">Enable State Tax</div>
                            <div style="font-size: 12px; color: #94A3B8; margin-top: 2px;">Enable state tax calculation</div>
                        </div>
                        <span id="stateStatus" style="margin-left: auto; font-size: 12px; color: #94A3B8; font-weight: 500;">Disabled</span>
                    </div>

                    <!-- Include Tax in Price -->
                    <div class="toggle-group" style="display: flex; align-items: center; gap: 12px; padding: 12px 16px; background: #F8FAFC; border-radius: 10px; margin-bottom: 20px;">
                        <label class="toggle-switch" style="position: relative; width: 48px; height: 26px; flex-shrink: 0; cursor: pointer;">
                            <input type="checkbox" name="include_tax" value="1" checked 
                                   style="opacity: 0; width: 0; height: 0; position: absolute;" 
                                   onchange="toggleTaxToggle(this, 'include')">
                            <span style="position: absolute; cursor: pointer; top: 0; left: 0; right: 0; bottom: 0; background: #2563EB; border-radius: 34px; transition: 0.3s;">
                                <span style="position: absolute; height: 20px; width: 20px; left: 3px; bottom: 3px; background: #FFFFFF; border-radius: 50%; transition: 0.3s; transform: translateX(22px);"></span>
                            </span>
                        </label>
                        <div>
                            <div style="font-size: 14px; color: #1E293B; font-weight: 500;">Include Tax in Price</div>
                            <div style="font-size: 12px; color: #94A3B8; margin-top: 2px;">Show price with tax included</div>
                        </div>
                        <span id="includeStatus" style="margin-left: auto; font-size: 12px; color: #10B981; font-weight: 500;">Enabled</span>
                    </div>

                    <!-- Tax Rules Table -->
                    <div style="margin-top: 20px;">
                        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 12px;">
                            <h6 style="font-weight: 600; color: #1E293B; margin: 0;">Tax Rules</h6>
                            <a href="add-tax.php" class="btn btn-primary btn-sm" style="background: #2563EB; border: none; padding: 6px 15px; border-radius: 6px; color: #FFFFFF; text-decoration: none;">
                                <i class="fas fa-plus"></i> Add Rule
                            </a>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead style="background: #F8FAFC;">
                                    <tr>
                                        <th>Category</th>
                                        <th>Tax %</th>
                                        <th>Applicable</th>
                                        <th style="width: 120px;">Action</th>
                                    </tr>
                                </thead>
                                <tbody id="taxRulesList">
                                    <tr>
                                        <td>Electronics</td>
                                        <td><span class="badge bg-primary">18%</span></td>
                                        <td>All States</td>
                                        <td>
                                            <a href="edit-tax.php?id=1" class="btn btn-sm btn-primary" style="padding: 3px 8px; margin-right: 3px;">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <a href="taxes.php?delete=1&id=1" class="btn btn-sm btn-danger" style="padding: 3px 8px;" onclick="return confirm('Are you sure you want to delete this tax rule?')">
                                                <i class="fas fa-trash"></i>
                                            </a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Clothing</td>
                                        <td><span class="badge bg-success">5%</span></td>
                                        <td>All States</td>
                                        <td>
                                            <a href="edit-tax.php?id=2" class="btn btn-sm btn-primary" style="padding: 3px 8px; margin-right: 3px;">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <a href="taxes.php?delete=1&id=2" class="btn btn-sm btn-danger" style="padding: 3px 8px;" onclick="return confirm('Are you sure you want to delete this tax rule?')">
                                                <i class="fas fa-trash"></i>
                                            </a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Books</td>
                                        <td><span class="badge bg-secondary">0%</span></td>
                                        <td>All States</td>
                                        <td>
                                            <a href="edit-tax.php?id=3" class="btn btn-sm btn-primary" style="padding: 3px 8px; margin-right: 3px;">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <a href="taxes.php?delete=1&id=3" class="btn btn-sm btn-danger" style="padding: 3px 8px;" onclick="return confirm('Are you sure you want to delete this tax rule?')">
                                                <i class="fas fa-trash"></i>
                                            </a>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>

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