<?php
$current_page = 'customers';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Customers - Admin Panel</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/style.css">
   
</head>
<body>
    <?php include 'templates/navbar.php'; ?>
     <?php include 'templates/sidebar.php'; ?>
  

<!-- ============================================ -->
<!-- SUCCESS TOAST NOTIFICATION                  -->
<!-- ============================================ -->
<div class="position-fixed bottom-0 end-0 p-3" style="z-index: 9999;">
    <div id="successToast" class="toast align-items-center text-white bg-success border-0" role="alert" aria-live="assertive" aria-atomic="true">
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
   
</body>
</html>