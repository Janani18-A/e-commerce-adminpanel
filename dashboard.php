<div class="content-area p-3 p-md-4 p-lg-5">
    <!-- Welcome Section -->
    <div class="welcome-section bg-white p-3 p-md-4 rounded-3 shadow-sm border mb-4 d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3">
        <div class="welcome-text text-center text-md-start">
            <h1 class="h3 fw-bold text-dark">Good Morning, Jennifer!</h1>
            <p class="text-secondary mb-0">Your store is performing great today! You've made <strong class="text-primary" id="totalRevenueDisplay">₹2,45,000</strong> in revenue this month. Keep up the momentum!</p>
        </div>
        <div class="store-stats-mini d-flex gap-3 gap-md-4 justify-content-center">
            <div class="mini-stat text-center">
                <span class="mini-label d-block small text-secondary">Today's Visitors</span>
                <span class="mini-value fw-bold h5 mb-0" id="todayVisitors">1,247</span>
            </div>
            <div class="mini-stat text-center">
                <span class="mini-label d-block small text-secondary">Conversion Rate</span>
                <span class="mini-value fw-bold h5 mb-0" id="conversionRate">3.2%</span>
            </div>
            <div class="mini-stat text-center">
                <span class="mini-label d-block small text-secondary">Active Users</span>
                <span class="mini-value fw-bold h5 mb-0" id="activeUsers">89</span>
            </div>
        </div>
    </div>

    <!-- Row 1 - Main KPI Cards -->
    <div class="row g-3 g-lg-4 mb-4">
        <div class="col-12 col-sm-6 col-xl-3">
            <div class="stat-card bg-white p-3 rounded-3 border shadow-sm d-flex align-items-center gap-3 h-100">
                <div class="stat-icon bg-primary bg-opacity-10 rounded-3 d-flex align-items-center justify-content-center flex-shrink-0" style="width: 50px; height: 50px;">
                    <span class="text-primary fs-4 fw-bold">₹</span>
                </div>
                <div>
                    <h3 class="h5 fw-bold mb-0" id="totalEarnings">₹2,45,000</h3>
                    <p class="small text-secondary mb-0">Total Earnings</p>
                    <span class="trend up text-success small fw-semibold" id="totalEarningsTrend">12.5% increase</span>
                </div>
            </div>
        </div>
        <div class="col-12 col-sm-6 col-xl-3">
            <div class="stat-card bg-white p-3 rounded-3 border shadow-sm d-flex align-items-center gap-3 h-100">
                <div class="stat-icon bg-warning bg-opacity-10 rounded-3 d-flex align-items-center justify-content-center flex-shrink-0" style="width: 50px; height: 50px;">
                    <span class="text-warning fs-4 fw-bold">₹</span>
                </div>
                <div>
                    <h3 class="h5 fw-bold mb-0" id="todayEarnings">₹0.00</h3>
                    <p class="small text-secondary mb-0">Today's Earnings</p>
                    <span class="trend down text-danger small fw-semibold" id="todayEarningsTrend">Awaiting sales</span>
                </div>
            </div>
        </div>
        <div class="col-12 col-sm-6 col-xl-3">
            <div class="stat-card bg-white p-3 rounded-3 border shadow-sm d-flex align-items-center gap-3 h-100">
                <div class="stat-icon bg-info bg-opacity-10 rounded-3 d-flex align-items-center justify-content-center flex-shrink-0" style="width: 50px; height: 50px;">
                    <span class="text-info fs-4 fw-bold">#</span>
                </div>
                <div>
                    <h3 class="h5 fw-bold mb-0" id="totalOrders">1,250</h3>
                    <p class="small text-secondary mb-0">All Orders</p>
                    <span class="trend up text-success small fw-semibold" id="totalOrdersTrend">25 today</span>
                </div>
            </div>
        </div>
        <div class="col-12 col-sm-6 col-xl-3">
            <div class="stat-card bg-white p-3 rounded-3 border shadow-sm d-flex align-items-center gap-3 h-100">
                <div class="stat-icon bg-danger bg-opacity-10 rounded-3 d-flex align-items-center justify-content-center flex-shrink-0" style="width: 50px; height: 50px;">
                    <span class="text-danger fs-4 fw-bold">#</span>
                </div>
                <div>
                    <h3 class="h5 fw-bold mb-0" id="todayOrders">0</h3>
                    <p class="small text-secondary mb-0">Today's Orders</p>
                    <span class="trend down text-danger small fw-semibold" id="todayOrdersTrend">No orders yet</span>
                </div>
            </div>
        </div>
    </div>

    <!-- Row 2 - Quick Stats -->
    <div class="row g-3 g-lg-4 mb-4">
        <div class="col-12">
            <div class="bg-white p-3 p-md-4 rounded-3 border shadow-sm">
                <h3 class="h6 fw-bold mb-3">Quick Stats</h3>
                <div class="row g-3">
                    <div class="col-12 col-sm-6 col-lg-3">
                        <div class="quick-stat-item d-flex align-items-center gap-3 p-3 bg-light rounded-3 h-100">
                            <div class="qs-icon bg-primary bg-opacity-10 rounded-3 d-flex align-items-center justify-content-center flex-shrink-0" style="width: 48px; height: 48px; min-width: 48px;">
                                <span class="text-primary fs-5 fw-bold">👥</span>
                            </div>
                            <div>
                                <span class="qs-label d-block small text-secondary">Total Customers</span>
                                <span class="qs-value fw-bold h6 mb-0" id="totalCustomers">3,478</span>
                                <span class="qs-trend up text-success small fw-semibold" id="customerTrend">8.2% growth</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-sm-6 col-lg-3">
                        <div class="quick-stat-item d-flex align-items-center gap-3 p-3 bg-light rounded-3 h-100">
                            <div class="qs-icon bg-success bg-opacity-10 rounded-3 d-flex align-items-center justify-content-center flex-shrink-0" style="width: 48px; height: 48px; min-width: 48px;">
                                <span class="text-success fs-5 fw-bold">📦</span>
                            </div>
                            <div>
                                <span class="qs-label d-block small text-secondary">Products Sold</span>
                                <span class="qs-value fw-bold h6 mb-0" id="productsSold">865</span>
                                <span class="qs-trend up text-success small fw-semibold" id="productsTrend">5.7% growth</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-sm-6 col-lg-3">
                        <div class="quick-stat-item d-flex align-items-center gap-3 p-3 bg-light rounded-3 h-100">
                            <div class="qs-icon bg-warning bg-opacity-10 rounded-3 d-flex align-items-center justify-content-center flex-shrink-0" style="width: 48px; height: 48px; min-width: 48px;">
                                <span class="text-warning fs-5 fw-bold">⭐</span>
                            </div>
                            <div>
                                <span class="qs-label d-block small text-secondary">Avg. Rating</span>
                                <span class="qs-value fw-bold h6 mb-0" id="avgRating">4.7</span>
                                <span class="qs-trend up text-success small fw-semibold" id="ratingTrend">0.3% increase</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-sm-6 col-lg-3">
                        <div class="quick-stat-item d-flex align-items-center gap-3 p-3 bg-light rounded-3 h-100">
                            <div class="qs-icon bg-danger bg-opacity-10 rounded-3 d-flex align-items-center justify-content-center flex-shrink-0" style="width: 48px; height: 48px; min-width: 48px;">
                                <span class="text-danger fs-5 fw-bold">⚠</span>
                            </div>
                            <div>
                                <span class="qs-label d-block small text-secondary">Low Stock Items</span>
                                <span class="qs-value fw-bold h6 mb-0" id="lowStockItems">15</span>
                                <span class="qs-trend down text-danger small fw-semibold" id="stockTrend">Need restock</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Row 3 - Order Status Grid (Simple Text Only) -->
    <div class="row g-2 g-md-3 mb-4">
        <div class="col-6 col-md-4 col-lg-3 col-xl-2">
            <div class="status-card bg-white p-2 p-md-3 rounded-3 border shadow-sm d-flex align-items-center gap-2 gap-md-3 h-100">
                <div>
                    <h6 class="small text-secondary mb-0">Paid</h6>
                    <h5 class="fw-bold mb-0" id="paidCount">0</h5>
                </div>
            </div>
        </div>
        <div class="col-6 col-md-4 col-lg-3 col-xl-2">
            <div class="status-card bg-white p-2 p-md-3 rounded-3 border shadow-sm d-flex align-items-center gap-2 gap-md-3 h-100">
                <div>
                    <h6 class="small text-secondary mb-0">Unpaid</h6>
                    <h5 class="fw-bold mb-0" id="unpaidCount">0</h5>
                </div>
            </div>
        </div>
        <div class="col-6 col-md-4 col-lg-3 col-xl-2">
            <div class="status-card bg-white p-2 p-md-3 rounded-3 border shadow-sm d-flex align-items-center gap-2 gap-md-3 h-100">
                <div>
                    <h6 class="small text-secondary mb-0">Accepted</h6>
                    <h5 class="fw-bold mb-0" id="acceptedCount">0</h5>
                </div>
            </div>
        </div>
        <div class="col-6 col-md-4 col-lg-3 col-xl-2">
            <div class="status-card bg-white p-2 p-md-3 rounded-3 border shadow-sm d-flex align-items-center gap-2 gap-md-3 h-100">
                <div>
                    <h6 class="small text-secondary mb-0">Pending</h6>
                    <h5 class="fw-bold mb-0" id="pendingCount">8</h5>
                </div>
            </div>
        </div>
        <div class="col-6 col-md-4 col-lg-3 col-xl-2">
            <div class="status-card bg-white p-2 p-md-3 rounded-3 border shadow-sm d-flex align-items-center gap-2 gap-md-3 h-100">
                <div>
                    <h6 class="small text-secondary mb-0">Awaiting Payment</h6>
                    <h5 class="fw-bold mb-0" id="awaitingPaymentCount">5</h5>
                </div>
            </div>
        </div>
        <div class="col-6 col-md-4 col-lg-3 col-xl-2">
            <div class="status-card bg-white p-2 p-md-3 rounded-3 border shadow-sm d-flex align-items-center gap-2 gap-md-3 h-100">
                <div>
                    <h6 class="small text-secondary mb-0">Awaiting Fulfillment</h6>
                    <h5 class="fw-bold mb-0" id="awaitingFulfillmentCount">12</h5>
                </div>
            </div>
        </div>
        <div class="col-6 col-md-4 col-lg-3 col-xl-2">
            <div class="status-card bg-white p-2 p-md-3 rounded-3 border shadow-sm d-flex align-items-center gap-2 gap-md-3 h-100">
                <div>
                    <h6 class="small text-secondary mb-0">Awaiting Shipment</h6>
                    <h5 class="fw-bold mb-0" id="awaitingShipmentCount">7</h5>
                </div>
            </div>
        </div>
        <div class="col-6 col-md-4 col-lg-3 col-xl-2">
            <div class="status-card bg-white p-2 p-md-3 rounded-3 border shadow-sm d-flex align-items-center gap-2 gap-md-3 h-100">
                <div>
                    <h6 class="small text-secondary mb-0">Awaiting Pickup</h6>
                    <h5 class="fw-bold mb-0" id="awaitingPickupCount">3</h5>
                </div>
            </div>
        </div>
        <div class="col-6 col-md-4 col-lg-3 col-xl-2">
            <div class="status-card bg-white p-2 p-md-3 rounded-3 border shadow-sm d-flex align-items-center gap-2 gap-md-3 h-100">
                <div>
                    <h6 class="small text-secondary mb-0">Partially Shipped</h6>
                    <h5 class="fw-bold mb-0" id="partiallyShippedCount">4</h5>
                </div>
            </div>
        </div>
        <div class="col-6 col-md-4 col-lg-3 col-xl-2">
            <div class="status-card bg-white p-2 p-md-3 rounded-3 border shadow-sm d-flex align-items-center gap-2 gap-md-3 h-100">
                <div>
                    <h6 class="small text-secondary mb-0">Completed</h6>
                    <h5 class="fw-bold mb-0" id="completedCount">156</h5>
                </div>
            </div>
        </div>
        <div class="col-6 col-md-4 col-lg-3 col-xl-2">
            <div class="status-card bg-white p-2 p-md-3 rounded-3 border shadow-sm d-flex align-items-center gap-2 gap-md-3 h-100">
                <div>
                    <h6 class="small text-secondary mb-0">Delivered</h6>
                    <h5 class="fw-bold mb-0" id="deliveredCount">890</h5>
                </div>
            </div>
        </div>
        <div class="col-6 col-md-4 col-lg-3 col-xl-2">
            <div class="status-card bg-white p-2 p-md-3 rounded-3 border shadow-sm d-flex align-items-center gap-2 gap-md-3 h-100">
                <div>
                    <h6 class="small text-secondary mb-0">Shipped</h6>
                    <h5 class="fw-bold mb-0" id="shippedCount">120</h5>
                </div>
            </div>
        </div>
        <div class="col-6 col-md-4 col-lg-3 col-xl-2">
            <div class="status-card bg-white p-2 p-md-3 rounded-3 border shadow-sm d-flex align-items-center gap-2 gap-md-3 h-100">
                <div>
                    <h6 class="small text-secondary mb-0">Cancelled</h6>
                    <h5 class="fw-bold mb-0" id="cancelledCount">25</h5>
                </div>
            </div>
        </div>
        <div class="col-6 col-md-4 col-lg-3 col-xl-2">
            <div class="status-card bg-white p-2 p-md-3 rounded-3 border shadow-sm d-flex align-items-center gap-2 gap-md-3 h-100">
                <div>
                    <h6 class="small text-secondary mb-0">Declined</h6>
                    <h5 class="fw-bold mb-0" id="declinedCount">8</h5>
                </div>
            </div>
        </div>
        <div class="col-6 col-md-4 col-lg-3 col-xl-2">
            <div class="status-card bg-white p-2 p-md-3 rounded-3 border shadow-sm d-flex align-items-center gap-2 gap-md-3 h-100">
                <div>
                    <h6 class="small text-secondary mb-0">Refunded</h6>
                    <h5 class="fw-bold mb-0" id="refundedCount">12</h5>
                </div>
            </div>
        </div>
        <div class="col-6 col-md-4 col-lg-3 col-xl-2">
            <div class="status-card bg-white p-2 p-md-3 rounded-3 border shadow-sm d-flex align-items-center gap-2 gap-md-3 h-100">
                <div>
                    <h6 class="small text-secondary mb-0">Disputed</h6>
                    <h5 class="fw-bold mb-0" id="disputedCount">2</h5>
                </div>
            </div>
        </div>
        <div class="col-6 col-md-4 col-lg-3 col-xl-2">
            <div class="status-card bg-white p-2 p-md-3 rounded-3 border shadow-sm d-flex align-items-center gap-2 gap-md-3 h-100">
                <div>
                    <h6 class="small text-secondary mb-0">Manual Verification</h6>
                    <h5 class="fw-bold mb-0" id="manualVerificationCount">6</h5>
                </div>
            </div>
        </div>
        <div class="col-6 col-md-4 col-lg-3 col-xl-2">
            <div class="status-card bg-white p-2 p-md-3 rounded-3 border shadow-sm d-flex align-items-center gap-2 gap-md-3 h-100">
                <div>
                    <h6 class="small text-secondary mb-0">Partially Refunded</h6>
                    <h5 class="fw-bold mb-0" id="partiallyRefundedCount">3</h5>
                </div>
            </div>
        </div>
    </div>

    <!-- Row 4 - Top Selling & Recent Orders -->
    <div class="row g-3 g-lg-4 mb-4">
        <div class="col-lg-4">
            <div class="top-selling bg-white p-3 p-md-4 rounded-3 border shadow-sm h-100">
                <h3 class="h6 fw-bold mb-3">Top Selling Products</h3>
                <div class="product-rank" id="topProducts">
                    <div class="rank-item d-flex align-items-center gap-2 py-2 border-bottom">
                        <span class="product-name flex-grow-1 fw-medium">Premium Wireless Headphones</span>
                        <span class="orders small text-secondary flex-shrink-0">342 Orders</span>
                        <span class="revenue text-primary fw-semibold flex-shrink-0">₹2,04,000</span>
                    </div>
                    <div class="rank-item d-flex align-items-center gap-2 py-2 border-bottom">
                        <span class="product-name flex-grow-1 fw-medium">Smartphone Stand Deluxe</span>
                        <span class="orders small text-secondary flex-shrink-0">287 Orders</span>
                        <span class="revenue text-primary fw-semibold flex-shrink-0">₹1,72,200</span>
                    </div>
                    <div class="rank-item d-flex align-items-center gap-2 py-2 border-bottom">
                        <span class="product-name flex-grow-1 fw-medium">Ergonomic Mouse Pad</span>
                        <span class="orders small text-secondary flex-shrink-0">245 Orders</span>
                        <span class="revenue text-primary fw-semibold flex-shrink-0">₹1,22,500</span>
                    </div>
                    <div class="rank-item d-flex align-items-center gap-2 py-2 border-bottom">
                        <span class="product-name flex-grow-1 fw-medium">USB-C Hub 5-in-1</span>
                        <span class="orders small text-secondary flex-shrink-0">198 Orders</span>
                        <span class="revenue text-primary fw-semibold flex-shrink-0">₹99,000</span>
                    </div>
                    <div class="rank-item d-flex align-items-center gap-2 py-2">
                        <span class="product-name flex-grow-1 fw-medium">Wireless Charging Pad</span>
                        <span class="orders small text-secondary flex-shrink-0">156 Orders</span>
                        <span class="revenue text-primary fw-semibold flex-shrink-0">₹78,000</span>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-8">
            <div class="recent-orders bg-white p-3 p-md-4 rounded-3 border shadow-sm h-100">
                <h3 class="h6 fw-bold mb-3">Recent Orders</h3>
                <div class="table-responsive">
                    <table class="table table-hover mb-0">
                        <thead>
                            <tr>
                                <th class="small text-secondary">Order ID</th>
                                <th class="small text-secondary">Customer</th>
                                <th class="small text-secondary">Amount</th>
                                <th class="small text-secondary">Status</th>
                                <th class="small text-secondary">Action</th>
                            </tr>
                        </thead>
                        <tbody id="recentOrdersTable">
                            <tr>
                                <td><span class="order-id fw-semibold text-primary">#1024</span></td>
                                <td>Rajesh Kumar</td>
                                <td>₹1,200</td>
                                <td><span class="status-badge pending badge bg-warning bg-opacity-25 text-warning">Pending</span></td>
                                <td>
                                    <button class="action-btn view btn btn-sm btn-primary bg-opacity-10 border-0 me-1">View</button>
                                    <button class="action-btn ship btn btn-sm btn-success bg-opacity-10 border-0 me-1">Ship</button>
                                    <button class="action-btn invoice btn btn-sm btn-warning bg-opacity-10 border-0">Invoice</button>
                                </td>
                            </tr>
                            <tr>
                                <td><span class="order-id fw-semibold text-primary">#1025</span></td>
                                <td>Priya Sharma</td>
                                <td>₹850</td>
                                <td><span class="status-badge shipped badge bg-info bg-opacity-25 text-info">Shipped</span></td>
                                <td>
                                    <button class="action-btn view btn btn-sm btn-primary bg-opacity-10 border-0 me-1">View</button>
                                    <button class="action-btn ship btn btn-sm btn-success bg-opacity-10 border-0 me-1">Ship</button>
                                    <button class="action-btn invoice btn btn-sm btn-warning bg-opacity-10 border-0">Invoice</button>
                                </td>
                            </tr>
                            <tr>
                                <td><span class="order-id fw-semibold text-primary">#1026</span></td>
                                <td>Amit Verma</td>
                                <td>₹2,450</td>
                                <td><span class="status-badge delivered badge bg-success bg-opacity-25 text-success">Delivered</span></td>
                                <td>
                                    <button class="action-btn view btn btn-sm btn-primary bg-opacity-10 border-0 me-1">View</button>
                                    <button class="action-btn ship btn btn-sm btn-success bg-opacity-10 border-0 me-1">Ship</button>
                                    <button class="action-btn invoice btn btn-sm btn-warning bg-opacity-10 border-0">Invoice</button>
                                </td>
                            </tr>
                            <tr>
                                <td><span class="order-id fw-semibold text-primary">#1027</span></td>
                                <td>Sneha Reddy</td>
                                <td>₹3,200</td>
                                <td><span class="status-badge awaiting badge bg-warning bg-opacity-25 text-warning">Awaiting Payment</span></td>
                                <td>
                                    <button class="action-btn view btn btn-sm btn-primary bg-opacity-10 border-0 me-1">View</button>
                                    <button class="action-btn ship btn btn-sm btn-success bg-opacity-10 border-0 me-1">Ship</button>
                                    <button class="action-btn invoice btn btn-sm btn-warning bg-opacity-10 border-0">Invoice</button>
                                </td>
                            </tr>
                            <tr>
                                <td><span class="order-id fw-semibold text-primary">#1028</span></td>
                                <td>Vikram Singh</td>
                                <td>₹1,800</td>
                                <td><span class="status-badge cancelled badge bg-danger bg-opacity-25 text-danger">Cancelled</span></td>
                                <td>
                                    <button class="action-btn view btn btn-sm btn-primary bg-opacity-10 border-0 me-1">View</button>
                                    <button class="action-btn ship btn btn-sm btn-success bg-opacity-10 border-0 me-1">Ship</button>
                                    <button class="action-btn invoice btn btn-sm btn-warning bg-opacity-10 border-0">Invoice</button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="table-footer d-flex flex-column flex-sm-row justify-content-between align-items-center gap-2 mt-3 pt-3 border-top">
                    <span class="small text-secondary" id="orderCount">Showing 5 of 1,250 orders</span>
                    <button class="view-all-btn btn btn-sm btn-link text-primary fw-semibold text-decoration-none">View All Orders</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Row 5 - Stock Alerts & Recent Activity -->
    <div class="row g-3 g-lg-4 mb-4">
        <div class="col-md-6">
            <div class="stock-alerts bg-white p-3 p-md-4 rounded-3 border shadow-sm h-100">
                <h3 class="h6 fw-bold mb-3">Stock Alerts</h3>
                <div id="stockAlertsList">
                    <div class="alert-item d-flex align-items-center gap-2 py-2 border-bottom ps-2 border-start border-3 border-danger">
                        <span class="alert-product flex-grow-1 fw-medium">Wireless Bluetooth Mouse</span>
                        <span class="alert-status danger badge bg-danger bg-opacity-10 text-danger flex-shrink-0">Only 3 Left</span>
                    </div>
                    <div class="alert-item d-flex align-items-center gap-2 py-2 border-bottom ps-2 border-start border-3 border-warning">
                        <span class="alert-product flex-grow-1 fw-medium">Laptop Stand Pro</span>
                        <span class="alert-status warning badge bg-warning bg-opacity-10 text-warning flex-shrink-0">Only 2 Left</span>
                    </div>
                    <div class="alert-item d-flex align-items-center gap-2 py-2 border-bottom ps-2 border-start border-3 border-danger">
                        <span class="alert-product flex-grow-1 fw-medium">Mechanical Gaming Keyboard</span>
                        <span class="alert-status danger badge bg-danger bg-opacity-10 text-danger flex-shrink-0">Out Of Stock</span>
                    </div>
                    <div class="alert-item d-flex align-items-center gap-2 py-2 border-bottom ps-2 border-start border-3 border-warning">
                        <span class="alert-product flex-grow-1 fw-medium">Webcam HD 1080p</span>
                        <span class="alert-status warning badge bg-warning bg-opacity-10 text-warning flex-shrink-0">Only 5 Left</span>
                    </div>
                    <div class="alert-item d-flex align-items-center gap-2 py-2 ps-2 border-start border-3 border-success">
                        <span class="alert-product flex-grow-1 fw-medium">USB-C Cable 2M</span>
                        <span class="alert-status success badge bg-success bg-opacity-10 text-success flex-shrink-0">In Stock</span>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="recent-activity bg-white p-3 p-md-4 rounded-3 border shadow-sm h-100">
                <h3 class="h6 fw-bold mb-3">Recent Activity</h3>
                <div id="recentActivityList">
                    <div class="activity-item d-flex justify-content-between align-items-center py-2 border-bottom">
                        <span class="time small text-secondary flex-shrink-0">10:20 AM</span>
                        <span class="action fw-medium flex-grow-1 px-2 px-md-3">Product Added: Wireless Mouse</span>
                        <span class="user small text-secondary flex-shrink-0">by Admin</span>
                    </div>
                    <div class="activity-item d-flex justify-content-between align-items-center py-2 border-bottom">
                        <span class="time small text-secondary flex-shrink-0">11:05 AM</span>
                        <span class="action fw-medium flex-grow-1 px-2 px-md-3">Order Received: #1024</span>
                        <span class="user small text-secondary flex-shrink-0">by Rajesh Kumar</span>
                    </div>
                    <div class="activity-item d-flex justify-content-between align-items-center py-2 border-bottom">
                        <span class="time small text-secondary flex-shrink-0">11:45 AM</span>
                        <span class="action fw-medium flex-grow-1 px-2 px-md-3">Customer Registered</span>
                        <span class="user small text-secondary flex-shrink-0">Priya Sharma</span>
                    </div>
                    <div class="activity-item d-flex justify-content-between align-items-center py-2 border-bottom">
                        <span class="time small text-secondary flex-shrink-0">12:10 PM</span>
                        <span class="action fw-medium flex-grow-1 px-2 px-md-3">Coupon Created: SUMMER25</span>
                        <span class="user small text-secondary flex-shrink-0">by Admin</span>
                    </div>
                    <div class="activity-item d-flex justify-content-between align-items-center py-2">
                        <span class="time small text-secondary flex-shrink-0">01:30 PM</span>
                        <span class="action fw-medium flex-grow-1 px-2 px-md-3">Order Shipped: #1025</span>
                        <span class="user small text-secondary flex-shrink-0">by Delivery Team</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Row 6 - Order History -->
    <div class="order-history-section bg-white p-3 p-md-4 rounded-3 border shadow-sm mb-4">
        <div class="history-header d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-2 mb-3">
            <h3 class="h6 fw-bold mb-0">Order History</h3>
            <div class="history-filters d-flex gap-1 flex-wrap justify-content-center">
                <button class="history-btn btn btn-sm btn-outline-primary active" data-period="week" onclick="updateHistory('week')">Last Week</button>
                <button class="history-btn btn btn-sm btn-outline-primary" data-period="month" onclick="updateHistory('month')">Last Month</button>
                <button class="history-btn btn btn-sm btn-outline-primary" data-period="quarter" onclick="updateHistory('quarter')">Last 3 Months</button>
            </div>
        </div>
        <div class="history-grid row g-3" id="historyGrid">
            <div class="col-md-6">
                <div class="history-card d-flex align-items-center gap-3 p-3 bg-light rounded-3 border h-100">
                    <div class="history-info">
                        <h5 class="small fw-semibold mb-1">Last Week Orders History</h5>
                        <div class="history-stats d-flex gap-3 flex-wrap">
                            <span class="small text-secondary"><strong>156</strong> Orders</span>
                            <span class="small text-secondary"><strong>₹1,85,000</strong> Revenue</span>
                            <span class="small text-success"><strong>+12%</strong> vs previous</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="history-card d-flex align-items-center gap-3 p-3 bg-light rounded-3 border h-100">
                    <div class="history-info">
                        <h5 class="small fw-semibold mb-1">Last Month Orders History</h5>
                        <div class="history-stats d-flex gap-3 flex-wrap">
                            <span class="small text-secondary"><strong>845</strong> Orders</span>
                            <span class="small text-secondary"><strong>₹9,45,000</strong> Revenue</span>
                            <span class="small text-success"><strong>+8.5%</strong> vs previous</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <div class="dashboard-footer text-center py-3">
        <p class="small text-secondary mb-0">© 2026 E-Shop Admin Panel. All rights reserved.</p>
    </div>
</div>