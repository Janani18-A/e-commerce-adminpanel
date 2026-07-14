<?php
include 'config/config.php';
?>

<?php
$current_page = 'categories';


?>
<!DOCTYPE html>
<html lang="en">
<head>
  <?php include 'templates/head.php'; ?>

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
           RESPONSIVE
           ============================================ */
        @media (max-width: 767.98px) {
            .sidebar-wrapper { width: 0; transform: translateX(-100%); transition: all 0.3s ease; }
            .sidebar-wrapper.open { width: 280px; transform: translateX(0); }
            .main-content { margin-left: 0; padding: 10px 12px; }
            .sidebar-toggle { display: block !important; }
            
            .d-flex.justify-content-between.align-items-center {
                flex-direction: column;
                align-items: flex-start !important;
                gap: 8px;
            }
            .btn-toolbar { width: 100%; }
            .btn-toolbar .btn-group { width: 100%; }
            .btn-toolbar .btn-group .btn { width: 100%; font-size: 0.8rem; }
            
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
            .category-table-container .table tbody td:first-child:before {
                display: none;
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
            .breadcrumb-custom { font-size: 0.8rem; }
        }

        @media (max-width: 575.98px) {
            .main-content { padding: 6px 8px; }
            .stat-card .stat-value { font-size: 0.95rem; }
            .stat-card { padding: 0.75rem; }
            .stat-card .stat-icon { width: 32px; height: 32px; font-size: 0.8rem; }
            .stat-card .stat-label { font-size: 0.7rem; }
            .h2 { font-size: 1rem; }
            
            .category-table-container .table tbody td { font-size: 0.75rem; padding: 3px 10px; }
            .category-table-container .table tbody td:before { min-width: 70px; font-size: 0.7rem; }
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
            .breadcrumb-custom { font-size: 0.75rem; }
            .btn-sm { font-size: 0.7rem; padding: 0.2rem 0.4rem; }
        }

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
            
           

            <!-- Alerts Container -->
            <div id="alertContainer"></div>

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
            <div class="row mb-4" id="statsContainer">
                <!-- Stats will be rendered by JavaScript -->
            </div>

            <!-- Table Tools -->
            <div class="table-tools">
                <div class="left-section">
                    <span style="font-size: 0.9rem; color: #1E293B; font-weight: 500;">Parent Category</span>
                    <select class="form-select form-select-sm entries-select" id="parentCategory">
                        <option value="">All</option>
                    </select>
                </div>
                <div class="right-section">
                    <span style="font-size: 0.9rem; color: #1E293B; font-weight: 500;">Show</span>
                    <select class="form-select form-select-sm entries-select" id="entriesSelect">
                        <option value="5">5</option>
                        <option value="10" selected>10</option>
                        <option value="25">25</option>
                        <option value="50">50</option>
                        <option value="100">100</option>
                    </select>
                    <span style="font-size: 0.9rem; color: #1E293B; font-weight: 500;">entries</span>
                </div>
            </div>

            <!-- Categories Table -->
            <div class="category-table-container">
                <table class="table">
                    <thead>
                        <tr>
                            <th style="width: 60px;">S.No</th>
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
                        <!-- Categories will be rendered by JavaScript -->
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            <div class="d-flex justify-content-between align-items-center mt-3">
                <div class="pagination-info" id="paginationInfo">Showing 0 to 0 of 0 entries</div>
                <nav>
                    <ul class="pagination pagination-sm mb-0" id="paginationControls">
                        <!-- Pagination will be rendered by JavaScript -->
                    </ul>
                </nav>
            </div>
        </div>
    </div>

   <!-- Bootstrap JS Bundle (Latest Stable) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
    <script src="assets/js/script.js"></script>
    
    <script>
        // ============================================================
        // CATEGORY DATA - READ FROM LOCALSTORAGE
        // ============================================================
        function getCategories() {
            return JSON.parse(localStorage.getItem('categories') || '[]');
        }

        function saveCategories(categories) {
            localStorage.setItem('categories', JSON.stringify(categories));
        }

        // Initialize categories in localStorage if empty
        if (getCategories().length === 0) {
            const defaultCategories = [
                {id: 1, name: 'Electronics', slug: 'electronics', menu: true, visitors: '1,245', status: 'Active', badge: 'active', color: '#2563EB', letter: 'E', parent: null, description: 'Electronic items and gadgets', icon: ''},
                {id: 2, name: 'Accessories', slug: 'accessories', menu: true, visitors: '876', status: 'Active', badge: 'active', color: '#10B981', letter: 'A', parent: null, description: 'Accessories for daily use', icon: ''},
                {id: 3, name: 'Home & Living', slug: 'home-living', menu: false, visitors: '543', status: 'Inactive', badge: 'inactive', color: '#F59E0B', letter: 'H', parent: null, description: 'Home and living products', icon: ''},
                {id: 4, name: 'Smart Devices', slug: 'smart-devices', menu: true, visitors: '2,109', status: 'Active', badge: 'active', color: '#8B5CF6', letter: 'S', parent: 1, description: 'Smart devices and gadgets', icon: ''},
                {id: 5, name: 'Travel', slug: 'travel', menu: false, visitors: '432', status: 'Draft', badge: 'draft', color: '#EF4444', letter: 'T', parent: null, description: 'Travel essentials', icon: ''},
                {id: 6, name: 'Industrial', slug: 'industrial', menu: true, visitors: '321', status: 'Active', badge: 'active', color: '#1E293B', letter: 'I', parent: null, description: 'Industrial products', icon: ''}
            ];
            saveCategories(defaultCategories);
        }

        let categoriesData = getCategories();
        let filteredCategories = [...categoriesData];
        let currentPage = 1;
        let rowsPerPage = 10;

        // ============================================================
        // FUNCTION: Calculate Stats
        // ============================================================
        function calculateStats() {
            const total = categoriesData.length;
            const active = categoriesData.filter(c => c.status === 'Active').length;
            const inactive = categoriesData.filter(c => c.status === 'Inactive').length;
            const draft = categoriesData.filter(c => c.status === 'Draft').length;
            return { total, active, inactive, draft };
        }

        // ============================================================
        // FUNCTION: Render Stats
        // ============================================================
        function renderStats() {
            const stats = calculateStats();
            const container = document.getElementById('statsContainer');
            const totalPercent = stats.total > 0 ? ((stats.total / 6) * 100).toFixed(1) : 0;
            const activePercent = stats.total > 0 ? ((stats.active / stats.total) * 100).toFixed(1) : 0;

            container.innerHTML = `
                <div class="col-xl-3 col-lg-6 col-md-6 col-12 mb-3">
                    <div class="stat-card d-flex align-items-center">
                        <div class="stat-icon blue me-3"><i class="fas fa-tags"></i></div>
                        <div>
                            <div class="stat-value">${stats.total}</div>
                            <div class="stat-label">Total Categories</div>
                            <div class="stat-trend up">↑ +${totalPercent}%</div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-6 col-md-6 col-12 mb-3">
                    <div class="stat-card d-flex align-items-center">
                        <div class="stat-icon green me-3"><i class="fas fa-check-circle"></i></div>
                        <div>
                            <div class="stat-value">${stats.active}</div>
                            <div class="stat-label">Active</div>
                            <div class="stat-trend up">↑ +${activePercent}%</div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-6 col-md-6 col-12 mb-3">
                    <div class="stat-card d-flex align-items-center">
                        <div class="stat-icon yellow me-3"><i class="fas fa-exclamation-triangle"></i></div>
                        <div>
                            <div class="stat-value">${stats.inactive}</div>
                            <div class="stat-label">Inactive</div>
                            <div class="stat-trend down">↓ ${stats.inactive > 0 ? 'Inactive' : 'All active'}</div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-6 col-md-6 col-12 mb-3">
                    <div class="stat-card d-flex align-items-center">
                        <div class="stat-icon red me-3"><i class="fas fa-times-circle"></i></div>
                        <div>
                            <div class="stat-value">${stats.draft}</div>
                            <div class="stat-label">Draft</div>
                            <div class="stat-trend down">↓ ${stats.draft > 0 ? 'In draft' : 'No drafts'}</div>
                        </div>
                    </div>
                </div>
            `;
        }

        // ============================================================
        // FUNCTION: Get Parent Name
        // ============================================================
        function getParentName(parentId) {
            if (!parentId) return '-';
            const parent = categoriesData.find(c => c.id === parentId);
            return parent ? parent.name : '-';
        }

        // ============================================================
        // FUNCTION: Render Categories Table
        // ============================================================
        function renderCategories() {
            const tbody = document.getElementById('categoryTableBody');
            const start = (currentPage - 1) * rowsPerPage;
            const end = Math.min(start + rowsPerPage, filteredCategories.length);
            const pageCategories = filteredCategories.slice(start, end);

            if (filteredCategories.length === 0) {
                tbody.innerHTML = `
                    <tr>
                        <td colspan="8" class="text-center py-4">
                            <i class="fas fa-folder-open fa-2x text-muted mb-2 d-block"></i>
                            <span class="text-muted">No categories found. <a href="add-categories.php">Add your first category</a></span>
                        </td>
                    </tr>
                `;
                renderPagination();
                return;
            }

            let html = '';
            let serial = start + 1;
            pageCategories.forEach(c => {
                html += `
                    <tr data-id="${c.id}" data-name="${c.name}" data-slug="${c.slug}" data-status="${c.status}" data-menu="${c.menu ? '1' : '0'}" data-description="${c.description || ''}" data-parent="${c.parent || ''}">
                        <td data-label="S.No">${serial++}</td>
                        <td data-label="Image">
                            <div class="category-img-placeholder" style="background: ${c.color};">${c.letter}</div>
                        </td>
                        <td data-label="Category"><strong>${c.name}</strong></td>
                        <td data-label="Slug"><code>${c.slug}</code></td>
                        <td data-label="Add to Menu">
                            <div class="menu-toggle ${c.menu ? 'active' : ''}" onclick="toggleMenu(${c.id})">
                                <span class="toggle-slider"></span>
                            </div>
                        </td>
                        <td data-label="Visitors">${c.visitors}</td>
                        <td data-label="Status"><span class="badge-status ${c.badge}">${c.status}</span></td>
                        <td data-label="Action">
                            <a href="edit-categories.php?id=${c.id}" class="btn btn-sm btn-outline-secondary me-1" style="border-radius: 6px; padding: 4px 10px;">
                                <i class="fas fa-edit"></i>
                            </a>
                            <button class="btn btn-sm btn-outline-danger" style="border-radius: 6px; padding: 4px 10px;" onclick="deleteCategory(${c.id})">
                                <i class="fas fa-trash"></i>
                            </button>
                        </td>
                    </tr>
                `;
            });

            tbody.innerHTML = html;
            renderPagination();
        }

        // ============================================================
        // FUNCTION: Render Pagination
        // ============================================================
        function renderPagination() {
            const totalPages = Math.ceil(filteredCategories.length / rowsPerPage);
            const controls = document.getElementById('paginationControls');
            const info = document.getElementById('paginationInfo');

            const start = (currentPage - 1) * rowsPerPage + 1;
            const end = Math.min(currentPage * rowsPerPage, filteredCategories.length);
            info.textContent = `Showing ${filteredCategories.length > 0 ? start : 0} to ${end} of ${filteredCategories.length} entries`;

            if (totalPages <= 1) {
                controls.innerHTML = `
                    <li class="page-item disabled"><a class="page-link" href="#">Previous</a></li>
                    <li class="page-item active"><a class="page-link" href="#">1</a></li>
                    <li class="page-item disabled"><a class="page-link" href="#">Next</a></li>
                `;
                return;
            }

            let html = '';
            html += `<li class="page-item ${currentPage <= 1 ? 'disabled' : ''}">
                <a class="page-link" href="#" onclick="changePage('prev')">Previous</a>
            </li>`;

            for (let i = 1; i <= totalPages; i++) {
                html += `<li class="page-item ${i === currentPage ? 'active' : ''}">
                    <a class="page-link" href="#" onclick="goToPage(${i})">${i}</a>
                </li>`;
            }

            html += `<li class="page-item ${currentPage >= totalPages ? 'disabled' : ''}">
                <a class="page-link" href="#" onclick="changePage('next')">Next</a>
            </li>`;

            controls.innerHTML = html;
        }

        // ============================================================
        // FUNCTION: Go to Page
        // ============================================================
        function goToPage(page) {
            const totalPages = Math.ceil(filteredCategories.length / rowsPerPage);
            if (page < 1 || page > totalPages) return;
            currentPage = page;
            renderCategories();
        }

        // ============================================================
        // FUNCTION: Change Page
        // ============================================================
        function changePage(direction) {
            const totalPages = Math.ceil(filteredCategories.length / rowsPerPage);
            if (direction === 'prev' && currentPage > 1) { currentPage--; }
            else if (direction === 'next' && currentPage < totalPages) { currentPage++; }
            else return;
            renderCategories();
        }

        // ============================================================
        // FUNCTION: Delete Category
        // ============================================================
        function deleteCategory(id) {
            if (confirm('Are you sure you want to delete this category?')) {
                categoriesData = categoriesData.filter(c => c.id !== id);
                filteredCategories = filteredCategories.filter(c => c.id !== id);
                saveCategories(categoriesData);
                if (filteredCategories.length === 0) currentPage = 1;
                renderStats();
                renderCategories();
                updateParentFilter();
                showAlert('Category deleted successfully!', 'success');
            }
        }

        // ============================================================
        // FUNCTION: Toggle Menu
        // ============================================================
        function toggleMenu(id) {
            categoriesData = categoriesData.map(c => {
                if (c.id === id) {
                    c.menu = !c.menu;
                }
                return c;
            });
            saveCategories(categoriesData);
            filteredCategories = [...categoriesData];
            renderCategories();
            showAlert('Menu status updated!', 'success');
        }

        // ============================================================
        // FUNCTION: Update Parent Filter
        // ============================================================
        function updateParentFilter() {
            const parentFilter = document.getElementById('parentCategory');
            const currentValue = parentFilter.value;
            const parentCategories = categoriesData.filter(c => c.parent === null);
            
            parentFilter.innerHTML = `<option value="">All</option>`;
            parentCategories.forEach(c => {
                parentFilter.innerHTML += `<option value="${c.id}">${c.name}</option>`;
            });
            
            if (currentValue) {
                parentFilter.value = currentValue;
            }
        }

        // ============================================================
        // FUNCTION: Show Alert
        // ============================================================
        function showAlert(message, type = 'success') {
            const container = document.getElementById('alertContainer');
            const colors = {
                success: { bg: '#D1FAE5', color: '#065F46', border: '#10B981', icon: 'check-circle' },
                error: { bg: '#FEE2E2', color: '#991B1B', border: '#EF4444', icon: 'exclamation-circle' }
            };
            const c = colors[type] || colors.success;
            
            container.innerHTML = `
                <div class="alert-custom success show" style="background: ${c.bg}; color: ${c.color}; border-left-color: ${c.border};">
                    <i class="fas fa-${c.icon} me-2"></i> ${message}
                </div>
            `;
            setTimeout(() => {
                const alert = container.querySelector('.alert-custom');
                if (alert) alert.classList.remove('show');
            }, 5000);
        }

        // ============================================================
        // FUNCTION: Filter Categories
        // ============================================================
        function filterCategories() {
            const searchTerm = document.getElementById('categorySearch')?.value.toLowerCase().trim() || '';
            const category = document.getElementById('categoryFilter')?.value || 'All Categories';
            const status = document.getElementById('statusFilter')?.value || 'All Status';
            const parent = document.getElementById('parentCategory')?.value || '';

            filteredCategories = categoriesData.filter(c => {
                const matchSearch = !searchTerm || c.name.toLowerCase().includes(searchTerm) || c.slug.toLowerCase().includes(searchTerm);
                const matchCategory = category === 'All Categories' || c.name === category;
                const matchStatus = status === 'All Status' || c.status === status;
                const matchParent = !parent || c.parent == parent;
                return matchSearch && matchCategory && matchStatus && matchParent;
            });

            currentPage = 1;
            renderCategories();
        }

        // ============================================================
        // CHECK URL PARAMETERS FOR ALERTS
        // ============================================================
        function checkUrlParams() {
            const urlParams = new URLSearchParams(window.location.search);
            if (urlParams.has('added')) {
                showAlert('Category added successfully!', 'success');
            }
            if (urlParams.has('deleted')) {
                showAlert('Category deleted successfully!', 'success');
            }
            if (urlParams.has('updated')) {
                showAlert('Category updated successfully!', 'success');
            }
            if (urlParams.has('error')) {
                showAlert('Failed to process category. Please check all fields.', 'error');
            }
        }

        // ============================================================
        // EVENT LISTENERS
        // ============================================================
        document.addEventListener('DOMContentLoaded', function() {
            // Reload categories from localStorage
            categoriesData = getCategories();
            filteredCategories = [...categoriesData];
            
            renderStats();
            renderCategories();
            updateParentFilter();
            checkUrlParams();

            // Search
            document.getElementById('categorySearch')?.addEventListener('keyup', filterCategories);

            // Category filter
            document.getElementById('categoryFilter')?.addEventListener('change', filterCategories);

            // Status filter
            document.getElementById('statusFilter')?.addEventListener('change', filterCategories);

            // Parent filter
            document.getElementById('parentCategory')?.addEventListener('change', filterCategories);

            // Entries selector
            document.getElementById('entriesSelect')?.addEventListener('change', function() {
                rowsPerPage = parseInt(this.value);
                currentPage = 1;
                renderCategories();
            });

            // Sidebar toggle
            const sidebarToggle = document.querySelector('.sidebar-toggle');
            if (sidebarToggle) {
                sidebarToggle.addEventListener('click', function() {
                    document.querySelector('.sidebar-wrapper')?.classList.toggle('open');
                });
            }

            document.addEventListener('click', function(e) {
                if (window.innerWidth < 768) {
                    const sidebar = document.querySelector('.sidebar-wrapper');
                    const toggle = document.querySelector('.sidebar-toggle');
                    if (sidebar && toggle && !sidebar.contains(e.target) && !toggle.contains(e.target)) {
                        sidebar.classList.remove('open');
                    }
                }
            });

            console.log('Categories page initialized (100% JavaScript with localStorage)');
            console.log('Total categories:', categoriesData.length);
        });
    </script>
</body>
</html>