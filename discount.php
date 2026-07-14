<?php
include 'config/config.php';
?>


<?php
$current_page = 'discounts';

?>
<!DOCTYPE html>
<html lang="en">


   <?php include 'templates/head.php'; ?>

    <style>
        * {
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', sans-serif;
            background: #F8FAFC;
        }


        .discount-table-container {
            background: #FFFFFF;
            border-radius: 8px;
            border: 1px solid #E2E8F0;
            overflow: hidden;
        }

        .discount-table-container .table {
            margin-bottom: 0;
        }

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

        .discount-table-container .table tbody tr:hover {
            background: #F8FAFC;
        }

        .discount-table-container .table tbody tr:last-child td {
            border-bottom: none;
        }

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

        .discount-amount {
            font-weight: 700;
            font-size: 1rem;
        }

        .discount-amount.percentage {
            color: #2563EB;
        }

        .discount-amount.fixed {
            color: #10B981;
        }

        .eligibility-badge {
            padding: 4px 10px;
            border-radius: 20px;
            font-size: 0.75rem;
            font-weight: 500;
            background: #F1F5F9;
            color: #1E293B;
        }

        .eligibility-badge.all {
            background: #DBEAFE;
            color: #1E40AF;
        }

        .eligibility-badge.category {
            background: #D1FAE5;
            color: #065F46;
        }

        .eligibility-badge.specific {
            background: #FEF3C7;
            color: #92400E;
        }

        .badge-status {
            padding: 4px 12px;
            border-radius: 20px;
            font-size: 0.75rem;
            font-weight: 500;
        }

        .badge-status.active {
            background: #D1FAE5;
            color: #065F46;
        }

        .badge-status.inactive {
            background: #FEE2E2;
            color: #991B1B;
        }

        .badge-status.expired {
            background: #FEF3C7;
            color: #92400E;
        }

        .badge-status.scheduled {
            background: #CFFAFE;
            color: #0E7490;
        }

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

        .action-btn:hover {
            background: #F1F5F9;
            color: #1E293B;
        }

        .action-btn.delete:hover {
            color: #EF4444;
            background: #FEE2E2;
        }

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

        .btn-add-coupon:hover {
            background: #1E40AF;
            color: #FFFFFF;
        }

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

        .entries-select {
            width: 80px !important;
        }

        .search-input {
            width: 250px !important;
        }

        .pagination-info {
            color: #64748B;
            font-size: 0.9rem;
        }

        .alert-custom {
            padding: 12px 16px;
            border-radius: 8px;
            margin-bottom: 1rem;
            display: none;
            border-left: 4px solid;
        }

        .alert-custom.show {
            display: block;
        }

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

        @media (max-width: 767.98px) {
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
                box-shadow: 2px 0 8px rgba(0, 0, 0, 0.1);
            }

            .sidebar-wrapper.open {
                width: 280px;
                transform: translateX(0);
            }

            .main-content {
                margin-left: 0;
                padding: 10px 12px;
            }

            .sidebar-toggle {
                display: block !important;
            }

            .d-flex.justify-content-between.align-items-center {
                flex-direction: column;
                align-items: flex-start !important;
                gap: 8px;
            }

            .btn-toolbar {
                width: 100%;
            }

            .btn-toolbar .btn-group {
                width: 100%;
            }

            .btn-toolbar .btn-group .btn {
                width: 100%;
            }

            .discount-table-container .table thead {
                display: none;
            }

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

            .discount-table-container .table tbody td:last-child:before {
                display: none;
            }

            .discount-table-container .table tbody td:last-child {
                justify-content: flex-start;
            }

            .discount-table-container .table tbody td:first-child:before {
                display: none;
            }

            .discount-table-container .table tbody tr {
                display: block;
                border-bottom: 1px solid #E2E8F0;
                padding: 4px 0;
            }

            .discount-table-container .table tbody tr:last-child {
                border-bottom: none;
            }

            .discount-table-container .table tbody td:first-child {
                padding-top: 8px;
            }

            .discount-table-container .table tbody td:last-child {
                padding-bottom: 8px;
            }

            .table-tools {
                flex-direction: column;
                align-items: stretch;
            }

            .search-input {
                width: 100% !important;
            }

            .modal-dialog {
                margin: 0.5rem;
            }

            .modal-body {
                padding: 1rem;
            }
        }

        @media (max-width: 479.98px) {
            .main-content {
                padding: 6px 8px;
            }
        }

        @keyframes slideIn {
            from {
                transform: translateX(100%);
                opacity: 0;
            }

            to {
                transform: translateX(0);
                opacity: 1;
            }
        }

        .custom-alert {
            animation: slideIn 0.3s ease-out;
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
        <div id="discounts-page" class="page-section active-page">



            <!-- Alert Container -->
            <div id="alertContainer"></div>

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
                        <!-- Coupons will be rendered by JavaScript -->
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
        // COUPON DATA - READ FROM LOCALSTORAGE
        // ============================================================
        function getCoupons() {
            return JSON.parse(localStorage.getItem('coupons') || '[]');
        }

        function saveCoupons(coupons) {
            localStorage.setItem('coupons', JSON.stringify(coupons));
        }

        // Initialize coupons in localStorage if empty
        if (getCoupons().length === 0) {
            const defaultCoupons = [{
                    id: 1,
                    code: 'SUMMER20',
                    type: 'Percentage',
                    discount: 20,
                    apply: 'All Products',
                    eligibility: 'Everyone',
                    usage_total: 150,
                    usage_per_customer: 5,
                    valid_from: '2026-06-01',
                    valid_till: '2026-07-31',
                    status: 'Active',
                    description: 'Summer sale discount',
                    created_at: new Date().toISOString()
                },
                {
                    id: 2,
                    code: 'FREESHIP',
                    type: 'Free Shipping',
                    discount: 0,
                    apply: 'All Products',
                    eligibility: 'Everyone',
                    usage_total: 75,
                    usage_per_customer: 3,
                    valid_from: '2026-06-15',
                    valid_till: '2026-08-15',
                    status: 'Active',
                    description: 'Free shipping on all orders',
                    created_at: new Date().toISOString()
                },
                {
                    id: 3,
                    code: 'WELCOME10',
                    type: 'Percentage',
                    discount: 10,
                    apply: 'All Products',
                    eligibility: 'New Customers',
                    usage_total: 200,
                    usage_per_customer: 2,
                    valid_from: '2026-01-01',
                    valid_till: '2026-12-31',
                    status: 'Active',
                    description: 'Welcome discount for new customers',
                    created_at: new Date().toISOString()
                },
                {
                    id: 4,
                    code: 'HOLIDAY25',
                    type: 'Percentage',
                    discount: 25,
                    apply: 'All Products',
                    eligibility: 'Everyone',
                    usage_total: 50,
                    usage_per_customer: 2,
                    valid_from: '2026-12-01',
                    valid_till: '2026-12-25',
                    status: 'Scheduled',
                    description: 'Holiday special discount',
                    created_at: new Date().toISOString()
                },
                {
                    id: 5,
                    code: 'FLASH50',
                    type: 'Percentage',
                    discount: 50,
                    apply: 'Specific Category',
                    eligibility: 'Everyone',
                    usage_total: 30,
                    usage_per_customer: 1,
                    valid_from: '2026-06-01',
                    valid_till: '2026-06-30',
                    status: 'Expired',
                    description: 'Flash sale on smart devices',
                    created_at: new Date().toISOString()
                }
            ];
            saveCoupons(defaultCoupons);
        }

        let couponsData = getCoupons();
        let filteredCoupons = [...couponsData];
        let currentPage = 1;
        let rowsPerPage = 5;

        // ============================================================
        // FUNCTION: Format Date
        // ============================================================
        function formatDate(dateStr) {
            if (!dateStr) return 'N/A';
            const date = new Date(dateStr);
            return date.toLocaleDateString('en-US', {
                month: 'short',
                day: 'numeric',
                year: 'numeric'
            });
        }

        // ============================================================
        // FUNCTION: Get Eligibility Badge Class
        // ============================================================
        function getEligibilityBadge(eligibility) {
            if (eligibility === 'All Products' || eligibility === 'Everyone') return 'all';
            if (eligibility === 'Specific Category' || eligibility === 'Category: Electronics' || eligibility === 'Category: Accessories') return 'category';
            return 'specific';
        }

        // ============================================================
        // FUNCTION: Get Status Badge Class
        // ============================================================
        function getStatusBadge(status) {
            if (status === 'Active') return 'active';
            if (status === 'Inactive') return 'inactive';
            if (status === 'Expired') return 'expired';
            if (status === 'Scheduled') return 'scheduled';
            return 'active';
        }

        // ============================================================
        // FUNCTION: Get Discount Display
        // ============================================================
        function getDiscountDisplay(type, discount) {
            if (type === 'Percentage') return discount + '% OFF';
            if (type === 'Fixed Amount') return '$' + discount.toFixed(2) + ' OFF';
            if (type === 'Free Shipping') return 'Free Shipping';
            if (type === 'Buy X Get Y') return 'Buy ' + discount + ' Get 1';
            return discount + '% OFF';
        }

        // ============================================================
        // FUNCTION: Render Coupons Table
        // ============================================================
        function renderCoupons() {
            const tbody = document.getElementById('discountTableBody');
            const start = (currentPage - 1) * rowsPerPage;
            const end = Math.min(start + rowsPerPage, filteredCoupons.length);
            const pageCoupons = filteredCoupons.slice(start, end);

            if (filteredCoupons.length === 0) {
                tbody.innerHTML = `
                    <tr>
                        <td colspan="8" class="text-center py-4">
                            <i class="fas fa-ticket-alt fa-2x text-muted mb-2 d-block"></i>
                            <span class="text-muted">No coupons found. <a href="add-discount.php">Add your first coupon</a></span>
                        </td>
                    </tr>
                `;
                renderPagination();
                return;
            }

            let html = '';
            let serial = start + 1;
            pageCoupons.forEach(c => {
                const discountDisplay = getDiscountDisplay(c.type, c.discount);
                const typeClass = c.type === 'Percentage' ? 'percentage' : 'fixed';
                const eligBadge = getEligibilityBadge(c.eligibility);
                const statusBadge = getStatusBadge(c.status);
                const usageDisplay = c.usage_total || 'No limit';
                const expiresDate = formatDate(c.valid_till);

                html += `
                    <tr data-id="${c.id}">
                        <td data-label="#">${serial++}</td>
                        <td data-label="Code">
                            <span class="discount-code">${c.code}</span>
                        </td>
                        <td data-label="Discount"><span class="discount-amount ${typeClass}">${discountDisplay}</span></td>
                        <td data-label="Eligibility"><span class="eligibility-badge ${eligBadge}">${c.eligibility}</span></td>
                        <td data-label="Usage limit">${usageDisplay}</td>
                        <td data-label="Expires on">${expiresDate}</td>
                        <td data-label="Status"><span class="badge-status ${statusBadge}">${c.status}</span></td>
                        <td data-label="Action">
                            <a href="edit-discount.php?id=${c.id}" class="btn btn-sm btn-outline-secondary me-1" style="border-radius: 6px; padding: 4px 10px;">
                                <i class="fas fa-edit"></i>
                            </a>
                            <button class="btn btn-sm btn-outline-danger" style="border-radius: 6px; padding: 4px 10px;" onclick="deleteCoupon(${c.id})">
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
            const totalPages = Math.ceil(filteredCoupons.length / rowsPerPage);
            const controls = document.getElementById('paginationControls');
            const info = document.getElementById('paginationInfo');

            const start = (currentPage - 1) * rowsPerPage + 1;
            const end = Math.min(currentPage * rowsPerPage, filteredCoupons.length);
            info.textContent = `Showing ${filteredCoupons.length > 0 ? start : 0} to ${end} of ${filteredCoupons.length} entries`;

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
            const totalPages = Math.ceil(filteredCoupons.length / rowsPerPage);
            if (page < 1 || page > totalPages) return;
            currentPage = page;
            renderCoupons();
        }

        // ============================================================
        // FUNCTION: Change Page
        // ============================================================
        function changePage(direction) {
            const totalPages = Math.ceil(filteredCoupons.length / rowsPerPage);
            if (direction === 'prev' && currentPage > 1) {
                currentPage--;
            } else if (direction === 'next' && currentPage < totalPages) {
                currentPage++;
            } else return;
            renderCoupons();
        }

        // ============================================================
        // FUNCTION: Delete Coupon
        // ============================================================
        function deleteCoupon(id) {
            if (confirm('Are you sure you want to delete this coupon?')) {
                couponsData = couponsData.filter(c => c.id !== id);
                filteredCoupons = filteredCoupons.filter(c => c.id !== id);
                saveCoupons(couponsData);
                if (filteredCoupons.length === 0) currentPage = 1;
                renderCoupons();
                showAlert('Coupon deleted successfully!', 'success');
            }
        }

        // ============================================================
        // FUNCTION: Show Alert
        // ============================================================
        function showAlert(message, type = 'success') {
            const container = document.getElementById('alertContainer');
            const colors = {
                success: {
                    bg: '#D1FAE5',
                    color: '#065F46',
                    border: '#10B981',
                    icon: 'check-circle'
                },
                error: {
                    bg: '#FEE2E2',
                    color: '#991B1B',
                    border: '#EF4444',
                    icon: 'exclamation-circle'
                }
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
        // FUNCTION: Search Coupons
        // ============================================================
        function searchCoupons() {
            const term = document.getElementById('discountSearch').value.toLowerCase().trim();

            filteredCoupons = couponsData.filter(c => {
                return !term ||
                    c.code.toLowerCase().includes(term) ||
                    c.eligibility.toLowerCase().includes(term) ||
                    c.status.toLowerCase().includes(term) ||
                    (c.type && c.type.toLowerCase().includes(term));
            });

            currentPage = 1;
            renderCoupons();
        }

        // ============================================================
        // FUNCTION: Entries Change
        // ============================================================
        function changeEntries() {
            const value = parseInt(document.getElementById('entriesSelect').value);
            rowsPerPage = value;
            currentPage = 1;
            renderCoupons();
        }

        // ============================================================
        // CHECK URL PARAMETERS FOR ALERTS
        // ============================================================
        function checkUrlParams() {
            const urlParams = new URLSearchParams(window.location.search);
            if (urlParams.has('added')) {
                showAlert('Coupon added successfully!', 'success');
            }
            if (urlParams.has('deleted')) {
                showAlert('Coupon deleted successfully!', 'success');
            }
            if (urlParams.has('updated')) {
                showAlert('Coupon updated successfully!', 'success');
            }
            if (urlParams.has('error')) {
                showAlert('Failed to process coupon. Please check all fields.', 'error');
            }
        }

        // ============================================================
        // EVENT LISTENERS
        // ============================================================
        document.addEventListener('DOMContentLoaded', function() {
            // Reload coupons from localStorage
            couponsData = getCoupons();
            filteredCoupons = [...couponsData];

            renderCoupons();
            checkUrlParams();

            // Search
            document.getElementById('discountSearch')?.addEventListener('keyup', searchCoupons);

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

            console.log('Discounts page initialized (100% JavaScript with localStorage)');
            console.log('Total coupons:', couponsData.length);
        });
    </script>
</body>

</html>