<?php
$current_page = 'categories';
session_start();

// Initialize categories if not exists
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

// Handle form submission
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
        $success = true;
        $successMessage = "Category '$name' added successfully!";
        
        // Clear form data
        $_POST = array();
    } else {
        $error = "Please enter category name.";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Category - Admin Panel</title>

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
        .breadcrumb-custom a { color: #2563EB; text-decoration: none; }
        .breadcrumb-custom a:hover { text-decoration: underline; }
        .breadcrumb-custom i { margin: 0 8px; font-size: 0.7rem; color: #94A3B8; }
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
        <div id="add-category-page" class="page-section active-page">
            
           

            <!-- Page Header -->
            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                <h1 class="h2">Add New Category</h1>
                <!-- Back to Product Categories button REMOVED -->
            </div>

            <!-- Success Message -->
            <?php if (isset($success) && $success): ?>
            <div class="alert-success-custom">
                <span>
                    <i class="fas fa-check-circle me-2"></i> 
                    <strong><?= $successMessage ?></strong>
                </span>
                <a href="product-categories.php" class="alert-link">
                    <i class="fas fa-arrow-right me-1"></i> View Categories
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
                <form id="addCategoryForm" action="" method="POST">
                    <input type="hidden" name="add_category" value="1">
                    
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Category Name <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="categoryName" name="category_name" placeholder="Enter category name" value="<?= htmlspecialchars($_POST['category_name'] ?? '') ?>" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Slug</label>
                            <input type="text" class="form-control" id="categorySlug" name="category_slug" placeholder="category-slug" value="<?= htmlspecialchars($_POST['category_slug'] ?? '') ?>">
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Parent Category</label>
                            <select class="form-select" id="categoryParent" name="category_parent">
                                <option>None (Top Level)</option>
                                <option <?= ($_POST['category_parent'] ?? '') === 'Electronics' ? 'selected' : '' ?>>Electronics</option>
                                <option <?= ($_POST['category_parent'] ?? '') === 'Accessories' ? 'selected' : '' ?>>Accessories</option>
                                <option <?= ($_POST['category_parent'] ?? '') === 'Home & Living' ? 'selected' : '' ?>>Home & Living</option>
                                <option <?= ($_POST['category_parent'] ?? '') === 'Smart Devices' ? 'selected' : '' ?>>Smart Devices</option>
                            </select>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Status</label>
                            <select class="form-select" id="categoryStatus" name="category_status">
                                <option <?= ($_POST['category_status'] ?? '') === 'Active' ? 'selected' : '' ?>>Active</option>
                                <option <?= ($_POST['category_status'] ?? '') === 'Inactive' ? 'selected' : '' ?>>Inactive</option>
                                <option <?= ($_POST['category_status'] ?? '') === 'Draft' ? 'selected' : '' ?>>Draft</option>
                            </select>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Description</label>
                        <textarea class="form-control" id="categoryDescription" name="category_description" rows="4" placeholder="Category description"><?= htmlspecialchars($_POST['category_description'] ?? '') ?></textarea>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Add to Menu</label>
                        <div class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" role="switch" id="categoryMenu" name="category_menu" <?= isset($_POST['category_menu']) ? 'checked' : 'checked' ?>>
                            <label class="form-check-label" for="categoryMenu">Show in menu</label>
                        </div>
                    </div>

                    <div class="d-flex gap-2">
                        <button type="submit" class="btn btn-primary" id="saveCategoryBtn">
                            <i class="fas fa-save me-1"></i> Save Category
                        </button>
                        <a href="categories.php" class="btn btn-secondary">Cancel</a>
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
            document.getElementById('addCategoryForm')?.addEventListener('submit', function(e) {
                var name = document.getElementById('categoryName')?.value.trim() || '';
                if (!name) {
                    e.preventDefault();
                    alert('Please enter category name');
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

            console.log('Add Category page initialized');
        });
    </script>
</body>
</html>