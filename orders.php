<?php
include 'config/config.php';
?>
<?php
$current_page = 'orders';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Orders - Admin Panel</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="<?= APP_URL; ?>assets/css/style.css">
    <!-- Only minimal inline style for demo data (Bootstrap handles layout) -->
    <style>
        body {
            font-family: 'Inter', sans-serif;
            background: #f8fafc;
        }

        .content-area {
            margin-left: 260px;
            margin-top: 70px;
            padding: 25px;
            background: #f8fafc;
            min-height: 100vh;
        }

        .orders-container {
            max-width: 1400px;
            margin: 0 auto;
        }

        .badge-menu {
            color: #fff;
            font-size: 11px;
            padding: 2px 10px;
            border-radius: 20px;
            margin-left: auto;
        }

        .invoice-btn {
            background: none;
            border: none;
            color: #2563eb;
            cursor: pointer;
            font-weight: 600;
            font-size: 13px;
        }

        .invoice-btn:hover {
            color: #1e40af;
            text-decoration: underline;
        }

        .toast {
            position: fixed;
            bottom: 20px;
            right: 20px;
            z-index: 9999;
        }

        @media (max-width: 992px) {
            .content-area {
                margin-left: 70px;
                padding: 15px;
            }
        }

        @media (max-width: 768px) {
            .content-area {
                margin-left: 0;
                padding: 10px;
            }
        }
    </style>
</head>

<body>
    <!-- Navbar -->
    <?php include 'templates/navbar.php'; ?>

    <!-- Sidebar -->
    <?php include 'templates/sidebar.php'; ?>

    <div class="content-area">
        <div class="orders-container">

            <!-- Top Bar -->

            <div class="page-header">
                <h4 class="page-title">
                    <i class="fas fa-shopping-bag text-primary me-2"></i> ORDERS
                </h4>
            </div>



            <!-- Filters Bar - Bootstrap Grid -->
            <div class="bg-white p-3 p-md-4 rounded-3 border mb-3 mb-md-4">
                <div class="row g-3">
                    <div class="col-12 col-md-6 col-lg-3">
                        <label class="form-label fw-semibold small text-secondary">Order Status</label>
                        <select class="form-select form-select-sm" id="filterOrderStatus">
                            <option value="all">All</option>
                            <option value="pending">Pending</option>
                            <option value="processing">Processing</option>
                            <option value="completed">Completed</option>
                            <option value="cancelled">Cancelled</option>
                        </select>
                    </div>
                    <div class="col-12 col-md-6 col-lg-3">
                        <label class="form-label fw-semibold small text-secondary">Payment Method</label>
                        <select class="form-select form-select-sm" id="filterPaymentMethod">
                            <option value="all">All</option>
                            <option value="credit_card">Credit Card</option>
                            <option value="paypal">PayPal</option>
                            <option value="bank_transfer">Bank Transfer</option>
                            <option value="cash">Cash</option>
                        </select>
                    </div>
                    <div class="col-12 col-md-6 col-lg-3">
                        <label class="form-label fw-semibold small text-secondary">Payment Status</label>
                        <select class="form-select form-select-sm" id="filterPaymentStatus">
                            <option value="all">All</option>
                            <option value="paid">Paid</option>
                            <option value="pending">Pending</option>
                            <option value="failed">Failed</option>
                            <option value="refunded">Refunded</option>
                        </select>
                    </div>
                    <div class="col-12 col-md-6 col-lg-3">
                        <label class="form-label fw-semibold small text-secondary">Due Date</label>
                        <select class="form-select form-select-sm" id="filterDueDate">
                            <option value="all">All</option>
                            <option value="expired">Expired</option>
                        </select>
                    </div>
                </div>

                <!-- Date Range Row -->
                <div class="row g-3 mt-2 align-items-end">
                    <div class="col-6 col-md-4 col-lg-3">
                        <label class="form-label fw-semibold small text-secondary">From</label>
                        <input type="date" class="form-control form-control-sm" id="filterDateFrom" />
                    </div>
                    <div class="col-6 col-md-4 col-lg-3">
                        <label class="form-label fw-semibold small text-secondary">To</label>
                        <input type="date" class="form-control form-control-sm" id="filterDateTo" />
                    </div>
                    <div class="col-12 col-md-4 col-lg-3">
                        <button class="btn btn-primary btn-sm w-100" id="dateSearchBtn">
                            <i class="fas fa-search"></i> <span>Search</span>
                        </button>
                    </div>
                </div>
            </div>

            <!-- Table -->
            <div class="bg-white p-3 p-md-4 rounded-3 border">
                <!-- Table Controls -->
                <div class="d-flex flex-wrap flex-md-nowrap justify-content-between align-items-center gap-3 mb-3">
                    <div class="position-relative " style="flex:1; max-width:300px;">
                        <i class="fas fa-search position-absolute top-50 start-0 translate-middle-y ms-2 text-secondary" style="font-size:14px;"></i>
                        <input type="text" class="form-control form-control-sm ps-5 ms-2" id="tableSearch" placeholder="Search by Order ID or Payment ID" />
                    </div>
                    <div class="d-flex flex-wrap align-items-center gap-2">
                        <div class="d-flex align-items-center gap-2">
                            <label class="form-label fw-semibold small text-secondary m-0">Show</label>
                            <select class="form-select form-select-sm" id="entriesPerPage" style="width:auto;">
                                <option value="5">5</option>
                                <option value="10" selected>10</option>
                                <option value="25">25</option>
                                <option value="50">50</option>
                            </select>
                            <label class="form-label small text-secondary m-0">entries</label>
                        </div>
                        <button class="btn btn-primary btn-sm" id="exportBtn">
                            <i class="fas fa-file-excel"></i> <span>Export</span>
                        </button>
                    </div>
                </div>

                <!-- Table Responsive -->
                <div class="table-responsive">
                    <table class="table table-hover table-bordered" id="ordersTable">
                        <thead class="table-light">
                            <tr>
                                <th class="text-nowrap">Order ID</th>
                                <th class="text-nowrap">Date</th>
                                <th class="text-nowrap">Total</th>
                                <th class="text-nowrap">Payment Method</th>
                                <th class="text-nowrap">Payment ID</th>
                                <th class="text-nowrap">Payment Status</th>
                                <th class="text-nowrap">Status</th>
                                <th class="text-nowrap">Due Date</th>
                                <th class="text-nowrap">Invoice</th>
                            </tr>
                        </thead>
                        <tbody id="tableBody">
                            <!-- Dummy Data - 10 rows -->
                            <tr>
                                <td><span class="fw-semibold text-primary">#1024</span></td>
                                <td>2026-01-15</td>
                                <td>₹1,200</td>
                                <td>Credit Card</td>
                                <td>PAY-123456</td>
                                <td><span class="badge bg-success">Paid</span></td>
                                <td><span class="badge bg-warning text-dark">Pending</span></td>
                                <td>2026-01-20</td>
                                <td><button class="btn btn-link btn-sm p-0 text-primary invoice-btn"><i class="fas fa-file-pdf"></i> Invoice</button></td>
                            </tr>
                            <tr>
                                <td><span class="fw-semibold text-primary">#1025</span></td>
                                <td>2026-01-16</td>
                                <td>₹850</td>
                                <td>PayPal</td>
                                <td>PAY-789012</td>
                                <td><span class="badge bg-warning text-dark">Pending</span></td>
                                <td><span class="badge bg-info text-dark">Processing</span></td>
                                <td>2026-01-22</td>
                                <td><button class="btn btn-link btn-sm p-0 text-primary invoice-btn"><i class="fas fa-file-pdf"></i> Invoice</button></td>
                            </tr>
                            <tr>
                                <td><span class="fw-semibold text-primary">#1026</span></td>
                                <td>2026-01-18</td>
                                <td>₹2,450</td>
                                <td>Bank Transfer</td>
                                <td>PAY-345678</td>
                                <td><span class="badge bg-success">Paid</span></td>
                                <td><span class="badge bg-success">Completed</span></td>
                                <td>2026-01-25</td>
                                <td><button class="btn btn-link btn-sm p-0 text-primary invoice-btn"><i class="fas fa-file-pdf"></i> Invoice</button></td>
                            </tr>
                            <tr>
                                <td><span class="fw-semibold text-primary">#1027</span></td>
                                <td>2026-01-20</td>
                                <td>₹3,200</td>
                                <td>Cash</td>
                                <td>PAY-901234</td>
                                <td><span class="badge bg-danger">Failed</span></td>
                                <td><span class="badge bg-danger">Cancelled</span></td>
                                <td>2026-01-27</td>
                                <td><button class="btn btn-link btn-sm p-0 text-primary invoice-btn"><i class="fas fa-file-pdf"></i> Invoice</button></td>
                            </tr>
                            <tr>
                                <td><span class="fw-semibold text-primary">#1028</span></td>
                                <td>2026-01-22</td>
                                <td>₹1,800</td>
                                <td>Credit Card</td>
                                <td>PAY-567890</td>
                                <td><span class="badge bg-secondary">Refunded</span></td>
                                <td><span class="badge bg-success">Completed</span></td>
                                <td>2026-01-29</td>
                                <td><button class="btn btn-link btn-sm p-0 text-primary invoice-btn"><i class="fas fa-file-pdf"></i> Invoice</button></td>
                            </tr>
                            <tr>
                                <td><span class="fw-semibold text-primary">#1029</span></td>
                                <td>2026-01-23</td>
                                <td>₹950</td>
                                <td>PayPal</td>
                                <td>PAY-678901</td>
                                <td><span class="badge bg-success">Paid</span></td>
                                <td><span class="badge bg-warning text-dark">Pending</span></td>
                                <td>2026-01-30</td>
                                <td><button class="btn btn-link btn-sm p-0 text-primary invoice-btn"><i class="fas fa-file-pdf"></i> Invoice</button></td>
                            </tr>
                            <tr>
                                <td><span class="fw-semibold text-primary">#1030</span></td>
                                <td>2026-01-25</td>
                                <td>₹5,600</td>
                                <td>Bank Transfer</td>
                                <td>PAY-789012</td>
                                <td><span class="badge bg-success">Paid</span></td>
                                <td><span class="badge bg-info text-dark">Processing</span></td>
                                <td>2026-02-01</td>
                                <td><button class="btn btn-link btn-sm p-0 text-primary invoice-btn"><i class="fas fa-file-pdf"></i> Invoice</button></td>
                            </tr>
                            <tr>
                                <td><span class="fw-semibold text-primary">#1031</span></td>
                                <td>2026-01-27</td>
                                <td>₹720</td>
                                <td>Cash</td>
                                <td>PAY-890123</td>
                                <td><span class="badge bg-warning text-dark">Pending</span></td>
                                <td><span class="badge bg-success">Completed</span></td>
                                <td>2026-02-03</td>
                                <td><button class="btn btn-link btn-sm p-0 text-primary invoice-btn"><i class="fas fa-file-pdf"></i> Invoice</button></td>
                            </tr>
                            <tr>
                                <td><span class="fw-semibold text-primary">#1032</span></td>
                                <td>2026-01-28</td>
                                <td>₹3,800</td>
                                <td>Credit Card</td>
                                <td>PAY-901234</td>
                                <td><span class="badge bg-success">Paid</span></td>
                                <td><span class="badge bg-warning text-dark">Pending</span></td>
                                <td>2026-02-05</td>
                                <td><button class="btn btn-link btn-sm p-0 text-primary invoice-btn"><i class="fas fa-file-pdf"></i> Invoice</button></td>
                            </tr>
                            <tr>
                                <td><span class="fw-semibold text-primary">#1033</span></td>
                                <td>2026-01-30</td>
                                <td>₹1,550</td>
                                <td>PayPal</td>
                                <td>PAY-012345</td>
                                <td><span class="badge bg-danger">Failed</span></td>
                                <td><span class="badge bg-danger">Cancelled</span></td>
                                <td>2026-02-07</td>
                                <td><button class="btn btn-link btn-sm p-0 text-primary invoice-btn"><i class="fas fa-file-pdf"></i> Invoice</button></td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <!-- Table Footer -->
                <div class="d-flex flex-wrap flex-md-nowrap justify-content-between align-items-center gap-2 mt-3 pt-3 border-top">
                    <div class="text-secondary small" id="tableInfo">
                        Showing 1 to 10 of 25 entries
                    </div>

                    <div class="d-flex gap-1 pagination">
                        <button class="btn btn-outline-secondary btn-sm" id="prevPage" disabled>
                            <i class="fas fa-chevron-left"></i>
                        </button>

                        <button class="btn btn-primary btn-sm page-btn active" data-page="1">1</button>
                        <button class="btn btn-outline-secondary btn-sm page-btn" data-page="2">2</button>
                        <button class="btn btn-outline-secondary btn-sm page-btn" data-page="3">3</button>

                        <button class="btn btn-outline-secondary btn-sm" id="nextPage">
                            <i class="fas fa-chevron-right"></i>
                        </button>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <!-- Toast -->
    <div class="toast align-items-center text-white bg-success border-0" id="toast" role="alert">
        <div class="d-flex">
            <div class="toast-body">
                <i class="fas fa-check-circle me-2"></i> <span id="toastMessage">Exported successfully!</span>
            </div>
            <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast"></button>
        </div>
    </div>

    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="<?= APP_URL; ?>assets/js/script.js"></script>

    <script>
        // Simple dummy data interactions
        document.addEventListener('DOMContentLoaded', function() {
            // Export button
            document.getElementById('exportBtn')?.addEventListener('click', function() {
                const toast = new bootstrap.Toast(document.getElementById('toast'));
                document.getElementById('toastMessage').textContent = 'Orders exported successfully!';
                toast.show();
            });

            // Search functionality
            document.getElementById('tableSearch')?.addEventListener('keyup', function() {
                const searchTerm = this.value.toLowerCase();
                const rows = document.querySelectorAll('#tableBody tr');
                rows.forEach(row => {
                    const text = row.textContent.toLowerCase();
                    row.style.display = text.includes(searchTerm) ? '' : 'none';
                });
                updateEntryInfo();
            });

            // Pagination buttons
            // Pagination buttons
            const pageButtons = document.querySelectorAll(".page-btn");
            const prevBtn = document.getElementById("prevPage");
            const nextBtn = document.getElementById("nextPage");

            let currentPage = 1;
            const totalPages = pageButtons.length;

            function updatePagination() {

                pageButtons.forEach((btn, index) => {
                    btn.classList.remove("btn-primary", "active");
                    btn.classList.add("btn-outline-secondary");

                    if (index + 1 === currentPage) {
                        btn.classList.remove("btn-outline-secondary");
                        btn.classList.add("btn-primary", "active");
                    }
                });

                prevBtn.disabled = currentPage === 1;
                nextBtn.disabled = currentPage === totalPages;
            }

            pageButtons.forEach((btn, index) => {
                btn.addEventListener("click", function() {
                    currentPage = index + 1;
                    updatePagination();
                });
            });

            prevBtn.addEventListener("click", function() {
                if (currentPage > 1) {
                    currentPage--;
                    updatePagination();
                }
            });

            nextBtn.addEventListener("click", function() {
                if (currentPage < totalPages) {
                    currentPage++;
                    updatePagination();
                }
            });

            updatePagination();
            // Filter change - simple demo
            document.querySelectorAll('#filtersBar select').forEach(select => {
                select.addEventListener('change', function() {
                    console.log('Filter changed:', this.id, this.value);
                    // In real app, filter the table
                });
            });

            function updateEntryInfo() {
                const visible = document.querySelectorAll('#tableBody tr:not([style*="display: none"])');
                const total = document.querySelectorAll('#tableBody tr').length;
                document.getElementById('tableInfo').textContent =
                    `Showing 1 to ${visible.length} of ${total} entries`;
            }

            // Date search
            document.getElementById('dateSearchBtn')?.addEventListener('click', function() {
                const from = document.getElementById('filterDateFrom').value;
                const to = document.getElementById('filterDateTo').value;
                console.log('Searching from:', from, 'to:', to);
                const toast = new bootstrap.Toast(document.getElementById('toast'));
                document.getElementById('toastMessage').textContent = `Filtering orders from ${from || 'start'} to ${to || 'end'}`;
                toast.show();
            });
        });
    </script>
</body>

</html>