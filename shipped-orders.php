<?php
include 'config/config.php';
?>

<?php
$current_page = 'shipped-orders';
?>
<!DOCTYPE html>
<html lang="en">

<head>

  <?php include 'templates/head.php'; ?>

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
            box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.1);
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
        }

        .table-wrapper tbody tr:hover {
            background: #f8fafc;
        }

        .badge-shipped {
            background: #dbeafe;
            color: #1e40af;
            padding: 4px 12px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 600;
        }

        .badge-delivered {
            background: #d1fae5;
            color: #065f46;
            padding: 4px 12px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 600;
        }

        .badge-pending {
            background: #fef3c7;
            color: #92400e;
            padding: 4px 12px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 600;
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

            .page-header {
                flex-direction: column;
                align-items: flex-start;
            }

            .controls-bar {
                flex-direction: column;
                align-items: stretch;
            }

            .controls-right {
                flex-direction: column;
                align-items: stretch;
            }

            .search-wrapper input {
                width: 100%;
            }

            .table-footer {
                flex-direction: column;
                text-align: center;
            }

            .page-title {
                font-size: 18px;
            }
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
                    <i class="fas fa-shipping-fast"></i> SHIPPED ORDERS
                </h4>
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
                        <input type="text" id="searchInput" placeholder="Search by Order ID or Tracking ID" />
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
                            <th>Order ID</th>
                            <th>Shipping Partner</th>
                            <th>Tracking ID</th>
                            <th>Expected Delivery Date</th>
                            <th>Shipping Date</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody id="tableBody">
                        <!-- Dummy Data -->
                        <tr>
                            <td><span class="fw-semibold text-primary">#1024</span></td>
                            <td>DHL Express</td>
                            <td>DHL-9876543210</td>
                            <td>2026-01-25</td>
                            <td>2026-01-20</td>
                            <td><span class="badge-shipped">In Transit</span></td>
                        </tr>
                        <tr>
                            <td><span class="fw-semibold text-primary">#1025</span></td>
                            <td>FedEx</td>
                            <td>FDX-1234567890</td>
                            <td>2026-01-28</td>
                            <td>2026-01-22</td>
                            <td><span class="badge-shipped">In Transit</span></td>
                        </tr>
                        <tr>
                            <td><span class="fw-semibold text-primary">#1026</span></td>
                            <td>Blue Dart</td>
                            <td>BLD-5678901234</td>
                            <td>2026-02-01</td>
                            <td>2026-01-25</td>
                            <td><span class="badge-shipped">In Transit</span></td>
                        </tr>
                        <tr>
                            <td><span class="fw-semibold text-primary">#1027</span></td>
                            <td>DTDC</td>
                            <td>DTDC-4321098765</td>
                            <td>2026-01-18</td>
                            <td>2026-01-15</td>
                            <td><span class="badge-delivered">Delivered</span></td>
                        </tr>
                        <tr>
                            <td><span class="fw-semibold text-primary">#1028</span></td>
                            <td>DHL Express</td>
                            <td>DHL-2468135790</td>
                            <td>2026-02-05</td>
                            <td>2026-01-28</td>
                            <td><span class="badge-shipped">In Transit</span></td>
                        </tr>
                        <tr>
                            <td><span class="fw-semibold text-primary">#1029</span></td>
                            <td>FedEx</td>
                            <td>FDX-9876543210</td>
                            <td>2026-02-10</td>
                            <td>2026-02-01</td>
                            <td><span class="badge-pending">Pending</span></td>
                        </tr>
                        <tr>
                            <td><span class="fw-semibold text-primary">#1030</span></td>
                            <td>Blue Dart</td>
                            <td>BLD-7890123456</td>
                            <td>2026-02-08</td>
                            <td>2026-01-30</td>
                            <td><span class="badge-shipped">In Transit</span></td>
                        </tr>
                        <tr>
                            <td><span class="fw-semibold text-primary">#1031</span></td>
                            <td>DTDC</td>
                            <td>DTDC-6543210987</td>
                            <td>2026-02-12</td>
                            <td>2026-02-03</td>
                            <td><span class="badge-pending">Pending</span></td>
                        </tr>
                        <tr>
                            <td><span class="fw-semibold text-primary">#1032</span></td>
                            <td>DHL Express</td>
                            <td>DHL-1357924680</td>
                            <td>2026-01-30</td>
                            <td>2026-01-22</td>
                            <td><span class="badge-delivered">Delivered</span></td>
                        </tr>
                        <tr>
                            <td><span class="fw-semibold text-primary">#1033</span></td>
                            <td>FedEx</td>
                            <td>FDX-5678901234</td>
                            <td>2026-02-15</td>
                            <td>2026-02-05</td>
                            <td><span class="badge-pending">Pending</span></td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <!-- Empty State -->
            <div id="emptyState" class="empty-state d-none">
                <i class="fas fa-inbox"></i>
                <h5>No data available in table</h5>
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
  <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
     <script src="<?= APP_URL; ?>/assets/js/script.js"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Export button
            document.getElementById('exportBtn')?.addEventListener('click', function() {
                const toast = new bootstrap.Toast(document.getElementById('toast'));
                document.getElementById('toastMessage').textContent = 'Shipped orders exported successfully!';
                toast.show();
            });

            // Search functionality
            document.getElementById('searchInput')?.addEventListener('keyup', function() {
                const searchTerm = this.value.toLowerCase();
                const rows = document.querySelectorAll('#tableBody tr');
                let visibleCount = 0;
                rows.forEach(row => {
                    const text = row.textContent.toLowerCase();
                    if (text.includes(searchTerm)) {
                        row.style.display = '';
                        visibleCount++;
                    } else {
                        row.style.display = 'none';
                    }
                });
                updateEntryInfo(visibleCount);
            });

            // Entries selector
            document.getElementById('entriesSelect')?.addEventListener('change', function() {
                const value = this.value;
                const rows = document.querySelectorAll('#tableBody tr');
                if (value === 'all') {
                    rows.forEach(row => row.style.display = '');
                } else {
                    rows.forEach((row, index) => {
                        row.style.display = index < parseInt(value) ? '' : 'none';
                    });
                }
                updateEntryInfo();
            });

            // Pagination click
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
                const visible = visibleCount !== undefined ? visibleCount : rows.length;
                const total = rows.length;
                const start = visible > 0 ? 1 : 0;
                const end = visible;
                document.getElementById('showingStart').textContent = start;
                document.getElementById('showingEnd').textContent = end;
                document.getElementById('totalCount').textContent = total;

                // Show empty state if no data
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
            }
        });
    </script>
</body>

</html>