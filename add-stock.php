<?php
$current_page = 'stock-management';
session_start();

// Initialize stock items in session if not exists
if (!isset($_SESSION['stock_items']) || empty($_SESSION['stock_items'])) {
    $_SESSION['stock_items'] = [
        ['id' => 1, 'item_name' => 'Item Alpha', 'sku' => 'STK-001', 'category' => 'Raw Materials', 'quantity' => 150, 'unit' => 'kg', 'supplier' => 'Supplier A', 'location' => 'Warehouse 1', 'status' => 'In Stock', 'badge' => 'success', 'color' => '2563EB', 'image' => ''],
        ['id' => 2, 'item_name' => 'Item Beta', 'sku' => 'STK-002', 'category' => 'Packaging', 'quantity' => 25, 'unit' => 'boxes', 'supplier' => 'Supplier B', 'location' => 'Warehouse 2', 'status' => 'Low Stock', 'badge' => 'warning', 'color' => 'F59E0B', 'image' => ''],
        ['id' => 3, 'item_name' => 'Item Gamma', 'sku' => 'STK-003', 'category' => 'Finished Goods', 'quantity' => 0, 'unit' => 'units', 'supplier' => 'Supplier C', 'location' => 'Warehouse 1', 'status' => 'Out of Stock', 'badge' => 'danger', 'color' => 'EF4444', 'image' => ''],
        ['id' => 4, 'item_name' => 'Item Delta', 'sku' => 'STK-004', 'category' => 'Raw Materials', 'quantity' => 75, 'unit' => 'liters', 'supplier' => 'Supplier A', 'location' => 'Warehouse 3', 'status' => 'In Stock', 'badge' => 'success', 'color' => '8B5CF6', 'image' => ''],
        ['id' => 5, 'item_name' => 'Item Epsilon', 'sku' => 'STK-005', 'category' => 'Packaging', 'quantity' => 120, 'unit' => 'rolls', 'supplier' => 'Supplier D', 'location' => 'Warehouse 2', 'status' => 'In Stock', 'badge' => 'success', 'color' => '06B6D4', 'image' => ''],
        ['id' => 6, 'item_name' => 'Item Zeta', 'sku' => 'STK-006', 'category' => 'Finished Goods', 'quantity' => 8, 'unit' => 'units', 'supplier' => 'Supplier B', 'location' => 'Warehouse 1', 'status' => 'Low Stock', 'badge' => 'warning', 'color' => '1E293B', 'image' => '']
    ];
}

// Handle form submission on same page
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add_stock_item'])) {
    $item_name = trim($_POST['item_name'] ?? '');
    $sku = trim($_POST['sku'] ?? '');
    $category = trim($_POST['category'] ?? '');
    $quantity = intval($_POST['quantity'] ?? 0);
    $unit = trim($_POST['unit'] ?? '');
    $supplier = trim($_POST['supplier'] ?? '');
    $location = trim($_POST['location'] ?? '');
    $status = trim($_POST['status'] ?? 'In Stock');
    $description = trim($_POST['description'] ?? '');
    $image = $_POST['item_image'] ?? '';
    
    if (!empty($item_name) && !empty($sku) && $quantity >= 0 && !empty($unit)) {
        $badge = 'success';
        if ($status === 'Low Stock') $badge = 'warning';
        if ($status === 'Out of Stock') $badge = 'danger';
        
        $colors = ['2563EB', 'F59E0B', 'EF4444', '8B5CF6', '06B6D4', '1E293B', 'EC4899', '10B981'];
        $color = $colors[array_rand($colors)];
        
        $newItem = [
            'id' => count($_SESSION['stock_items']) + 1,
            'item_name' => $item_name,
            'sku' => $sku,
            'category' => $category ?: 'Uncategorized',
            'quantity' => $quantity,
            'unit' => $unit,
            'supplier' => $supplier ?: 'N/A',
            'location' => $location ?: 'N/A',
            'status' => $status,
            'badge' => $badge,
            'color' => $color,
            'description' => $description,
            'image' => $image
        ];
        
        $_SESSION['stock_items'][] = $newItem;
        $success = true;
        $successMessage = "Stock item '$item_name' added successfully!";
        $itemId = $newItem['id'];
        
        // Clear form data
        $_POST = array();
    } else {
        $error = "Please fill all required fields correctly.";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Stock Item - Admin Panel</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/style.css">

    <style>
        .form-section {
            background: #FFFFFF;
            border-radius: 0.75rem;
            border: 1px solid #E2E8F0;
            padding: 2rem;
        }
        .form-section .form-label { 
            font-weight: 500; 
            color: #1E293B; 
            font-size: 0.875rem;
        }
        .form-section .form-control,
        .form-section .form-select {
            border-radius: 0.5rem;
            border-color: #E2E8F0;
            font-size: 0.875rem;
        }
        .form-section .form-control:focus,
        .form-section .form-select:focus {
            border-color: #2563EB;
            box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.15);
        }
        .breadcrumb-custom {
            font-size: 0.9rem;
            color: #64748B;
        }
        .breadcrumb-custom a { 
            color: #2563EB; 
            text-decoration: none;
            cursor: pointer;
        }
        .breadcrumb-custom a:hover { 
            text-decoration: underline; 
        }
        .breadcrumb-custom i { 
            margin: 0 8px; 
            font-size: 0.7rem; 
            color: #94A3B8; 
        }
        .alert-success-custom {
            background: #D1FAE5;
            color: #065F46;
            border-left: 4px solid #10B981;
            padding: 12px 16px;
            border-radius: 8px;
            margin-bottom: 1rem;
            display: flex;
            align-items: center;
            justify-content: space-between;
            flex-wrap: wrap;
        }
        .alert-success-custom .alert-link {
            color: #2563EB;
            font-weight: 600;
            text-decoration: none;
            padding: 4px 12px;
            background: white;
            border-radius: 6px;
            transition: all 0.3s ease;
        }
        .alert-success-custom .alert-link:hover {
            background: #DBEAFE;
            text-decoration: underline;
        }
        .alert-error-custom {
            background: #FEE2E2;
            color: #991B1B;
            border-left: 4px solid #EF4444;
            padding: 12px 16px;
            border-radius: 8px;
            margin-bottom: 1rem;
        }
        .sidebar-toggle {
            display: none;
            background: transparent;
            border: none;
            color: #1E293B;
            font-size: 1.2rem;
            padding: 0 10px;
        }
        .required-star {
            color: #EF4444;
        }

        /* Responsive */
        @media (max-width: 767.98px) {
            .sidebar-wrapper { width: 0; transform: translateX(-100%); transition: all 0.3s ease; }
            .sidebar-wrapper.open { width: 280px; transform: translateX(0); }
            .main-content { margin-left: 0; padding: 10px 12px; }
            .sidebar-toggle { display: block !important; }
            .form-section { padding: 1rem; }
            .alert-success-custom { flex-direction: column; gap: 8px; align-items: flex-start; }
        }
        @media (max-width: 479.98px) {
            .main-content { padding: 6px 8px; }
            .form-section { padding: 0.75rem; }
        }
    </style>
</head>
<body>
    <!-- Navbar -->
    <?php include 'templates/navbar.php'; ?>
    
    <!-- Sidebar -->
     <?php include 'templates/sidebar.php'; ?>

    <!-- Main Content -->
    <div class="content-area main-content">
        <div id="add-stock-page" class="page-section active-page">
            
            <!-- Breadcrumb -->
            <div class="breadcrumb-custom mb-3">
                <a href="dashboard.php"><i class="fas fa-home"></i> Dashboard</a>
                <i class="fas fa-chevron-right"></i>
                <a href="stock-management.php">Stock Management</a>
                <i class="fas fa-chevron-right"></i>
                <span>Add Stock Item</span>
            </div>

            <!-- Page Header -->
            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                <h1 class="h2"><i class="fas fa-boxes me-2 text-primary"></i> Add Stock Item</h1>
                <div class="btn-toolbar mb-2 mb-md-0">
                    <div class="btn-group me-2">
                        <a href="stock-management.php" class="btn btn-sm btn-outline-secondary">
                            <i class="fas fa-arrow-left me-1"></i> Back to Stock
                        </a>
                    </div>
                </div>
            </div>

            <!-- Success Message -->
            <?php if (isset($success) && $success): ?>
            <div class="alert-success-custom">
                <span>
                    <i class="fas fa-check-circle me-2"></i> 
                    <strong><?= $successMessage ?></strong>
                </span>
                <div class="d-flex gap-2 flex-wrap">
                    <a href="stock-management.php" class="alert-link">
                        <i class="fas fa-list me-1"></i> View All Stock
                    </a>
                    <a href="add-stock-item.php" class="alert-link">
                        <i class="fas fa-plus me-1"></i> Add Another
                    </a>
                </div>
            </div>
            <?php endif; ?>

            <?php if (isset($error)): ?>
            <div class="alert-error-custom">
                <i class="fas fa-exclamation-circle me-2"></i> <?= $error ?>
            </div>
            <?php endif; ?>

            <!-- Form -->
            <div class="form-section">
                <form id="addStockForm" action="" method="POST">
                    <input type="hidden" name="add_stock_item" value="1">
                    
                    <!-- Item Name & SKU -->
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Item Name <span class="required-star">*</span></label>
                            <input type="text" class="form-control" id="itemName" name="item_name" placeholder="Enter item name" value="<?= htmlspecialchars($_POST['item_name'] ?? '') ?>" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">SKU <span class="required-star">*</span></label>
                            <input type="text" class="form-control" id="itemSku" name="sku" placeholder="Enter SKU" value="<?= htmlspecialchars($_POST['sku'] ?? '') ?>" required>
                        </div>
                    </div>

                    <!-- Category & Unit -->
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Category</label>
                            <select class="form-select" id="itemCategory" name="category">
                                <option value="">Select Category</option>
                                <option value="Raw Materials" <?= ($_POST['category'] ?? '') === 'Raw Materials' ? 'selected' : '' ?>>Raw Materials</option>
                                <option value="Packaging" <?= ($_POST['category'] ?? '') === 'Packaging' ? 'selected' : '' ?>>Packaging</option>
                                <option value="Finished Goods" <?= ($_POST['category'] ?? '') === 'Finished Goods' ? 'selected' : '' ?>>Finished Goods</option>
                                <option value="Supplies" <?= ($_POST['category'] ?? '') === 'Supplies' ? 'selected' : '' ?>>Supplies</option>
                                <option value="Equipment" <?= ($_POST['category'] ?? '') === 'Equipment' ? 'selected' : '' ?>>Equipment</option>
                            </select>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Unit <span class="required-star">*</span></label>
                            <select class="form-select" id="itemUnit" name="unit" required>
                                <option value="">Select Unit</option>
                                <option value="kg" <?= ($_POST['unit'] ?? '') === 'kg' ? 'selected' : '' ?>>Kilogram (kg)</option>
                                <option value="g" <?= ($_POST['unit'] ?? '') === 'g' ? 'selected' : '' ?>>Gram (g)</option>
                                <option value="liters" <?= ($_POST['unit'] ?? '') === 'liters' ? 'selected' : '' ?>>Liters (L)</option>
                                <option value="ml" <?= ($_POST['unit'] ?? '') === 'ml' ? 'selected' : '' ?>>Milliliters (ml)</option>
                                <option value="units" <?= ($_POST['unit'] ?? '') === 'units' ? 'selected' : '' ?>>Units</option>
                                <option value="boxes" <?= ($_POST['unit'] ?? '') === 'boxes' ? 'selected' : '' ?>>Boxes</option>
                                <option value="rolls" <?= ($_POST['unit'] ?? '') === 'rolls' ? 'selected' : '' ?>>Rolls</option>
                                <option value="pcs" <?= ($_POST['unit'] ?? '') === 'pcs' ? 'selected' : '' ?>>Pieces (pcs)</option>
                                <option value="packs" <?= ($_POST['unit'] ?? '') === 'packs' ? 'selected' : '' ?>>Packs</option>
                            </select>
                        </div>
                    </div>

                    <!-- Quantity & Status -->
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Quantity <span class="required-star">*</span></label>
                            <input type="number" class="form-control" id="itemQuantity" name="quantity" placeholder="0" min="0" value="<?= htmlspecialchars($_POST['quantity'] ?? '') ?>" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Status</label>
                            <select class="form-select" id="itemStatus" name="status">
                                <option value="In Stock" <?= ($_POST['status'] ?? 'In Stock') === 'In Stock' ? 'selected' : '' ?>>In Stock</option>
                                <option value="Low Stock" <?= ($_POST['status'] ?? '') === 'Low Stock' ? 'selected' : '' ?>>Low Stock</option>
                                <option value="Out of Stock" <?= ($_POST['status'] ?? '') === 'Out of Stock' ? 'selected' : '' ?>>Out of Stock</option>
                            </select>
                        </div>
                    </div>

                    <!-- Supplier & Location -->
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Supplier</label>
                            <input type="text" class="form-control" id="itemSupplier" name="supplier" placeholder="Enter supplier name" value="<?= htmlspecialchars($_POST['supplier'] ?? '') ?>">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Location</label>
                            <input type="text" class="form-control" id="itemLocation" name="location" placeholder="Enter storage location" value="<?= htmlspecialchars($_POST['location'] ?? '') ?>">
                        </div>
                    </div>

                    <!-- Description -->
                    <div class="mb-3">
                        <label class="form-label">Description</label>
                        <textarea class="form-control" id="itemDescription" name="description" rows="4" placeholder="Item description (optional)"><?= htmlspecialchars($_POST['description'] ?? '') ?></textarea>
                    </div>

                    <!-- Buttons -->
                    <div class="d-flex gap-2 flex-wrap">
                        <button type="submit" class="btn btn-primary" id="saveItemBtn">
                            <i class="fas fa-save me-1"></i> Save Stock Item
                        </button>
                        <a href="stock-management.php" class="btn btn-secondary">
                            <i class="fas fa-times me-1"></i> Cancel
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="assets/js/script.js"></script>
    
    <script>
        document.addEventListener('DOMContentLoaded', function () {

            // ---- FORM VALIDATION BEFORE SUBMIT ----
            document.getElementById('addStockForm')?.addEventListener('submit', function(e) {
                var itemName = document.getElementById('itemName')?.value.trim() || '';
                var sku = document.getElementById('itemSku')?.value.trim() || '';
                var quantity = document.getElementById('itemQuantity')?.value || '';
                var unit = document.getElementById('itemUnit')?.value || '';

                if (!itemName) {
                    e.preventDefault();
                    alert('Please enter item name');
                    document.getElementById('itemName').focus();
                    return false;
                }
                if (!sku) {
                    e.preventDefault();
                    alert('Please enter SKU');
                    document.getElementById('itemSku').focus();
                    return false;
                }
                if (quantity === '' || parseInt(quantity) < 0) {
                    e.preventDefault();
                    alert('Please enter valid quantity (0 or more)');
                    document.getElementById('itemQuantity').focus();
                    return false;
                }
                if (!unit) {
                    e.preventDefault();
                    alert('Please select a unit');
                    document.getElementById('itemUnit').focus();
                    return false;
                }
                return true;
            });

            // ---- AUTO UPDATE STATUS BASED ON QUANTITY ----
            document.getElementById('itemQuantity')?.addEventListener('input', function() {
                var qty = parseInt(this.value) || 0;
                var statusSelect = document.getElementById('itemStatus');
                if (qty <= 0) {
                    statusSelect.value = 'Out of Stock';
                } else if (qty <= 10) {
                    statusSelect.value = 'Low Stock';
                } else {
                    statusSelect.value = 'In Stock';
                }
            });

            // ---- SIDEBAR TOGGLE (Mobile) ----
            var sidebarToggle = document.querySelector('.sidebar-toggle');
            if (sidebarToggle) {
                sidebarToggle.addEventListener('click', function () {
                    document.querySelector('.sidebar-wrapper')?.classList.toggle('open');
                });
            }

            document.addEventListener('click', function (e) {
                if (window.innerWidth < 768) {
                    var sidebar = document.querySelector('.sidebar-wrapper');
                    var toggle = document.querySelector('.sidebar-toggle');
                    if (sidebar && toggle && !sidebar.contains(e.target) && !toggle.contains(e.target)) {
                        sidebar.classList.remove('open');
                    }
                }
            });

            // ---- AUTO FOCUS ON FIRST FIELD ----
            document.getElementById('itemName')?.focus();

            console.log('Add Stock Item page initialized');
        });
    </script>
</body>
</html>