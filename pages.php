<?php $current_page = 'pages'; ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pages - Admin Panel</title>
    <!-- Bootstrap 5 & Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/style.css">

    <style>
        /* Minimal custom overrides – everything else uses Bootstrap */
        body {
            background: #f4f7fc;
            font-family: 'Inter', sans-serif;
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

        .page-title {
            font-size: 25px;
            font-weight: 500;
            color: #0b0b0b;
        }

        .card {
            border-radius: 16px;
            border: none;
            box-shadow: 0 8px 30px rgba(0, 0, 0, 0.05);
        }

        .card-body {
            padding: 28px 30px 30px;
        }

        /* Custom colors for action buttons (using Bootstrap btn classes) */
        .btn-edit {
            background: #eef2ff;
            color: #4338ca;
        }

        .btn-edit:hover {
            background: #4338ca;
            color: #fff;
        }

        .btn-delete {
            background: #fee2e2;
            color: #dc2626;
        }

        .btn-delete:hover {
            background: #dc2626;
            color: #fff;
        }

        /* Toast - unchanged */
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

        @media (max-width: 576px) {
            .toast-notification {
                bottom: 16px;
                right: 16px;
                left: 16px;
                padding: 12px 18px;
                font-size: 14px;
            }
        }

        /* ensure table cells are vertically centered */
        .table td,
        .table th {
            vertical-align: middle;
        }

        /* custom code style for slug */
        .slug-code {
            background: #f1f5f9;
            padding: 2px 8px;
            border-radius: 4px;
            font-size: 0.9rem;
            color: #0b2a4a;
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
                <h4 class="page-title">
                    <i class="fas fa-file-alt me-2"></i> PAGES
                </h4>

                <!-- add buttons--->
                <a href="add-pages.php" class="btn btn-primary btn-lg px-5">
                    <i class="fas fa-plus me-1"></i> Add Page
                </a>
            </div>

            <!-- Table Card -->
            <div class="card">
                <div class="card-body">

                    <!-- Toolbar: Show entries + Add Page + Search -->
                    <div class="d-flex flex-wrap align-items-center justify-content-between gap-2 mb-3">
                        <div class="d-flex flex-wrap align-items-center gap-2">
                            <!-- Show entries -->
                            <div class="d-flex align-items-center gap-2">
                                <label for="entriesPerPage" class="fw-semibold small mb-0">Show</label>
                                <select id="entriesPerPage" class="form-select form-select-sm w-auto">
                                    <option value="5">5</option>
                                    <option value="10" selected>10</option>
                                    <option value="25">25</option>
                                    <option value="50">50</option>
                                </select>
                                <span class="text-muted small">entries</span>
                            </div>
                        </div>
                        <!-- Search -->
                        <div class="d-flex align-items-center gap-2">
                            <label for="searchInput" class="fw-semibold small mb-0">Search:</label>
                            <input type="text" id="searchInput" class="form-control form-control-sm" placeholder="Search..." style="width:200px;">
                        </div>
                    </div>

                    <!-- Table -->
                    <div class="table-responsive">
                        <table class="table table-hover align-middle">
                            <thead class="table-light">
                                <tr>
                                    <th class="fw-bold text-uppercase small">Name</th>
                                    <th class="fw-bold text-uppercase small">Slug</th>
                                    <th class="fw-bold text-uppercase small text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody id="tableBody">
                                <!-- rows injected by JavaScript -->
                            </tbody>
                        </table>
                    </div>

                    <!-- Footer: Info + Pagination (Bootstrap) -->
                    <div class="d-flex flex-wrap align-items-center justify-content-between mt-3 pt-2 border-top">
                        <span id="tableInfo" class="text-muted small">Showing 0 to 0 of 0 entries</span>
                        <nav aria-label="Page navigation">
                            <ul class="pagination pagination-sm mb-0" id="pagination">
                                <!-- pagination will be generated by JavaScript using Bootstrap classes -->
                            </ul>
                        </nav>
                    </div>

                </div>
            </div>

        </div>
    </div>

    <!-- Toast -->
    <div class="toast-notification" id="toast">
        <i class="fas fa-check-circle"></i>
        <span id="toastMessage">Action performed!</span>
    </div>

    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="assets/js/script.js"></script>

    <script>
        (function() {
            'use strict';

            // ---------- SAMPLE DATA ----------
            const samplePages = [{
                    name: 'Dashboard',
                    slug: 'dashboard'
                },
                {
                    name: 'Profile',
                    slug: 'profile'
                },
                {
                    name: 'Settings',
                    slug: 'settings'
                },
                {
                    name: 'Users',
                    slug: 'users'
                },
                {
                    name: 'Roles',
                    slug: 'roles'
                },
                {
                    name: 'Permissions',
                    slug: 'permissions'
                },
                {
                    name: 'Products',
                    slug: 'products'
                },
                {
                    name: 'Categories',
                    slug: 'categories'
                },
                {
                    name: 'Orders',
                    slug: 'orders'
                },
                {
                    name: 'Customers',
                    slug: 'customers'
                },
                {
                    name: 'Reviews',
                    slug: 'reviews'
                },
                {
                    name: 'Coupons',
                    slug: 'coupons'
                },
                {
                    name: 'Reports',
                    slug: 'reports'
                },
                {
                    name: 'Analytics',
                    slug: 'analytics'
                },
                {
                    name: 'Logs',
                    slug: 'logs'
                },
                {
                    name: 'Backups',
                    slug: 'backups'
                },
                {
                    name: 'SEO',
                    slug: 'seo'
                },
                {
                    name: 'Social Media',
                    slug: 'social-media'
                },
                {
                    name: 'Email Templates',
                    slug: 'email-templates'
                },
                {
                    name: 'Translations',
                    slug: 'translations'
                },
                {
                    name: 'Payment Methods',
                    slug: 'payment-methods'
                },
                {
                    name: 'Shipping Zones',
                    slug: 'shipping-zones'
                },
                {
                    name: 'Tax Rates',
                    slug: 'tax-rates'
                },
                {
                    name: 'Currencies',
                    slug: 'currencies'
                },
                {
                    name: 'Languages',
                    slug: 'languages'
                }
            ];

            let allData = samplePages.map((item, index) => ({
                id: index + 1,
                name: item.name,
                slug: item.slug
            }));

            let filteredData = [...allData];
            let currentPage = 1;
            let entriesPerPage = 10;

            const tbody = document.getElementById("tableBody");
            const tableInfo = document.getElementById("tableInfo");
            const paginationEl = document.getElementById("pagination");
            const entriesSelect = document.getElementById("entriesPerPage");
            const searchInput = document.getElementById("searchInput");
            const toast = document.getElementById("toast");
            const toastMsg = document.getElementById("toastMessage");

            function showToast(msg) {
                toastMsg.textContent = msg;
                toast.classList.add("show");

                clearTimeout(window.toastTimer);

                window.toastTimer = setTimeout(() => {
                    toast.classList.remove("show");
                }, 3000);
            }

            function applyFilters() {

                const keyword = searchInput.value.toLowerCase();

                filteredData = allData.filter(item =>
                    item.name.toLowerCase().includes(keyword) ||
                    item.slug.toLowerCase().includes(keyword)
                );

                currentPage = 1;
                renderTable();
            }

            function renderTable() {

                const total = filteredData.length;
                const totalPages = Math.max(1, Math.ceil(total / entriesPerPage));

                if (currentPage > totalPages) {
                    currentPage = totalPages;
                }

                const start = (currentPage - 1) * entriesPerPage;
                const end = Math.min(start + entriesPerPage, total);

                const pageData = filteredData.slice(start, end);

                tbody.innerHTML = "";

                if (pageData.length === 0) {

                    tbody.innerHTML = `
            <tr>
                <td colspan="3" class="text-center text-muted py-4">
                    No data available in table
                </td>
            </tr>`;
                } else {

                    pageData.forEach(item => {

                        tbody.innerHTML += `
                <tr>

                    <td><strong>${item.name}</strong></td>

                    <td>
                        <code class="slug-code">${item.slug}</code>
                    </td>

                    <td class="text-center">

                        <button class="btn btn-edit btn-sm me-2 editBtn"
                            data-id="${item.id}">
                            <i class="fas fa-edit"></i> Edit
                        </button>

                        <button class="btn btn-delete btn-sm deleteBtn"
                            data-id="${item.id}">
                            <i class="fas fa-trash"></i> Delete
                        </button>

                    </td>

                </tr>`;
                    });

                }

                const from = total == 0 ? 0 : start + 1;
                const to = total == 0 ? 0 : end;

                tableInfo.innerHTML =
                    `Showing ${from} to ${to} of ${total} entries`;

                renderPagination(totalPages);

                // EDIT
                document.querySelectorAll(".editBtn").forEach(btn => {

                    btn.onclick = function() {

                        const id = this.dataset.id;

                        const page = allData.find(p => p.id == id);

                        localStorage.setItem("editPage",
                            JSON.stringify(page));

                        showToast("Opening edit page...");

                        setTimeout(() => {
                            window.location.href = "add-pages.php";
                        }, 600);

                    }

                });

                // DELETE
                document.querySelectorAll(".deleteBtn").forEach(btn => {

                    btn.onclick = function() {

                        const id = Number(this.dataset.id);

                        allData = allData.filter(item => item.id !== id);

                        applyFilters();

                        showToast("Page deleted successfully.");

                    }

                });

            }

            function renderPagination(totalPages) {

                paginationEl.innerHTML = "";

                paginationEl.innerHTML += `
        <li class="page-item ${currentPage == 1 ? 'disabled' : ''}">
            <a href="#" class="page-link" id="prevBtn">&laquo;</a>
        </li>`;

                for (let i = 1; i <= totalPages; i++) {

                    paginationEl.innerHTML += `
            <li class="page-item ${i == currentPage ? 'active' : ''}">
                <a href="#" class="page-link pageNo"
                    data-page="${i}">
                    ${i}
                </a>
            </li>`;
                }

                paginationEl.innerHTML += `
        <li class="page-item ${currentPage == totalPages ? 'disabled' : ''}">
            <a href="#" class="page-link" id="nextBtn">&raquo;</a>
        </li>`;

                document.querySelectorAll(".pageNo").forEach(btn => {

                    btn.onclick = function(e) {

                        e.preventDefault();

                        currentPage = Number(this.dataset.page);

                        renderTable();

                    }

                });

                document.getElementById("prevBtn").onclick = function(e) {

                    e.preventDefault();

                    if (currentPage > 1) {

                        currentPage--;

                        renderTable();

                    }

                };

                document.getElementById("nextBtn").onclick = function(e) {

                    e.preventDefault();

                    if (currentPage < totalPages) {

                        currentPage++;

                        renderTable();

                    }

                };

            }

            searchInput.addEventListener("input", applyFilters);

            entriesSelect.addEventListener("change", function() {

                entriesPerPage = Number(this.value);

                currentPage = 1;

                renderTable();

            });

            renderTable();

        })();
    </script>


</body>

</html>