<?php
$current_page = 'products';
session_start();

// Get product ID from URL
$productId = isset($_GET['id']) ? intval($_GET['id']) : 0;

// Find the product in session
$product = null;
if (isset($_SESSION['products'])) {
    foreach ($_SESSION['products'] as $p) {
        if ($p['id'] === $productId) {
            $product = $p;
            break;
        }
    }
}

// If product not found, redirect to products list
if (!$product) {
    header('Location: products-list.php');
    exit;
}

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update_product'])) {
    $id = intval($_POST['product_id'] ?? 0);
    $name = trim($_POST['product_name'] ?? '');
    $sku = trim($_POST['product_sku'] ?? '');
    $category = trim($_POST['product_category'] ?? '');
    $status = trim($_POST['product_status'] ?? 'In Stock');
    $price = floatval($_POST['product_price'] ?? 0);
    $stock = intval($_POST['product_stock'] ?? 0);
    $description = trim($_POST['product_description'] ?? '');
    
    if ($id > 0 && !empty($name) && !empty($sku) && $price > 0 && $stock >= 0) {
        foreach ($_SESSION['products'] as &$p) {
            if ($p['id'] === $id) {
                $badge = 'success';
                if ($status === 'Low Stock') $badge = 'warning';
                if ($status === 'Out of Stock') $badge = 'danger';
                
                $p['name'] = $name;
                $p['sku'] = $sku;
                $p['category'] = $category ?: 'Uncategorized';
                $p['price'] = '$' . number_format($price, 2);
                $p['stock'] = $stock;
                $p['status'] = $status;
                $p['badge'] = $badge;
                $p['description'] = $description;
                break;
            }
        }
        
        // Show success message on same page
        $success = true;
        $successMessage = "Product '$name' updated successfully!";
        
        // Update product variable
        foreach ($_SESSION['products'] as $p) {
            if ($p['id'] === $productId) {
                $product = $p;
                break;
            }
        }
    } else {
        $error = "Please fill all required fields correctly.";
    }
}

// Get the product data (after possible update)
foreach ($_SESSION['products'] as $p) {
    if ($p['id'] === $productId) {
        $product = $p;
        break;
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Product - Admin Panel</title>

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
        <div id="edit-product-page" class="page-section active-page">
            
           

            <!-- Page Header -->
            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                <h1 class="h2">Edit Product</h1>
                <!-- Back to Products button REMOVED -->
            </div>

            <!-- Success Message -->
            <?php if (isset($success) && $success): ?>
            <div class="alert-success-custom">
                <span>
                    <i class="fas fa-check-circle me-2"></i> 
                    <strong><?= $successMessage ?></strong>
                </span>
                <a href="product.php" class="alert-link">
                    <i class="fas fa-arrow-right me-1"></i> View Products
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
                <form id="editProductForm" action="" method="POST">
                    <input type="hidden" name="update_product" value="1">
                    <input type="hidden" name="product_id" value="<?= $product['id'] ?>">
                    
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Product Name <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="productName" name="product_name" value="<?= htmlspecialchars($product['name']) ?>" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">SKU <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="productSku" name="product_sku" value="<?= htmlspecialchars($product['sku']) ?>" required>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Category</label>
                            <select class="form-select" id="productCategory" name="product_category">
                                <option value="">Select Category</option>
                                <option <?= ($product['category'] ?? '') === 'Electronics' ? 'selected' : '' ?>>Electronics</option>
                                <option <?= ($product['category'] ?? '') === 'Accessories' ? 'selected' : '' ?>>Accessories</option>
                                <option <?= ($product['category'] ?? '') === 'Home' ? 'selected' : '' ?>>Home</option>
                                <option <?= ($product['category'] ?? '') === 'Smart Devices' ? 'selected' : '' ?>>Smart Devices</option>
                                <option <?= ($product['category'] ?? '') === 'Travel' ? 'selected' : '' ?>>Travel</option>
                                <option <?= ($product['category'] ?? '') === 'Industrial' ? 'selected' : '' ?>>Industrial</option>
                            </select>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Status</label>
                            <select class="form-select" id="productStatus" name="product_status">
                                <option <?= ($product['status'] ?? '') === 'In Stock' ? 'selected' : '' ?>>In Stock</option>
                                <option <?= ($product['status'] ?? '') === 'Low Stock' ? 'selected' : '' ?>>Low Stock</option>
                                <option <?= ($product['status'] ?? '') === 'Out of Stock' ? 'selected' : '' ?>>Out of Stock</option>
                            </select>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Price <span class="text-danger">*</span></label>
                            <input type="number" class="form-control" id="productPrice" name="product_price" step="0.01" value="<?= str_replace(['$', ','], '', $product['price']) ?>" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Stock Quantity <span class="text-danger">*</span></label>
                            <input type="number" class="form-control" id="productStock" name="product_stock" value="<?= $product['stock'] ?>" required>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Description</label>
                        <textarea class="form-control" id="productDescription" name="product_description" rows="4"><?= htmlspecialchars($product['description'] ?? '') ?></textarea>
                    </div>

                    <div class="d-flex gap-2">
                        <button type="submit" class="btn btn-primary" id="updateProductBtn">
                            <i class="fas fa-save me-1"></i> Update Product
                        </button>
                        <a href="products-list.php" class="btn btn-secondary">Cancel</a>
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
            document.getElementById('editProductForm')?.addEventListener('submit', function(e) {
                var name = document.getElementById('productName')?.value.trim() || '';
                var sku = document.getElementById('productSku')?.value.trim() || '';
                var price = document.getElementById('productPrice')?.value || '';
                var stock = document.getElementById('productStock')?.value || '';

                if (!name) {
                    e.preventDefault();
                    alert('Please enter product name');
                    return false;
                }
                if (!sku) {
                    e.preventDefault();
                    alert('Please enter SKU');
                    return false;
                }
                if (!price || price <= 0) {
                    e.preventDefault();
                    alert('Please enter a valid price');
                    return false;
                }
                if (stock === '' || stock < 0) {
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

            console.log('Edit Product page initialized');
        });
    </script>
</body>
</html>