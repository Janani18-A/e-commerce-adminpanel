<?php
include 'config/config.php';
?>

<?php
$current_page = 'customers';
?>
<!DOCTYPE html>
<html lang="en">

<head>
 <?php include 'head.php'; ?>

    <style>
        /* Minimal overrides – only to match the shipped-orders layout, no custom design */
        body {
            background: #f8fafc;
            font-family: 'Inter', sans-serif;
        }
        .content-area {
            margin-left: 260px;
            margin-top: 70px;
            padding: 25px;
            background: #f8fafc;
            min-height: 100vh;
        }
        .page-wrapper {
            max-width: 1400px;
            margin: 0 auto;
        }
        .page-header {
            background: #fff;
            padding: 20px 25px;
            border-radius: 12px;
            border: 1px solid #e2e8f0;
            margin-bottom: 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            gap: 15px;
        }
        .page-title {
            font-size: 20px;
            font-weight: 700;
            color: #1e293b;
            margin: 0;
        }
        .page-title i {
            color: #2563eb;
        }

        /* Stats cards row */
        .stats-row {
            display: flex;
            flex-wrap: wrap;
            gap: 16px;
            margin-bottom: 20px;
        }
        .stat-card {
            background: #fff;
            border: 1px solid #e2e8f0;
            border-radius: 12px;
            padding: 16px 20px;
            flex: 1 1 180px;
            min-width: 150px;
            display: flex;
            align-items: center;
            gap: 14px;
            transition: 0.2s;
        }
        .stat-card .stat-icon {
            width: 48px;
            height: 48px;
            border-radius: 50%;
            background: #eff6ff;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 22px;
            color: #2563eb;
        }
        .stat-card .stat-info {
            display: flex;
            flex-direction: column;
        }
        .stat-card .stat-info .stat-label {
            font-size: 13px;
            color: #64748b;
            font-weight: 500;
        }
        .stat-card .stat-info .stat-value {
            font-size: 22px;
            font-weight: 700;
            color: #0f172a;
            line-height: 1.3;
        }
        .stat-card .stat-info .stat-sub {
            font-size: 12px;
            color: #64748b;
        }
        .stat-card.paid .stat-icon { background: #d1fae5; color: #065f46; }
        .stat-card.unpaid .stat-icon { background: #fef3c7; color: #92400e; }
        .stat-card.total .stat-icon { background: #e0e7ff; color: #4338ca; }

        .controls-bar {
            background: #fff;
            padding: 15px 20px;
            border-radius: 12px;
            border: 1px solid #e2e8f0;
            margin-bottom: 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            gap: 15px;
        }
        .controls-left label {
            font-size: 14px;
            color: #1e293b;
            display: flex;
            align-items: center;
            gap: 8px;
            margin: 0;
        }
        .controls-left select {
            padding: 5px 10px;
            border: 1px solid #e2e8f0;
            border-radius: 6px;
            font-size: 14px;
            background: #fff;
        }
        .controls-right {
            display: flex;
            align-items: center;
            gap: 12px;
            flex-wrap: wrap;
        }
        .search-wrapper {
            position: relative;
        }
        .search-wrapper input {
            padding: 8px 15px 8px 40px;
            border: 1px solid #e2e8f0;
            border-radius: 8px;
            font-size: 14px;
            width: 220px;
            background: #f8fafc;
        }
        .search-wrapper input:focus {
            outline: none;
            border-color: #2563eb;
            box-shadow: 0 0 0 3px rgba(37,99,235,0.1);
        }
        .search-wrapper i {
            position: absolute;
            left: 12px;
            top: 50%;
            transform: translateY(-50%);
            color: #94a3b8;
        }
        .btn-export {
            background: #2563eb;
            color: #fff;
            border: none;
            padding: 8px 18px;
            border-radius: 8px;
            font-weight: 600;
            cursor: pointer;
            display: flex;
            align-items: center;
            gap: 8px;
            font-size: 14px;
        }
        .btn-export:hover {
            background: #1e40af;
        }
        .table-wrapper {
            background: #fff;
            padding: 20px;
            border-radius: 12px;
            border: 1px solid #e2e8f0;
            overflow-x: auto;
        }
        .table-wrapper table {
            width: 100%;
            border-collapse: collapse;
            min-width: 700px;
            font-size: 14px;
        }
        .table-wrapper thead th {
            background: #f8fafc;
            padding: 12px 15px;
            text-align: left;
            font-weight: 600;
            color: #64748b;
            border-bottom: 2px solid #e2e8f0;
            white-space: nowrap;
        }
        .table-wrapper tbody td {
            padding: 12px 15px;
            border-bottom: 1px solid #e2e8f0;
            color: #1e293b;
            vertical-align: middle;
        }
        .table-wrapper tbody tr:hover {
            background: #f8fafc;
        }
        .badge-active {
            background: #d1fae5;
            color: #065f46;
            padding: 4px 12px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 600;
        }
        .badge-inactive {
            background: #fef3c7;
            color: #92400e;
            padding: 4px 12px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 600;
        }
        .badge-paid {
            background: #d1fae5;
            color: #065f46;
            padding: 4px 12px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 600;
        }
        .badge-unpaid {
            background: #fee2e2;
            color: #991b1b;
            padding: 4px 12px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 600;
        }
        .eye-icon {
            color: #64748b;
            cursor: pointer;
            transition: 0.2s;
            font-size: 16px;
        }
        .eye-icon:hover {
            color: #2563eb;
        }
        .empty-state {
            text-align: center;
            padding: 60px 20px;
            background: #fff;
            border-radius: 12px;
            border: 1px solid #e2e8f0;
        }
        .empty-state i {
            font-size: 60px;
            color: #cbd5e1;
            margin-bottom: 15px;
        }
        .empty-state h5 {
            font-weight: 600;
            color: #1e293b;
            margin-bottom: 8px;
        }
        .empty-state p {
            color: #94a3b8;
            font-size: 14px;
        }
        .table-footer {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-top: 15px;
            padding-top: 15px;
            border-top: 1px solid #e2e8f0;
            flex-wrap: wrap;
            gap: 10px;
        }
        .table-info {
            font-size: 14px;
            color: #64748b;
        }
        .table-info strong {
            color: #1e293b;
        }
        .pagination {
            margin: 0;
            gap: 4px;
        }
        .pagination .page-link {
            padding: 6px 12px;
            border: 1px solid #e2e8f0;
            border-radius: 6px;
            color: #1e293b;
            font-size: 14px;
            background: #fff;
        }
        .pagination .page-link:hover {
            background: #f8fafc;
            border-color: #2563eb;
        }
        .pagination .active .page-link {
            background: #2563eb;
            color: #fff;
            border-color: #2563eb;
        }
        .pagination .disabled .page-link {
            opacity: 0.4;
            cursor: not-allowed;
        }
        .toast {
            position: fixed;
            bottom: 20px;
            right: 20px;
            z-index: 9999;
        }
        @media (max-width: 992px) {
            .content-area { margin-left: 70px; padding: 15px; }
        }
        @media (max-width: 768px) {
            .content-area { margin-left: 0; padding: 10px; }
            .page-header { flex-direction: column; align-items: flex-start; }
            .controls-bar { flex-direction: column; align-items: stretch; }
            .controls-right { flex-direction: column; align-items: stretch; }
            .search-wrapper input { width: 100%; }
            .table-footer { flex-direction: column; text-align: center; }
            .page-title { font-size: 18px; }
            .stats-row { flex-direction: column; }
        }
    </style>
</head>

<body>
    <?php include 'templates/navbar.php'; ?>
    <?php include 'templates/sidebar.php'; ?>

    <div class="content-area">
        <div class="page-wrapper">

            <!-- Page Header -->
            <div class="page-header">
                <h4 class="page-title">
                    <i class="fas fa-users"></i> CUSTOMERS
                </h4>
            </div>

            <!-- Stats Cards: Total, Paid, Unpaid -->
            <div class="stats-row">
                <div class="stat-card total">
                    <div class="stat-icon"><i class="fas fa-user-friends"></i></div>
                    <div class="stat-info">
                        <span class="stat-label">Total Customers</span>
                        <span class="stat-value" id="totalCustomersStat">10</span>
                        <span class="stat-sub">active + inactive</span>
                    </div>
                </div>
                <div class="stat-card paid">
                    <div class="stat-icon"><i class="fas fa-check-circle"></i></div>
                    <div class="stat-info">
                        <span class="stat-label">Paid</span>
                        <span class="stat-value" id="paidCustomersStat">6</span>
                        <span class="stat-sub">fully paid orders</span>
                    </div>
                </div>
                <div class="stat-card unpaid">
                    <div class="stat-icon"><i class="fas fa-exclamation-circle"></i></div>
                    <div class="stat-info">
                        <span class="stat-label">Unpaid</span>
                        <span class="stat-value" id="unpaidCustomersStat">4</span>
                        <span class="stat-sub">pending payment</span>
                    </div>
                </div>
            </div>

            <!-- Controls Bar -->
            <div class="controls-bar">
                <div class="controls-left">
                    <label>
                        Show
                        <select id="entriesSelect">
                            <option value="5">5</option>
                            <option value="10" selected>10</option>
                            <option value="25">25</option>
                            <option value="50">50</option>
                            <option value="all">All</option>
                        </select>
                        entries
                    </label>
                </div>
                <div class="controls-right">
                    <div class="search-wrapper">
                        <i class="fas fa-search"></i>
                        <input type="text" id="searchInput" placeholder="Search by name, email, or location" />
                    </div>
                    <button class="btn-export" id="exportBtn">
                        <i class="fas fa-file-excel"></i> Export to Excel
                    </button>
                </div>
            </div>

            <!-- Table -->
            <div class="table-wrapper">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Full Name</th>
                            <th>Email</th>
                            <th>Location</th>
                            <th>Orders</th>
                            <th>Payment</th>
                            <th>Status</th>
                            <th class="text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody id="tableBody">
                        <!-- Customer data (e-commerce) with payment status -->
                        <tr data-paid="true">
                            <td><span class="fw-semibold">1</span></td>
                            <td><span class="fw-semibold">Aisha Patel</span></td>
                            <td>aisha.p@example.com</td>
                            <td>Mumbai, India</td>
                            <td>12</td>
                            <td><span class="badge-paid">Paid</span></td>
                            <td><span class="badge-active">Active</span></td>
                            <td class="text-center"><i class="fas fa-eye eye-icon" data-bs-toggle="tooltip" title="View details"></i></td>
                        </tr>
                        <tr data-paid="true">
                            <td><span class="fw-semibold">2</span></td>
                            <td><span class="fw-semibold">James Carter</span></td>
                            <td>j.carter@example.com</td>
                            <td>London, UK</td>
                            <td>8</td>
                            <td><span class="badge-paid">Paid</span></td>
                            <td><span class="badge-active">Active</span></td>
                            <td class="text-center"><i class="fas fa-eye eye-icon" data-bs-toggle="tooltip" title="View details"></i></td>
                        </tr>
                        <tr data-paid="false">
                            <td><span class="fw-semibold">3</span></td>
                            <td><span class="fw-semibold">Maria Garcia</span></td>
                            <td>maria.g@example.com</td>
                            <td>Madrid, Spain</td>
                            <td>5</td>
                            <td><span class="badge-unpaid">Unpaid</span></td>
                            <td><span class="badge-inactive">Inactive</span></td>
                            <td class="text-center"><i class="fas fa-eye eye-icon" data-bs-toggle="tooltip" title="View details"></i></td>
                        </tr>
                        <tr data-paid="true">
                            <td><span class="fw-semibold">4</span></td>
                            <td><span class="fw-semibold">David Kim</span></td>
                            <td>david.k@example.com</td>
                            <td>Seoul, Korea</td>
                            <td>23</td>
                            <td><span class="badge-paid">Paid</span></td>
                            <td><span class="badge-active">Active</span></td>
                            <td class="text-center"><i class="fas fa-eye eye-icon" data-bs-toggle="tooltip" title="View details"></i></td>
                        </tr>
                        <tr data-paid="true">
                            <td><span class="fw-semibold">5</span></td>
                            <td><span class="fw-semibold">Sophie Dubois</span></td>
                            <td>sophie.d@example.com</td>
                            <td>Paris, France</td>
                            <td>7</td>
                            <td><span class="badge-paid">Paid</span></td>
                            <td><span class="badge-active">Active</span></td>
                            <td class="text-center"><i class="fas fa-eye eye-icon" data-bs-toggle="tooltip" title="View details"></i></td>
                        </tr>
                        <tr data-paid="false">
                            <td><span class="fw-semibold">6</span></td>
                            <td><span class="fw-semibold">Rajesh Sharma</span></td>
                            <td>rajesh.s@example.com</td>
                            <td>Delhi, India</td>
                            <td>15</td>
                            <td><span class="badge-unpaid">Unpaid</span></td>
                            <td><span class="badge-inactive">Inactive</span></td>
                            <td class="text-center"><i class="fas fa-eye eye-icon" data-bs-toggle="tooltip" title="View details"></i></td>
                        </tr>
                        <tr data-paid="true">
                            <td><span class="fw-semibold">7</span></td>
                            <td><span class="fw-semibold">Emily Wilson</span></td>
                            <td>emily.w@example.com</td>
                            <td>New York, USA</td>
                            <td>31</td>
                            <td><span class="badge-paid">Paid</span></td>
                            <td><span class="badge-active">Active</span></td>
                            <td class="text-center"><i class="fas fa-eye eye-icon" data-bs-toggle="tooltip" title="View details"></i></td>
                        </tr>
                        <tr data-paid="true">
                            <td><span class="fw-semibold">8</span></td>
                            <td><span class="fw-semibold">Chen Wei</span></td>
                            <td>chen.w@example.com</td>
                            <td>Shanghai, China</td>
                            <td>4</td>
                            <td><span class="badge-paid">Paid</span></td>
                            <td><span class="badge-active">Active</span></td>
                            <td class="text-center"><i class="fas fa-eye eye-icon" data-bs-toggle="tooltip" title="View details"></i></td>
                        </tr>
                        <tr data-paid="false">
                            <td><span class="fw-semibold">9</span></td>
                            <td><span class="fw-semibold">Liam O'Brien</span></td>
                            <td>liam.o@example.com</td>
                            <td>Dublin, Ireland</td>
                            <td>9</td>
                            <td><span class="badge-unpaid">Unpaid</span></td>
                            <td><span class="badge-inactive">Inactive</span></td>
                            <td class="text-center"><i class="fas fa-eye eye-icon" data-bs-toggle="tooltip" title="View details"></i></td>
                        </tr>
                        <tr data-paid="false">
                            <td><span class="fw-semibold">10</span></td>
                            <td><span class="fw-semibold">Fatima Al-Farsi</span></td>
                            <td>fatima.a@example.com</td>
                            <td>Dubai, UAE</td>
                            <td>18</td>
                            <td><span class="badge-unpaid">Unpaid</span></td>
                            <td><span class="badge-active">Active</span></td>
                            <td class="text-center"><i class="fas fa-eye eye-icon" data-bs-toggle="tooltip" title="View details"></i></td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <!-- Empty State -->
            <div id="emptyState" class="empty-state d-none">
                <i class="fas fa-user-slash"></i>
                <h5>No customers found</h5>
                <p>Try adjusting your search or filter to find what you're looking for.</p>
            </div>

            <!-- Footer -->
            <div class="table-footer">
                <div class="table-info" id="tableInfo">
                    Showing <strong id="showingStart">1</strong> to <strong id="showingEnd">10</strong> of <strong id="totalCount">10</strong> entries
                </div>
                <nav>
                    <ul class="pagination" id="pagination">
                        <li class="page-item disabled"><a class="page-link" href="#"><i class="fas fa-chevron-left"></i></a></li>
                        <li class="page-item active"><a class="page-link" href="#">1</a></li>
                        <li class="page-item"><a class="page-link" href="#">2</a></li>
                        <li class="page-item"><a class="page-link" href="#">3</a></li>
                        <li class="page-item"><a class="page-link" href="#"><i class="fas fa-chevron-right"></i></a></li>
                    </ul>
                </nav>
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

   <!-- Bootstrap JS Bundle (Latest Stable) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
    <script src="assets/js/script.js"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Init tooltips
            var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
            tooltipTriggerList.map(function (el) {
                return new bootstrap.Tooltip(el);
            });

            // Update stats function
            function updateStats() {
                const rows = document.querySelectorAll('#tableBody tr');
                let total = rows.length;
                let paid = 0, unpaid = 0;
                rows.forEach(row => {
                    if (row.style.display === 'none') return;
                    const isPaid = row.getAttribute('data-paid') === 'true';
                    if (isPaid) paid++; else unpaid++;
                });
                document.getElementById('totalCustomersStat').textContent = total;
                document.getElementById('paidCustomersStat').textContent = paid;
                document.getElementById('unpaidCustomersStat').textContent = unpaid;
            }

            // Export
            document.getElementById('exportBtn')?.addEventListener('click', function() {
                const toast = new bootstrap.Toast(document.getElementById('toast'));
                document.getElementById('toastMessage').textContent = 'Customer list exported successfully!';
                toast.show();
            });

            // Search filter
            document.getElementById('searchInput')?.addEventListener('keyup', function() {
                const term = this.value.toLowerCase();
                const rows = document.querySelectorAll('#tableBody tr');
                let visible = 0;
                rows.forEach(row => {
                    const text = row.textContent.toLowerCase();
                    if (text.includes(term)) {
                        row.style.display = '';
                        visible++;
                    } else {
                        row.style.display = 'none';
                    }
                });
                updateEntryInfo(visible);
                updateStats();
            });

            // Entries select
            document.getElementById('entriesSelect')?.addEventListener('change', function() {
                const value = this.value;
                const rows = document.querySelectorAll('#tableBody tr');
                if (value === 'all') {
                    rows.forEach(row => row.style.display = '');
                } else {
                    rows.forEach((row, idx) => {
                        row.style.display = idx < parseInt(value) ? '' : 'none';
                    });
                }
                updateEntryInfo();
                updateStats();
            });

            // Pagination (visual)
            document.querySelectorAll('.pagination .page-link').forEach(link => {
                link.addEventListener('click', function(e) {
                    e.preventDefault();
                    if (this.closest('.page-item').classList.contains('disabled')) return;
                    document.querySelectorAll('.pagination .page-item').forEach(item => item.classList.remove('active'));
                    this.closest('.page-item').classList.add('active');
                });
            });

            function updateEntryInfo(visibleCount) {
                const rows = document.querySelectorAll('#tableBody tr');
                const total = rows.length;
                const visible = (visibleCount !== undefined) ? visibleCount : rows.length;
                const start = visible > 0 ? 1 : 0;
                const end = visible;
                document.getElementById('showingStart').textContent = start;
                document.getElementById('showingEnd').textContent = end;
                document.getElementById('totalCount').textContent = total;

                const emptyState = document.getElementById('emptyState');
                if (visible === 0) {
                    emptyState.classList.remove('d-none');
                    document.querySelector('.table-wrapper').style.display = 'none';
                    document.querySelector('.table-footer').style.display = 'none';
                } else {
                    emptyState.classList.add('d-none');
                    document.querySelector('.table-wrapper').style.display = 'block';
                    document.querySelector('.table-footer').style.display = 'flex';
                }
                updateStats();
            }

            // Initial stats
            updateStats();
        });
    </script>
</body>

</html>