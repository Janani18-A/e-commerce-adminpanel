<?php
include 'config/config.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
      <?php include 'head.php'; ?>

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

        /* Status Indicator Dot */
        .status-dot {
            display: inline-block;
            width: 10px;
            height: 10px;
            border-radius: 50%;
            margin-right: 6px;
        }
        .status-dot.active { background: #10B981; }
        .status-dot.inactive { background: #EF4444; }
        .status-dot.pending { background: #F59E0B; }

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
                min-width: 90px;
                flex-shrink: 0;
            }
            .product-table-container .table tbody td:last-child:before {
                display: none;
            }
            .product-table-container .table tbody td:last-child {
                justify-content: flex-start;
            }
            .product-table-container .table tbody td:first-child:before {
                display: none;
            }
            .product-table-container .table tbody tr {
                display: block;
                border-bottom: 1px solid #E2E8F0;
                padding: 4px 0;
            }
            .product-table-container .table tbody tr:last-child { border-bottom: none; }
            .product-table-container .table tbody td:first-child { padding-top: 10px; }
            .product-table-container .table tbody td:last-child { padding-bottom: 10px; }
            .product-thumb, .product-image-preview { width: 35px; height: 35px; }
            .product-table-container .table .badge { font-size: 0.7rem; padding: 3px 8px; }
            .product-table-container .table .btn-sm { padding: 2px 6px; font-size: 0.7rem; }
            
            .d-flex.justify-content-between.align-items-center.mt-4 {
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
            
            .product-table-container .table tbody td { font-size: 0.75rem; padding: 3px 10px; }
            .product-table-container .table tbody td:before { min-width: 80px; font-size: 0.7rem; }
            .product-thumb, .product-image-preview { width: 30px; height: 30px; }
            .product-table-container .table .badge { font-size: 0.6rem; padding: 2px 6px; }
            .product-table-container .table .btn-sm { padding: 1px 4px; font-size: 0.6rem; }
            
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
            .stat-card .stat-value { font-size: 0.8rem; }
            .stat-card { padding: 0.5rem; }
            .stat-card .stat-icon { width: 28px; height: 28px; font-size: 0.7rem; }
            .stat-card .stat-label { font-size: 0.6rem; }
            .h2 { font-size: 0.85rem; }
            .product-table-container .table tbody td { font-size: 0.65rem; padding: 2px 6px; }
            .product-thumb, .product-image-preview { width: 25px; height: 25px; }
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
        <div id="products-page" class="page-section active-page">
            
            

            <!-- Alerts Container -->
            <div id="alertContainer"></div>

            <!-- Page Header -->
            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                <h1 class="h2">Products</h1>
                <div class="btn-toolbar mb-2 mb-md-0">
                    <div class="btn-group me-2">
                        <a href="add-product_v2.php" class="btn btn-sm btn-outline-primary">
                            <i class="fas fa-plus-circle me-1"></i> Add Product
                        </a>
                    </div>
                </div>
            </div>

            <!-- Stats Cards -->
            <div class="row mb-4" id="statsContainer">
                <!-- Stats will be rendered by JavaScript -->
            </div>

            <!-- Filters -->
            <div class="row mb-3 filters-section">
                <div class="col-md-3 col-sm-6 col-12">
                    <select class="form-select form-select-sm" id="categoryFilter">
                        <option>All Categories</option>
                        <option>Flowers</option>
                        <option>Wedding</option>
                        <option>Bouquet</option>
                        <option>Gifts</option>
                    </select>
                </div>
                <div class="col-md-3 col-sm-6 col-12">
                    <select class="form-select form-select-sm" id="statusFilter">
                        <option>All Status</option>
                        <option>Active</option>
                        <option>Inactive</option>
                        <option>Pending</option>
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
                            <th style="width: 60px;">S.No</th>
                            <th>Product</th>
                            <th>Price</th>
                            <th>MRP Price</th>
                            <th>Stock</th>
                            <th>Visitors</th>
                            <th>Status</th>
                            <th class="text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody id="productTableBody">
                        <!-- Products will be rendered by JavaScript -->
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            <div class="d-flex justify-content-between align-items-center mt-4">
                <div style="color: #64748B; font-size: 0.9rem;" id="paginationInfo">Showing 0 to 0 of 0 entries</div>
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
 <script src="<?= APP_URL; ?>/assets/js/script.js"></script>
    
    <script>
        // ============================================================
        // PRODUCT DATA - READ FROM LOCALSTORAGE
        // ============================================================
        function getProducts() {
            return JSON.parse(localStorage.getItem('products') || '[]');
        }

        function saveProducts(products) {
            localStorage.setItem('products', JSON.stringify(products));
        }

        // Initialize products in localStorage if empty
        if (getProducts().length === 0) {
            const defaultProducts = [
                {id: 1, name: 'Lotus', sku: 'LOTUS-001', slug: 'lotus', category: 'Flowers', subcategory: 'N/A', price: '99.00', mrp: '100.00', stock: 9999, min_purchase: 1, max_purchase: 10, unit: 'piece', weight: '0.00', status: 'In Stock', badge: 'success', badge_text: '', color: '2563EB', visibility: 'Published', tags: '', unlimited_stock: true, out_of_stock: false, seo_title: 'Lotus', seo_description: '', description: '', main_image: '', additional_images: [], variations: [], visitors: 0},
                {id: 2, name: 'White and Red Rose Wedding Garland', sku: 'ROSE-002', slug: 'white-red-rose-wedding-garland', category: 'Wedding', subcategory: 'N/A', price: '199.00', mrp: '199.00', stock: 15, min_purchase: 1, max_purchase: 5, unit: 'piece', weight: '0.00', status: 'In Stock', badge: 'success', badge_text: '', color: 'F59E0B', visibility: 'Published', tags: '', unlimited_stock: false, out_of_stock: false, seo_title: 'White and Red Rose Wedding Garland', seo_description: '', description: '', main_image: '', additional_images: [], variations: [], visitors: 3},
                {id: 3, name: 'Vale', sku: 'VALE-003', slug: 'vale', category: 'Flowers', subcategory: 'N/A', price: '279.00', mrp: '279.00', stock: 20, min_purchase: 1, max_purchase: 2, unit: 'piece', weight: '0.00', status: 'In Stock', badge: 'success', badge_text: '', color: 'EF4444', visibility: 'Published', tags: '', unlimited_stock: false, out_of_stock: false, seo_title: 'Vale', seo_description: '', description: '', main_image: '', additional_images: [], variations: [], visitors: 2},
                {id: 4, name: 'Paradise Mixed Roses Bouquet', sku: 'PARADISE-004', slug: 'paradise-mixed-roses-bouquet', category: 'Bouquet', subcategory: 'N/A', price: '449.00', mrp: '449.00', stock: 12, min_purchase: 1, max_purchase: 3, unit: 'piece', weight: '0.00', status: 'In Stock', badge: 'success', badge_text: '', color: '8B5CF6', visibility: 'Published', tags: '', unlimited_stock: false, out_of_stock: false, seo_title: 'Paradise Mixed Roses Bouquet', seo_description: '', description: '', main_image: '', additional_images: [], variations: [], visitors: 0},
                {id: 5, name: 'Flowers Bouquet In Paper Packing', sku: 'PAPER-005', slug: 'flowers-bouquet-in-paper-packing', category: 'Bouquet', subcategory: 'N/A', price: '199.00', mrp: '199.00', stock: 30, min_purchase: 1, max_purchase: 5, unit: 'piece', weight: '0.00', status: 'In Stock', badge: 'success', badge_text: '', color: '06B6D4', visibility: 'Published', tags: '', unlimited_stock: false, out_of_stock: false, seo_title: 'Flowers Bouquet In Paper Packing', seo_description: '', description: '', main_image: '', additional_images: [], variations: [], visitors: 0},
                {id: 6, name: 'Flower Fantasy', sku: 'FANTASY-006', slug: 'flower-fantasy', category: 'Flowers', subcategory: 'N/A', price: '349.00', mrp: '349.00', stock: 17, min_purchase: 1, max_purchase: 2, unit: 'piece', weight: '0.00', status: 'In Stock', badge: 'success', badge_text: '', color: '1E293B', visibility: 'Published', tags: '', unlimited_stock: false, out_of_stock: false, seo_title: 'Flower Fantasy', seo_description: '', description: '', main_image: '', additional_images: [], variations: [], visitors: 0},
                {id: 7, name: 'Floral n Chocolatey Elegance', sku: 'CHOCOLATE-007', slug: 'floral-n-chocolatey-elegance', category: 'Gifts', subcategory: 'N/A', price: '599.00', mrp: '599.00', stock: 22, min_purchase: 1, max_purchase: 2, unit: 'piece', weight: '0.00', status: 'In Stock', badge: 'success', badge_text: '', color: 'EC4899', visibility: 'Published', tags: '', unlimited_stock: false, out_of_stock: false, seo_title: 'Floral n Chocolatey Elegance', seo_description: '', description: '', main_image: '', additional_images: [], variations: [], visitors: 0}
            ];
            saveProducts(defaultProducts);
        }

        let productsData = getProducts();
        let filteredProducts = [...productsData];
        let currentPage = 1;
        let rowsPerPage = 5;

        // ============================================================
        // FUNCTION: Calculate Stats
        // ============================================================
        function calculateStats() {
            const total = productsData.length;
            const inStock = productsData.filter(p => p.status === 'In Stock').length;
            const lowStock = productsData.filter(p => {
                return p.stock <= 10 && p.stock > 0;
            }).length;
            const outOfStock = productsData.filter(p => p.status === 'Out of Stock').length;
            return { total, inStock, lowStock, outOfStock };
        }

        // ============================================================
        // FUNCTION: Render Stats
        // ============================================================
        function renderStats() {
            const stats = calculateStats();
            const container = document.getElementById('statsContainer');
            const totalPercent = stats.total > 0 ? ((stats.total / 7) * 100).toFixed(1) : 0;
            const inStockPercent = stats.total > 0 ? ((stats.inStock / stats.total) * 100).toFixed(1) : 0;

            container.innerHTML = `
                <div class="col-xl-3 col-lg-6 col-md-6 col-12 mb-3">
                    <div class="stat-card d-flex align-items-center">
                        <div class="stat-icon blue me-3"><i class="fas fa-box"></i></div>
                        <div>
                            <div class="stat-value">${stats.total}</div>
                            <div class="stat-label">Total Products</div>
                            <div class="stat-trend up">↑ +${totalPercent}%</div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-6 col-md-6 col-12 mb-3">
                    <div class="stat-card d-flex align-items-center">
                        <div class="stat-icon green me-3"><i class="fas fa-check-circle"></i></div>
                        <div>
                            <div class="stat-value">${stats.inStock}</div>
                            <div class="stat-label">In Stock</div>
                            <div class="stat-trend up">↑ +${inStockPercent}%</div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-6 col-md-6 col-12 mb-3">
                    <div class="stat-card d-flex align-items-center">
                        <div class="stat-icon yellow me-3"><i class="fas fa-exclamation-triangle"></i></div>
                        <div>
                            <div class="stat-value">${stats.lowStock}</div>
                            <div class="stat-label">Low Stock</div>
                            <div class="stat-trend down">↓ ${stats.lowStock > 0 ? 'Need restock' : 'All good'}</div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-6 col-md-6 col-12 mb-3">
                    <div class="stat-card d-flex align-items-center">
                        <div class="stat-icon red me-3"><i class="fas fa-times-circle"></i></div>
                        <div>
                            <div class="stat-value">${stats.outOfStock}</div>
                            <div class="stat-label">Out of Stock</div>
                            <div class="stat-trend down">↓ ${stats.outOfStock > 0 ? 'Need restock' : 'All in stock'}</div>
                        </div>
                    </div>
                </div>
            `;
        }

        // ============================================================
        // FUNCTION: Render Products Table
        // ============================================================
        function renderProducts() {
            const tbody = document.getElementById('productTableBody');
            const start = (currentPage - 1) * rowsPerPage;
            const end = Math.min(start + rowsPerPage, filteredProducts.length);
            const pageProducts = filteredProducts.slice(start, end);

            if (filteredProducts.length === 0) {
                tbody.innerHTML = `
                    <tr>
                        <td colspan="8" class="text-center py-4">
                            <i class="fas fa-box-open fa-2x text-muted mb-2 d-block"></i>
                            <span class="text-muted">No products found. <a href="add-product_v2.php">Add your first product</a></span>
                        </td>
                    </tr>
                `;
                renderPagination();
                return;
            }

            let html = '';
            let serial = start + 1;
            pageProducts.forEach(p => {
                const statusClass = p.status.toLowerCase();
                const dotClass = statusClass === 'in stock' ? 'active' : (statusClass === 'out of stock' ? 'inactive' : 'pending');
                const stockColor = p.unlimited_stock ? '#10B981' : '#1E293B';
                const imgSrc = p.main_image || `https://via.placeholder.com/45x45/${p.color || '2563EB'}/FFFFFF?text=${p.name.charAt(0)}`;
                const stockDisplay = p.unlimited_stock ? 'Unlimited' : p.stock;

                html += `
                    <tr data-id="${p.id}">
                        <td data-label="S.No">${serial++}</td>
                        <td data-label="Product">
                            <div class="d-flex align-items-center gap-3">
                                <img src="${imgSrc}" alt="${p.name}" class="product-thumb">
                                <div>
                                    <div style="font-weight: 600; color: #1E293B;">${p.name}</div>
                                    <div style="font-size: 0.8rem; color: #64748B;">SKU: ${p.sku}</div>
                                </div>
                            </div>
                        </td>
                        <td data-label="Price" style="font-weight: 700; color: #2563EB;">₹${p.price}</td>
                        <td data-label="MRP Price" style="color: #64748B;">₹${p.mrp}</td>
                        <td data-label="Stock" style="font-weight: 600; color: ${stockColor};">${stockDisplay}</td>
                        <td data-label="Visitors" style="text-align: center; font-weight: 600; color: #64748B;">${p.visitors || 0}</td>
                        <td data-label="Status">
                            <span class="status-dot ${dotClass}"></span>
                            <span style="font-weight: 500; text-transform: capitalize;">${p.status}</span>
                        </td>
                        <td data-label="Action" class="text-center">
                            <a href="edit-product_v2.php?id=${p.id}" class="btn btn-sm btn-outline-secondary me-1" style="border-radius: 6px; padding: 4px 10px;">
                                <i class="fas fa-edit"></i>
                            </a>
                            <button class="btn btn-sm btn-outline-danger" style="border-radius: 6px; padding: 4px 10px;" onclick="deleteProduct(${p.id})">
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
            const totalPages = Math.ceil(filteredProducts.length / rowsPerPage);
            const controls = document.getElementById('paginationControls');
            const info = document.getElementById('paginationInfo');

            const start = (currentPage - 1) * rowsPerPage + 1;
            const end = Math.min(currentPage * rowsPerPage, filteredProducts.length);
            info.textContent = `Showing ${filteredProducts.length > 0 ? start : 0} to ${end} of ${filteredProducts.length} entries`;

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
            const totalPages = Math.ceil(filteredProducts.length / rowsPerPage);
            if (page < 1 || page > totalPages) return;
            currentPage = page;
            renderProducts();
        }

        // ============================================================
        // FUNCTION: Change Page
        // ============================================================
        function changePage(direction) {
            const totalPages = Math.ceil(filteredProducts.length / rowsPerPage);
            if (direction === 'prev' && currentPage > 1) { currentPage--; }
            else if (direction === 'next' && currentPage < totalPages) { currentPage++; }
            else return;
            renderProducts();
        }

        // ============================================================
        // FUNCTION: Delete Product
        // ============================================================
        function deleteProduct(id) {
            if (confirm('Are you sure you want to delete this product?')) {
                productsData = productsData.filter(p => p.id !== id);
                filteredProducts = filteredProducts.filter(p => p.id !== id);
                saveProducts(productsData);
                if (filteredProducts.length === 0) currentPage = 1;
                renderStats();
                renderProducts();
                showAlert('Product deleted successfully!', 'success');
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
        // FUNCTION: Filter Products
        // ============================================================
        function filterProducts() {
            const searchTerm = document.getElementById('productSearch').value.toLowerCase().trim();
            const category = document.getElementById('categoryFilter').value;
            const status = document.getElementById('statusFilter').value;

            filteredProducts = productsData.filter(p => {
                const matchSearch = !searchTerm || p.name.toLowerCase().includes(searchTerm) || p.sku.toLowerCase().includes(searchTerm);
                const matchCategory = category === 'All Categories' || p.category === category;
                const matchStatus = status === 'All Status' || p.status === status;
                return matchSearch && matchCategory && matchStatus;
            });

            currentPage = 1;
            renderProducts();
        }

        // ============================================================
        // CHECK URL PARAMETERS FOR ALERTS
        // ============================================================
        function checkUrlParams() {
            const urlParams = new URLSearchParams(window.location.search);
            if (urlParams.has('added')) {
                showAlert('Product added successfully!', 'success');
            }
            if (urlParams.has('deleted')) {
                showAlert('Product deleted successfully!', 'success');
            }
            if (urlParams.has('updated')) {
                showAlert('Product updated successfully!', 'success');
            }
            if (urlParams.has('error')) {
                showAlert('Failed to process product. Please check all fields.', 'error');
            }
        }

        // ============================================================
        // EVENT LISTENERS
        // ============================================================
        document.addEventListener('DOMContentLoaded', function() {
            // Reload products from localStorage
            productsData = getProducts();
            filteredProducts = [...productsData];
            
            renderStats();
            renderProducts();
            checkUrlParams();

            document.getElementById('productSearch').addEventListener('keyup', filterProducts);
            document.getElementById('categoryFilter').addEventListener('change', filterProducts);
            document.getElementById('statusFilter').addEventListener('change', filterProducts);

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

            console.log('Products page initialized (100% JavaScript with localStorage)');
            console.log('Total products:', productsData.length);
        });
    </script>
</body>
</html>