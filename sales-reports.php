<?php
include 'config/config.php';
?>

<?php $current_page = 'reports'; ?>
<!DOCTYPE html>
<html lang="en">


   <?php include 'templates/head.php'; ?>
    <style>
        /* ----- GLOBAL ----- */
        body {
            background: #f4f7fc;
            font-family: 'Inter', sans-serif;
            color: #1e293b;
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

        /* ----- PAGE HEADER ----- */
        .page-header {
            display: flex;
            flex-wrap: wrap;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 28px;
            padding-bottom: 12px;
            border-bottom: 2px solid #e9edf4;
        }

        .page-title {
            font-size: 25px;
            font-weight: 500;
            color: #000000;
            margin: 0;
        }

        .page-title i {
            color: #2a7de1;
            margin-right: 10px;
        }

        .report-filter {
            padding: 6px 14px;
            border-radius: 8px;
            border: 1.5px solid #dce1eb;
            background: #fff;
            font-size: 14px;
            color: #1e293b;
        }

        /* ----- SUMMARY CARDS ----- */
        .report-card {
            background: #fff;
            border-radius: 16px;
            padding: 20px 22px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            box-shadow: 0 4px 16px rgba(0, 0, 0, 0.04);
            transition: 0.2s;
            border-left: 5px solid #2a7de1;
        }

        .report-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 24px rgba(0, 0, 0, 0.08);
        }

        .card-content span {
            font-size: 14px;
            color: #64748b;
            font-weight: 500;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .card-content h2 {
            font-size: 26px;
            font-weight: 700;
            margin: 4px 0 0;
            color: #0b2a4a;
        }

        .card-icon {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 22px;
            color: #fff;
        }

        .card-earnings .card-icon {
            background: #85c8e5;
        }

        .card-earnings {
            border-left-color: #3b82f6;
        }

        .card-gst .card-icon {
            background: #b4a0e0;
        }

        .card-gst {
            border-left-color: #8b5cf6;
        }

        .card-delivery .card-icon {
            background: #f4c87d;
        }

        .card-delivery {
            border-left-color: #f59e0b;
        }

        .card-total .card-icon {
            background: #75e1bd;
        }

        .card-total {
            border-left-color: #10b981;
        }

        /* ----- MAIN CARD ----- */
        .card {
            border-radius: 16px;
            border: none;
            box-shadow: 0 8px 30px rgba(0, 0, 0, 0.05);
        }

        .card-body {
            padding: 28px 30px 30px;
        }

        /* ----- TABLE TOOLBAR ----- */
        .table-toolbar {
            display: flex;
            flex-wrap: wrap;
            align-items: center;
            justify-content: space-between;
            gap: 12px;
            margin-bottom: 16px;
        }

        .left-toolbar {
            display: flex;
            flex-wrap: wrap;
            align-items: center;
            gap: 12px;
        }

        .entries {
            display: flex;
            align-items: center;
            gap: 8px;
            font-size: 14px;
            color: #334155;
        }

        .entries select {
            padding: 4px 8px;
            border: 1.5px solid #dce1eb;
            border-radius: 6px;
            font-size: 14px;
            background: #fafcff;
        }

        .right-toolbar {
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .right-toolbar label {
            font-weight: 500;
            font-size: 14px;
            color: #334155;
            margin: 0;
        }

        .right-toolbar input {
            padding: 6px 14px;
            border: 1.5px solid #dce1eb;
            border-radius: 8px;
            font-size: 14px;
            width: 180px;
            background: #fafcff;
        }

        .right-toolbar input:focus {
            border-color: #2a7de1;
            outline: none;
            box-shadow: 0 0 0 3px rgba(42, 125, 225, 0.12);
        }

        /* ----- TABLE ----- */
        .table th {
            background: #f8fafd;
            color: #1e293b;
            font-weight: 700;
            font-size: 13px;
            text-transform: uppercase;
            letter-spacing: 0.4px;
            padding: 14px 16px;
            border-bottom: 2px solid #e2e8f0;
        }

        .table td {
            padding: 13px 16px;
            border-bottom: 1px solid #f1f4f9;
        }

        .table tbody tr:hover {
            background: #f8fbff;
        }

        /* ============================================================
           ENHANCED PAGINATION STYLES (for the bottom part)
           ============================================================ */
        .table-footer {
            display: flex;
            flex-wrap: wrap;
            align-items: center;
            justify-content: space-between;
            margin-top: 18px;
            padding-top: 8px;
            font-size: 14px;
            color: #64748b;
            border-top: 1px solid #eef2f7;
        }

        #pagination {
            display: flex;
            align-items: center;
            gap: 6px;
            flex-wrap: wrap;
        }

        #pagination button,
        #pagination .page-num {
            background: #f1f4f9;
            border: none;
            border-radius: 8px;
            padding: 6px 14px;
            font-size: 14px;
            font-weight: 500;
            color: #1e293b;
            transition: 0.2s;
            min-width: 36px;
            text-align: center;
            cursor: pointer;
            display: inline-flex;
            align-items: center;
            justify-content: center;
        }

        #pagination button:hover:not(:disabled),
        #pagination .page-num:hover:not(.active-page) {
            background: #e2e8f0;
        }

        #pagination button:disabled {
            opacity: 0.4;
            cursor: not-allowed;
        }

        #pagination .active-page {
            background: #2a7de1;
            color: #fff;
            font-weight: 600;
            box-shadow: 0 2px 6px rgba(42, 125, 225, 0.3);
        }

        #pagination .page-prev,
        #pagination .page-next {
            background: transparent;
            padding: 6px 10px;
        }

        #pagination .page-prev:hover:not(:disabled),
        #pagination .page-next:hover:not(:disabled) {
            background: #e2e8f0;
        }

        /* ----- TOAST ----- */
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

        /* ----- RESPONSIVE ----- */
        @media (max-width: 768px) {
            .table-toolbar {
                flex-direction: column;
                align-items: stretch;
            }

            .right-toolbar input {
                width: 100%;
            }

            .page-header {
                flex-direction: column;
                align-items: flex-start;
                gap: 10px;
            }

            .report-filter {
                width: 100%;
            }

            .card-body {
                padding: 18px 14px 20px;
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

            <!-- Header -->
            <div class="page-header">
                <h4 class="page-title"><i class="bi bi-bar-chart-line-fill text-primary me-2"></i> Sales Reports</h4>
                <div class="d-flex align-items-center gap-3 flex-wrap">

                    <select class="report-filter" id="timeFilter">
                        <option value="all">All Time</option>
                        <option value="today">Today</option>
                        <option value="week">This Week</option>
                        <option value="month">This Month</option>
                        <option value="year">This Year</option>
                    </select>
                </div>
            </div>

            <!-- Summary Cards -->
            <div class="row g-4 mb-4">
                <div class="col-lg-3 col-md-6">
                    <div class="report-card card-earnings">
                        <div class="card-content"><span>Earnings</span>
                            <h2 id="totalEarnings">₹0.00</h2>
                        </div>
                        <div class="card-icon"><i class="fas fa-arrow-up"></i></div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="report-card card-gst">
                        <div class="card-content"><span>GST</span>
                            <h2 id="totalGst">₹0.00</h2>
                        </div>
                        <div class="card-icon"><i class="fas fa-receipt"></i></div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="report-card card-delivery">
                        <div class="card-content"><span>Delivery Charges</span>
                            <h2 id="totalDelivery">₹0.00</h2>
                        </div>
                        <div class="card-icon"><i class="fas fa-truck"></i></div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="report-card card-total">
                        <div class="card-content"><span>Total Earnings</span>
                            <h2 id="grandTotal">₹0.00</h2>
                        </div>
                        <div class="card-icon"><i class="fas fa-coins"></i></div>
                    </div>
                </div>
            </div>

            <!-- Report Card -->
            <div class="card border-0 shadow-sm">
                <div class="card-body">

                    <!-- Date Filter -->
                    <div class="row align-items-end g-3 mb-4">
                        <div class="col-md-3">
                            <label class="form-label">Date From</label>
                            <input type="date" id="dateFrom" class="form-control">
                        </div>
                        <div class="col-md-3">
                            <label class="form-label">Date To</label>
                            <input type="date" id="dateTo" class="form-control">
                        </div>
                        <div class="col-md-2">
                            <button class="btn btn-primary w-100" id="searchBtn"><i class="fas fa-search"></i> Search</button>
                        </div>
                    </div>

                    <hr>

                    <!-- Toolbar -->
                    <div class="table-toolbar">
                        <div class="left-toolbar">
                            <div class="entries">
                                Show
                                <select id="entries">
                                    <option value="5">5</option>
                                    <option value="10" selected>10</option>
                                    <option value="25">25</option>
                                    <option value="50">50</option>
                                </select>
                                entries
                            </div>
                            <button class="btn btn-success" id="exportExcel"><i class="fas fa-file-excel"></i> Export to Excel</button>
                        </div>
                        <div class="right-toolbar">
                            <label>Search :</label>
                            <input type="text" id="searchBox" placeholder="Order ID">
                        </div>
                    </div>

                    <!-- Table -->
                    <div class="table-responsive">
                        <table class="table table-hover align-middle" id="reportTable">
                            <thead>
                                <tr>
                                    <th>Order ID</th>
                                    <th>Date</th>
                                    <th>Earnings</th>
                                    <th>GST</th>
                                    <th>Delivery Charges</th>
                                    <th>Discount</th>
                                    <th>Quantity</th>
                                    <th>Total Earnings</th>
                                </tr>
                            </thead>
                            <tbody id="tableBody"></tbody>
                        </table>
                    </div>

                    <!-- Footer with Pagination (the bottom part) -->
                    <div class="table-footer">
                        <span id="tableInfo">Showing 0 to 0 of 0 entries</span>
                        <div id="pagination"></div>
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
    <script src="assets/js/script.js"></script>

    <!-- ===== EMBEDDED JAVASCRIPT (full functionality) ===== -->
    <script>
        (function() {
            'use strict';

            // ----------------------------------------------------------
            // 1. SAMPLE DATA GENERATOR
            // ----------------------------------------------------------
            function generateOrders(count) {
                const orders = [];
                const orderIds = ['ORD-1001', 'ORD-1002', 'ORD-1003', 'ORD-1004', 'ORD-1005',
                    'ORD-1006', 'ORD-1007', 'ORD-1008', 'ORD-1009', 'ORD-1010',
                    'ORD-1011', 'ORD-1012', 'ORD-1013', 'ORD-1014', 'ORD-1015',
                    'ORD-1016', 'ORD-1017', 'ORD-1018', 'ORD-1019', 'ORD-1020'
                ];
                const start = new Date(2026, 0, 1);
                const end = new Date(2026, 6, 9);

                function randomDate(from, to) {
                    const d = new Date(from.getTime() + Math.random() * (to.getTime() - from.getTime()));
                    return d.getFullYear() + '-' + String(d.getMonth() + 1).padStart(2, '0') + '-' + String(d.getDate()).padStart(2, '0');
                }
                for (let i = 0; i < count; i++) {
                    const earnings = +(Math.random() * 500 + 50).toFixed(2);
                    const gst = +(earnings * 0.18).toFixed(2);
                    const delivery = +(Math.random() * 40 + 10).toFixed(2);
                    const discount = +(Math.random() * 30).toFixed(2);
                    const qty = Math.floor(Math.random() * 10) + 1;
                    const total = +(earnings + gst + delivery - discount).toFixed(2);
                    orders.push({
                        id: orderIds[i % orderIds.length] + '-' + String(i + 1).padStart(3, '0'),
                        date: randomDate(start, end),
                        earnings,
                        gst,
                        delivery,
                        discount,
                        qty,
                        total
                    });
                }
                return orders;
            }

            // ----------------------------------------------------------
            // 2. STATE & DOM REFS
            // ----------------------------------------------------------
            let allOrders = generateOrders(120);
            let filteredOrders = [...allOrders];
            let currentPage = 1;
            let entriesPerPage = 10;

            const tbody = document.getElementById('tableBody');
            const tableInfo = document.getElementById('tableInfo');
            const paginationEl = document.getElementById('pagination');

            const dateFrom = document.getElementById('dateFrom');
            const dateTo = document.getElementById('dateTo');
            const searchBtn = document.getElementById('searchBtn');
            const searchBox = document.getElementById('searchBox');
            const entriesSelect = document.getElementById('entries');
            const timeFilter = document.getElementById('timeFilter');
            const exportBtn = document.getElementById('exportExcel');

            const totalEarningsEl = document.getElementById('totalEarnings');
            const totalGstEl = document.getElementById('totalGst');
            const totalDeliveryEl = document.getElementById('totalDelivery');
            const grandTotalEl = document.getElementById('grandTotal');

            const toast = document.getElementById('toast');
            const toastMsg = document.getElementById('toastMessage');

            // ----------------------------------------------------------
            // 3. HELPERS
            // ----------------------------------------------------------
            function showToast(msg) {
                toastMsg.textContent = msg || 'Action completed!';
                toast.classList.add('show');
                clearTimeout(toast._timer);
                toast._timer = setTimeout(() => toast.classList.remove('show'), 3000);
            }

            function formatCurrency(val) {
                return '₹' + val.toFixed(2);
            }

            function parseDate(dateStr) {
                if (!dateStr) return null;
                const parts = dateStr.split('-');
                return new Date(parts[0], parts[1] - 1, parts[2]);
            }

            // ----------------------------------------------------------
            // 4. FILTERING
            // ----------------------------------------------------------
            function applyFilters() {
                const fromVal = dateFrom.value;
                const toVal = dateTo.value;
                const search = searchBox.value.trim().toLowerCase();
                const timeVal = timeFilter.value;

                let fromDate = fromVal ? parseDate(fromVal) : null;
                let toDate = toVal ? parseDate(toVal) : null;
                const now = new Date();
                const todayStr = now.getFullYear() + '-' + String(now.getMonth() + 1).padStart(2, '0') + '-' + String(now.getDate()).padStart(2, '0');

                if (timeVal === 'today') {
                    fromDate = parseDate(todayStr);
                    toDate = parseDate(todayStr);
                    dateFrom.value = todayStr;
                    dateTo.value = todayStr;
                } else if (timeVal === 'week') {
                    const weekStart = new Date(now);
                    weekStart.setDate(now.getDate() - now.getDay());
                    const ws = weekStart.getFullYear() + '-' + String(weekStart.getMonth() + 1).padStart(2, '0') + '-' + String(weekStart.getDate()).padStart(2, '0');
                    fromDate = parseDate(ws);
                    toDate = parseDate(todayStr);
                    dateFrom.value = ws;
                    dateTo.value = todayStr;
                } else if (timeVal === 'month') {
                    const monthStart = new Date(now.getFullYear(), now.getMonth(), 1);
                    const ms = monthStart.getFullYear() + '-' + String(monthStart.getMonth() + 1).padStart(2, '0') + '-01';
                    fromDate = parseDate(ms);
                    toDate = parseDate(todayStr);
                    dateFrom.value = ms;
                    dateTo.value = todayStr;
                } else if (timeVal === 'year') {
                    const yearStart = new Date(now.getFullYear(), 0, 1);
                    const ys = yearStart.getFullYear() + '-01-01';
                    fromDate = parseDate(ys);
                    toDate = parseDate(todayStr);
                    dateFrom.value = ys;
                    dateTo.value = todayStr;
                }

                filteredOrders = allOrders.filter(order => {
                    if (fromDate) {
                        const orderDate = parseDate(order.date);
                        if (orderDate < fromDate) return false;
                    }
                    if (toDate) {
                        const orderDate = parseDate(order.date);
                        if (orderDate > toDate) return false;
                    }
                    if (search && !order.id.toLowerCase().includes(search)) return false;
                    return true;
                });

                currentPage = 1;
                renderTable();
                updateSummary();
            }

            // ----------------------------------------------------------
            // 5. RENDER TABLE
            // ----------------------------------------------------------
            function renderTable() {
                const total = filteredOrders.length;
                const totalPages = Math.ceil(total / entriesPerPage) || 1;
                if (currentPage > totalPages) currentPage = totalPages;
                const start = (currentPage - 1) * entriesPerPage;
                const end = Math.min(start + entriesPerPage, total);
                const pageData = filteredOrders.slice(start, end);

                let html = '';
                if (pageData.length === 0) {
                    html = '<tr><td colspan="8" class="text-center py-4 text-muted">No records found</td></tr>';
                } else {
                    pageData.forEach(o => {
                        html += `<tr>
                            <td><strong>${o.id}</strong></td>
                            <td>${o.date}</td>
                            <td>${formatCurrency(o.earnings)}</td>
                            <td>${formatCurrency(o.gst)}</td>
                            <td>${formatCurrency(o.delivery)}</td>
                            <td>${formatCurrency(o.discount)}</td>
                            <td>${o.qty}</td>
                            <td><strong>${formatCurrency(o.total)}</strong></td>
                        </tr>`;
                    });
                }
                tbody.innerHTML = html;

                const from = total === 0 ? 0 : start + 1;
                const to = total === 0 ? 0 : end;
                tableInfo.textContent = `Showing ${from} to ${to} of ${total} entries`;

                renderPagination(totalPages);
            }

            // ----------------------------------------------------------
            // 6. PAGINATION (with visible page numbers)
            // ----------------------------------------------------------
            function renderPagination(totalPages) {
                let html = '';
                html += `<button class="page-prev" id="prevPage" ${currentPage <= 1 ? 'disabled' : ''}><i class="fas fa-chevron-left"></i></button>`;
                for (let i = 1; i <= totalPages; i++) {
                    const active = i === currentPage ? 'active-page' : '';
                    html += `<button class="page-num ${active}" data-page="${i}">${i}</button>`;
                }
                html += `<button class="page-next" id="nextPage" ${currentPage >= totalPages ? 'disabled' : ''}><i class="fas fa-chevron-right"></i></button>`;
                paginationEl.innerHTML = html;

                // Event listeners for page numbers
                document.querySelectorAll('.page-num').forEach(btn => {
                    btn.addEventListener('click', function() {
                        const page = parseInt(this.dataset.page, 10);
                        if (page !== currentPage) {
                            currentPage = page;
                            renderTable();
                        }
                    });
                });
                document.getElementById('prevPage')?.addEventListener('click', function() {
                    if (currentPage > 1) {
                        currentPage--;
                        renderTable();
                    }
                });
                document.getElementById('nextPage')?.addEventListener('click', function() {
                    const total = filteredOrders.length;
                    const totalPages = Math.ceil(total / entriesPerPage) || 1;
                    if (currentPage < totalPages) {
                        currentPage++;
                        renderTable();
                    }
                });
            }

            // ----------------------------------------------------------
            // 7. UPDATE SUMMARY CARDS
            // ----------------------------------------------------------
            function updateSummary() {
                let totalEarnings = 0,
                    totalGst = 0,
                    totalDelivery = 0,
                    grandTotal = 0;
                filteredOrders.forEach(o => {
                    totalEarnings += o.earnings;
                    totalGst += o.gst;
                    totalDelivery += o.delivery;
                    grandTotal += o.total;
                });
                totalEarningsEl.textContent = formatCurrency(totalEarnings);
                totalGstEl.textContent = formatCurrency(totalGst);
                totalDeliveryEl.textContent = formatCurrency(totalDelivery);
                grandTotalEl.textContent = formatCurrency(grandTotal);
            }

            // ----------------------------------------------------------
            // 8. EXPORT TO EXCEL (CSV)
            // ----------------------------------------------------------
            function exportToExcel() {
                const rows = filteredOrders.length ? filteredOrders : allOrders;
                if (!rows.length) {
                    showToast('No data to export.');
                    return;
                }
                let csv = '\uFEFF';
                csv += 'Order ID,Date,Earnings,GST,Delivery Charges,Discount,Quantity,Total Earnings\n';
                rows.forEach(o => {
                    csv += `"${o.id}","${o.date}",${o.earnings.toFixed(2)},${o.gst.toFixed(2)},${o.delivery.toFixed(2)},${o.discount.toFixed(2)},${o.qty},${o.total.toFixed(2)}\n`;
                });
                const blob = new Blob([csv], {
                    type: 'text/csv;charset=utf-8;'
                });
                const link = document.createElement('a');
                const url = URL.createObjectURL(blob);
                link.href = url;
                link.download = `reports_${new Date().toISOString().slice(0,10)}.csv`;
                document.body.appendChild(link);
                link.click();
                document.body.removeChild(link);
                URL.revokeObjectURL(url);
                showToast(`Exported ${rows.length} rows successfully!`);
            }

            // ----------------------------------------------------------
            // 9. EVENT BINDINGS
            // ----------------------------------------------------------
            searchBtn.addEventListener('click', applyFilters);
            searchBox.addEventListener('input', applyFilters);
            entriesSelect.addEventListener('change', function() {
                entriesPerPage = parseInt(this.value, 10);
                currentPage = 1;
                renderTable();
            });
            timeFilter.addEventListener('change', applyFilters);
            dateFrom.addEventListener('change', applyFilters);
            dateTo.addEventListener('change', applyFilters);
            exportBtn.addEventListener('click', exportToExcel);

            document.addEventListener('keydown', function(e) {
                if (e.ctrlKey && e.shiftKey && (e.key === 'E' || e.key === 'e')) {
                    e.preventDefault();
                    exportToExcel();
                }
            });

            // ----------------------------------------------------------
            // 10. INIT
            // ----------------------------------------------------------
            const today = new Date();
            const thirtyDaysAgo = new Date(today);
            thirtyDaysAgo.setDate(today.getDate() - 30);
            dateFrom.value = thirtyDaysAgo.toISOString().slice(0, 10);
            dateTo.value = today.toISOString().slice(0, 10);
            applyFilters();
        })();
    </script>
</body>

</html>