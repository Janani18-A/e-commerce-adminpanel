<?php
$current_page = 'products';

// Start session
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Initialize products in session if not exists
if (!isset($_SESSION['products']) || empty($_SESSION['products'])) {
    $_SESSION['products'] = [
        ['id' => 1, 'name' => 'Product Alpha', 'sku' => 'ALPHA-001', 'category' => 'Electronics', 'price' => '$49.99', 'stock' => 150, 'status' => 'In Stock', 'badge' => 'success', 'color' => '2563EB', 'image' => ''],
        ['id' => 2, 'name' => 'Product Beta', 'sku' => 'BETA-002', 'category' => 'Accessories', 'price' => '$89.00', 'stock' => 25, 'status' => 'Low Stock', 'badge' => 'warning', 'color' => 'F59E0B', 'image' => ''],
        ['id' => 3, 'name' => 'Product Gamma', 'sku' => 'GAMMA-003', 'category' => 'Home', 'price' => '$120.00', 'stock' => 0, 'status' => 'Out of Stock', 'badge' => 'danger', 'color' => 'EF4444', 'image' => ''],
        ['id' => 4, 'name' => 'Product Delta', 'sku' => 'DELTA-004', 'category' => 'Smart Devices', 'price' => '$199.99', 'stock' => 75, 'status' => 'In Stock', 'badge' => 'success', 'color' => '8B5CF6', 'image' => ''],
        ['id' => 5, 'name' => 'Product Epsilon', 'sku' => 'EPSILON-005', 'category' => 'Travel', 'price' => '$34.50', 'stock' => 120, 'status' => 'In Stock', 'badge' => 'success', 'color' => '06B6D4', 'image' => ''],
        ['id' => 6, 'name' => 'Product Zeta', 'sku' => 'ZETA-006', 'category' => 'Industrial', 'price' => '$75.00', 'stock' => 8, 'status' => 'Low Stock', 'badge' => 'warning', 'color' => '1E293B', 'image' => '']
    ];
}

// --- HANDLE ADD PRODUCT ---
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add_product'])) {
    $name = trim($_POST['product_name'] ?? '');
    $sku = trim($_POST['product_sku'] ?? '');
    $category = trim($_POST['product_category'] ?? '');
    $status = trim($_POST['product_status'] ?? 'In Stock');
    $price = floatval($_POST['product_price'] ?? 0);
    $stock = intval($_POST['product_stock'] ?? 0);
    $description = trim($_POST['product_description'] ?? '');
    $image = $_POST['product_image'] ?? '';
    
    if (!empty($name) && !empty($sku) && $price > 0 && $stock >= 0) {
        $badge = 'success';
        if ($status === 'Low Stock') $badge = 'warning';
        if ($status === 'Out of Stock') $badge = 'danger';
        
        $colors = ['2563EB', 'F59E0B', 'EF4444', '8B5CF6', '06B6D4', '1E293B', 'EC4899', '10B981'];
        $color = $colors[array_rand($colors)];
        
        $newProduct = [
            'id' => count($_SESSION['products']) + 1,
            'name' => $name,
            'sku' => $sku,
            'category' => $category ?: 'Uncategorized',
            'price' => '$' . number_format($price, 2),
            'stock' => $stock,
            'status' => $status,
            'badge' => $badge,
            'color' => $color,
            'description' => $description,
            'image' => $image
        ];
        
        $_SESSION['products'][] = $newProduct;
        header('Location: products-list.php?added=1');
        exit;
    } else {
        header('Location: products-list.php?error=1');
        exit;
    }
}

// --- HANDLE DELETE PRODUCT ---
if (isset($_GET['delete']) && isset($_GET['id'])) {
    $id = intval($_GET['id']);
    $_SESSION['products'] = array_values(array_filter($_SESSION['products'], function($p) use ($id) {
        return $p['id'] !== $id;
    }));
    header('Location: products-list.php?deleted=1');
    exit;
}

// --- HANDLE UPDATE PRODUCT ---
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
        foreach ($_SESSION['products'] as &$product) {
            if ($product['id'] === $id) {
                $badge = 'success';
                if ($status === 'Low Stock') $badge = 'warning';
                if ($status === 'Out of Stock') $badge = 'danger';
                
                $product['name'] = $name;
                $product['sku'] = $sku;
                $product['category'] = $category ?: 'Uncategorized';
                $product['price'] = '$' . number_format($price, 2);
                $product['stock'] = $stock;
                $product['status'] = $status;
                $product['badge'] = $badge;
                $product['description'] = $description;
                break;
            }
        }
        header('Location: products-list.php?updated=1');
        exit;
    } else {
        header('Location: products-list.php?error=1');
        exit;
    }
}

$products = $_SESSION['products'];
$showAdded = isset($_GET['added']);
$showDeleted = isset($_GET['deleted']);
$showUpdated = isset($_GET['updated']);
$showError = isset($_GET['error']);

// Calculate stats
$totalProducts = count($products);
$lowStockItems = count(array_filter($products, function($p) {
    return $p['stock'] <= 10 && $p['stock'] > 0;
}));
$outOfStock = count(array_filter($products, function($p) {
    return $p['stock'] <= 0;
}));
$inStock = $totalProducts - $outOfStock;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Products - Admin Panel</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/style.css">

    <style>
        /* ============================================
           BASE STYLES
           ============================================ */
        * { box-sizing: border-box; }
        body { font-family: 'Inter', sans-serif; background: #F8FAFC; }

        /* ============================================
           STAT CARDS
           ============================================ */
        .stat-card {
            background: #FFFFFF;
            border-radius: 0.75rem;
            border: 1px solid #E2E8F0;
            padding: 1.25rem;
            transition: all 0.3s ease;
            height: 100%;
        }
        .stat-card:hover {
            box-shadow: 0 4px 12px rgba(37, 99, 235, 0.1);
            transform: translateY(-2px);
        }
        .stat-card .stat-icon {
            width: 48px;
            height: 48px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.25rem;
            flex-shrink: 0;
        }
        .stat-card .stat-icon.blue { background: #DBEAFE; color: #2563EB; }
        .stat-card .stat-icon.green { background: #D1FAE5; color: #10B981; }
        .stat-card .stat-icon.yellow { background: #FEF3C7; color: #F59E0B; }
        .stat-card .stat-icon.red { background: #FEE2E2; color: #EF4444; }
        .stat-card .stat-value {
            font-size: 1.5rem;
            font-weight: 700;
            color: #1E293B;
            margin-bottom: 2px;
            line-height: 1.2;
        }
        .stat-card .stat-label {
            font-size: 0.85rem;
            color: #64748B;
            font-weight: 500;
        }
        .stat-card .stat-trend {
            font-size: 0.75rem;
            font-weight: 600;
        }
        .stat-card .stat-trend.up { color: #10B981; }
        .stat-card .stat-trend.down { color: #EF4444; }

        /* ============================================
           FILTERS SECTION
           ============================================ */
        .filters-section {
            background: #FFFFFF;
            padding: 1rem;
            border-radius: 0.75rem;
            border: 1px solid #E2E8F0;
            margin-bottom: 1.5rem;
        }
        .filters-section .form-select,
        .filters-section .form-control {
            border-radius: 0.5rem;
            border-color: #E2E8F0;
            font-size: 0.875rem;
        }
        .filters-section .form-select:focus,
        .filters-section .form-control:focus {
            border-color: #2563EB;
            box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.15);
        }

        /* ============================================
           PRODUCT TABLE
           ============================================ */
        .product-table-container {
            background: #FFFFFF;
            border-radius: 0.75rem;
            border: 1px solid #E2E8F0;
            overflow: hidden;
        }
        .product-table-container .table { margin-bottom: 0; }
        .product-table-container .table thead th {
            background: #F8FAFC;
            color: #1E293B;
            font-weight: 600;
            border-bottom: 2px solid #E2E8F0;
            padding: 0.75rem 1rem;
            font-size: 0.85rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            white-space: nowrap;
        }
        .product-table-container .table tbody td {
            padding: 0.75rem 1rem;
            vertical-align: middle;
        }
        .product-table-container .table tbody tr:hover { background: #F8FAFC; }
        .product-thumb {
            width: 45px;
            height: 45px;
            object-fit: cover;
            border-radius: 0.5rem;
            background: #F8FAFC;
            border: 1px solid #E2E8F0;
            flex-shrink: 0;
        }
        .product-image-preview {
            width: 45px;
            height: 45px;
            object-fit: cover;
            border-radius: 8px;
            border: 1px solid #E2E8F0;
            flex-shrink: 0;
        }

        /* ============================================
           BADGES
           ============================================ */
        .badge.bg-success { background: #10B981 !important; color: #FFFFFF; }
        .badge.bg-warning { background: #F59E0B !important; color: #1E293B; }
        .badge.bg-danger { background: #EF4444 !important; color: #FFFFFF; }

        /* ============================================
           PAGINATION
           ============================================ */
        .pagination .page-link { color: #2563EB; border-color: #E2E8F0; font-size: 0.875rem; padding: 0.375rem 0.75rem; }
        .pagination .page-item.active .page-link { background: #2563EB; border-color: #2563EB; color: #FFFFFF; }
        .pagination .page-link:hover { background: #DBEAFE; color: #1E40AF; }

        /* ============================================
           ALERTS
           ============================================ */
        .alert-custom {
            padding: 12px 16px;
            border-radius: 8px;
            margin-bottom: 1rem;
            display: none;
            border-left: 4px solid;
        }
        .alert-custom.show { display: block; }
        .alert-custom.success {
            background: #D1FAE5;
            color: #065F46;
            border-left-color: #10B981;
        }
        .alert-custom.error {
            background: #FEE2E2;
            color: #991B1B;
            border-left-color: #EF4444;
        }

        /* ============================================
           SIDEBAR TOGGLE
           ============================================ */
        .sidebar-toggle {
            display: none;
            background: transparent;
            border: none;
            color: #1E293B;
            font-size: 1.2rem;
            padding: 0 10px;
        }

        /* ============================================
           RESPONSIVE MEDIA QUERIES
           ============================================ */

        /* ---- Large Desktop (1200px and above) ---- */
        @media (min-width: 1200px) {
            .stat-card .stat-value { font-size: 1.6rem; }
            .stat-card { padding: 1.5rem; }
        }

        /* ---- Desktop (992px to 1199px) ---- */
        @media (min-width: 992px) and (max-width: 1199px) {
            .stat-card .stat-value { font-size: 1.4rem; }
            .stat-card { padding: 1.25rem; }
            .stat-card .stat-icon { width: 44px; height: 44px; font-size: 1.1rem; }
        }

        /* ---- Tablet (768px to 991px) ---- */
        @media (min-width: 768px) and (max-width: 991px) {
            .sidebar-wrapper { width: 60px; }
            .sidebar-wrapper .nav-link span { display: none; }
            .sidebar-wrapper .nav-link { padding: 10px; text-align: center; }
            .sidebar-wrapper .nav-link i { margin-right: 0; font-size: 1.2rem; }
            .sidebar-wrapper .sidebar-heading span { display: none; }
            .main-content { margin-left: 60px; padding: 15px; }

            .stat-card .stat-value { font-size: 1.2rem; }
            .stat-card { padding: 1rem; }
            .stat-card .stat-icon { width: 40px; height: 40px; font-size: 1rem; }

            .h2 { font-size: 1.4rem; }
            .product-table-container .table thead th { font-size: 0.7rem; padding: 8px 10px; }
            .product-table-container .table tbody td { padding: 8px 10px; font-size: 0.8rem; }
            .product-thumb, .product-image-preview { width: 35px; height: 35px; }

            .btn-sm { font-size: 0.7rem; padding: 0.2rem 0.5rem; }
            .pagination .page-link { font-size: 0.75rem; padding: 0.3rem 0.6rem; }
        }

        /* ---- Mobile Large (576px to 767px) ---- */
        @media (min-width: 576px) and (max-width: 767px) {
            .sidebar-wrapper {
                width: 0;
                transform: translateX(-100%);
                transition: all 0.3s ease;
                position: fixed;
                top: 56px;
                left: 0;
                bottom: 0;
                z-index: 1040;
                background: #FFFFFF;
                overflow-y: auto;
                box-shadow: 2px 0 8px rgba(0,0,0,0.1);
            }
            .sidebar-wrapper.open {
                width: 280px;
                transform: translateX(0);
            }
            .main-content { margin-left: 0; padding: 12px 15px; }
            .sidebar-toggle { display: block !important; }

            .stat-card .stat-value { font-size: 1.1rem; }
            .stat-card { padding: 0.9rem; }
            .stat-card .stat-icon { width: 36px; height: 36px; font-size: 0.9rem; }

            .h2 { font-size: 1.2rem; }
            .btn-sm { font-size: 0.75rem; padding: 0.25rem 0.5rem; }

            .filters-section { padding: 0.75rem; }
            .filters-section .row>div { flex: 0 0 100%; max-width: 100%; margin-bottom: 6px; }

            /* Mobile Table View - Stacked */
            .product-table-container .table thead { display: none; }
            .product-table-container .table tbody td {
                display: flex;
                padding: 4px 12px;
                border-bottom: none;
                font-size: 0.85rem;
                text-align: left !important;
                align-items: center;
                gap: 8px;
                flex-wrap: wrap;
            }
            .product-table-container .table tbody td:before {
                content: attr(data-label);
                font-weight: 600;
                color: #64748B;
                min-width: 80px;
                flex-shrink: 0;
            }
            .product-table-container .table tbody td:last-child:before {
                display: none;
            }
            .product-table-container .table tbody td:last-child {
                justify-content: flex-start;
            }
            .product-table-container .table tbody tr {
                display: block;
                border-bottom: 1px solid #E2E8F0;
                padding: 6px 0;
            }
            .product-table-container .table tbody tr:last-child { border-bottom: none; }
            .product-table-container .table tbody td:first-child { padding-top: 10px; }
            .product-table-container .table tbody td:last-child { padding-bottom: 10px; }
            .product-thumb, .product-image-preview { width: 40px; height: 40px; }

            .d-flex.justify-content-between.align-items-center.mt-4 {
                flex-direction: column;
                gap: 10px;
                align-items: flex-start !important;
            }
            .pagination-info { font-size: 0.8rem; }
            .pagination .page-link { font-size: 0.75rem; padding: 0.25rem 0.5rem; }
        }

        /* ---- Mobile Small (below 576px) ---- */
        @media (max-width: 575.98px) {
            .sidebar-wrapper {
                width: 0;
                transform: translateX(-100%);
                transition: all 0.3s ease;
                position: fixed;
                top: 56px;
                left: 0;
                bottom: 0;
                z-index: 1040;
                background: #FFFFFF;
                overflow-y: auto;
                box-shadow: 2px 0 8px rgba(0,0,0,0.1);
            }
            .sidebar-wrapper.open {
                width: 280px;
                transform: translateX(0);
            }
            .main-content { margin-left: 0; padding: 8px 10px; }
            .sidebar-toggle { display: block !important; }

            .stat-card .stat-value { font-size: 0.95rem; }
            .stat-card { padding: 0.75rem; }
            .stat-card .stat-icon { width: 32px; height: 32px; font-size: 0.8rem; }
            .stat-card .stat-label { font-size: 0.7rem; }

            .h2 { font-size: 1rem; }
            .btn-sm { font-size: 0.7rem; padding: 0.2rem 0.4rem; }

            .filters-section { padding: 0.5rem; }
            .filters-section .row>div { flex: 0 0 100%; max-width: 100%; margin-bottom: 4px; }
            .filters-section .form-select-sm,
            .filters-section .form-control-sm { font-size: 0.7rem; padding: 0.15rem 0.4rem; }

            /* Mobile Table View - Stacked */
            .product-table-container .table thead { display: none; }
            .product-table-container .table tbody td {
                display: flex;
                padding: 3px 10px;
                border-bottom: none;
                font-size: 0.75rem;
                text-align: left !important;
                align-items: center;
                gap: 6px;
                flex-wrap: wrap;
            }
            .product-table-container .table tbody td:before {
                content: attr(data-label);
                font-weight: 600;
                color: #64748B;
                min-width: 70px;
                flex-shrink: 0;
                font-size: 0.7rem;
            }
            .product-table-container .table tbody td:last-child:before {
                display: none;
            }
            .product-table-container .table tbody td:last-child {
                justify-content: flex-start;
            }
            .product-table-container .table tbody tr {
                display: block;
                border-bottom: 1px solid #E2E8F0;
                padding: 4px 0;
            }
            .product-table-container .table tbody tr:last-child { border-bottom: none; }
            .product-table-container .table tbody td:first-child { padding-top: 8px; }
            .product-table-container .table tbody td:last-child { padding-bottom: 8px; }
            .product-thumb, .product-image-preview { width: 32px; height: 32px; }
            .product-table-container .table .badge { font-size: 0.6rem; padding: 2px 6px; }
            .product-table-container .table .btn-sm { padding: 1px 6px; font-size: 0.6rem; }

            .d-flex.justify-content-between.align-items-center.mt-4 {
                flex-direction: column;
                gap: 8px;
                align-items: flex-start !important;
            }
            .pagination-info { font-size: 0.7rem; }
            .pagination .page-link { font-size: 0.65rem; padding: 0.2rem 0.4rem; }
        }

        /* ---- Very Small Phones (below 380px) ---- */
        @media (max-width: 379.98px) {
            .main-content { padding: 5px 6px; }
            .stat-card .stat-value { font-size: 0.8rem; }
            .stat-card { padding: 0.5rem; }
            .stat-card .stat-icon { width: 28px; height: 28px; font-size: 0.7rem; }
            .stat-card .stat-label { font-size: 0.6rem; }
            .h2 { font-size: 0.85rem; }
            .product-table-container .table tbody td { font-size: 0.65rem; padding: 2px 6px; }
            .product-thumb, .product-image-preview { width: 28px; height: 28px; }
            .pagination .page-link { font-size: 0.55rem; padding: 0.15rem 0.3rem; }
            .pagination-info { font-size: 0.6rem; }
        }

        @keyframes slideIn { from { transform: translateX(100%); opacity: 0; } to { transform: translateX(0); opacity: 1; } }
        .custom-alert { animation: slideIn 0.3s ease-out; }
    </style>
</head>
<body>
    <!-- Navbar -->
    <?php include 'templates/navbar.php'; ?>
    
    <!-- Sidebar -->
     <?php include 'templates/sidebar.php'; ?>

    <!-- Main Content -->
    <div class="content-area main-content">
        <div id="products-page" class="page-section active-page">
            
            
            <!-- Alerts -->
            <?php if ($showAdded): ?>
            <div class="alert-custom success show">
                <i class="fas fa-check-circle me-2"></i> Product added successfully!
            </div>
            <?php endif; ?>
            
            <?php if ($showUpdated): ?>
            <div class="alert-custom success show">
                <i class="fas fa-check-circle me-2"></i> Product updated successfully!
            </div>
            <?php endif; ?>
            
            <?php if ($showDeleted): ?>
            <div class="alert-custom success show" style="background: #FEE2E2; color: #991B1B; border-left-color: #EF4444;">
                <i class="fas fa-trash me-2"></i> Product deleted successfully!
            </div>
            <?php endif; ?>

            <?php if ($showError): ?>
            <div class="alert-custom error show">
                <i class="fas fa-exclamation-circle me-2"></i> Failed to process product. Please check all fields.
            </div>
            <?php endif; ?>

            <!-- Page Header -->
            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                <h1 class="h2">Products</h1>
                <div class="btn-toolbar mb-2 mb-md-0">
                    <div class="btn-group me-2">
                        <a href="add-product.php" class="btn btn-sm btn-outline-primary">
                            <i class="fas fa-plus-circle me-1"></i> Add Product
                        </a>
                    </div>
                </div>
            </div>

            <!-- Stats Cards -->
            <div class="row mb-4">
                <div class="col-xl-3 col-lg-6 col-md-6 col-12 mb-3">
                    <div class="stat-card d-flex align-items-center">
                        <div class="stat-icon blue me-3">
                            <i class="fas fa-box"></i>
                        </div>
                        <div>
                            <div class="stat-value"><?= $totalProducts ?></div>
                            <div class="stat-label">Total Products</div>
                            <div class="stat-trend up">↑ +<?= $totalProducts > 0 ? round(($totalProducts / 6) * 100, 1) : 0 ?>%</div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-6 col-md-6 col-12 mb-3">
                    <div class="stat-card d-flex align-items-center">
                        <div class="stat-icon green me-3">
                            <i class="fas fa-check-circle"></i>
                        </div>
                        <div>
                            <div class="stat-value"><?= $inStock ?></div>
                            <div class="stat-label">In Stock</div>
                            <div class="stat-trend up">↑ +<?= $inStock > 0 ? round(($inStock / $totalProducts) * 100, 1) : 0 ?>%</div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-6 col-md-6 col-12 mb-3">
                    <div class="stat-card d-flex align-items-center">
                        <div class="stat-icon yellow me-3">
                            <i class="fas fa-exclamation-triangle"></i>
                        </div>
                        <div>
                            <div class="stat-value"><?= $lowStockItems ?></div>
                            <div class="stat-label">Low Stock</div>
                            <div class="stat-trend down">↓ <?= $lowStockItems > 0 ? 'Need restock' : 'All good' ?></div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-6 col-md-6 col-12 mb-3">
                    <div class="stat-card d-flex align-items-center">
                        <div class="stat-icon red me-3">
                            <i class="fas fa-times-circle"></i>
                        </div>
                        <div>
                            <div class="stat-value"><?= $outOfStock ?></div>
                            <div class="stat-label">Out of Stock</div>
                            <div class="stat-trend down">↓ <?= $outOfStock > 0 ? 'Need restock' : 'All in stock' ?></div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Filters -->
            <div class="row mb-3 filters-section">
                <div class="col-md-3 col-sm-6 col-12">
                    <select class="form-select form-select-sm" id="categoryFilter">
                        <option>All Categories</option>
                        <option>Electronics</option>
                        <option>Accessories</option>
                        <option>Home</option>
                        <option>Smart Devices</option>
                    </select>
                </div>
                <div class="col-md-3 col-sm-6 col-12">
                    <select class="form-select form-select-sm" id="statusFilter">
                        <option>All Status</option>
                        <option>In Stock</option>
                        <option>Low Stock</option>
                        <option>Out of Stock</option>
                    </select>
                </div>
                <div class="col-md-6 col-sm-12 col-12">
                    <div class="input-group input-group-sm">
                        <span class="input-group-text bg-white border-end-0">
                            <i class="fas fa-search text-muted"></i>
                        </span>
                        <input type="text" class="form-control form-control-sm border-start-0" id="productSearch" placeholder="Search products...">
                    </div>
                </div>
            </div>

            <!-- Products Table -->
            <div class="table-responsive product-table-container">
                <table class="table table-hover align-middle mb-0" id="productTable">
                    <thead>
                        <tr>
                            <th>Product</th>
                            <th>Category</th>
                            <th>Price</th>
                            <th>Stock</th>
                            <th>Status</th>
                            <th class="text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody id="productTableBody">
                        <?php if (empty($products)): ?>
                        <tr>
                            <td colspan="6" class="text-center py-4">
                                <i class="fas fa-box-open fa-2x text-muted mb-2 d-block"></i>
                                <span class="text-muted">No products found. <a href="add-product.php">Add your first product</a></span>
                            </td>
                        </tr>
                        <?php else: ?>
                        <?php foreach ($products as $p): ?>
                        <tr data-id="<?= $p['id'] ?>" data-name="<?= htmlspecialchars($p['name']) ?>" data-sku="<?= htmlspecialchars($p['sku']) ?>" data-category="<?= htmlspecialchars($p['category']) ?>" data-price="<?= str_replace(['$', ','], '', $p['price']) ?>" data-stock="<?= $p['stock'] ?>" data-status="<?= htmlspecialchars($p['status']) ?>" data-description="<?= htmlspecialchars($p['description'] ?? '') ?>">
                            <td data-label="Product">
                                <div class="d-flex align-items-center gap-3">
                                    <?php if (!empty($p['image'])): ?>
                                        <img src="<?= $p['image'] ?>" alt="<?= $p['name'] ?>" class="product-image-preview">
                                    <?php else: ?>
                                        <img src="https://via.placeholder.com/45x45/<?= $p['color'] ?? '2563EB' ?>/FFFFFF?text=<?= substr($p['name'], -1) ?>" alt="<?= $p['name'] ?>" class="product-thumb">
                                    <?php endif; ?>
                                    <div>
                                        <div style="font-weight: 600; color: #1E293B;"><?= htmlspecialchars($p['name']) ?></div>
                                        <div style="font-size: 0.8rem; color: #64748B;">SKU: <?= htmlspecialchars($p['sku']) ?></div>
                                    </div>
                                </div>
                            </td>
                            <td data-label="Category" style="color: #1E293B;"><?= htmlspecialchars($p['category']) ?></td>
                            <td data-label="Price" style="font-weight: 700; color: #2563EB;"><?= htmlspecialchars($p['price']) ?></td>
                            <td data-label="Stock" style="font-weight: 600; color: <?= ($p['badge'] ?? 'success') === 'success' ? '#10B981' : (($p['badge'] ?? '') === 'warning' ? '#F59E0B' : '#EF4444') ?>;"><?= $p['stock'] ?></td>
                            <td data-label="Status">
                                <span class="badge bg-<?= $p['badge'] ?? 'success' ?><?= ($p['badge'] ?? '') === 'warning' ? ' text-dark' : '' ?>" style="padding: 5px 12px; border-radius: 20px;"><?= htmlspecialchars($p['status']) ?></span>
                            </td>
                            <td data-label="Actions" class="text-center">
                                <a href="edit-product.php?id=<?= $p['id'] ?>" class="btn btn-sm btn-outline-secondary me-1" style="border-radius: 6px; padding: 4px 10px;">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <a href="products-list.php?delete=1&id=<?= $p['id'] ?>" class="btn btn-sm btn-outline-danger delete-product-btn" style="border-radius: 6px; padding: 4px 10px;" onclick="return confirm('Are you sure you want to delete this product?')">
                                    <i class="fas fa-trash"></i>
                                </a>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            <div class="d-flex justify-content-between align-items-center mt-4">
                <div style="color: #64748B; font-size: 0.9rem;" id="paginationInfo">Showing 1 to <?= $totalProducts ?> of <?= $totalProducts ?> entries</div>
                <nav>
                    <ul class="pagination pagination-sm mb-0" id="paginationControls">
                        <li class="page-item disabled" id="prevPage">
                            <a class="page-link" href="#" onclick="changePage('prev')">Previous</a>
                        </li>
                        <li class="page-item active" data-page="1">
                            <a class="page-link" href="#" onclick="goToPage(1)">1</a>
                        </li>
                        <li class="page-item" data-page="2">
                            <a class="page-link" href="#" onclick="goToPage(2)">2</a>
                        </li>
                        <li class="page-item" data-page="3">
                            <a class="page-link" href="#" onclick="goToPage(3)">3</a>
                        </li>
                        <li class="page-item" id="nextPage">
                            <a class="page-link" href="#" onclick="changePage('next')">Next</a>
                        </li>
                    </ul>
                </nav>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="assets/js/script.js"></script>
    
    <script>
        document.addEventListener('DOMContentLoaded', function () {

            // ---- PAGINATION ----
            var currentPage = 1;
            var rowsPerPage = 5;
            var rows = document.querySelectorAll('#productTableBody tr');
            var totalRows = rows.length;
            var totalPages = Math.ceil(totalRows / rowsPerPage);

            function showPage(page) {
                currentPage = page;
                var start = (page - 1) * rowsPerPage;
                var end = start + rowsPerPage;

                rows.forEach(function(row, index) {
                    if (index >= start && index < end) {
                        row.style.display = '';
                    } else {
                        row.style.display = 'none';
                    }
                });

                var visibleCount = 0;
                rows.forEach(function(row) {
                    if (row.style.display !== 'none') visibleCount++;
                });
                var paginationInfo = document.getElementById('paginationInfo');
                if (paginationInfo) {
                    paginationInfo.textContent = 'Showing ' + (start + 1) + ' to ' + Math.min(end, totalRows) + ' of ' + totalRows + ' entries';
                }

                var pageItems = document.querySelectorAll('#paginationControls .page-item');
                pageItems.forEach(function(item) {
                    var pageNum = parseInt(item.getAttribute('data-page'));
                    if (pageNum) {
                        item.classList.remove('active');
                        if (pageNum === page) {
                            item.classList.add('active');
                        }
                    }
                });

                var prevBtn = document.getElementById('prevPage');
                var nextBtn = document.getElementById('nextPage');
                if (prevBtn) {
                    if (page <= 1) {
                        prevBtn.classList.add('disabled');
                    } else {
                        prevBtn.classList.remove('disabled');
                    }
                }
                if (nextBtn) {
                    if (page >= totalPages) {
                        nextBtn.classList.add('disabled');
                    } else {
                        nextBtn.classList.remove('disabled');
                    }
                }
            }

            window.goToPage = function(page) {
                if (page < 1 || page > totalPages) return;
                showPage(page);
            };

            window.changePage = function(direction) {
                if (direction === 'prev' && currentPage > 1) {
                    showPage(currentPage - 1);
                } else if (direction === 'next' && currentPage < totalPages) {
                    showPage(currentPage + 1);
                }
            };

            // ---- AUTO-HIDE ALERTS ----
            var alerts = document.querySelectorAll('.alert-custom');
            alerts.forEach(function(alert) {
                setTimeout(function() {
                    alert.classList.remove('show');
                }, 5000);
            });

            // ---- SEARCH PRODUCTS ----
            var productSearch = document.getElementById('productSearch');
            if (productSearch) {
                productSearch.addEventListener('keyup', function () {
                    var term = this.value.toLowerCase().trim();
                    var rows = document.querySelectorAll('#productTableBody tr');
                    var visibleCount = 0;

                    rows.forEach(function (row) {
                        var text = row.textContent.toLowerCase();
                        if (text.includes(term) || !term) {
                            row.style.display = '';
                            visibleCount++;
                        } else {
                            row.style.display = 'none';
                        }
                    });

                    var paginationInfo = document.getElementById('paginationInfo');
                    if (paginationInfo) {
                        paginationInfo.textContent = 'Showing ' + visibleCount + ' of ' + rows.length + ' entries';
                    }
                });
            }

            // ---- FILTER PRODUCTS ----
            var categoryFilter = document.getElementById('categoryFilter');
            var statusFilter = document.getElementById('statusFilter');

            if (categoryFilter) {
                categoryFilter.addEventListener('change', function () { filterProducts(); });
            }
            if (statusFilter) {
                statusFilter.addEventListener('change', function () { filterProducts(); });
            }

            function filterProducts() {
                var category = document.getElementById('categoryFilter')?.value || 'All Categories';
                var status = document.getElementById('statusFilter')?.value || 'All Status';
                var rows = document.querySelectorAll('#productTableBody tr');
                var visibleCount = 0;

                rows.forEach(function (row) {
                    var rowCategory = row.querySelector('td:nth-child(2)')?.textContent || '';
                    var rowStatus = row.querySelector('td:nth-child(5) .badge')?.textContent || '';

                    var show = true;
                    if (category !== 'All Categories' && rowCategory !== category) show = false;
                    if (status !== 'All Status' && rowStatus !== status) show = false;

                    row.style.display = show ? '' : 'none';
                    if (show) visibleCount++;
                });

                var paginationInfo = document.getElementById('paginationInfo');
                if (paginationInfo) {
                    paginationInfo.textContent = 'Showing ' + visibleCount + ' of ' + rows.length + ' entries';
                }
            }

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

            // Initialize pagination
            if (totalRows > 0) {
                showPage(1);
            }

            console.log('Products page initialized');
        });
    </script>
</body>
</html>