<?php
$current_page = 'stock';
session_start();

// Initialize stock items in session if not exists
if (!isset($_SESSION['stock_items']) || empty($_SESSION['stock_items'])) {
    $_SESSION['stock_items'] = [
        ['id' => 1, 'name' => 'Product Alpha', 'category' => 'Electronics', 'stock' => 150, 'min' => 20, 'max' => 200, 'status' => 'In Stock', 'badge' => 'success'],
        ['id' => 2, 'name' => 'Product Beta', 'category' => 'Accessories', 'stock' => 25, 'min' => 30, 'max' => 150, 'status' => 'Low Stock', 'badge' => 'warning'],
        ['id' => 3, 'name' => 'Product Gamma', 'category' => 'Home', 'stock' => 0, 'min' => 15, 'max' => 100, 'status' => 'Out of Stock', 'badge' => 'danger'],
        ['id' => 4, 'name' => 'Product Delta', 'category' => 'Smart Devices', 'stock' => 75, 'min' => 10, 'max' => 120, 'status' => 'In Stock', 'badge' => 'success']
    ];
}

// Calculate stats
$totalProducts = count($_SESSION['stock_items']);
$lowStockItems = count(array_filter($_SESSION['stock_items'], function($item) {
    return $item['stock'] <= 10 && $item['stock'] > 0;
}));
$outOfStock = count(array_filter($_SESSION['stock_items'], function($item) {
    return $item['stock'] <= 0;
}));
$inStock = $totalProducts - $outOfStock;
$totalValue = array_sum(array_map(function($item) {
    return $item['stock'] * 100;
}, $_SESSION['stock_items']));

// --- HANDLE EXPORT PDF (NO REDIRECT) ---
if (isset($_GET['export_pdf'])) {
    $html = '<!DOCTYPE html>
    <html>
    <head>
        <style>
            body { font-family: Arial, sans-serif; }
            h1 { color: #2563EB; text-align: center; }
            table { width: 100%; border-collapse: collapse; margin-top: 20px; }
            th { background: #2563EB; color: white; padding: 10px; text-align: left; }
            td { padding: 8px; border-bottom: 1px solid #ddd; }
            .text-success { color: #10B981; }
            .text-warning { color: #F59E0B; }
            .text-danger { color: #EF4444; }
            .footer { text-align: center; margin-top: 30px; color: #64748B; font-size: 12px; }
        </style>
    </head>
    <body>
        <h1>Stock Management Report</h1>
        <p style="text-align:center;">Generated on: ' . date('d-m-Y H:i:s') . '</p>
        <table>
            <thead>
                <tr>
                    <th>#</th>
                    <th>Product</th>
                    <th>Category</th>
                    <th>Current Stock</th>
                    <th>Min Level</th>
                    <th>Max Level</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>';
    
    foreach ($_SESSION['stock_items'] as $item) {
        $color = $item['badge'] === 'success' ? 'text-success' : ($item['badge'] === 'warning' ? 'text-warning' : 'text-danger');
        $html .= '<tr>
            <td>' . $item['id'] . '</td>
            <td><strong>' . $item['name'] . '</strong></td>
            <td>' . $item['category'] . '</td>
            <td class="' . $color . '">' . $item['stock'] . '</td>
            <td>' . $item['min'] . '</td>
            <td>' . $item['max'] . '</td>
            <td>' . $item['status'] . '</td>
        </tr>';
    }
    
    $html .= '</tbody>
        </table>
        <div class="footer">
            <p>Total Products: ' . $totalProducts . ' | In Stock: ' . $inStock . ' | Low Stock: ' . $lowStockItems . ' | Out of Stock: ' . $outOfStock . '</p>
            <p>&copy; ' . date('Y') . ' Admin Panel. All rights reserved.</p>
        </div>
    </body>
    </html>';
    
    $filename = 'stock_report_' . date('Y-m-d') . '.html';
    header('Content-Type: application/octet-stream');
    header('Content-Disposition: attachment; filename="' . $filename . '"');
    echo $html;
    exit;
}

// --- HANDLE DELETE PRODUCT ---
if (isset($_GET['delete']) && isset($_GET['id'])) {
    $id = intval($_GET['id']);
    $_SESSION['stock_items'] = array_values(array_filter($_SESSION['stock_items'], function($item) use ($id) {
        return $item['id'] !== $id;
    }));
    header('Location: stock-management.php?deleted=1');
    exit;
}

$showDeleted = isset($_GET['deleted']);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Stock Management - Admin Panel</title>

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
           BREADCRUMB
           ============================================ */
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

        /* ============================================
           STAT CARDS
           ============================================ */
        .stock-stat-card {
            border: none;
            border-radius: 0.75rem;
            color: #FFFFFF;
            transition: all 0.3s ease;
            height: 100%;
        }
        .stock-stat-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 4px 12px rgba(0,0,0,0.15);
        }
        .stock-stat-card.bg-success { background: linear-gradient(135deg, #10B981, #059669) !important; }
        .stock-stat-card.bg-warning { background: linear-gradient(135deg, #F59E0B, #D97706) !important; }
        .stock-stat-card.bg-danger { background: linear-gradient(135deg, #EF4444, #DC2626) !important; }
        .stock-stat-card.bg-info { background: linear-gradient(135deg, #2563EB, #1E40AF) !important; }
        .stock-stat-card .card-body { padding: 1.25rem; }
        .stock-stat-card h6 { opacity: 0.9; font-weight: 500; margin-bottom: 0.25rem; }
        .stock-stat-card h3 { font-weight: 700; margin-bottom: 0.25rem; }
        .stock-stat-card small { opacity: 0.85; font-size: 0.8rem; }

        /* ============================================
           STOCK ALERT
           ============================================ */
        .stock-alert {
            border-radius: 0.75rem;
            border-left: 4px solid #F59E0B;
            background: #FEF3C7;
            color: #92400E;
        }
        .stock-alert .alert-link { color: #2563EB; font-weight: 600; }

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
           RESPONSIVE - DESKTOP DEFAULT
           ============================================ */
        .stat-card .stat-value { font-size: 1.5rem; }
        .stat-card { padding: 1.25rem; }
        .h2 { font-size: 1.8rem; }
        .table-responsive .table thead { display: table-header-group; }
        .table-responsive .table tbody td { display: table-cell; }
        .table-responsive .table tbody td:before { display: none; }

        /* ============================================
           RESPONSIVE - LARGE DESKTOP (1200px+)
           ============================================ */
        @media (min-width: 1200px) {
            .stock-stat-card h3 { font-size: 2rem; }
            .stock-stat-card .card-body { padding: 1.5rem; }
            .h2 { font-size: 2rem; }
        }

        /* ============================================
           RESPONSIVE - DESKTOP (992px - 1199px)
           ============================================ */
        @media (min-width: 992px) and (max-width: 1199px) {
            .stock-stat-card h3 { font-size: 1.6rem; }
            .stock-stat-card .card-body { padding: 1.25rem; }
            .h2 { font-size: 1.6rem; }
        }

        /* ============================================
           RESPONSIVE - TABLET (768px - 991px)
           ============================================ */
        @media (min-width: 768px) and (max-width: 991px) {
            .sidebar-wrapper { width: 60px; }
            .sidebar-wrapper .nav-link span { display: none; }
            .sidebar-wrapper .nav-link { padding: 10px; text-align: center; }
            .sidebar-wrapper .nav-link i { margin-right: 0; font-size: 1.2rem; }
            .sidebar-wrapper .sidebar-heading span { display: none; }
            .main-content { margin-left: 60px; padding: 15px; }

            .stock-stat-card h3 { font-size: 1.3rem; }
            .stock-stat-card .card-body { padding: 1rem; }
            .h2 { font-size: 1.4rem; }
            
            .table-responsive .table thead th { font-size: 0.7rem; padding: 8px 10px; }
            .table-responsive .table tbody td { padding: 8px 10px; font-size: 0.8rem; }
            .btn-sm { font-size: 0.7rem; padding: 0.2rem 0.5rem; }
            .breadcrumb-custom { font-size: 0.8rem; }
            .breadcrumb-custom i { margin: 0 5px; font-size: 0.6rem; }
            
            .d-flex.justify-content-between.align-items-center {
                flex-direction: column;
                align-items: flex-start !important;
                gap: 8px;
            }
            .btn-toolbar { width: 100%; }
            .btn-toolbar .btn-group { width: 100%; }
            .btn-toolbar .btn-group .btn { width: 100%; }
        }

        /* ============================================
           RESPONSIVE - MOBILE LARGE (576px - 767px)
           ============================================ */
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

            .stock-stat-card h3 { font-size: 1.1rem; }
            .stock-stat-card .card-body { padding: 0.9rem; }
            .stock-stat-card h6 { font-size: 0.8rem; }
            .stock-stat-card small { font-size: 0.7rem; }
            .h2 { font-size: 1.2rem; }
            .btn-sm { font-size: 0.75rem; padding: 0.25rem 0.5rem; }
            .breadcrumb-custom { font-size: 0.8rem; }
            .breadcrumb-custom i { margin: 0 5px; font-size: 0.6rem; }

            .d-flex.justify-content-between.align-items-center {
                flex-direction: column;
                align-items: flex-start !important;
                gap: 8px;
            }
            .btn-toolbar { width: 100%; }
            .btn-toolbar .btn-group { width: 100%; }
            .btn-toolbar .btn-group .btn { width: 100%; font-size: 0.75rem; }

            /* Mobile Table View - Stacked */
            .table-responsive .table thead { display: none; }
            .table-responsive .table tbody td {
                display: flex;
                padding: 4px 12px;
                border-bottom: none;
                font-size: 0.85rem;
                text-align: left !important;
                align-items: center;
                gap: 8px;
                flex-wrap: wrap;
            }
            .table-responsive .table tbody td:before {
                content: attr(data-label);
                font-weight: 600;
                color: #64748B;
                min-width: 120px;
                flex-shrink: 0;
            }
            .table-responsive .table tbody td:last-child:before {
                display: none;
            }
            .table-responsive .table tbody td:last-child {
                justify-content: flex-start;
            }
            .table-responsive .table tbody td:first-child:before {
                display: none;
            }
            .table-responsive .table tbody tr {
                display: block;
                border-bottom: 1px solid #E2E8F0;
                padding: 4px 0;
            }
            .table-responsive .table tbody tr:last-child { border-bottom: none; }
            .table-responsive .table tbody td:first-child { padding-top: 10px; }
            .table-responsive .table tbody td:last-child { padding-bottom: 10px; }
            .table-responsive .table .badge { font-size: 0.7rem; padding: 3px 8px; }
            .table-responsive .table .btn-sm { padding: 2px 6px; font-size: 0.7rem; }

            .modal-dialog { margin: 0.5rem; }
            .modal-body { padding: 1rem; }
        }

        /* ============================================
           RESPONSIVE - MOBILE SMALL (below 576px)
           ============================================ */
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

            .stock-stat-card h3 { font-size: 0.95rem; }
            .stock-stat-card .card-body { padding: 0.75rem; }
            .stock-stat-card h6 { font-size: 0.7rem; }
            .stock-stat-card small { font-size: 0.65rem; }
            .h2 { font-size: 1rem; }
            .btn-sm { font-size: 0.7rem; padding: 0.2rem 0.4rem; }
            .breadcrumb-custom { font-size: 0.75rem; }
            .breadcrumb-custom i { margin: 0 4px; font-size: 0.55rem; }

            .d-flex.justify-content-between.align-items-center {
                flex-direction: column;
                align-items: flex-start !important;
                gap: 6px;
            }
            .btn-toolbar { width: 100%; }
            .btn-toolbar .btn-group { width: 100%; }
            .btn-toolbar .btn-group .btn { width: 100%; font-size: 0.7rem; }

            /* Mobile Table View - Stacked */
            .table-responsive .table thead { display: none; }
            .table-responsive .table tbody td {
                display: flex;
                padding: 3px 10px;
                border-bottom: none;
                font-size: 0.75rem;
                text-align: left !important;
                align-items: center;
                gap: 6px;
                flex-wrap: wrap;
            }
            .table-responsive .table tbody td:before {
                content: attr(data-label);
                font-weight: 600;
                color: #64748B;
                min-width: 100px;
                flex-shrink: 0;
                font-size: 0.7rem;
            }
            .table-responsive .table tbody td:last-child:before {
                display: none;
            }
            .table-responsive .table tbody td:last-child {
                justify-content: flex-start;
            }
            .table-responsive .table tbody td:first-child:before {
                display: none;
            }
            .table-responsive .table tbody tr {
                display: block;
                border-bottom: 1px solid #E2E8F0;
                padding: 4px 0;
            }
            .table-responsive .table tbody tr:last-child { border-bottom: none; }
            .table-responsive .table tbody td:first-child { padding-top: 8px; }
            .table-responsive .table tbody td:last-child { padding-bottom: 8px; }
            .table-responsive .table .badge { font-size: 0.6rem; padding: 2px 6px; }
            .table-responsive .table .btn-sm { padding: 1px 4px; font-size: 0.6rem; }

            .modal-dialog { margin: 0.3rem; }
            .modal-body { padding: 0.75rem; }
            .modal-header { padding: 10px 12px; }
            .modal-header .modal-title { font-size: 1rem; }
            .modal-footer { padding: 10px 12px; }
            .modal-footer .btn { font-size: 0.8rem; padding: 0.25rem 0.5rem; }
            .form-label { font-size: 0.75rem; }
            .form-control, .form-select { font-size: 0.75rem; padding: 0.2rem 0.4rem; }
        }

        /* ============================================
           RESPONSIVE - VERY SMALL (below 380px)
           ============================================ */
        @media (max-width: 379.98px) {
            .main-content { padding: 5px 6px; }
            .stock-stat-card h3 { font-size: 0.8rem; }
            .stock-stat-card .card-body { padding: 0.5rem; }
            .h2 { font-size: 0.85rem; }
            .table-responsive .table tbody td { font-size: 0.65rem; padding: 2px 6px; }
            .table-responsive .table tbody td:before { min-width: 70px; font-size: 0.6rem; }
            .breadcrumb-custom { font-size: 0.65rem; }
            .btn-sm { font-size: 0.6rem; padding: 0.15rem 0.3rem; }
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
        <div id="stock-page" class="page-section active-page">
            
            <!-- Breadcrumb -->
            <div class="breadcrumb-custom mb-3">
                <a href="dashboard.php"><i class="fas fa-home"></i> Dashboard</a>
                <i class="fas fa-chevron-right"></i>
                <span>Stock Management</span>
            </div>

            <!-- Alerts -->
            <?php if ($showDeleted): ?>
            <div class="alert-custom success show" style="background: #FEE2E2; color: #991B1B; border-left-color: #EF4444;">
                <i class="fas fa-trash me-2"></i> Stock item deleted successfully!
            </div>
            <?php endif; ?>

            <!-- Page Header -->
            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                <h1 class="h2">Stock Management</h1>
                <div class="btn-toolbar mb-2 mb-md-0">
                    <div class="btn-group me-2">
                        <a href="add-stock.php" class="btn btn-sm btn-outline-primary">
                            <i class="fas fa-plus-circle me-1"></i> Add Stock Item
                        </a>
                        <a href="stock-management.php?export_pdf=1" class="btn btn-sm btn-outline-secondary">
                            <i class="fas fa-download me-1"></i> Export Report
                        </a>
                    </div>
                </div>
            </div>

            <!-- Stock Statistics -->
            <div class="row mb-4">
                <div class="col-xl-3 col-lg-6 col-md-6 col-12 mb-3">
                    <div class="card stock-stat-card bg-success">
                        <div class="card-body">
                            <h6>Total Products</h6>
                            <h3><?= $totalProducts ?></h3>
                            <small>Active products in inventory</small>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-6 col-md-6 col-12 mb-3">
                    <div class="card stock-stat-card bg-warning">
                        <div class="card-body">
                            <h6>Low Stock Items</h6>
                            <h3><?= $lowStockItems ?></h3>
                            <small>Products below reorder level</small>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-6 col-md-6 col-12 mb-3">
                    <div class="card stock-stat-card bg-danger">
                        <div class="card-body">
                            <h6>Out of Stock</h6>
                            <h3><?= $outOfStock ?></h3>
                            <small>Products with zero quantity</small>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-6 col-md-6 col-12 mb-3">
                    <div class="card stock-stat-card bg-info">
                        <div class="card-body">
                            <h6>Total Value</h6>
                            <h3>$<?= number_format($totalValue) ?></h3>
                            <small>Total stock value</small>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Stock Alert -->
            <?php if ($lowStockItems > 0): ?>
            <div class="alert alert-warning alert-dismissible fade show stock-alert" id="stockAlert">
                <i class="fas fa-exclamation-triangle"></i>
                <strong> Stock Alert:</strong>
                <span class="ms-2"><?= $lowStockItems ?> products are below reorder level. <a href="#" class="alert-link">View details</a></span>
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
            <?php endif; ?>

            <!-- Stock Table -->
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0 bg-white" style="border-radius: 8px; border: 1px solid #E2E8F0; overflow: hidden;">
                    <thead style="background: #F8FAFC; border-bottom: 2px solid #E2E8F0;">
                        <tr>
                            <th style="padding: 12px 15px; font-weight: 600; font-size: 0.85rem; text-transform: uppercase; letter-spacing: 0.5px;">#</th>
                            <th style="padding: 12px 15px; font-weight: 600; font-size: 0.85rem; text-transform: uppercase; letter-spacing: 0.5px;">Product</th>
                            <th style="padding: 12px 15px; font-weight: 600; font-size: 0.85rem; text-transform: uppercase; letter-spacing: 0.5px;">Category</th>
                            <th style="padding: 12px 15px; font-weight: 600; font-size: 0.85rem; text-transform: uppercase; letter-spacing: 0.5px;">Current Stock</th>
                            <th style="padding: 12px 15px; font-weight: 600; font-size: 0.85rem; text-transform: uppercase; letter-spacing: 0.5px;">Min Level</th>
                            <th style="padding: 12px 15px; font-weight: 600; font-size: 0.85rem; text-transform: uppercase; letter-spacing: 0.5px;">Max Level</th>
                            <th style="padding: 12px 15px; font-weight: 600; font-size: 0.85rem; text-transform: uppercase; letter-spacing: 0.5px;">Status</th>
                            <th style="padding: 12px 15px; font-weight: 600; font-size: 0.85rem; text-transform: uppercase; letter-spacing: 0.5px; text-align: center;">Actions</th>
                        </tr>
                    </thead>
                    <tbody id="stockTableBody">
                        <?php if (empty($_SESSION['stock_items'])): ?>
                        <tr>
                            <td colspan="8" class="text-center py-4">
                                <i class="fas fa-boxes fa-2x text-muted mb-2 d-block"></i>
                                <span class="text-muted">No stock items found. <a href="add-stock.php">Add your first stock item</a></span>
                            </td>
                        </tr>
                        <?php else: ?>
                        <?php foreach ($_SESSION['stock_items'] as $s): ?>
                        <tr data-id="<?= $s['id'] ?>">
                            <td data-label="#" style="padding: 12px 15px;"><?= $s['id'] ?></td>
                            <td data-label="Product" style="padding: 12px 15px;"><strong><?= $s['name'] ?></strong></td>
                            <td data-label="Category" style="padding: 12px 15px; color: #1E293B;"><?= $s['category'] ?></td>
                            <td data-label="Current Stock" style="padding: 12px 15px; font-weight: 600; color: <?= $s['badge'] === 'success' ? '#10B981' : ($s['badge'] === 'warning' ? '#F59E0B' : '#EF4444') ?>;"><?= $s['stock'] ?></td>
                            <td data-label="Min Level" style="padding: 12px 15px;"><?= $s['min'] ?></td>
                            <td data-label="Max Level" style="padding: 12px 15px;"><?= $s['max'] ?></td>
                            <td data-label="Status" style="padding: 12px 15px;">
                                <span class="badge bg-<?= $s['badge'] ?><?= $s['badge'] === 'warning' ? ' text-dark' : '' ?>" style="padding: 5px 12px; border-radius: 20px;"><?= $s['status'] ?></span>
                            </td>
                            <td data-label="Actions" style="padding: 12px 15px; text-align: center;">
                                <a href="edit-stock.php?id=<?= $s['id'] ?>" class="btn btn-sm btn-outline-secondary me-1" style="border-radius: 6px; padding: 4px 10px;">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <a href="stock-management.php?delete=1&id=<?= $s['id'] ?>" class="btn btn-sm btn-outline-danger" style="border-radius: 6px; padding: 4px 10px;" onclick="return confirm('Are you sure you want to delete this stock item?')">
                                    <i class="fas fa-trash"></i>
                                </a>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>

            <!-- Stock Movement History -->
            <div class="mt-4">
                <h5 class="mb-3">Recent Stock Movements</h5>
                <div class="table-responsive" style="background: #FFFFFF; border-radius: 8px; border: 1px solid #E2E8F0; overflow: hidden;">
                    <table class="table table-sm table-striped mb-0">
                        <thead style="background: #F8FAFC; border-bottom: 2px solid #E2E8F0;">
                            <tr>
                                <th style="padding: 10px 15px; font-weight: 600; font-size: 0.85rem; text-transform: uppercase; letter-spacing: 0.5px;">Date</th>
                                <th style="padding: 10px 15px; font-weight: 600; font-size: 0.85rem; text-transform: uppercase; letter-spacing: 0.5px;">Product</th>
                                <th style="padding: 10px 15px; font-weight: 600; font-size: 0.85rem; text-transform: uppercase; letter-spacing: 0.5px;">Type</th>
                                <th style="padding: 10px 15px; font-weight: 600; font-size: 0.85rem; text-transform: uppercase; letter-spacing: 0.5px;">Quantity</th>
                                <th style="padding: 10px 15px; font-weight: 600; font-size: 0.85rem; text-transform: uppercase; letter-spacing: 0.5px;">User</th>
                                <th style="padding: 10px 15px; font-weight: 600; font-size: 0.85rem; text-transform: uppercase; letter-spacing: 0.5px;">Note</th>
                            </tr>
                        </thead>
                        <tbody id="movementTableBody">
                            <?php
                            $movements = [
                                ['date' => date('Y-m-d H:i'), 'product' => 'Product Alpha', 'type' => 'Added', 'badge' => 'success', 'qty' => '+50', 'user' => 'Admin', 'note' => 'Restock'],
                                ['date' => date('Y-m-d H:i', strtotime('-2 hours')), 'product' => 'Product Beta', 'type' => 'Removed', 'badge' => 'danger', 'qty' => '-15', 'user' => 'Admin', 'note' => 'Order #1234'],
                                ['date' => date('Y-m-d H:i', strtotime('-1 day')), 'product' => 'Product Gamma', 'type' => 'Adjusted', 'badge' => 'warning', 'qty' => '0', 'user' => 'Admin', 'note' => 'Inventory count']
                            ];
                            foreach ($movements as $m):
                            ?>
                            <tr>
                                <td style="padding: 10px 15px;"><?= $m['date'] ?></td>
                                <td style="padding: 10px 15px;"><strong><?= $m['product'] ?></strong></td>
                                <td style="padding: 10px 15px;"><span class="badge bg-<?= $m['badge'] ?><?= $m['badge'] === 'warning' ? ' text-dark' : '' ?>"><?= $m['type'] ?></span></td>
                                <td style="padding: 10px 15px;"><?= $m['qty'] ?></td>
                                <td style="padding: 10px 15px;"><?= $m['user'] ?></td>
                                <td style="padding: 10px 15px;"><?= $m['note'] ?></td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="assets/js/script.js"></script>
    
    <script>
        document.addEventListener('DOMContentLoaded', function () {

            // ---- AUTO-HIDE ALERTS ----
            var alerts = document.querySelectorAll('.alert-custom');
            alerts.forEach(function(alert) {
                setTimeout(function() {
                    alert.classList.remove('show');
                }, 5000);
            });

            // ---- STOCK ALERT DISMISSAL ----
            document.querySelectorAll('.stock-alert .btn-close').forEach(function(btn) {
                btn.addEventListener('click', function () {
                    this.closest('.stock-alert').style.display = 'none';
                });
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

            console.log('Stock Management page initialized');
        });
    </script>
</body>
</html>