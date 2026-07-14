<?php
include 'config/config.php';
?>



<?php $current_page = 'reports'; ?>
<!DOCTYPE html>
<html lang="en">


   <?php include 'templates/head.php'; ?>
</head>

<body>
    <!-- Navbar -->
    <?php include 'templates/navbar.php'; ?>
    <!-- Sidebar -->    
     <?php include 'templates/sidebar.php'; ?>

    <!-- MAIN CONTENT WRAPPER (matches other pages) -->
    <div class="content-area">
        <div class="container-fluid">

            <!-- Header -->
            <div class="page-header">
                <h4 class="page-title">
                    <i class="fas fa-chart-pie"></i> Reports
                </h4>
                <div class="d-flex align-items-center gap-3 flex-wrap">
                    <nav>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">Dashboard</li>
                            <li class="breadcrumb-item active">Reports</li>
                        </ol>
                    </nav>
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
                        <div class="card-content">
                            <span>Earnings</span>
                            <h2>₹0.00</h2>
                        </div>
                        <div class="card-icon">
                            <i class="fas fa-arrow-up"></i>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="report-card card-gst">
                        <div class="card-content">
                            <span>GST</span>
                            <h2>₹0.00</h2>
                        </div>
                        <div class="card-icon">
                            <i class="fas fa-receipt"></i>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="report-card card-delivery">
                        <div class="card-content">
                            <span>Delivery Charges</span>
                            <h2>₹0.00</h2>
                        </div>
                        <div class="card-icon">
                            <i class="fas fa-truck"></i>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="report-card card-total">
                        <div class="card-content">
                            <span>Total Earnings</span>
                            <h2>₹0.00</h2>
                        </div>
                        <div class="card-icon">
                            <i class="fas fa-coins"></i>
                        </div>
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
                            <button class="btn btn-primary w-100" id="searchBtn">
                                <i class="fas fa-search"></i> Search
                            </button>
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
                            <button class="btn btn-success" id="exportExcel">
                                <i class="fas fa-file-excel"></i> Export to Excel
                            </button>
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
                            <tbody id="tableBody">
                                <!-- Filled by JavaScript -->
                            </tbody>
                        </table>
                    </div>

                    <!-- Footer -->
                    <div class="table-footer">
                        <span id="tableInfo">Showing 0 to 0 of 0 entries</span>
                        <div id="pagination"></div>
                    </div>

                </div>
            </div>

        </div>
    </div><!-- /content-area -->

    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
   <!-- Bootstrap JS Bundle (Latest Stable) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>

    <script src="assets/js/script.js"></script>

</body>
</html>