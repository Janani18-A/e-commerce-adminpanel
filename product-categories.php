<?php
$current_page = 'categories';

// Start session
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Initialize categories in session if not exists
if (!isset($_SESSION['categories']) || empty($_SESSION['categories'])) {
    $_SESSION['categories'] = [
        ['id' => 1, 'name' => 'Electronics', 'slug' => 'electronics', 'menu' => true, 'visitors' => '1,245', 'status' => 'Active', 'badge' => 'active', 'color' => '#2563EB', 'letter' => 'E'],
        ['id' => 2, 'name' => 'Accessories', 'slug' => 'accessories', 'menu' => true, 'visitors' => '876', 'status' => 'Active', 'badge' => 'active', 'color' => '#10B981', 'letter' => 'A'],
        ['id' => 3, 'name' => 'Home & Living', 'slug' => 'home-living', 'menu' => false, 'visitors' => '543', 'status' => 'Inactive', 'badge' => 'inactive', 'color' => '#F59E0B', 'letter' => 'H'],
        ['id' => 4, 'name' => 'Smart Devices', 'slug' => 'smart-devices', 'menu' => true, 'visitors' => '2,109', 'status' => 'Active', 'badge' => 'active', 'color' => '#8B5CF6', 'letter' => 'S'],
        ['id' => 5, 'name' => 'Travel', 'slug' => 'travel', 'menu' => false, 'visitors' => '432', 'status' => 'Draft', 'badge' => 'draft', 'color' => '#EF4444', 'letter' => 'T'],
        ['id' => 6, 'name' => 'Industrial', 'slug' => 'industrial', 'menu' => true, 'visitors' => '321', 'status' => 'Active', 'badge' => 'active', 'color' => '#1E293B', 'letter' => 'I']
    ];
}

// --- HANDLE ADD CATEGORY ---
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add_category'])) {
    $name = trim($_POST['category_name'] ?? '');
    $slug = trim($_POST['category_slug'] ?? '');
    $status = trim($_POST['category_status'] ?? 'Active');
    $menu = isset($_POST['category_menu']) ? true : false;
    $description = trim($_POST['category_description'] ?? '');
    
    if (!empty($name)) {
        $finalSlug = $slug ?: strtolower(str_replace(' ', '-', $name));
        
        $badgeClass = 'active';
        if ($status === 'Inactive') $badgeClass = 'inactive';
        if ($status === 'Draft') $badgeClass = 'draft';
        
        $colors = ['#2563EB', '#10B981', '#F59E0B', '#8B5CF6', '#EF4444', '#1E293B', '#06B6D4', '#EC4899'];
        $color = $colors[array_rand($colors)];
        $letter = strtoupper($name[0]);
        
        $newCategory = [
            'id' => count($_SESSION['categories']) + 1,
            'name' => $name,
            'slug' => $finalSlug,
            'menu' => $menu,
            'visitors' => '0',
            'status' => $status,
            'badge' => $badgeClass,
            'color' => $color,
            'letter' => $letter,
            'description' => $description
        ];
        
        $_SESSION['categories'][] = $newCategory;
        header('Location: categories.php?added=1');
        exit;
    } else {
        header('Location: categories.php?error=1');
        exit;
    }
}

// --- HANDLE DELETE CATEGORY ---
if (isset($_GET['delete']) && isset($_GET['id'])) {
    $id = intval($_GET['id']);
    $_SESSION['categories'] = array_values(array_filter($_SESSION['categories'], function($c) use ($id) {
        return $c['id'] !== $id;
    }));
    header('Location: categories.php?deleted=1');
    exit;
}

// --- HANDLE UPDATE CATEGORY ---
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update_category'])) {
    $id = intval($_POST['category_id'] ?? 0);
    $name = trim($_POST['category_name'] ?? '');
    $slug = trim($_POST['category_slug'] ?? '');
    $status = trim($_POST['category_status'] ?? 'Active');
    $menu = isset($_POST['category_menu']) ? true : false;
    $description = trim($_POST['category_description'] ?? '');
    
    if ($id > 0 && !empty($name)) {
        foreach ($_SESSION['categories'] as &$category) {
            if ($category['id'] === $id) {
                $finalSlug = $slug ?: strtolower(str_replace(' ', '-', $name));
                
                $badgeClass = 'active';
                if ($status === 'Inactive') $badgeClass = 'inactive';
                if ($status === 'Draft') $badgeClass = 'draft';
                
                $category['name'] = $name;
                $category['slug'] = $finalSlug;
                $category['status'] = $status;
                $category['badge'] = $badgeClass;
                $category['menu'] = $menu;
                $category['description'] = $description;
                break;
            }
        }
        header('Location: categories.php?updated=1');
        exit;
    } else {
        header('Location: categories.php?error=1');
        exit;
    }
}

$categories = $_SESSION['categories'];
$showAdded = isset($_GET['added']);
$showDeleted = isset($_GET['deleted']);
$showUpdated = isset($_GET['updated']);
$showError = isset($_GET['error']);

// Calculate stats
$totalCategories = count($categories);
$activeCategories = count(array_filter($categories, function($c) {
    return $c['status'] === 'Active';
}));
$inactiveCategories = count(array_filter($categories, function($c) {
    return $c['status'] === 'Inactive';
}));
$draftCategories = count(array_filter($categories, function($c) {
    return $c['status'] === 'Draft';
}));
$menuCategories = count(array_filter($categories, function($c) {
    return $c['menu'] === true;
}));
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Categories - Admin Panel</title>

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
           CATEGORY TABLE
           ============================================ */
        .category-table-container {
            background: #FFFFFF;
            border-radius: 8px;
            border: 1px solid #E2E8F0;
            overflow: hidden;
        }
        .category-table-container .table { margin-bottom: 0; }
        .category-table-container .table thead th {
            background: #F8FAFC;
            color: #1E293B;
            font-weight: 600;
            border-bottom: 2px solid #E2E8F0;
            padding: 12px 15px;
            font-size: 0.85rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }
        .category-table-container .table tbody td {
            padding: 12px 15px;
            vertical-align: middle;
            border-bottom: 1px solid #E2E8F0;
        }
        .category-table-container .table tbody tr:hover { background: #F8FAFC; }
        .category-table-container .table tbody tr:last-child td { border-bottom: none; }

        .category-img-placeholder {
            width: 40px;
            height: 40px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 8px;
            font-weight: 700;
            font-size: 14px;
            color: #FFFFFF;
        }

        .badge-status {
            padding: 4px 12px;
            border-radius: 20px;
            font-size: 0.75rem;
            font-weight: 500;
        }
        .badge-status.active { background: #D1FAE5; color: #065F46; }
        .badge-status.inactive { background: #FEE2E2; color: #991B1B; }
        .badge-status.draft { background: #FEF3C7; color: #92400E; }

        .action-btn {
            padding: 4px 8px;
            border-radius: 6px;
            border: none;
            background: transparent;
            transition: all 0.2s ease;
            color: #64748B;
        }
        .action-btn:hover { background: #F1F5F9; color: #1E293B; }
        .action-btn.edit:hover { color: #2563EB; background: #DBEAFE; }
        .action-btn.delete:hover { color: #EF4444; background: #FEE2E2; }

        .menu-toggle {
            width: 40px;
            height: 22px;
            background: #CBD5E1;
            border-radius: 20px;
            display: inline-block;
            position: relative;
            cursor: pointer;
            transition: all 0.3s ease;
        }
        .menu-toggle.active { background: #2563EB; }
        .menu-toggle .toggle-slider {
            width: 18px;
            height: 18px;
            background: #FFFFFF;
            border-radius: 50%;
            position: absolute;
            top: 2px;
            left: 2px;
            transition: all 0.3s ease;
            box-shadow: 0 1px 3px rgba(0,0,0,0.2);
        }
        .menu-toggle.active .toggle-slider { left: 20px; }

        /* ============================================
           TABLE TOOLS
           ============================================ */
        .table-tools {
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            gap: 15px;
            margin-bottom: 20px;
        }
        .table-tools .left-section,
        .table-tools .right-section {
            display: flex;
            align-items: center;
            gap: 10px;
            flex-wrap: wrap;
        }
        .entries-select { width: 80px !important; }
        .search-input { width: 250px !important; }

        .pagination-info { color: #64748B; font-size: 0.9rem; }

        .btn-add-category {
            background: #2563EB;
            color: #FFFFFF;
            border: none;
            padding: 6px 16px;
            border-radius: 6px;
            font-size: 0.85rem;
            font-weight: 500;
            transition: all 0.3s ease;
        }
        .btn-add-category:hover { background: #1E40AF; color: #FFFFFF; }

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

        /* ---- Desktop Default ---- */
        .stat-card .stat-value { font-size: 1.5rem; }
        .stat-card { padding: 1.25rem; }
        .stat-card .stat-icon { width: 48px; height: 48px; font-size: 1.25rem; }
        .h2 { font-size: 1.8rem; }

        /* ---- Large Desktop (1200px+) ---- */
        @media (min-width: 1200px) {
            .stat-card .stat-value { font-size: 1.6rem; }
            .stat-card { padding: 1.5rem; }
            .h2 { font-size: 2rem; }
        }

        /* ---- Desktop (992px-1199px) ---- */
        @media (min-width: 992px) and (max-width: 1199px) {
            .stat-card .stat-value { font-size: 1.4rem; }
            .stat-card { padding: 1.25rem; }
            .stat-card .stat-icon { width: 44px; height: 44px; font-size: 1.1rem; }
            .h2 { font-size: 1.6rem; }
        }

        /* ---- Tablet (768px-991px) ---- */
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
            .category-table-container .table thead th { font-size: 0.7rem; padding: 8px 10px; }
            .category-table-container .table tbody td { padding: 8px 10px; font-size: 0.8rem; }
            
            .btn-sm { font-size: 0.7rem; padding: 0.2rem 0.5rem; }
            .pagination .page-link { font-size: 0.75rem; padding: 0.3rem 0.6rem; }
            .pagination-info { font-size: 0.8rem; }
            
            .filters-section .form-select-sm,
            .filters-section .form-control-sm { font-size: 0.8rem; padding: 0.2rem 0.5rem; }
        }

        /* ---- Mobile Large (576px-767px) ---- */
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
            .filters-section .form-select-sm,
            .filters-section .form-control-sm { font-size: 0.8rem; padding: 0.2rem 0.5rem; }

            .table-tools { flex-direction: column; align-items: stretch; }
            .search-input { width: 100% !important; }
            .entries-select { width: 80px !important; }

            /* Mobile Table View - Stacked */
            .category-table-container .table thead { display: none; }
            .category-table-container .table tbody td {
                display: flex;
                padding: 4px 12px;
                border-bottom: none;
                font-size: 0.85rem;
                text-align: left !important;
                align-items: center;
                gap: 8px;
                flex-wrap: wrap;
            }
            .category-table-container .table tbody td:before {
                content: attr(data-label);
                font-weight: 600;
                color: #64748B;
                min-width: 80px;
                flex-shrink: 0;
            }
            .category-table-container .table tbody td:last-child:before {
                display: none;
            }
            .category-table-container .table tbody td:last-child {
                justify-content: flex-start;
            }
            .category-table-container .table tbody tr {
                display: block;
                border-bottom: 1px solid #E2E8F0;
                padding: 6px 0;
            }
            .category-table-container .table tbody tr:last-child { border-bottom: none; }
            .category-table-container .table tbody td:first-child { padding-top: 10px; }
            .category-table-container .table tbody td:last-child { padding-bottom: 10px; }
            .category-img-placeholder { width: 35px; height: 35px; font-size: 12px; }

            .d-flex.justify-content-between.align-items-center.mt-3 {
                flex-direction: column;
                gap: 10px;
                align-items: flex-start !important;
            }
            .pagination-info { font-size: 0.8rem; }
            .pagination .page-link { font-size: 0.75rem; padding: 0.25rem 0.5rem; }
            
            /* Page header on mobile */
            .d-flex.justify-content-between.align-items-center {
                flex-direction: column;
                align-items: flex-start !important;
                gap: 8px;
            }
            .btn-toolbar { width: 100%; }
            .btn-toolbar .btn-group { width: 100%; }
            .btn-toolbar .btn-group .btn { width: 100%; }
            
            .breadcrumb-custom { font-size: 0.8rem; }
            .breadcrumb-custom i { margin: 0 5px; font-size: 0.6rem; }
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

            .table-tools { flex-direction: column; align-items: stretch; }
            .search-input { width: 100% !important; }
            .entries-select { width: 80px !important; }

            /* Mobile Table View - Stacked */
            .category-table-container .table thead { display: none; }
            .category-table-container .table tbody td {
                display: flex;
                padding: 3px 10px;
                border-bottom: none;
                font-size: 0.75rem;
                text-align: left !important;
                align-items: center;
                gap: 6px;
                flex-wrap: wrap;
            }
            .category-table-container .table tbody td:before {
                content: attr(data-label);
                font-weight: 600;
                color: #64748B;
                min-width: 70px;
                flex-shrink: 0;
                font-size: 0.7rem;
            }
            .category-table-container .table tbody td:last-child:before {
                display: none;
            }
            .category-table-container .table tbody td:last-child {
                justify-content: flex-start;
            }
            .category-table-container .table tbody tr {
                display: block;
                border-bottom: 1px solid #E2E8F0;
                padding: 4px 0;
            }
            .category-table-container .table tbody tr:last-child { border-bottom: none; }
            .category-table-container .table tbody td:first-child { padding-top: 8px; }
            .category-table-container .table tbody td:last-child { padding-bottom: 8px; }
            .category-img-placeholder { width: 30px; height: 30px; font-size: 10px; }
            .category-table-container .table .badge-status { font-size: 0.6rem; padding: 2px 6px; }
            .action-btn { padding: 2px 5px; font-size: 0.7rem; }

            .d-flex.justify-content-between.align-items-center.mt-3 {
                flex-direction: column;
                gap: 8px;
                align-items: flex-start !important;
            }
            .pagination-info { font-size: 0.7rem; }
            .pagination .page-link { font-size: 0.65rem; padding: 0.2rem 0.4rem; }
            
            /* Page header on mobile */
            .d-flex.justify-content-between.align-items-center {
                flex-direction: column;
                align-items: flex-start !important;
                gap: 6px;
            }
            .btn-toolbar { width: 100%; }
            .btn-toolbar .btn-group { width: 100%; }
            .btn-toolbar .btn-group .btn { width: 100%; font-size: 0.7rem; }
            
            .breadcrumb-custom { font-size: 0.75rem; }
            .breadcrumb-custom i { margin: 0 4px; font-size: 0.55rem; }
        }

        /* ---- Very Small Phones (below 380px) ---- */
        @media (max-width: 379.98px) {
            .main-content { padding: 5px 6px; }
            .stat-card .stat-value { font-size: 0.8rem; }
            .stat-card { padding: 0.5rem; }
            .stat-card .stat-icon { width: 28px; height: 28px; font-size: 0.7rem; }
            .stat-card .stat-label { font-size: 0.6rem; }
            .h2 { font-size: 0.85rem; }
            .category-table-container .table tbody td { font-size: 0.65rem; padding: 2px 6px; }
            .category-img-placeholder { width: 25px; height: 25px; font-size: 8px; }
            .pagination .page-link { font-size: 0.55rem; padding: 0.15rem 0.3rem; }
            .pagination-info { font-size: 0.6rem; }
            .breadcrumb-custom { font-size: 0.65rem; }
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
        <div id="categories-page" class="page-section active-page">
            
            

            <!-- Alerts -->
            <?php if ($showAdded): ?>
            <div class="alert-custom success show">
                <i class="fas fa-check-circle me-2"></i> Category added successfully!
            </div>
            <?php endif; ?>
            
            <?php if ($showUpdated): ?>
            <div class="alert-custom success show">
                <i class="fas fa-check-circle me-2"></i> Category updated successfully!
            </div>
            <?php endif; ?>
            
            <?php if ($showDeleted): ?>
            <div class="alert-custom success show" style="background: #FEE2E2; color: #991B1B; border-left-color: #EF4444;">
                <i class="fas fa-trash me-2"></i> Category deleted successfully!
            </div>
            <?php endif; ?>

            <?php if ($showError): ?>
            <div class="alert-custom error show">
                <i class="fas fa-exclamation-circle me-2"></i> Failed to process category. Please check all fields.
            </div>
            <?php endif; ?>

            <!-- Page Header -->
            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                <h1 class="h2">Product Categories</h1>
                <div class="btn-toolbar mb-2 mb-md-0">
                    <div class="btn-group me-2">
                        <a href="add-categories.php" class="btn btn-sm btn-outline-primary">
                            <i class="fas fa-plus-circle me-1"></i> Add Category
                        </a>
                    </div>
                </div>
            </div>

            <!-- Stats Cards -->
            <div class="row mb-4">
                <div class="col-xl-3 col-lg-6 col-md-6 col-12 mb-3">
                    <div class="stat-card d-flex align-items-center">
                        <div class="stat-icon blue me-3">
                            <i class="fas fa-tags"></i>
                        </div>
                        <div>
                            <div class="stat-value"><?= $totalCategories ?></div>
                            <div class="stat-label">Total Categories</div>
                            <div class="stat-trend up">↑ +<?= $totalCategories > 0 ? round(($totalCategories / 6) * 100, 1) : 0 ?>%</div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-6 col-md-6 col-12 mb-3">
                    <div class="stat-card d-flex align-items-center">
                        <div class="stat-icon green me-3">
                            <i class="fas fa-check-circle"></i>
                        </div>
                        <div>
                            <div class="stat-value"><?= $activeCategories ?></div>
                            <div class="stat-label">Active</div>
                            <div class="stat-trend up">↑ +<?= $activeCategories > 0 ? round(($activeCategories / $totalCategories) * 100, 1) : 0 ?>%</div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-6 col-md-6 col-12 mb-3">
                    <div class="stat-card d-flex align-items-center">
                        <div class="stat-icon yellow me-3">
                            <i class="fas fa-exclamation-triangle"></i>
                        </div>
                        <div>
                            <div class="stat-value"><?= $inactiveCategories ?></div>
                            <div class="stat-label">Inactive</div>
                            <div class="stat-trend down">↓ <?= $inactiveCategories > 0 ? 'Inactive' : 'All active' ?></div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-6 col-md-6 col-12 mb-3">
                    <div class="stat-card d-flex align-items-center">
                        <div class="stat-icon red me-3">
                            <i class="fas fa-times-circle"></i>
                        </div>
                        <div>
                            <div class="stat-value"><?= $draftCategories ?></div>
                            <div class="stat-label">Draft</div>
                            <div class="stat-trend down">↓ <?= $draftCategories > 0 ? 'In draft' : 'No drafts' ?></div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Filters - Like Products Page -->
            <div class="row mb-3 filters-section">
                <div class="col-md-3 col-sm-6 col-12">
                    <select class="form-select form-select-sm" id="categoryFilter">
                        <option>All Categories</option>
                        <option>Electronics</option>
                        <option>Accessories</option>
                        <option>Home & Living</option>
                        <option>Smart Devices</option>
                        <option>Travel</option>
                        <option>Industrial</option>
                    </select>
                </div>
                <div class="col-md-3 col-sm-6 col-12">
                    <select class="form-select form-select-sm" id="statusFilter">
                        <option>All Status</option>
                        <option>Active</option>
                        <option>Inactive</option>
                        <option>Draft</option>
                    </select>
                </div>
                <div class="col-md-6 col-sm-12 col-12">
                    <div class="input-group input-group-sm">
                        <span class="input-group-text bg-white border-end-0">
                            <i class="fas fa-search text-muted"></i>
                        </span>
                        <input type="text" class="form-control form-control-sm border-start-0" id="categorySearch" placeholder="Search categories...">
                    </div>
                </div>
            </div>

            <!-- Categories Table -->
            <div class="category-table-container">
                <table class="table">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Image</th>
                            <th>Category</th>
                            <th>Slug</th>
                            <th>Add to Menu</th>
                            <th>Visitors</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody id="categoryTableBody">
                        <?php if (empty($categories)): ?>
                        <tr>
                            <td colspan="8" class="text-center py-4">
                                <i class="fas fa-folder-open fa-2x text-muted mb-2 d-block"></i>
                                <span class="text-muted">No categories found. <a href="add-categories.php">Add your first category</a></span>
                            </td>
                        </tr>
                        <?php else: ?>
                        <?php foreach ($categories as $c): ?>
                        <tr data-id="<?= $c['id'] ?>" data-name="<?= htmlspecialchars($c['name']) ?>" data-slug="<?= htmlspecialchars($c['slug']) ?>" data-status="<?= htmlspecialchars($c['status']) ?>" data-menu="<?= $c['menu'] ? '1' : '0' ?>" data-description="<?= htmlspecialchars($c['description'] ?? '') ?>">
                            <td data-label="#"><?= $c['id'] ?></td>
                            <td data-label="Image">
                                <div class="category-img-placeholder" style="background: <?= $c['color'] ?>;"><?= $c['letter'] ?></div>
                            </td>
                            <td data-label="Category"><strong><?= htmlspecialchars($c['name']) ?></strong></td>
                            <td data-label="Slug"><code><?= htmlspecialchars($c['slug']) ?></code></td>
                            <td data-label="Add to Menu">
                                <div class="menu-toggle <?= $c['menu'] ? 'active' : '' ?>">
                                    <span class="toggle-slider"></span>
                                </div>
                            </td>
                            <td data-label="Visitors"><?= $c['visitors'] ?></td>
                            <td data-label="Status"><span class="badge-status <?= $c['badge'] ?>"><?= $c['status'] ?></span></td>
                            <td data-label="Action">
                                <a href="edit-categories.php?id=<?= $c['id'] ?>" class="btn btn-sm btn-outline-secondary me-1" style="border-radius: 6px; padding: 4px 10px;">
                                <i class="fas fa-edit"></i></a>
                                <a href="categories.php?delete=1&id=<?= $c['id'] ?>" class="btn btn-sm btn-outline-danger" style="border-radius: 6px; padding: 4px 10px;" onclick="return confirm('Are you sure you want to delete this category?')">
                                <i class="fas fa-trash"></i></a>
                        </tr>
                        <?php endforeach; ?>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            <div class="d-flex justify-content-between align-items-center mt-3">
                <div class="pagination-info" id="paginationInfo">Showing 1 to <?= $totalCategories ?> of <?= $totalCategories ?> entries</div>
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
            var rows = document.querySelectorAll('#categoryTableBody tr');
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

            // ---- TOGGLE MENU SWITCH ----
            document.addEventListener('click', function(e) {
                if (e.target.closest('.menu-toggle')) {
                    var toggle = e.target.closest('.menu-toggle');
                    toggle.classList.toggle('active');
                }
            });

            // ---- SEARCH CATEGORIES ----
            var categorySearch = document.getElementById('categorySearch');
            if (categorySearch) {
                categorySearch.addEventListener('keyup', function () {
                    var term = this.value.toLowerCase().trim();
                    var rows = document.querySelectorAll('#categoryTableBody tr');
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

            // ---- FILTER CATEGORIES ----
            var categoryFilter = document.getElementById('categoryFilter');
            var statusFilter = document.getElementById('statusFilter');

            if (categoryFilter) {
                categoryFilter.addEventListener('change', function () { filterCategories(); });
            }
            if (statusFilter) {
                statusFilter.addEventListener('change', function () { filterCategories(); });
            }

            function filterCategories() {
                var category = document.getElementById('categoryFilter')?.value || 'All Categories';
                var status = document.getElementById('statusFilter')?.value || 'All Status';
                var rows = document.querySelectorAll('#categoryTableBody tr');
                var visibleCount = 0;

                rows.forEach(function (row) {
                    var rowCategory = row.querySelector('td:nth-child(3)')?.textContent?.trim() || '';
                    var rowStatus = row.querySelector('td:nth-child(7) .badge-status')?.textContent || '';

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

            // ---- ENTRIES SELECTOR ----
            var entriesSelect = document.getElementById('entriesSelect');
            if (entriesSelect) {
                entriesSelect.addEventListener('change', function () {
                    rowsPerPage = parseInt(this.value);
                    currentPage = 1;
                    totalPages = Math.ceil(totalRows / rowsPerPage);
                    showPage(1);
                });
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

            console.log('Categories page initialized');
        });
    </script>
</body>
</html>