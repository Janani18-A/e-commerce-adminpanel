<?php
$current_page = 'shipped-orders';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
<<<<<<< HEAD:customers.php
    <title>Customers - Admin Panel</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/style.css">
   
=======
    <title>Shipped Orders</title>
    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
    <!-- Font Awesome 6 -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="assets/css/style.css">

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
            font-size: 25px;
            font-weight: 500;
            color: #0b0b0b;
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
>>>>>>> 129cdbd (update-files committed):e-commerce-adminpanel-main/shipped-orders.php
</head>
<body>
    <?php include 'templates/navbar.php'; ?>
     <?php include 'templates/sidebar.php'; ?>
  

<<<<<<< HEAD:customers.php
<!-- ============================================ -->
<!-- SUCCESS TOAST NOTIFICATION                  -->
<!-- ============================================ -->
<div class="position-fixed bottom-0 end-0 p-3" style="z-index: 9999;">
    <div id="successToast" class="toast align-items-center text-white bg-success border-0" role="alert" aria-live="assertive" aria-atomic="true">
=======
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
>>>>>>> 129cdbd (update-files committed):e-commerce-adminpanel-main/shipped-orders.php
        <div class="d-flex">
            <div class="toast-body">
                <i class="fas fa-check-circle me-2"></i> <span id="toastMessage">Customer added successfully!</span>
            </div>
            <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast"></button>
        </div>
    </div>
</div>

<div class="position-fixed bottom-0 end-0 p-3" style="z-index: 9999;">
    <div id="errorToast" class="toast align-items-center text-white bg-danger border-0" role="alert" aria-live="assertive" aria-atomic="true">
        <div class="d-flex">
            <div class="toast-body">
                <i class="fas fa-exclamation-circle me-2"></i> <span id="errorToastMessage">Something went wrong!</span>
            </div>
            <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast"></button>
        </div>
    </div>
</div>
    <div class="content-area">
        <!-- Page Header -->
        <div class="page-header">
            <div class="header-left">
                <h1>👥 Customers</h1>
                <p>Manage and view all your customer information</p>
            </div>
            <div class="header-right">
                <button class="btn-add" onclick="addCustomer()">
                    <i class="fas fa-user-plus"></i> Add Customer
                </button>
                <button class="btn-export" onclick="exportData()">
                    <i class="fas fa-file-export"></i> Export
                </button>
            </div>
        </div>

        <!-- Row 1 - Stats Cards (4 columns) -->
        <div class="stats-grid">
            <div class="stat-card">
                <div class="stat-icon" style="background: #DBEAFE; color: #2563EB;">
                    <i class="fas fa-users"></i>
                </div>
                <div class="stat-info">
                    <h3>8,742</h3>
                    <p>Total Customers</p>
                    <span class="trend up"><i class="fas fa-arrow-up"></i> +5.1% this month</span>
                </div>
            </div>
            <div class="stat-card">
                <div class="stat-icon" style="background: #D1FAE5; color: #065F46;">
                    <i class="fas fa-user-plus"></i>
                </div>
                <div class="stat-info">
                    <h3>45</h3>
                    <p>New Customers</p>
                    <span class="trend up"><i class="fas fa-arrow-up"></i> This Month</span>
                </div>
            </div>
            <div class="stat-card">
                <div class="stat-icon" style="background: #FEF3C7; color: #92400E;">
                    <i class="fas fa-user-check"></i>
                </div>
                <div class="stat-info">
                    <h3>380</h3>
                    <p>Repeat Customers</p>
                    <span class="trend up"><i class="fas fa-arrow-up"></i> 91% healthy</span>
                </div>
            </div>
            <div class="stat-card">
                <div class="stat-icon" style="background: #FEE2E2; color: #991B1B;">
                    <i class="fas fa-coins"></i>
                </div>
                <div class="stat-info">
                    <h3>₹1,250</h3>
                    <p>Avg Spend</p>
                    <span class="trend up"><i class="fas fa-arrow-up"></i> +8.2%</span>
                </div>
            </div>
        </div>

        <!-- Row 2 - Quick Stats (4 columns) -->
        <div class="quick-stats-row">
            <div class="quick-stat">
                <span class="qs-icon">🥇</span>
                <div class="qs-content">
                    <h4>VIP Customers</h4>
                    <p>42</p>
                </div>
            </div>
            <div class="quick-stat">
                <span class="qs-icon">🔄</span>
                <div class="qs-content">
                    <h4>Repeat Buyers</h4>
                    <p>380</p>
                </div>
            </div>
            <div class="quick-stat">
                <span class="qs-icon">🆕</span>
                <div class="qs-content">
                    <h4>New Customers</h4>
                    <p>120</p>
                </div>
            </div>
            <div class="quick-stat">
                <span class="qs-icon">⚠️</span>
                <div class="qs-content">
                    <h4>Inactive Customers</h4>
                    <p>85</p>
                </div>
            </div>
        </div>

        <!-- Row 3 - Analytics & Top Customers -->
        <div class="analytics-row">
            <div class="chart-box">
                <div class="chart-header">
                    <h3>📈 Customer Growth</h3>
                    <div class="chart-filters">
                        <button class="filter-btn active" onclick="updateCustomerChart('jan')">Jan</button>
                        <button class="filter-btn" onclick="updateCustomerChart('feb')">Feb</button>
                        <button class="filter-btn" onclick="updateCustomerChart('mar')">Mar</button>
                        <button class="filter-btn" onclick="updateCustomerChart('apr')">Apr</button>
                        <button class="filter-btn" onclick="updateCustomerChart('may')">May</button>
                        <button class="filter-btn" onclick="updateCustomerChart('jun')">Jun</button>
                    </div>
                </div>
                <div class="growth-chart" id="growthChart">
    <div class="bar-group">
        <div class="bar" style="height: 40px;"></div>
        <span class="bar-value">20</span>
        <span>Jan</span>
    </div>
    <div class="bar-group">
        <div class="bar" style="height: 70px;"></div>
        <span class="bar-value">35</span>
        <span>Feb</span>
    </div>
    <div class="bar-group">
        <div class="bar" style="height: 104px;"></div>
        <span class="bar-value">52</span>
        <span>Mar</span>
    </div>
    <div class="bar-group">
        <div class="bar" style="height: 160px;"></div>
        <span class="bar-value">80</span>
        <span>Apr</span>
    </div>
    <div class="bar-group">
        <div class="bar" style="height: 220px;"></div>
        <span class="bar-value">110</span>
        <span>May</span>
    </div>
    <div class="bar-group">
        <div class="bar" style="height: 300px;"></div>
        <span class="bar-value">150</span>
        <span>Jun</span>
    </div>
</div>
            </div>

            <div class="top-customers">
                <h3>🏆 Top Customers</h3>
                <div class="top-customer-list">
                    <div class="top-item">
                        <span class="rank">🥇</span>
                        <span class="name">Janani</span>
                        <span class="amount">₹25,000</span>
                    </div>
                    <div class="top-item">
                        <span class="rank">🥈</span>
                        <span class="name">Hari</span>
                        <span class="amount">₹18,000</span>
                    </div>
                    <div class="top-item">
                        <span class="rank">🥉</span>
                        <span class="name">Kumar</span>
                        <span class="amount">₹12,000</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Row 4 - Customer Locations & Status -->
        <div class="locations-row">
            <div class="locations-box">
                <h3>📍 Customer Locations</h3>
                <div class="location-list">
                    <div class="location-item">
                        <span class="city">Chennai</span>
                        <div class="progress-bar">
                            <div class="progress" style="width: 80%; background: #2563EB;"></div>
                        </div>
                        <span class="count">320</span>
                    </div>
                    <div class="location-item">
                        <span class="city">Coimbatore</span>
                        <div class="progress-bar">
                            <div class="progress" style="width: 65%; background: #60A5FA;"></div>
                        </div>
                        <span class="count">140</span>
                    </div>
                    <div class="location-item">
                        <span class="city">Madurai</span>
                        <div class="progress-bar">
                            <div class="progress" style="width: 45%; background: #93BBFC;"></div>
                        </div>
                        <span class="count">90</span>
                    </div>
                    <div class="location-item">
                        <span class="city">Salem</span>
                        <div class="progress-bar">
                            <div class="progress" style="width: 35%; background: #BFDBFE;"></div>
                        </div>
                        <span class="count">75</span>
                    </div>
                </div>
            </div>

            <div class="status-box">
                <h3>📊 Customer Status</h3>
                <div class="status-grid">
                    <div class="status-item">
                        <div class="status-dot active"></div>
                        <span>Active</span>
                        <span class="status-count">7,980</span>
                    </div>
                    <div class="status-item">
                        <div class="status-dot pending"></div>
                        <span>Pending</span>
                        <span class="status-count">184</span>
                    </div>
                    <div class="status-item">
                        <div class="status-dot suspended"></div>
                        <span>Suspended</span>
                        <span class="status-count">38</span>
                    </div>
                    <div class="status-item">
                        <div class="status-dot flagged"></div>
                        <span>Flagged</span>
                        <span class="status-count">4</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Row 5 - Customer Table with Pagination -->
        <div class="table-section">
            <div class="table-header">
                <div class="table-left">
                    <h3>📋 Customer List</h3>
                    <span class="table-subtitle">Search, review, and manage customer accounts</span>
                </div>
                <div class="table-right">
                    <div class="search-box">
                        <i class="fas fa-search"></i>
                        <input type="text" id="customerSearch" placeholder="Search customers..." onkeyup="filterCustomers(this.value)">
                    </div>
                    <div class="view-toggle">
                        <button class="toggle-btn active" onclick="switchView('table')">
                            <i class="fas fa-table"></i>
                        </button>
                        <button class="toggle-btn" onclick="switchView('card')">
                            <i class="fas fa-th-large"></i>
                        </button>
                    </div>
                </div>
            </div>

            <div class="table-responsive" id="tableContainer">
                <table class="customer-table" id="customerTable">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Image</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Orders</th>
                            <th>Paid</th>
                            <th>Unpaid</th>
                            <th>Total Spend</th>
                            <th>Created</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody id="customerTableBody">
                        <!-- Data will be loaded by JS -->
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            <div class="table-footer">
                <div class="footer-left">
                    <span id="entryInfo">Showing 1 to 5 of 16 entries</span>
                    <button class="show-all-btn" onclick="showAll()">Show All</button>
                </div>
                <div class="footer-right" id="paginationControls">
                    <!-- Pagination buttons will be generated by JS -->
                </div>
            </div>
        </div>

        <div class="dashboard-footer">
            <p>© 2026 E-Shop Admin Panel. All rights reserved.</p>
        </div>
    </div>
<!-- Include Logout Modal -->
    <?php include 'templates/modal/logout-modal.php'; ?>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="assets/js/script.js"></script>
<<<<<<< HEAD:customers.php
   
=======

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
>>>>>>> 129cdbd (update-files committed):e-commerce-adminpanel-main/shipped-orders.php
</body>
</html>