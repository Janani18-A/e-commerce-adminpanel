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
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
    <?php include ('templates/navbar.php'); ?>
    <?php include('templates/sidebar.php'); ?>

    <div class="content-area">
        <div class="settings-container bg-white border rounded-4 overflow-hidden">
            <!-- Header -->
            <div class="settings-header p-4 border-bottom d-flex flex-wrap justify-content-between align-items-center">
                <div>
                    <h1 class="fs-4 fw-bold text-dark mb-0">🧾 Taxes</h1>
                    <p class="text-secondary small mb-0">Set up tax rules, GST settings, and regional tax configurations.</p>
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

            <form method="POST" action="" onsubmit="return saveTaxSettings();" class="p-3">
                <div class="bg-white border rounded-3 p-4">
                    
                    <!-- Enable GST -->
                    <div class="bg-light rounded-3 p-3 d-flex align-items-center gap-3 mb-2">
                        <div class="form-check form-switch mb-0">
                            <input class="form-check-input" type="checkbox" name="enable_gst" value="1" checked 
                                   style="width:48px; height:26px; cursor:pointer;" 
                                   onchange="toggleTaxToggle(this, 'gst')" id="gstToggle">
                        </div>
                        <div class="flex-grow-1">
                            <div class="fw-medium text-dark small">Enable GST</div>
                            <div class="text-secondary small">Enable GST tax calculation</div>
                        </div>
                        <span id="gstStatus" class="text-success fw-medium small">Enabled</span>
                    </div>

                    <!-- GST Percentage - Disabled when GST is OFF -->
                    <div id="gstField" class="mb-3" style="padding-left: 64px;">
                        <label class="form-label fw-semibold small">GST Percentage</label>
                        <select class="form-select" name="gst_percentage" style="max-width: 200px;">
                            <option value="18%">18%</option>
                            <option value="12%">12%</option>
                            <option value="5%">5%</option>
                            <option value="0%">0%</option>
                        </select>
                    </div>

                    <!-- Enable State Tax -->
                    <div class="bg-light rounded-3 p-3 d-flex align-items-center gap-3 mb-2">
                        <div class="form-check form-switch mb-0">
                            <input class="form-check-input" type="checkbox" name="enable_state_tax" value="1" 
                                   style="width:48px; height:26px; cursor:pointer;" 
                                   onchange="toggleTaxToggle(this, 'state')" id="stateTaxToggle">
                        </div>
                        <div class="flex-grow-1">
                            <div class="fw-medium text-dark small">Enable State Tax</div>
                            <div class="text-secondary small">Enable state tax calculation</div>
                        </div>
                        <span id="stateStatus" class="text-secondary fw-medium small">Disabled</span>
                    </div>

                    <!-- Include Tax in Price -->
                    <div class="bg-light rounded-3 p-3 d-flex align-items-center gap-3 mb-3">
                        <div class="form-check form-switch mb-0">
                            <input class="form-check-input" type="checkbox" name="include_tax" value="1" checked 
                                   style="width:48px; height:26px; cursor:pointer;" 
                                   onchange="toggleTaxToggle(this, 'include')" id="includeTaxToggle">
                        </div>
                        <div class="flex-grow-1">
                            <div class="fw-medium text-dark small">Include Tax in Price</div>
                            <div class="text-secondary small">Show price with tax included</div>
                        </div>
                        <span id="includeStatus" class="text-success fw-medium small">Enabled</span>
                    </div>

                    <!-- Tax Rules Table -->
                    <div class="mt-3">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <h6 class="fw-semibold text-dark mb-0">Tax Rules</h6>
                            <a href="add-tax.php" class="btn btn-primary btn-sm">
                                <i class="fas fa-plus"></i> Add Rule
                            </a>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-bordered table-hover">
                                <thead class="table-light">
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
                                            <a href="edit-tax.php?id=1" class="btn btn-primary btn-sm">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <a href="taxes.php?delete=1&id=1" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this tax rule?')">
                                                <i class="fas fa-trash"></i>
                                            </a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Clothing</td>
                                        <td><span class="badge bg-success">5%</span></td>
                                        <td>All States</td>
                                        <td>
                                            <a href="edit-tax.php?id=2" class="btn btn-primary btn-sm">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <a href="taxes.php?delete=1&id=2" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this tax rule?')">
                                                <i class="fas fa-trash"></i>
                                            </a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Books</td>
                                        <td><span class="badge bg-secondary">0%</span></td>
                                        <td>All States</td>
                                        <td>
                                            <a href="edit-tax.php?id=3" class="btn btn-primary btn-sm">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <a href="taxes.php?delete=1&id=3" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this tax rule?')">
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
    <script src="assets/js/script.js"></script>

    <script>
    // Toggle Tax Settings
    function toggleTaxToggle(checkbox, type) {
        const statusMap = {
            'gst': { statusId: 'gstStatus', fieldId: 'gstField' },
            'state': { statusId: 'stateStatus', fieldId: null },
            'include': { statusId: 'includeStatus', fieldId: null }
        };

        const config = statusMap[type];
        const statusEl = document.getElementById(config.statusId);
        const fieldEl = config.fieldId ? document.getElementById(config.fieldId) : null;

        if (checkbox.checked) {
            // ENABLED
            if (statusEl) {
                statusEl.textContent = 'Enabled';
                statusEl.className = 'text-success fw-medium small';
            }
            // Enable the field (remove disabled state)
            if (fieldEl) {
                fieldEl.style.opacity = '1';
                fieldEl.style.pointerEvents = 'auto';
                const select = fieldEl.querySelector('select');
                if (select) {
                    select.disabled = false;
                    select.style.opacity = '1';
                    select.style.background = '#FFFFFF';
                }
            }
        } else {
            // DISABLED
            if (statusEl) {
                statusEl.textContent = 'Disabled';
                statusEl.className = 'text-secondary fw-medium small';
            }
            // Disable the field (grey out)
            if (fieldEl) {
                fieldEl.style.opacity = '0.5';
                fieldEl.style.pointerEvents = 'none';
                const select = fieldEl.querySelector('select');
                if (select) {
                    select.disabled = true;
                    select.style.opacity = '0.5';
                    select.style.background = '#F1F5F9';
                }
            }
        }
    }

    // Save Tax Settings
    function saveTaxSettings() {
        const gst = document.querySelector('input[name="enable_gst"]')?.checked;
        const stateTax = document.querySelector('input[name="enable_state_tax"]')?.checked;
        const includeTax = document.querySelector('input[name="include_tax"]')?.checked;
        const gstPercent = document.querySelector('select[name="gst_percentage"]')?.value;

        const enabled = [];
        if (gst) enabled.push('GST (' + gstPercent + ')');
        if (stateTax) enabled.push('State Tax');
        if (includeTax) enabled.push('Tax Included in Price');

        if (typeof showToast === 'function') {
            if (enabled.length > 0) {
                showToast('✅ Tax settings saved! (' + enabled.join(', ') + ')', 'success');
            } else {
                showToast('✅ All taxes disabled!', 'info');
            }
        }

        return true;
    }

    // Initialize on page load
    document.addEventListener('DOMContentLoaded', function() {
        // Set initial states for all toggles
        const gstCheckbox = document.getElementById('gstToggle');
        if (gstCheckbox && gstCheckbox.checked) {
            document.getElementById('gstField').style.opacity = '1';
            document.getElementById('gstField').style.pointerEvents = 'auto';
        }
    });
    </script>
</body>
</html>