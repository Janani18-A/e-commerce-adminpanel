<?php
$current_page = 'categories';
session_start();

// Get category ID from URL
$categoryId = isset($_GET['id']) ? intval($_GET['id']) : 0;

// Find the category in session
$category = null;
if (isset($_SESSION['categories'])) {
    foreach ($_SESSION['categories'] as $c) {
        if ($c['id'] === $categoryId) {
            $category = $c;
            break;
        }
    }
}

// If category not found, redirect to categories list
if (!$category) {
    header('Location: categories.php');
    exit;
}

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update_category'])) {
    $id = intval($_POST['category_id'] ?? 0);
    $name = trim($_POST['category_name'] ?? '');
    $slug = trim($_POST['category_slug'] ?? '');
    $status = trim($_POST['category_status'] ?? 'Active');
    $menu = isset($_POST['category_menu']) ? true : false;
    $description = trim($_POST['category_description'] ?? '');
    
    if ($id > 0 && !empty($name)) {
        foreach ($_SESSION['categories'] as &$c) {
            if ($c['id'] === $id) {
                $finalSlug = $slug ?: strtolower(str_replace(' ', '-', $name));
                
                $badgeClass = 'active';
                if ($status === 'Inactive') $badgeClass = 'inactive';
                if ($status === 'Draft') $badgeClass = 'draft';
                
                $c['name'] = $name;
                $c['slug'] = $finalSlug;
                $c['status'] = $status;
                $c['badge'] = $badgeClass;
                $c['menu'] = $menu;
                $c['description'] = $description;
                break;
            }
        }
        
        // Show success message on same page
        $success = true;
        $successMessage = "Category '$name' updated successfully!";
        
        // Update category variable
        foreach ($_SESSION['categories'] as $c) {
            if ($c['id'] === $categoryId) {
                $category = $c;
                break;
            }
        }
    } else {
        $error = "Please enter category name.";
    }
}

// Get the category data (after possible update)
foreach ($_SESSION['categories'] as $c) {
    if ($c['id'] === $categoryId) {
        $category = $c;
        break;
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Category - Admin Panel</title>

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
        <div id="edit-category-page" class="page-section active-page">
            
            

            <!-- Page Header -->
            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                <h1 class="h2">Edit Category</h1>
                <!-- Back to Categories button REMOVED -->
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
                <form id="editCategoryForm" action="" method="POST">
                    <input type="hidden" name="update_category" value="1">
                    <input type="hidden" name="category_id" value="<?= $category['id'] ?>">
                    
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Category Name <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="categoryName" name="category_name" value="<?= htmlspecialchars($category['name']) ?>" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Slug</label>
                            <input type="text" class="form-control" id="categorySlug" name="category_slug" value="<?= htmlspecialchars($category['slug']) ?>">
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Parent Category</label>
                            <select class="form-select" id="categoryParent" name="category_parent">
                                <option>None (Top Level)</option>
                                <option <?= ($category['parent'] ?? '') === 'Electronics' ? 'selected' : '' ?>>Electronics</option>
                                <option <?= ($category['parent'] ?? '') === 'Accessories' ? 'selected' : '' ?>>Accessories</option>
                                <option <?= ($category['parent'] ?? '') === 'Home & Living' ? 'selected' : '' ?>>Home & Living</option>
                                <option <?= ($category['parent'] ?? '') === 'Smart Devices' ? 'selected' : '' ?>>Smart Devices</option>
                            </select>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Status</label>
                            <select class="form-select" id="categoryStatus" name="category_status">
                                <option <?= ($category['status'] ?? '') === 'Active' ? 'selected' : '' ?>>Active</option>
                                <option <?= ($category['status'] ?? '') === 'Inactive' ? 'selected' : '' ?>>Inactive</option>
                                <option <?= ($category['status'] ?? '') === 'Draft' ? 'selected' : '' ?>>Draft</option>
                            </select>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Description</label>
                        <textarea class="form-control" id="categoryDescription" name="category_description" rows="4"><?= htmlspecialchars($category['description'] ?? '') ?></textarea>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Add to Menu</label>
                        <div class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" role="switch" id="categoryMenu" name="category_menu" <?= $category['menu'] ? 'checked' : '' ?>>
                            <label class="form-check-label" for="categoryMenu">Show in menu</label>
                        </div>
                    </div>

                    <div class="d-flex gap-2">
                        <button type="submit" class="btn btn-primary" id="updateCategoryBtn">
                            <i class="fas fa-save me-1"></i> Update Category
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
            document.getElementById('editCategoryForm')?.addEventListener('submit', function(e) {
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

            console.log('Edit Category page initialized');
        });
    </script>
</body>
</html>