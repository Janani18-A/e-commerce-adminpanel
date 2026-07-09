<?php
$current_page = 'discounts';
session_start();

// Get discount ID from URL
$discountId = isset($_GET['id']) ? intval($_GET['id']) : 0;

// Find the discount in session
$discount = null;
if (isset($_SESSION['discounts'])) {
    foreach ($_SESSION['discounts'] as $d) {
        if ($d['id'] === $discountId) {
            $discount = $d;
            break;
        }
    }
}

// If discount not found, redirect
if (!$discount) {
    header('Location: discounts.php');
    exit;
}

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update_discount'])) {
    $id = intval($_POST['discount_id'] ?? 0);
    $code = strtoupper(trim($_POST['discount_code'] ?? ''));
    $type = trim($_POST['discount_type'] ?? '');
    $value = floatval($_POST['discount_value'] ?? 0);
    $eligibility = trim($_POST['discount_eligibility'] ?? '');
    $usage = trim($_POST['usage_limit'] ?? 'No limit');
    $status = trim($_POST['discount_status'] ?? 'Active');
    $description = trim($_POST['discount_description'] ?? '');
    $minOrder = floatval($_POST['min_order'] ?? 0);
    
    if ($id > 0 && !empty($code) && $value > 0) {
        foreach ($_SESSION['discounts'] as &$d) {
            if ($d['id'] === $id) {
                // Determine discount display
                $discountDisplay = $value . '% OFF';
                $typeClass = 'percentage';
                if ($type === 'Fixed Amount') {
                    $discountDisplay = '$' . number_format($value, 2) . ' OFF';
                    $typeClass = 'fixed';
                } else if ($type === 'Free Shipping') {
                    $discountDisplay = 'Free Shipping';
                    $typeClass = 'fixed';
                } else if ($type === 'Buy X Get Y') {
                    $discountDisplay = 'Buy ' . $value . ' Get 1';
                    $typeClass = 'fixed';
                }
                
                // Determine eligibility badge
                $eligClass = 'all';
                if ($eligibility === 'Specific Category') $eligClass = 'category';
                if ($eligibility === 'Specific Product' || $eligibility === 'New Customers') $eligClass = 'specific';
                
                // Determine status badge
                $statusClass = 'active';
                if ($status === 'Inactive') $statusClass = 'inactive';
                if ($status === 'Scheduled') $statusClass = 'scheduled';
                
                $d['code'] = $code;
                $d['discount'] = $discountDisplay;
                $d['type'] = $typeClass;
                $d['eligibility'] = $eligibility ?: 'All Products';
                $d['badge_elig'] = $eligClass;
                $d['usage'] = $usage === 'No limit' ? 'No limit' : intval($usage);
                $d['status'] = $status;
                $d['badge_status'] = $statusClass;
                $d['description'] = $description;
                $d['min_order'] = $minOrder;
                break;
            }
        }
        
        $success = true;
        $successMessage = "Coupon '$code' updated successfully!";
        
        // Update discount variable
        foreach ($_SESSION['discounts'] as $d) {
            if ($d['id'] === $discountId) {
                $discount = $d;
                break;
            }
        }
    } else {
        $error = "Please enter coupon code and valid discount value.";
    }
}

// Get the discount data (after possible update)
foreach ($_SESSION['discounts'] as $d) {
    if ($d['id'] === $discountId) {
        $discount = $d;
        break;
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Coupon - Admin Panel</title>

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
        .breadcrumb-custom a { color: #2563EB; text-decoration: none; cursor: pointer; }
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
        .sidebar-toggle { display: none; background: transparent; border: none; color: #1E293B; font-size: 1.2rem; padding: 0 10px; }

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
        <div id="edit-discount-page" class="page-section active-page">
            
            <!-- Breadcrumb -->
            <div class="breadcrumb-custom mb-3">
                <a href="dashboard.php"><i class="fas fa-home"></i> Dashboard</a>
                <i class="fas fa-chevron-right"></i>
                <a href="discount.php">Discounts</a>
                <i class="fas fa-chevron-right"></i>
                <span>Edit Coupon</span>
            </div>

            <!-- Page Header -->
            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                <h1 class="h2">Edit Coupon</h1>
            </div>

            <!-- Success Message -->
            <?php if (isset($success) && $success): ?>
            <div class="alert-success-custom">
                <span>
                    <i class="fas fa-check-circle me-2"></i> 
                    <strong><?= $successMessage ?></strong>
                </span>
                <a href="discount.php" class="alert-link">
                    <i class="fas fa-arrow-right me-1"></i> View Coupons
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
                <form id="editDiscountForm" action="" method="POST">
                    <input type="hidden" name="update_discount" value="1">
                    <input type="hidden" name="discount_id" value="<?= $discount['id'] ?>">
                    
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Coupon Code <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="couponCode" name="discount_code" value="<?= htmlspecialchars($discount['code']) ?>" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Discount Type</label>
                            <select class="form-select" id="discountType" name="discount_type">
                                <option <?= ($discount['type'] ?? '') === 'percentage' ? 'selected' : '' ?>>Percentage</option>
                                <option <?= ($discount['type'] ?? '') === 'fixed' ? 'selected' : '' ?>>Fixed Amount</option>
                                <option <?= ($discount['type'] ?? '') === 'fixed' && strpos($discount['discount'], 'Free Shipping') !== false ? 'selected' : '' ?>>Free Shipping</option>
                                <option <?= ($discount['type'] ?? '') === 'fixed' && strpos($discount['discount'], 'Buy') !== false ? 'selected' : '' ?>>Buy X Get Y</option>
                            </select>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Discount Value <span class="text-danger">*</span></label>
                            <input type="number" class="form-control" id="discountValue" name="discount_value" value="<?= preg_replace('/[^0-9.]/', '', $discount['discount']) ?>" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Eligibility</label>
                            <select class="form-select" id="eligibility" name="discount_eligibility">
                                <option <?= ($discount['eligibility'] ?? '') === 'All Products' ? 'selected' : '' ?>>All Products</option>
                                <option <?= ($discount['eligibility'] ?? '') === 'Category: Electronics' || ($discount['eligibility'] ?? '') === 'Category: Accessories' ? 'selected' : '' ?>>Specific Category</option>
                                <option <?= ($discount['eligibility'] ?? '') === 'Smart Devices' ? 'selected' : '' ?>>Specific Product</option>
                                <option <?= ($discount['eligibility'] ?? '') === 'New Customers' ? 'selected' : '' ?>>New Customers</option>
                            </select>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Usage Limit</label>
                            <input type="text" class="form-control" id="usageLimit" name="usage_limit" value="<?= htmlspecialchars($discount['usage']) ?>">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Status</label>
                            <select class="form-select" id="discountStatus" name="discount_status">
                                <option <?= ($discount['status'] ?? '') === 'Active' ? 'selected' : '' ?>>Active</option>
                                <option <?= ($discount['status'] ?? '') === 'Inactive' ? 'selected' : '' ?>>Inactive</option>
                                <option <?= ($discount['status'] ?? '') === 'Scheduled' ? 'selected' : '' ?>>Scheduled</option>
                            </select>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Minimum Order Amount</label>
                            <input type="number" class="form-control" id="minOrder" name="min_order" placeholder="0.00" step="0.01" value="<?= htmlspecialchars($discount['min_order'] ?? '') ?>">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Description</label>
                            <textarea class="form-control" id="discountDescription" name="discount_description" rows="2" placeholder="Coupon description"><?= htmlspecialchars($discount['description'] ?? '') ?></textarea>
                        </div>
                    </div>

                    <div class="d-flex gap-2">
                        <button type="submit" class="btn btn-primary" id="updateDiscountBtn">
                            <i class="fas fa-save me-1"></i> Update Coupon
                        </button>
                        <a href="discount.php" class="btn btn-secondary">Cancel</a>
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
            document.getElementById('editDiscountForm')?.addEventListener('submit', function(e) {
                var code = document.getElementById('couponCode')?.value.trim() || '';
                var value = document.getElementById('discountValue')?.value || '';

                if (!code) {
                    e.preventDefault();
                    alert('Please enter coupon code');
                    return false;
                }
                if (!value || value <= 0) {
                    e.preventDefault();
                    alert('Please enter valid discount value');
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

            console.log('Edit Discount page initialized');
        });
    </script>
</body>
</html>