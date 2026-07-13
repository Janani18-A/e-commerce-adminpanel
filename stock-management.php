<?php
include 'config/config.php';
?>



<!DOCTYPE html>
<html lang="en">
<head>
       <?php include 'head.php'; ?>

    <style>
        * { box-sizing: border-box; }
        body { font-family: 'Inter', sans-serif; background: #F8FAFC; }

        

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
        .stock-stat-card.bg-primary { background: linear-gradient(135deg, #2563EB, #1E40AF) !important; }
        .stock-stat-card .card-body { padding: 1.25rem; }
        .stock-stat-card h6 { opacity: 0.9; font-weight: 500; margin-bottom: 0.25rem; font-size: 0.85rem; }
        .stock-stat-card h3 { font-weight: 700; margin-bottom: 0.25rem; font-size: 1.8rem; }
        .stock-stat-card small { opacity: 0.85; font-size: 0.75rem; }

        .stock-alert {
            border-radius: 0.75rem;
            border-left: 4px solid #F59E0B;
            background: #FEF3C7;
            color: #92400E;
        }
        .stock-alert .alert-link { color: #2563EB; font-weight: 600; }

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

        .sidebar-toggle {
            display: none;
            background: transparent;
            border: none;
            color: #1E293B;
            font-size: 1.2rem;
            padding: 0 10px;
        }

        /* Table Tools */
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
            
            .table-tools { flex-direction: column; align-items: stretch; }
            .search-input { width: 100% !important; }
            
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
            
            .d-flex.justify-content-between.align-items-center.mt-4 {
                flex-direction: column;
                gap: 10px;
                align-items: flex-start !important;
            }
            .pagination-info { font-size: 0.8rem; }
            .pagination .page-link { font-size: 0.75rem; padding: 0.25rem 0.5rem; }
            .breadcrumb-custom { font-size: 0.8rem; }
            
            .stock-stat-card h3 { font-size: 1.3rem; }
            .stock-stat-card .card-body { padding: 0.9rem; }
        }

        @media (max-width: 575.98px) {
            .main-content { padding: 6px 8px; }
            .stock-stat-card h3 { font-size: 1.1rem; }
            .stock-stat-card .card-body { padding: 0.75rem; }
            .stock-stat-card h6 { font-size: 0.7rem; }
            .stock-stat-card small { font-size: 0.65rem; }
            .h2 { font-size: 1rem; }
            
            .table-responsive .table tbody td { font-size: 0.75rem; padding: 3px 10px; }
            .table-responsive .table tbody td:before { min-width: 100px; font-size: 0.7rem; }
            .table-responsive .table .badge { font-size: 0.6rem; padding: 2px 6px; }
            .table-responsive .table .btn-sm { padding: 1px 4px; font-size: 0.6rem; }
            
            .d-flex.justify-content-between.align-items-center.mt-4 {
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
            .stock-stat-card h3 { font-size: 0.9rem; }
            .stock-stat-card .card-body { padding: 0.5rem; }
            .stock-stat-card h6 { font-size: 0.6rem; }
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
            
            

            <!-- Alert Container -->
            <div id="alertContainer"></div>

            <!-- Page Header -->
            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                <h1 class="h2">Stock Management</h1>
                <div class="btn-toolbar mb-2 mb-md-0">
                    <div class="btn-group me-2">
                        <a href="add-stock.php" class="btn btn-sm btn-outline-primary">
                            <i class="fas fa-plus-circle me-1"></i> Add Stock Item
                        </a>
                        <button class="btn btn-sm btn-outline-secondary" onclick="exportReport()">
                            <i class="fas fa-download me-1"></i> Export Report
                        </button>
                    </div>
                </div>
            </div>

            <!-- Stock Statistics -->
            <div class="row mb-4" id="statsContainer">
                <!-- Stats will be rendered by JavaScript -->
            </div>

            <!-- Stock Alert -->
            <div id="stockAlertContainer"></div>

            <!-- Table Tools -->
            <div class="table-tools">
                <div class="left-section">
                    <span class="text-muted" style="font-size:0.85rem;">Show</span>
                    <select class="form-select form-select-sm entries-select" id="entriesSelect">
                        <option value="5">5</option>
                        <option value="10" selected>10</option>
                        <option value="25">25</option>
                        <option value="50">50</option>
                        <option value="100">100</option>
                    </select>
                    <span class="text-muted" style="font-size:0.85rem;">entries</span>
                </div>
                <div class="right-section">
                    <span class="text-muted" style="font-size:0.85rem;">Search:</span>
                    <input type="text" class="form-control form-control-sm search-input" id="stockSearch" placeholder="Search stock...">
                </div>
            </div>

            <!-- Stock Table -->
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0 bg-white" style="border-radius: 8px; border: 1px solid #E2E8F0; overflow: hidden;">
                    <thead style="background: #F8FAFC; border-bottom: 2px solid #E2E8F0;">
                        <tr>
                            <th style="padding: 12px 15px; font-weight: 600; font-size: 0.85rem; text-transform: uppercase; letter-spacing: 0.5px;">#</th>
                            <th style="padding: 12px 15px; font-weight: 600; font-size: 0.85rem; text-transform: uppercase; letter-spacing: 0.5px;">Item Name</th>
                            <th style="padding: 12px 15px; font-weight: 600; font-size: 0.85rem; text-transform: uppercase; letter-spacing: 0.5px;">Category</th>
                            <th style="padding: 12px 15px; font-weight: 600; font-size: 0.85rem; text-transform: uppercase; letter-spacing: 0.5px;">Quantity</th>
                            <th style="padding: 12px 15px; font-weight: 600; font-size: 0.85rem; text-transform: uppercase; letter-spacing: 0.5px;">Unit</th>
                            <th style="padding: 12px 15px; font-weight: 600; font-size: 0.85rem; text-transform: uppercase; letter-spacing: 0.5px;">Status</th>
                            <th style="padding: 12px 15px; font-weight: 600; font-size: 0.85rem; text-transform: uppercase; letter-spacing: 0.5px; text-align: center;">Actions</th>
                        </tr>
                    </thead>
                    <tbody id="stockTableBody">
                        <!-- Stock items will be rendered by JavaScript -->
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            <div class="d-flex justify-content-between align-items-center mt-4">
                <div class="pagination-info" id="paginationInfo">Showing 0 to 0 of 0 entries</div>
                <nav>
                    <ul class="pagination pagination-sm mb-0" id="paginationControls">
                        <!-- Pagination will be rendered by JavaScript -->
                    </ul>
                </nav>
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
                            <!-- Movements will be rendered by JavaScript -->
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

   <!-- Bootstrap JS Bundle (Latest Stable) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
    <script src="assets/js/script.js"></script>
    
    <script>
        // ============================================================
        // STOCK DATA - READ FROM LOCALSTORAGE
        // ============================================================
        function getStockItems() {
            return JSON.parse(localStorage.getItem('stock_items') || '[]');
        }

        function saveStockItems(items) {
            localStorage.setItem('stock_items', JSON.stringify(items));
        }

        // Initialize stock items in localStorage if empty
        if (getStockItems().length === 0) {
            const defaultItems = [
                {id: 1, item_name: 'Item Alpha', sku: 'STK-001', category: 'Raw Materials', quantity: 150, unit: 'kg', supplier: 'Supplier A', location: 'Warehouse 1', status: 'In Stock', badge: 'success', color: '2563EB', image: '', description: ''},
                {id: 2, item_name: 'Item Beta', sku: 'STK-002', category: 'Packaging', quantity: 25, unit: 'boxes', supplier: 'Supplier B', location: 'Warehouse 2', status: 'Low Stock', badge: 'warning', color: 'F59E0B', image: '', description: ''},
                {id: 3, item_name: 'Item Gamma', sku: 'STK-003', category: 'Finished Goods', quantity: 0, unit: 'units', supplier: 'Supplier C', location: 'Warehouse 1', status: 'Out of Stock', badge: 'danger', color: 'EF4444', image: '', description: ''},
                {id: 4, item_name: 'Item Delta', sku: 'STK-004', category: 'Raw Materials', quantity: 75, unit: 'liters', supplier: 'Supplier A', location: 'Warehouse 3', status: 'In Stock', badge: 'success', color: '8B5CF6', image: '', description: ''},
                {id: 5, item_name: 'Item Epsilon', sku: 'STK-005', category: 'Packaging', quantity: 120, unit: 'rolls', supplier: 'Supplier D', location: 'Warehouse 2', status: 'In Stock', badge: 'success', color: '06B6D4', image: '', description: ''},
                {id: 6, item_name: 'Item Zeta', sku: 'STK-006', category: 'Finished Goods', quantity: 8, unit: 'units', supplier: 'Supplier B', location: 'Warehouse 1', status: 'Low Stock', badge: 'warning', color: '1E293B', image: '', description: ''}
            ];
            saveStockItems(defaultItems);
        }

        let stockItems = [];
        let filteredItems = [];
        let currentPage = 1;
        let rowsPerPage = 5;

        // ============================================================
        // MOVEMENT DATA
        // ============================================================
        const movements = [
            {date: new Date().toLocaleString(), product: 'Item Alpha', type: 'Added', badge: 'success', qty: '+50', user: 'Admin', note: 'Restock'},
            {date: new Date(Date.now() - 2*60*60*1000).toLocaleString(), product: 'Item Beta', type: 'Removed', badge: 'danger', qty: '-15', user: 'Admin', note: 'Order #1234'},
            {date: new Date(Date.now() - 24*60*60*1000).toLocaleString(), product: 'Item Gamma', type: 'Adjusted', badge: 'warning', qty: '0', user: 'Admin', note: 'Inventory count'}
        ];

        // ============================================================
        // FUNCTION: Load Data
        // ============================================================
        function loadData() {
            stockItems = getStockItems();
            filteredItems = [...stockItems];
            console.log('Data loaded. Total items:', stockItems.length);
        }

        // ============================================================
        // FUNCTION: Calculate Stats
        // ============================================================
        function calculateStats() {
            const total = stockItems.length;
            const inStock = stockItems.filter(item => item.quantity > 10 && item.status === 'In Stock').length;
            const lowStock = stockItems.filter(item => item.quantity <= 10 && item.quantity > 0).length;
            const outOfStock = stockItems.filter(item => item.quantity <= 0 || item.status === 'Out of Stock').length;
            return { total, inStock, lowStock, outOfStock };
        }

        // ============================================================
        // FUNCTION: Render Stats
        // ============================================================
        function renderStats() {
            const stats = calculateStats();
            const container = document.getElementById('statsContainer');
            
            container.innerHTML = `
                <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6 col-12 mb-3">
                    <div class="card stock-stat-card bg-primary">
                        <div class="card-body">
                            <h6>Total Items</h6>
                            <h3>${stats.total}</h3>
                            <small>All items in inventory</small>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6 col-12 mb-3">
                    <div class="card stock-stat-card bg-success">
                        <div class="card-body">
                            <h6>In Stock</h6>
                            <h3>${stats.inStock}</h3>
                            <small>Items available in stock</small>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6 col-12 mb-3">
                    <div class="card stock-stat-card bg-warning">
                        <div class="card-body">
                            <h6>Low Stock</h6>
                            <h3>${stats.lowStock}</h3>
                            <small>Items below reorder level</small>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6 col-12 mb-3">
                    <div class="card stock-stat-card bg-danger">
                        <div class="card-body">
                            <h6>Out of Stock</h6>
                            <h3>${stats.outOfStock}</h3>
                            <small>Items with zero quantity</small>
                        </div>
                    </div>
                </div>
            `;

            // Render stock alert if low stock items exist
            const alertContainer = document.getElementById('stockAlertContainer');
            if (stats.lowStock > 0) {
                alertContainer.innerHTML = `
                    <div class="alert alert-warning alert-dismissible fade show stock-alert" id="stockAlert">
                        <i class="fas fa-exclamation-triangle"></i>
                        <strong> Stock Alert:</strong>
                        <span class="ms-2">${stats.lowStock} items are below reorder level.</span>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" onclick="this.closest('.stock-alert').style.display='none'"></button>
                    </div>
                `;
            } else {
                alertContainer.innerHTML = '';
            }
        }

        // ============================================================
        // FUNCTION: Render Pagination
        // ============================================================
        function renderPagination() {
            const totalPages = Math.ceil(filteredItems.length / rowsPerPage);
            const controls = document.getElementById('paginationControls');
            const info = document.getElementById('paginationInfo');

            const start = (currentPage - 1) * rowsPerPage + 1;
            const end = Math.min(currentPage * rowsPerPage, filteredItems.length);
            info.textContent = `Showing ${filteredItems.length > 0 ? start : 0} to ${end} of ${filteredItems.length} entries`;

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
            const totalPages = Math.ceil(filteredItems.length / rowsPerPage);
            if (page < 1 || page > totalPages) return;
            currentPage = page;
            renderStockTable();
        }

        // ============================================================
        // FUNCTION: Change Page
        // ============================================================
        function changePage(direction) {
            const totalPages = Math.ceil(filteredItems.length / rowsPerPage);
            if (direction === 'prev' && currentPage > 1) { currentPage--; }
            else if (direction === 'next' && currentPage < totalPages) { currentPage++; }
            else return;
            renderStockTable();
        }

        // ============================================================
        // FUNCTION: Render Stock Table
        // ============================================================
        function renderStockTable() {
            const tbody = document.getElementById('stockTableBody');
            const start = (currentPage - 1) * rowsPerPage;
            const end = Math.min(start + rowsPerPage, filteredItems.length);
            const pageItems = filteredItems.slice(start, end);

            if (filteredItems.length === 0) {
                tbody.innerHTML = `
                    <tr>
                        <td colspan="7" class="text-center py-4">
                            <i class="fas fa-boxes fa-2x text-muted mb-2 d-block"></i>
                            <span class="text-muted">No stock items found. <a href="add-stock.php">Add your first stock item</a></span>
                        </td>
                    </tr>
                `;
                renderPagination();
                return;
            }

            let html = '';
            let serial = start + 1;
            pageItems.forEach(item => {
                const stockColor = item.badge === 'success' ? '#10B981' : (item.badge === 'warning' ? '#F59E0B' : '#EF4444');
                const badgeClass = item.badge === 'warning' ? 'bg-warning text-dark' : `bg-${item.badge}`;
                
                html += `
                    <tr data-id="${item.id}">
                        <td data-label="#">${serial++}</td>
                        <td data-label="Item Name"><strong>${item.item_name}</strong></td>
                        <td data-label="Category" style="color: #1E293B;">${item.category}</td>
                        <td data-label="Quantity" style="font-weight: 600; color: ${stockColor};">${item.quantity}</td>
                        <td data-label="Unit">${item.unit}</td>
                        <td data-label="Status">
                            <span class="badge ${badgeClass}" style="padding: 5px 12px; border-radius: 20px;">${item.status}</span>
                        </td>
                        <td data-label="Actions" style="text-align: center;">
                            <a href="edit-stock.php?id=${item.id}" class="btn btn-sm btn-outline-secondary me-1" style="border-radius: 6px; padding: 4px 10px;">
                                <i class="fas fa-edit"></i>
                            </a>
                            <button class="btn btn-sm btn-outline-danger" style="border-radius: 6px; padding: 4px 10px;" onclick="deleteStockItem(${item.id})">
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
        // FUNCTION: Delete Stock Item
        // ============================================================
        function deleteStockItem(id) {
            if (confirm('Are you sure you want to delete this stock item?')) {
                stockItems = stockItems.filter(item => item.id !== id);
                filteredItems = filteredItems.filter(item => item.id !== id);
                saveStockItems(stockItems);
                renderStats();
                renderStockTable();
                showAlert('Stock item deleted successfully!', 'success');
            }
        }

        // ============================================================
        // FUNCTION: Render Movements
        // ============================================================
        function renderMovements() {
            const tbody = document.getElementById('movementTableBody');
            let html = '';
            movements.forEach(m => {
                const badgeClass = m.badge === 'warning' ? 'bg-warning text-dark' : `bg-${m.badge}`;
                html += `
                    <tr>
                        <td style="padding: 10px 15px;">${m.date}</td>
                        <td style="padding: 10px 15px;"><strong>${m.product}</strong></td>
                        <td style="padding: 10px 15px;"><span class="badge ${badgeClass}">${m.type}</span></td>
                        <td style="padding: 10px 15px;">${m.qty}</td>
                        <td style="padding: 10px 15px;">${m.user}</td>
                        <td style="padding: 10px 15px;">${m.note}</td>
                    </tr>
                `;
            });
            tbody.innerHTML = html;
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
        // FUNCTION: Search Stock
        // ============================================================
        function searchStock() {
            const term = document.getElementById('stockSearch').value.toLowerCase().trim();
            
            if (!term) {
                filteredItems = [...stockItems];
            } else {
                filteredItems = stockItems.filter(item => 
                    item.item_name.toLowerCase().includes(term) ||
                    item.category.toLowerCase().includes(term) ||
                    item.status.toLowerCase().includes(term)
                );
            }
            
            currentPage = 1;
            renderStockTable();
        }

        // ============================================================
        // FUNCTION: Change Entries
        // ============================================================
        function changeEntries() {
            rowsPerPage = parseInt(document.getElementById('entriesSelect').value);
            currentPage = 1;
            renderStockTable();
        }

        // ============================================================
        // FUNCTION: Export Report
        // ============================================================
        function exportReport() {
            const stats = calculateStats();
            let html = `
                <!DOCTYPE html>
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
                    <p style="text-align:center;">Generated on: ${new Date().toLocaleString()}</p>
                    <table>
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Item Name</th>
                                <th>Category</th>
                                <th>Quantity</th>
                                <th>Unit</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
            `;

            stockItems.forEach((item, index) => {
                const colorClass = item.badge === 'success' ? 'text-success' : (item.badge === 'warning' ? 'text-warning' : 'text-danger');
                html += `
                    <tr>
                        <td>${index + 1}</td>
                        <td><strong>${item.item_name}</strong></td>
                        <td>${item.category}</td>
                        <td class="${colorClass}">${item.quantity}</td>
                        <td>${item.unit}</td>
                        <td>${item.status}</td>
                    </tr>
                `;
            });

            html += `
                        </tbody>
                    </table>
                    <div class="footer">
                        <p>Total Items: ${stats.total} | In Stock: ${stats.inStock} | Low Stock: ${stats.lowStock} | Out of Stock: ${stats.outOfStock}</p>
                        <p>&copy; ${new Date().getFullYear()} Admin Panel. All rights reserved.</p>
                    </div>
                </body>
                </html>
            `;

            const blob = new Blob([html], { type: 'text/html' });
            const url = URL.createObjectURL(blob);
            const a = document.createElement('a');
            a.href = url;
            a.download = `stock_report_${new Date().toISOString().split('T')[0]}.html`;
            document.body.appendChild(a);
            a.click();
            document.body.removeChild(a);
            URL.revokeObjectURL(url);
        }

        // ============================================================
        // FUNCTION: Refresh All Data
        // ============================================================
        function refreshAll() {
            loadData();
            renderStats();
            renderStockTable();
            renderMovements();
        }

        // ============================================================
        // CHECK URL PARAMETERS FOR ALERTS
        // ============================================================
        function checkUrlParams() {
            const urlParams = new URLSearchParams(window.location.search);
            if (urlParams.has('added')) {
                showAlert('Stock item added successfully!', 'success');
                const newUrl = window.location.pathname;
                window.history.replaceState({}, document.title, newUrl);
            }
            if (urlParams.has('deleted')) {
                showAlert('Stock item deleted successfully!', 'success');
                const newUrl = window.location.pathname;
                window.history.replaceState({}, document.title, newUrl);
            }
            if (urlParams.has('updated')) {
                showAlert('Stock item updated successfully!', 'success');
                const newUrl = window.location.pathname;
                window.history.replaceState({}, document.title, newUrl);
            }
            if (urlParams.has('error')) {
                showAlert('Failed to process stock item. Please check all fields.', 'error');
                const newUrl = window.location.pathname;
                window.history.replaceState({}, document.title, newUrl);
            }
        }

        // ============================================================
        // EVENT LISTENERS
        // ============================================================
        document.addEventListener('DOMContentLoaded', function() {
            loadData();
            renderStats();
            renderStockTable();
            renderMovements();
            checkUrlParams();

            // Search
            document.getElementById('stockSearch')?.addEventListener('keyup', searchStock);

            // Entries selector
            document.getElementById('entriesSelect')?.addEventListener('change', changeEntries);

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

            console.log('Stock Management page initialized (100% JavaScript with localStorage)');
            console.log('Total stock items:', stockItems.length);
        });

        window.addEventListener('popstate', function() {
            refreshAll();
        });
    </script>
</body>
</html>