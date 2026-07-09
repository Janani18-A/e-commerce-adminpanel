<?php
$current_page = 'discounts';
session_start();

// Initialize discounts in session if not exists
if (!isset($_SESSION['discounts']) || empty($_SESSION['discounts'])) {
    $_SESSION['discounts'] = [
        ['id' => 1, 'code' => 'SUMMER20', 'discount' => '20% OFF', 'type' => 'percentage', 'eligibility' => 'All Products', 'badge_elig' => 'all', 'usage' => 150, 'expires' => 'Jul 31, 2026', 'status' => 'Active', 'badge_status' => 'active'],
        ['id' => 2, 'code' => 'FREESHIP', 'discount' => 'Free Shipping', 'type' => 'fixed', 'eligibility' => 'Category: Electronics', 'badge_elig' => 'category', 'usage' => 75, 'expires' => 'Aug 15, 2026', 'status' => 'Active', 'badge_status' => 'active'],
        ['id' => 3, 'code' => 'WELCOME10', 'discount' => '10% OFF', 'type' => 'percentage', 'eligibility' => 'New Customers', 'badge_elig' => 'specific', 'usage' => 200, 'expires' => 'Dec 31, 2026', 'status' => 'Active', 'badge_status' => 'active'],
        ['id' => 4, 'code' => 'HOLIDAY25', 'discount' => '25% OFF', 'type' => 'percentage', 'eligibility' => 'All Products', 'badge_elig' => 'all', 'usage' => 50, 'expires' => 'Dec 25, 2026', 'status' => 'Scheduled', 'badge_status' => 'scheduled'],
        ['id' => 5, 'code' => 'FLASH50', 'discount' => '50% OFF', 'type' => 'percentage', 'eligibility' => 'Smart Devices', 'badge_elig' => 'specific', 'usage' => 30, 'expires' => 'Jun 30, 2026', 'status' => 'Expired', 'badge_status' => 'expired'],
        ['id' => 6, 'code' => 'BOGO2026', 'discount' => 'Buy 1 Get 1', 'type' => 'fixed', 'eligibility' => 'Category: Accessories', 'badge_elig' => 'category', 'usage' => 100, 'expires' => 'Sep 30, 2026', 'status' => 'Active', 'badge_status' => 'active']
    ];
}

// Handle Delete Discount
if (isset($_GET['delete']) && isset($_GET['id'])) {
    $id = intval($_GET['id']);
    $_SESSION['discounts'] = array_values(array_filter($_SESSION['discounts'], function($d) use ($id) {
        return $d['id'] !== $id;
    }));
    header('Location: discounts.php?deleted=1');
    exit;
}

$discounts = $_SESSION['discounts'];
$showDeleted = isset($_GET['deleted']);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Discounts - Admin Panel</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/style.css">

    <style>
        * { box-sizing: border-box; }
        body { font-family: 'Inter', sans-serif; background: #F8FAFC; }

        .breadcrumb-custom {
            font-size: 0.9rem;
            color: #64748B;
        }
        .breadcrumb-custom a { color: #2563EB; text-decoration: none; cursor: pointer; }
        .breadcrumb-custom a:hover { text-decoration: underline; }
        .breadcrumb-custom i { margin: 0 8px; font-size: 0.7rem; color: #94A3B8; }

        .discount-table-container {
            background: #FFFFFF;
            border-radius: 8px;
            border: 1px solid #E2E8F0;
            overflow: hidden;
        }
        .discount-table-container .table { margin-bottom: 0; }
        .discount-table-container .table thead th {
            background: #F8FAFC;
            color: #1E293B;
            font-weight: 600;
            border-bottom: 2px solid #E2E8F0;
            padding: 12px 15px;
            font-size: 0.85rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }
        .discount-table-container .table tbody td {
            padding: 12px 15px;
            vertical-align: middle;
            border-bottom: 1px solid #E2E8F0;
        }
        .discount-table-container .table tbody tr:hover { background: #F8FAFC; }
        .discount-table-container .table tbody tr:last-child td { border-bottom: none; }

        .discount-code {
            display: inline-block;
            background: #F1F5F9;
            padding: 4px 12px;
            border-radius: 6px;
            font-weight: 600;
            font-size: 0.85rem;
            color: #1E293B;
            font-family: 'Courier New', monospace;
            letter-spacing: 0.5px;
        }

        .discount-amount { font-weight: 700; font-size: 1rem; }
        .discount-amount.percentage { color: #2563EB; }
        .discount-amount.fixed { color: #10B981; }

        .eligibility-badge {
            padding: 4px 10px;
            border-radius: 20px;
            font-size: 0.75rem;
            font-weight: 500;
            background: #F1F5F9;
            color: #1E293B;
        }
        .eligibility-badge.all { background: #DBEAFE; color: #1E40AF; }
        .eligibility-badge.category { background: #D1FAE5; color: #065F46; }
        .eligibility-badge.specific { background: #FEF3C7; color: #92400E; }

        .badge-status {
            padding: 4px 12px;
            border-radius: 20px;
            font-size: 0.75rem;
            font-weight: 500;
        }
        .badge-status.active { background: #D1FAE5; color: #065F46; }
        .badge-status.inactive { background: #FEE2E2; color: #991B1B; }
        .badge-status.expired { background: #FEF3C7; color: #92400E; }
        .badge-status.scheduled { background: #CFFAFE; color: #0E7490; }

        .action-btn {
            padding: 4px 8px;
            border-radius: 6px;
            border: none;
            background: transparent;
            transition: all 0.2s ease;
            color: #64748B;
            text-decoration: none;
            display: inline-block;
        }
        .action-btn:hover { background: #F1F5F9; color: #1E293B; }
        .action-btn.delete:hover { color: #EF4444; background: #FEE2E2; }

        .btn-add-coupon {
            background: #2563EB;
            color: #FFFFFF;
            border: none;
            padding: 6px 16px;
            border-radius: 6px;
            font-size: 0.85rem;
            font-weight: 500;
            transition: all 0.3s ease;
        }
        .btn-add-coupon:hover { background: #1E40AF; color: #FFFFFF; }

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

        .alert-custom {
            padding: 12px 16px;
            border-radius: 8px;
            margin-bottom: 1rem;
            display: none;
            border-left: 4px solid;
        }
        .alert-custom.show { display: block; }
        .alert-custom.success { background: #D1FAE5; color: #065F46; border-left-color: #10B981; }
        .alert-custom.error { background: #FEE2E2; color: #991B1B; border-left-color: #EF4444; }

        .sidebar-toggle { display: none; background: transparent; border: none; color: #1E293B; font-size: 1.2rem; padding: 0 10px; }

        @media (max-width: 767.98px) {
            .sidebar-wrapper { width: 0; transform: translateX(-100%); transition: all 0.3s ease; position: fixed; top: 56px; left: 0; bottom: 0; z-index: 1040; background: #FFFFFF; overflow-y: auto; box-shadow: 2px 0 8px rgba(0,0,0,0.1); }
            .sidebar-wrapper.open { width: 280px; transform: translateX(0); }
            .main-content { margin-left: 0; padding: 10px 12px; }
            .sidebar-toggle { display: block !important; }
            .d-flex.justify-content-between.align-items-center { flex-direction: column; align-items: flex-start !important; gap: 8px; }
            .btn-toolbar { width: 100%; }
            .btn-toolbar .btn-group { width: 100%; }
            .btn-toolbar .btn-group .btn { width: 100%; }
            
            .discount-table-container .table thead { display: none; }
            .discount-table-container .table tbody td {
                display: flex;
                padding: 4px 10px;
                border-bottom: none;
                font-size: 0.8rem;
                text-align: left !important;
                align-items: center;
                gap: 8px;
                flex-wrap: wrap;
            }
            .discount-table-container .table tbody td:before {
                content: attr(data-label);
                font-weight: 600;
                color: #64748B;
                min-width: 100px;
                flex-shrink: 0;
            }
            .discount-table-container .table tbody td:last-child:before { display: none; }
            .discount-table-container .table tbody td:last-child { justify-content: flex-start; }
            .discount-table-container .table tbody td:first-child:before { display: none; }
            .discount-table-container .table tbody tr { display: block; border-bottom: 1px solid #E2E8F0; padding: 4px 0; }
            .discount-table-container .table tbody tr:last-child { border-bottom: none; }
            .discount-table-container .table tbody td:first-child { padding-top: 8px; }
            .discount-table-container .table tbody td:last-child { padding-bottom: 8px; }
            
            .table-tools { flex-direction: column; align-items: stretch; }
            .search-input { width: 100% !important; }
            
            .modal-dialog { margin: 0.5rem; }
            .modal-body { padding: 1rem; }
        }

        @media (max-width: 479.98px) {
            .main-content { padding: 6px 8px; }
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
        <div id="discounts-page" class="page-section active-page">
            
            <!-- Breadcrumb -->
            <div class="breadcrumb-custom mb-3">
                <a href="dashboard.php"><i class="fas fa-home"></i> Dashboard</a>
                <i class="fas fa-chevron-right"></i>
                <span>Discounts</span>
            </div>

            <!-- Alerts -->
            <?php if ($showDeleted): ?>
            <div class="alert-custom success show" style="background: #FEE2E2; color: #991B1B; border-left-color: #EF4444;">
                <i class="fas fa-trash me-2"></i> Coupon deleted successfully!
            </div>
            <?php endif; ?>

            <!-- Page Header -->
            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-1 pb-3 mb-3 border-bottom">
                <h1 class="h2">Discounts</h1>
                <div class="btn-toolbar mb-2 mb-md-0">
                    <a href="add-discount.php" class="btn btn-add-coupon">
                        <i class="fas fa-plus"></i> Add Coupon
                    </a>
                </div>
            </div>

            <!-- Table Tools -->
            <div class="table-tools">
                <div class="left-section">
                    <span class="text-muted" style="font-size:0.85rem;">Show</span>
                    <select class="form-select form-select-sm entries-select" id="entriesSelect">
                        <option>10</option>
                        <option>25</option>
                        <option>50</option>
                        <option>100</option>
                    </select>
                    <span class="text-muted" style="font-size:0.85rem;">entries</span>
                </div>
                <div class="right-section">
                    <span class="text-muted" style="font-size:0.85rem;">Search:</span>
                    <input type="text" class="form-control form-control-sm search-input" id="discountSearch" placeholder="Search coupons...">
                </div>
            </div>

            <!-- Discounts Table -->
            <div class="discount-table-container">
                <table class="table">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Code</th>
                            <th>Discount</th>
                            <th>Eligibility</th>
                            <th>Usage limit</th>
                            <th>Expires on</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody id="discountTableBody">
                        <?php if (empty($discounts)): ?>
                        <tr>
                            <td colspan="8" class="text-center py-4">
                                <i class="fas fa-ticket-alt fa-2x text-muted mb-2 d-block"></i>
                                <span class="text-muted">No coupons found. <a href="add-discount.php">Add your first coupon</a></span>
                            </td>
                        </tr>
                        <?php else: ?>
                        <?php foreach ($discounts as $d): ?>
                        <tr data-id="<?= $d['id'] ?>" data-code="<?= htmlspecialchars($d['code']) ?>" data-discount="<?= htmlspecialchars($d['discount']) ?>" data-type="<?= $d['type'] ?>" data-eligibility="<?= htmlspecialchars($d['eligibility']) ?>" data-badge_elig="<?= $d['badge_elig'] ?>" data-usage="<?= $d['usage'] ?>" data-expires="<?= $d['expires'] ?>" data-status="<?= $d['status'] ?>" data-badge_status="<?= $d['badge_status'] ?>">
                            <td data-label="#"><?= $d['id'] ?></td>
                            <td data-label="Code">
                                <span class="discount-code">
                                    <?= $d['code'] ?>
                                </span>
                            </td>
                            <td data-label="Discount"><span class="discount-amount <?= $d['type'] ?>"><?= $d['discount'] ?></span></td>
                            <td data-label="Eligibility"><span class="eligibility-badge <?= $d['badge_elig'] ?>"><?= $d['eligibility'] ?></span></td>
                            <td data-label="Usage limit"><?= $d['usage'] ?></td>
                            <td data-label="Expires on"><?= $d['expires'] ?></td>
                            <td data-label="Status"><span class="badge-status <?= $d['badge_status'] ?>"><?= $d['status'] ?></span></td>
                            <td data-label="Action">
                                <a href="edit-discount.php?id=<?= $d['id'] ?>" class="btn btn-sm btn-outline-secondary me-1" style="border-radius: 6px; padding: 4px 10px;">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <a href="discounts.php?delete=1&id=<?= $d['id'] ?>" class="btn btn-sm btn-outline-danger" style="border-radius: 6px; padding: 4px 10px;" onclick="return confirm('Are you sure you want to delete this coupon?')">
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
            <div class="d-flex justify-content-between align-items-center mt-3">
                <div class="pagination-info" id="paginationInfo">Showing 1 to <?= count($discounts) ?> of <?= count($discounts) ?> entries</div>
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

            // ---- AUTO-HIDE ALERTS ----
            var alerts = document.querySelectorAll('.alert-custom');
            alerts.forEach(function(alert) {
                setTimeout(function() {
                    alert.classList.remove('show');
                }, 5000);
            });

            // ---- SEARCH DISCOUNTS ----
            var discountSearch = document.getElementById('discountSearch');
            if (discountSearch) {
                discountSearch.addEventListener('keyup', function () {
                    var term = this.value.toLowerCase().trim();
                    var rows = document.querySelectorAll('#discountTableBody tr');
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

            // ---- ENTRIES SELECTOR ----
            var entriesSelect = document.getElementById('entriesSelect');
            if (entriesSelect) {
                entriesSelect.addEventListener('change', function () {
                    var value = parseInt(this.value);
                    var rows = document.querySelectorAll('#discountTableBody tr');
                    rows.forEach(function(row, index) {
                        row.style.display = index < value ? '' : 'none';
                    });
                    updatePaginationInfo();
                });
            }

            // ---- PAGINATION ----
            var currentPage = 1;
            var rowsPerPage = 5;
            var rows = document.querySelectorAll('#discountTableBody tr');
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

            function updatePaginationInfo() {
                var visibleRows = document.querySelectorAll('#discountTableBody tr:not([style*="display: none"])');
                var totalRows = document.querySelectorAll('#discountTableBody tr').length;
                var paginationInfo = document.getElementById('paginationInfo');
                if (paginationInfo) {
                    var start = visibleRows.length > 0 ? 1 : 0;
                    var end = visibleRows.length;
                    paginationInfo.textContent = 'Showing ' + start + ' to ' + end + ' of ' + totalRows + ' entries';
                }
            }

            // Initialize pagination
            if (totalRows > 0) {
                showPage(1);
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

            console.log('Discounts page initialized');
        });
    </script>
</body>
</html>