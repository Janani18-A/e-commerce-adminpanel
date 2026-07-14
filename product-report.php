<?php
include 'config/config.php';
?>
<?php $current_page = 'product-reports'; ?>
<!DOCTYPE html>
<html lang="en">


  <?php include 'templates/head.php'; ?>

    <style>
        body {
            background: #f4f7fc;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        .content-area {
            margin-left: 260px;
            padding: 30px 30px 40px;
            min-height: 100vh;
            transition: margin-left 0.3s ease;
        }

        @media (max-width: 992px) {
            .content-area {
                margin-left: 0;
                padding: 20px 16px 30px;
            }
        }

        .page-header {
            border-bottom: 2px solid #e9edf4;
            padding-bottom: 12px;
            margin-bottom: 28px;
        }

        .page-title i {
            color: #2a7de1;
        }

        .card {
            border-radius: 16px;
            border: none;
            box-shadow: 0 8px 30px rgba(0, 0, 0, 0.05);
        }

        .product-category-badge {
            font-size: 11px;
            font-weight: 600;
            padding: 2px 12px;
            border-radius: 20px;
            background: #eef2ff;
            color: #4338ca;
            margin-left: 8px;
        }

        .badge-sold {
            background: #d1fae5;
            color: #065f46;
            font-weight: 600;
            padding: 2px 12px;
            border-radius: 20px;
            font-size: 12px;
        }

        .badge-remaining {
            background: #fef3c7;
            color: #92400e;
            font-weight: 600;
            padding: 2px 12px;
            border-radius: 20px;
            font-size: 12px;
        }

        .earnings-amount {
            font-weight: 700;
            color: #0b2a4a;
        }

        .toast-notification {
            position: fixed;
            bottom: 30px;
            right: 30px;
            background: #1e293b;
            color: #fff;
            padding: 14px 26px;
            border-radius: 14px;
            display: flex;
            align-items: center;
            gap: 14px;
            font-size: 15px;
            font-weight: 500;
            box-shadow: 0 12px 40px rgba(0, 0, 0, 0.25);
            transform: translateY(80px);
            opacity: 0;
            transition: transform 0.4s cubic-bezier(0.22, 1, 0.36, 1), opacity 0.4s ease;
            z-index: 9999;
            pointer-events: none;
        }

        .toast-notification.show {
            transform: translateY(0);
            opacity: 1;
            pointer-events: auto;
        }

        .toast-notification i {
            font-size: 22px;
            color: #34d399;
        }

        /* ========================================== */
        /* CIRCULAR PAGINATION – custom styling       */
        /* ========================================== */
        .pagination {
            gap: 4px;
        }

        .pagination .page-item .page-link {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 36px;
            height: 36px;
            padding: 0;
            border-radius: 50% !important;
            font-size: 14px;
            font-weight: 500;
            color: #1e293b;
            background: #fff;
            border: 1.5px solid #e2e8f0;
            transition: all 0.2s ease;
            line-height: 1;
            text-decoration: none;
        }

        /* Hover effect */
        .pagination .page-item:not(.active):not(.disabled) .page-link:hover {
            background: #eef2ff;
            border-color: #2a7de1;
            color: #2a7de1;
            transform: scale(1.05);
        }

        /* Active page – blue circle */
        .pagination .page-item.active .page-link {
            background: #2a7de1;
            border-color: #2a7de1;
            color: #fff;
            box-shadow: 0 4px 10px rgba(42, 125, 225, 0.35);
        }

        /* Disabled state (prev / next when inactive) */
        .pagination .page-item.disabled .page-link {
            opacity: 0.5;
            cursor: not-allowed;
            background: #f1f5f9;
            border-color: #e2e8f0;
            color: #94a3b8;
            transform: none;
        }

        /* Previous / Next arrows – keep them circular too */
        .pagination .page-item:first-child .page-link,
        .pagination .page-item:last-child .page-link {
            width: 36px;
            height: 36px;
            border-radius: 50% !important;
            font-size: 16px;
        }

        /* Remove default bootstrap left/right border-radius overrides */
        .pagination .page-item:first-child .page-link,
        .pagination .page-item:last-child .page-link {
            border-radius: 50% !important;
        }

        /* Add a subtle ring around the whole pagination area */
        .pagination {
            --bs-pagination-border-radius: 50%;
        }

        /* spacing between page items */
        .pagination .page-item {
            margin: 0 2px;
        }

        /* Responsive: smaller circles on mobile */
        @media (max-width: 576px) {
            .pagination .page-item .page-link {
                width: 32px;
                height: 32px;
                font-size: 12px;
            }

            .pagination .page-item:first-child .page-link,
            .pagination .page-item:last-child .page-link {
                width: 32px;
                height: 32px;
                font-size: 14px;
            }

            .toast-notification {
                bottom: 16px;
                right: 16px;
                left: 16px;
                padding: 12px 18px;
                font-size: 14px;
            }
        }
    </style>
</head>

<body>
    <!-- Navbar & Sidebar -->
    <?php include 'templates/navbar.php'; ?>
    <?php include 'templates/sidebar.php'; ?>

    <!-- MAIN CONTENT -->
    <div class="content-area">
        <div class="container-fluid">

            <!-- Page Header -->
            <div class="page-header d-flex flex-wrap align-items-center justify-content-between">
              <h4 class="page-title mb-0"><i class="bi bi-file-earmark-bar-graph-fill text-primary me-2"></i> PRODUCT REPORTS</h4>
            </div>

            <!-- Main Card -->
            <div class="card">
                <div class="card-body">

                    <!-- FILTERS ROW -->
                    <div class="row g-3 align-items-end mb-4 pb-2 border-bottom">

                        <!-- Date From -->
                        <div class="col-md-3 col-sm-6">
                            <label for="dateFrom" class="form-label fw-semibold text-uppercase small">
                                Date From
                            </label>
                            <input type="date" class="form-control form-control-sm" id="dateFrom">
                        </div>

                        <!-- Date To -->
                        <div class="col-md-3 col-sm-6">
                            <label for="dateTo" class="form-label fw-semibold text-uppercase small">
                                Date To
                            </label>
                            <input type="date" class="form-control form-control-sm" id="dateTo">
                        </div>

                        <!-- Search Button -->
                        <div class="col-md-auto col-sm-3">
                            <button class="btn btn-primary w-100" id="searchBtn">
                                <i class="fas fa-search me-1"></i> Search
                            </button>
                        </div>

                        <!-- Category -->
                        <div class="col-md-3 col-sm-6 ms-4">
                            <label for="categoryFilter" class="form-label fw-semibold text-uppercase small ">
                                Category
                            </label>
                            <select class="form-select form-select-sm" id="categoryFilter">
                                <option value="all">All</option>
                                <option value="Cakes">Cakes</option>
                                <option value="Pastries">Pastries</option>
                                <option value="Breads">Breads</option>
                                <option value="Cookies">Cookies</option>
                                <option value="Muffins">Muffins</option>
                                <option value="Tarts">Tarts</option>
                                <option value="Brownies">Brownies</option>
                            </select>
                        </div>

                    </div>
                </div>

                <!-- Toolbar Row -->
                <div class="row g-2 align-items-center mb-3">
                    <div class="col-md-6 d-flex flex-wrap align-items-center gap-2 ps-3">
                        <div class="d-flex align-items-center gap-2">
                            <label for="entriesPerPage" class="fw-semibold small mb-0 ">Show</label>
                            <select class="form-select form-select-sm w-auto" id="entriesPerPage">
                                <option value="5">5</option>
                                <option value="10" selected>10</option>
                                <option value="25">25</option>
                                <option value="50">50</option>
                            </select>
                            <span class="text-muted small">entries</span>
                        </div>
                        <button class="btn btn-success btn-sm" id="exportBtn">
                            <i class="fas fa-file-excel me-1"></i> Export to Excel
                        </button>
                    </div>
                    <div class="col-md-6 d-flex justify-content-md-end align-items-center gap-2">
                        <label for="searchInput" class="fw-semibold small mb-0">Search:</label>
                        <input type="text" class="form-control form-control-sm w-50" id="searchInput" placeholder="Product name...">
                    </div>
                </div>

                <!-- Table -->
                <div class="table-responsive">
                    <table class="table table-hover align-middle" id="productTable">
                        <thead class="table-light">
                            <tr>
                                <th>Product</th>
                                <th>Date</th>
                                <th>Pulled</th>
                                <th>Sold</th>
                                <th>Remaining</th>
                                <th>Earnings</th>
                            </tr>
                        </thead>
                        <tbody id="tableBody">
                            <!-- rows from JS -->
                        </tbody>
                    </table>
                </div>

                <!-- Table Footer with CIRCULAR Pagination -->
                <div class="row g-2 align-items-center mt-3">
                    <div class="col-md-6">
                        <span class="text-muted small" id="tableInfo">Showing 0 to 0 of 0 entries</span>
                    </div>
                    <div class="col-md-6 d-flex justify-content-md-end">
                        <nav aria-label="Page navigation">
                            <ul class="pagination pagination-sm mb-0" id="paginationControls">
                                <li class="page-item" id="prevPageItem">
                                    <a class="page-link" href="#" aria-label="Previous" id="prevPage">
                                        <span aria-hidden="true">&laquo;</span>
                                    </a>
                                </li>
                                <li class="page-item d-flex" id="pageNumbers">
                                    <!-- page numbers injected by JS -->
                                </li>
                                <li class="page-item" id="nextPageItem">
                                    <a class="page-link" href="#" aria-label="Next" id="nextPage">
                                        <span aria-hidden="true">&raquo;</span>
                                    </a>
                                </li>
                            </ul>
                        </nav>
                    </div>
                </div>

            </div>
        </div>

    </div>
    </div>

    <!-- Toast -->
    <div class="toast-notification" id="toast">
        <i class="fas fa-check-circle"></i>
        <span id="toastMessage">Exported successfully!</span>
    </div>

    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
   <!-- Bootstrap JS Bundle (Latest Stable) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
    <script src="<?= APP_URL; ?>/assets/js/script.js"></script>

    <script>
        (function() {
            'use strict';

            const productNames = [
                'Vanilla Dream Cake', 'Chocolate Fudge Cake', 'Red Velvet Cake',
                'Carrot Walnut Cake', 'Lemon Drizzle Cake', 'Strawberry Shortcake',
                'Butter Croissant', 'Chocolate Danish', 'Almond Pain',
                'Apple Turnover', 'Cinnamon Roll', 'Cheese Danish',
                'Sourdough Loaf', 'Whole Wheat Bread', 'Baguette',
                'Focaccia', 'Rye Bread', 'Brioche',
                'Chocolate Chip Cookies', 'Oatmeal Raisin Cookies', 'Peanut Butter Cookies',
                'Snickerdoodle', 'Macadamia Nut Cookies', 'Double Chocolate Cookies',
                'Blueberry Muffins', 'Banana Nut Muffins', 'Chocolate Chip Muffins',
                'Pumpkin Spice Muffins', 'Lemon Poppy Seed Muffins', 'Apple Cinnamon Muffins',
                'Fruit Tart', 'Chocolate Tart', 'Lemon Tart',
                'Almond Tart', 'Berry Tart', 'Pecan Tart',
                'Fudge Brownies', 'Walnut Brownies', 'Blondies',
                'Cheesecake Brownies', 'Peppermint Brownies', 'Salted Caramel Brownies'
            ];
            const categories = ['Cakes', 'Pastries', 'Breads', 'Cookies', 'Muffins', 'Tarts', 'Brownies'];

            function getRandomItem(arr) {
                return arr[Math.floor(Math.random() * arr.length)];
            }

            function pad(n) {
                return String(n).padStart(2, '0');
            }

            function randomDate(from, to) {
                const d = new Date(from.getTime() + Math.random() * (to.getTime() - from.getTime()));
                return d.getFullYear() + '-' + pad(d.getMonth() + 1) + '-' + pad(d.getDate());
            }

            function generateSampleData(count) {
                const data = [];
                const start = new Date(2026, 0, 1);
                const end = new Date(2026, 6, 9);
                for (let i = 0; i < count; i++) {
                    const name = getRandomItem(productNames);
                    const cat = getRandomItem(categories);
                    const date = randomDate(start, end);
                    const pulled = Math.floor(Math.random() * 30) + 5;
                    const sold = Math.floor(Math.random() * pulled);
                    const remaining = pulled - sold;
                    const earnings = +(sold * (Math.random() * 15 + 3)).toFixed(2);
                    data.push({
                        id: i + 1,
                        name,
                        category: cat,
                        date,
                        pulled,
                        sold,
                        remaining,
                        earnings
                    });
                }
                return data;
            }

            let allData = generateSampleData(120);
            let filteredData = [...allData];
            let currentPage = 1;
            let entriesPerPage = 10;

            const tbody = document.getElementById('tableBody');
            const tableInfo = document.getElementById('tableInfo');
            const pageNumbers = document.getElementById('pageNumbers');
            const prevPage = document.getElementById('prevPage');
            const nextPage = document.getElementById('nextPage');
            const entriesSelect = document.getElementById('entriesPerPage');
            const searchInput = document.getElementById('searchInput');
            const dateFrom = document.getElementById('dateFrom');
            const dateTo = document.getElementById('dateTo');
            const categoryFilter = document.getElementById('categoryFilter');
            const searchBtn = document.getElementById('searchBtn');
            const exportBtn = document.getElementById('exportBtn');
            const toast = document.getElementById('toast');
            const toastMsg = document.getElementById('toastMessage');

            function showToast(msg) {
                toastMsg.textContent = msg || 'Action completed!';
                toast.classList.add('show');
                clearTimeout(toast._timer);
                toast._timer = setTimeout(() => toast.classList.remove('show'), 3000);
            }

            function escapeHtml(text) {
                const div = document.createElement('div');
                div.textContent = text;
                return div.innerHTML;
            }

            function applyFilters() {
                const search = searchInput.value.trim().toLowerCase();
                const from = dateFrom.value;
                const to = dateTo.value;
                const cat = categoryFilter.value;
                filteredData = allData.filter(item => {
                    if (search && !item.name.toLowerCase().includes(search)) return false;
                    if (from && item.date < from) return false;
                    if (to && item.date > to) return false;
                    if (cat !== 'all' && item.category !== cat) return false;
                    return true;
                });
                currentPage = 1;
                renderTable();
            }

            function renderTable() {
                const total = filteredData.length;
                const totalPages = Math.ceil(total / entriesPerPage) || 1;
                if (currentPage > totalPages) currentPage = totalPages;
                const start = (currentPage - 1) * entriesPerPage;
                const end = Math.min(start + entriesPerPage, total);
                const pageData = filteredData.slice(start, end);

                let html = '';
                if (pageData.length === 0) {
                    html = '<tr><td colspan="6" class="text-center py-4 text-muted">No records found</td></tr>';
                } else {
                    pageData.forEach(item => {
                        html += `<tr>
                            <td><span class="fw-semibold">${escapeHtml(item.name)}</span> <span class="product-category-badge">${escapeHtml(item.category)}</span></td>
                            <td>${escapeHtml(item.date)}</td>
                            <td>${item.pulled}</td>
                            <td><span class="badge-sold">${item.sold}</span></td>
                            <td><span class="badge-remaining">${item.remaining}</span></td>
                            <td><span class="earnings-amount">$${item.earnings.toFixed(2)}</span></td>
                        </tr>`;
                    });
                }
                tbody.innerHTML = html;

                const fromDisplay = total === 0 ? 0 : start + 1;
                const toDisplay = total === 0 ? 0 : end;
                tableInfo.textContent = `Showing ${fromDisplay} to ${toDisplay} of ${total} entries`;

                renderPagination(totalPages);
            }

            function renderPagination(totalPages) {
                const pageNumbersContainer = document.getElementById('pageNumbers');
                pageNumbersContainer.innerHTML = '';
                for (let i = 1; i <= totalPages; i++) {
                    const li = document.createElement('li');
                    li.className = `page-item ${i === currentPage ? 'active' : ''}`;
                    const a = document.createElement('a');
                    a.className = 'page-link';
                    a.href = '#';
                    a.textContent = i;
                    a.dataset.page = i;
                    a.addEventListener('click', (e) => {
                        e.preventDefault();
                        const page = parseInt(e.target.dataset.page, 10);
                        if (page !== currentPage) {
                            currentPage = page;
                            renderTable();
                        }
                    });
                    li.appendChild(a);
                    pageNumbersContainer.appendChild(li);
                }

                document.getElementById('prevPageItem').classList.toggle('disabled', currentPage <= 1);
                document.getElementById('nextPageItem').classList.toggle('disabled', currentPage >= totalPages);
            }

            function goToPrev(e) {
                e.preventDefault();
                if (currentPage > 1) {
                    currentPage--;
                    renderTable();
                }
            }

            function goToNext(e) {
                e.preventDefault();
                const total = filteredData.length;
                const totalPages = Math.ceil(total / entriesPerPage) || 1;
                if (currentPage < totalPages) {
                    currentPage++;
                    renderTable();
                }
            }

            function exportToExcel() {
                const rows = filteredData.length ? filteredData : allData;
                if (!rows.length) {
                    showToast('No data to export.');
                    return;
                }
                let csv = '\uFEFF';
                csv += 'Product,Category,Date,Pulled,Sold,Remaining,Earnings\n';
                rows.forEach(item => {
                    csv += `"${item.name}","${item.category}","${item.date}",${item.pulled},${item.sold},${item.remaining},${item.earnings.toFixed(2)}\n`;
                });
                const blob = new Blob([csv], {
                    type: 'text/csv;charset=utf-8;'
                });
                const link = document.createElement('a');
                const url = URL.createObjectURL(blob);
                link.href = url;
                link.download = `product_reports_${new Date().toISOString().slice(0,10)}.csv`;
                document.body.appendChild(link);
                link.click();
                document.body.removeChild(link);
                URL.revokeObjectURL(url);
                showToast(`Exported ${rows.length} rows successfully!`);
            }

            searchBtn.addEventListener('click', applyFilters);
            searchInput.addEventListener('keydown', e => {
                if (e.key === 'Enter') applyFilters();
            });
            entriesSelect.addEventListener('change', function() {
                entriesPerPage = parseInt(this.value, 10);
                currentPage = 1;
                renderTable();
            });
            prevPage.addEventListener('click', goToPrev);
            nextPage.addEventListener('click', goToNext);
            exportBtn.addEventListener('click', exportToExcel);

            document.addEventListener('keydown', e => {
                if (e.ctrlKey && e.shiftKey && (e.key === 'E' || e.key === 'e')) {
                    e.preventDefault();
                    exportToExcel();
                }
            });

            const today = new Date();
            const thirtyDaysAgo = new Date(today);
            thirtyDaysAgo.setDate(today.getDate() - 30);
            dateFrom.value = thirtyDaysAgo.toISOString().slice(0, 10);
            dateTo.value = today.toISOString().slice(0, 10);
            renderTable();
        })();
    </script>
</body>

</html>