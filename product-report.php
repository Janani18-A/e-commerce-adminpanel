<?php $current_page = 'product-reports'; ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Reports</title>

    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
    <!-- Font Awesome 6 -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="assets/css/style.css">
</head>

<body>
    <!-- Navbar -->
    <?php include 'templates/navbar.php'; ?>
    <!-- Sidebar -->
     <?php include 'templates/sidebar.php'; ?>

    <!-- MAIN CONTENT WRAPPER (matches other pages) -->
    <div class="content-area">
        <div class="container-fluid">

            <!-- Page Header -->
            <div class="page-header">
                <h4 class="page-title">
                    <i class="fas fa-chart-line"></i> PRODUCT REPORTS
                </h4>
                <nav>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">Dashboard</li>
                        <li class="breadcrumb-item">Reports</li>
                        <li class="breadcrumb-item active">Product Reports</li>
                    </ol>
                </nav>
            </div>

            <!-- Main Card -->
            <div class="card border-0 shadow-sm">
                <div class="card-body">

                    <!-- Filter Row: Date From / To + Category + Search -->
                    <div class="filters-row">
                        <div class="filter-group">
                            <label>Date</label>
                            <input type="date" id="dateFrom" />
                        </div>
                        <div class="filter-group">
                            <span class="date-sep">to</span>
                            <input type="date" id="dateTo" />
                        </div>
                        <div class="filter-group">
                            <label>Category</label>
                            <select id="categoryFilter">
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
                        <button class="search-btn" id="searchBtn">
                            <i class="fas fa-search"></i> <span>Search</span>
                        </button>
                    </div>

                    <!-- Toolbar Row: Show Entries + Export -->
                    <div class="toolbar-row">
                        <div class="toolbar-left">
                            <div class="show-group">
                                <label>Show</label>
                                <select id="entriesPerPage">
                                    <option value="5">5</option>
                                    <option value="10" selected>10</option>
                                    <option value="25">25</option>
                                    <option value="50">50</option>
                                </select>
                                <span class="entries-label">entries</span>
                            </div>
                            <button class="export-btn" id="exportBtn">
                                <i class="fas fa-file-excel"></i> <span>Export to Excel</span>
                            </button>
                        </div>
                    </div>

                    <!-- Search Row -->
                    <div class="search-row">
                        <label>Search:</label>
                        <input type="text" id="searchInput" placeholder="Product name..." />
                    </div>

                    <!-- Table -->
                    <div class="table-responsive">
                        <table class="table table-hover align-middle" id="productTable">
                            <thead>
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
                                <!-- Rows injected by JavaScript -->
                            </tbody>
                        </table>
                    </div>

                    <!-- Table Footer -->
                    <div class="table-footer">
                        <div class="info-text" id="tableInfo">Showing 0 to 0 of 0 entries</div>
                        <div class="pagination" id="paginationControls">
                            <button id="prevPage" disabled><i class="fas fa-chevron-left"></i></button>
                            <span id="pageNumbers"></span>
                            <button id="nextPage" disabled><i class="fas fa-chevron-right"></i></button>
                        </div>
                    </div>

                </div>
            </div>

        </div>
    </div><!-- /content-area -->

    <!-- Toast Notification -->
    <div class="toast-notification" id="toast">
        <i class="fas fa-check-circle"></i>
        <span id="toastMessage">Exported successfully!</span>
    </div>

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <!-- Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="assets/js/script.js"></script>

</body>

</html>