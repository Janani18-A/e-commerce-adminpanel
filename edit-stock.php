<?php
$current_page = 'stock';
session_start();

// Get stock ID from URL
$stockId = isset($_GET['id']) ? intval($_GET['id']) : 0;

// Find the stock item in session
$stockItem = null;
if (isset($_SESSION['stock_items'])) {
    foreach ($_SESSION['stock_items'] as $item) {
        if ($item['id'] === $stockId) {
            $stockItem = $item;
            break;
        }
    }
}

// If stock item not found, redirect
if (!$stockItem) {
    header('Location: stock-management.php');
    exit;
}

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update_stock'])) {
    $id = intval($_POST['stock_id'] ?? 0);
    $name = trim($_POST['stock_name'] ?? '');
    $category = trim($_POST['stock_category'] ?? '');
    $stock = intval($_POST['stock_quantity'] ?? 0);
    $min = intval($_POST['stock_min'] ?? 0);
    $max = intval($_POST['stock_max'] ?? 0);
    
    if ($id > 0 && !empty($name) && $stock >= 0) {
        foreach ($_SESSION['stock_items'] as &$item) {
            if ($item['id'] === $id) {
                $badge = 'success';
                $status = 'In Stock';
                if ($stock <= 0) {
                    $badge = 'danger';
                    $status = 'Out of Stock';
                } elseif ($stock <= 10) {
                    $badge = 'warning';
                    $status = 'Low Stock';
                }
                
                $item['name'] = $name;
                $item['category'] = $category ?: 'Uncategorized';
                $item['stock'] = $stock;
                $item['min'] = $min ?: 10;
                $item['max'] = $max ?: 100;
                $item['status'] = $status;
                $item['badge'] = $badge;
                break;
            }
        }
        
        $success = true;
        $successMessage = "Stock item '$name' updated successfully!";
        
        // Update stockItem variable
        foreach ($_SESSION['stock_items'] as $item) {
            if ($item['id'] === $stockId) {
                $stockItem = $item;
                break;
            }
        }
    } else {
        $error = "Please enter product name and valid stock quantity.";
    }
}

// Get the stock data (after possible update)
foreach ($_SESSION['stock_items'] as $item) {
    if ($item['id'] === $stockId) {
        $stockItem = $item;
        break;
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Stock - Admin Panel</title>

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
        .form-section .form-label { font-weight: 500; color: #1E293B; }
        .form-section .form-control,
        .form-section .form-select {
            border-radius: 0.5rem;
            border-color: #E2E8F0;
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
        <div id="edit-stock-page" class="page-section active-page">
            
            <!-- Breadcrumb -->
            <div class="breadcrumb-custom mb-3">
                <a href="dashboard.php"><i class="fas fa-home"></i> Dashboard</a>
                <i class="fas fa-chevron-right"></i>
                <a href="stock-management.php">Stock Management</a>
                <i class="fas fa-chevron-right"></i>
                <span>Edit Stock Item</span>
            </div>

            <!-- Page Header -->
            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                <h1 class="h2">Edit Stock Item</h1>
            </div>

            <!-- Success Message -->
            <?php if (isset($success) && $success): ?>
            <div class="alert-success-custom">
                <span>
                    <i class="fas fa-check-circle me-2"></i> 
                    <strong><?= $successMessage ?></strong>
                </span>
                <a href="stock-management.php" class="alert-link">
                    <i class="fas fa-arrow-right me-1"></i> View Stock
                </a>
            </div>
            <?php endif; ?>

            <?php if (isset($error)): ?>
            <div class="alert-error-custom">
                <i class="fas fa-exclamation-circle me-2"></i> <?= $error ?>
            </div>
            <?php endif; ?>

            <!-- Form -->
            <div class="form-section">
                <form id="editStockForm" action="" method="POST">
                    <input type="hidden" name="update_stock" value="1">
                    <input type="hidden" name="stock_id" value="<?= $stockItem['id'] ?>">
                    
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Product Name <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="stockName" name="stock_name" value="<?= htmlspecialchars($stockItem['name']) ?>" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Category</label>
                            <select class="form-select" id="stockCategory" name="stock_category">
                                <option value="">Select Category</option>
                                <option <?= ($stockItem['category'] ?? '') === 'Electronics' ? 'selected' : '' ?>>Electronics</option>
                                <option <?= ($stockItem['category'] ?? '') === 'Accessories' ? 'selected' : '' ?>>Accessories</option>
                                <option <?= ($stockItem['category'] ?? '') === 'Home' ? 'selected' : '' ?>>Home</option>
                                <option <?= ($stockItem['category'] ?? '') === 'Smart Devices' ? 'selected' : '' ?>>Smart Devices</option>
                            </select>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-4 mb-3">
                            <label class="form-label">Stock Quantity <span class="text-danger">*</span></label>
                            <input type="number" class="form-control" id="stockQuantity" name="stock_quantity" value="<?= $stockItem['stock'] ?>" required>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label class="form-label">Minimum Level</label>
                            <input type="number" class="form-control" id="stockMin" name="stock_min" value="<?= $stockItem['min'] ?>">
                        </div>
                        <div class="col-md-4 mb-3">
                            <label class="form-label">Maximum Level</label>
                            <input type="number" class="form-control" id="stockMax" name="stock_max" value="<?= $stockItem['max'] ?>">
                        </div>
                    </div>

                    <div class="d-flex gap-2">
                        <button type="submit" class="btn btn-primary" id="updateStockBtn">
                            <i class="fas fa-save me-1"></i> Update Stock
                        </button>
                        <a href="stock-management.php" class="btn btn-secondary">Cancel</a>
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
            document.getElementById('editStockForm')?.addEventListener('submit', function(e) {
                var name = document.getElementById('stockName')?.value.trim() || '';
                var qty = document.getElementById('stockQuantity')?.value || '';

                if (!name) {
                    e.preventDefault();
                    alert('Please enter product name');
                    return false;
                }
                if (!qty || qty < 0) {
                    e.preventDefault();
                    alert('Please enter valid stock quantity');
                    return false;
                }
                return true;
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

            console.log('Edit Stock page initialized');
        });
    </script>
</body>
</html>