<div class="content-area">
    <!-- Welcome Section -->
    <div class="welcome-section">
        <div class="welcome-text">
            <h1>Good Morning, Jennifer! ☀️</h1>
            <p>Your store is performing great today! You've made <strong id="totalRevenueDisplay">₹2,45,000</strong> in revenue this month. Keep up the momentum! 🚀</p>
        </div>
        <div class="store-stats-mini">
            <div class="mini-stat">
                <span class="mini-label">Today's Visitors</span>
                <span class="mini-value" id="todayVisitors">1,247</span>
            </div>
            <div class="mini-stat">
                <span class="mini-label">Conversion Rate</span>
                <span class="mini-value" id="conversionRate">3.2%</span>
            </div>
            <div class="mini-stat">
                <span class="mini-label">Active Users</span>
                <span class="mini-value" id="activeUsers">89</span>
            </div>
        </div>
    </div>

    <!-- Row 1 - Main KPI Cards -->
    <div class="stats-grid">
        <div class="stat-card">
            <div class="stat-icon"><i class="fas fa-wallet"></i></div>
            <div class="stat-info">
                <h3 id="totalEarnings">₹2,45,000</h3>
                <p>Total Earnings</p>
                <span class="trend up" id="totalEarningsTrend"><i class="fas fa-arrow-up"></i> 12.5%</span>
            </div>
        </div>
        <div class="stat-card">
            <div class="stat-icon"><i class="fas fa-coins"></i></div>
            <div class="stat-info">
                <h3 id="todayEarnings">₹0.00</h3>
                <p>Today's Earnings</p>
                <span class="trend down" id="todayEarningsTrend"><i class="fas fa-clock"></i> Awaiting sales</span>
            </div>
        </div>
        <div class="stat-card">
            <div class="stat-icon"><i class="fas fa-shopping-bag"></i></div>
            <div class="stat-info">
                <h3 id="totalOrders">1,250</h3>
                <p>All Orders</p>
                <span class="trend up" id="totalOrdersTrend"><i class="fas fa-arrow-up"></i> +25 Today</span>
            </div>
        </div>
        <div class="stat-card">
            <div class="stat-icon"><i class="fas fa-clock"></i></div>
            <div class="stat-info">
                <h3 id="todayOrders">0</h3>
                <p>Today's Orders</p>
                <span class="trend down" id="todayOrdersTrend"><i class="fas fa-hourglass"></i> No orders yet</span>
            </div>
        </div>
    </div>

    <!-- Row 2 - Order Status Grid -->
    <div class="order-status-grid">
        <div class="status-card paid">
            <div class="status-icon"><i class="fas fa-check-circle"></i></div>
            <div class="status-info">
                <h4>Paid</h4>
                <h2 id="paidCount">0</h2>
            </div>
        </div>
        <div class="status-card unpaid">
            <div class="status-icon"><i class="fas fa-hourglass-half"></i></div>
            <div class="status-info">
                <h4>Unpaid</h4>
                <h2 id="unpaidCount">0</h2>
            </div>
        </div>
        <div class="status-card accepted">
            <div class="status-icon"><i class="fas fa-check"></i></div>
            <div class="status-info">
                <h4>Order Accepted</h4>
                <h2 id="acceptedCount">0</h2>
            </div>
        </div>
        <div class="status-card pending">
            <div class="status-icon"><i class="fas fa-spinner"></i></div>
            <div class="status-info">
                <h4>Pending</h4>
                <h2 id="pendingCount">8</h2>
            </div>
        </div>
        <div class="status-card awaiting-payment">
            <div class="status-icon"><i class="fas fa-credit-card"></i></div>
            <div class="status-info">
                <h4>Awaiting Payment</h4>
                <h2 id="awaitingPaymentCount">5</h2>
            </div>
        </div>
        <div class="status-card awaiting-fulfillment">
            <div class="status-icon"><i class="fas fa-box"></i></div>
            <div class="status-info">
                <h4>Awaiting Fulfillment</h4>
                <h2 id="awaitingFulfillmentCount">12</h2>
            </div>
        </div>
        <div class="status-card awaiting-shipment">
            <div class="status-icon"><i class="fas fa-truck"></i></div>
            <div class="status-info">
                <h4>Awaiting Shipment</h4>
                <h2 id="awaitingShipmentCount">7</h2>
            </div>
        </div>
        <div class="status-card awaiting-pickup">
            <div class="status-icon"><i class="fas fa-store"></i></div>
            <div class="status-info">
                <h4>Awaiting Pickup</h4>
                <h2 id="awaitingPickupCount">3</h2>
            </div>
        </div>
        <div class="status-card partially-shipped">
            <div class="status-icon"><i class="fas fa-truck-loading"></i></div>
            <div class="status-info">
                <h4>Partially Shipped</h4>
                <h2 id="partiallyShippedCount">4</h2>
            </div>
        </div>
        <div class="status-card completed">
            <div class="status-icon"><i class="fas fa-check-double"></i></div>
            <div class="status-info">
                <h4>Completed</h4>
                <h2 id="completedCount">156</h2>
            </div>
        </div>
        <div class="status-card delivered">
            <div class="status-icon"><i class="fas fa-home"></i></div>
            <div class="status-info">
                <h4>Delivered</h4>
                <h2 id="deliveredCount">890</h2>
            </div>
        </div>
        <div class="status-card shipped">
            <div class="status-icon"><i class="fas fa-shipping-fast"></i></div>
            <div class="status-info">
                <h4>Shipped</h4>
                <h2 id="shippedCount">120</h2>
            </div>
        </div>
        <div class="status-card cancelled">
            <div class="status-icon"><i class="fas fa-times-circle"></i></div>
            <div class="status-info">
                <h4>Cancelled</h4>
                <h2 id="cancelledCount">25</h2>
            </div>
        </div>
        <div class="status-card declined">
            <div class="status-icon"><i class="fas fa-ban"></i></div>
            <div class="status-info">
                <h4>Declined</h4>
                <h2 id="declinedCount">8</h2>
            </div>
        </div>
        <div class="status-card refunded">
            <div class="status-icon"><i class="fas fa-undo"></i></div>
            <div class="status-info">
                <h4>Refunded</h4>
                <h2 id="refundedCount">12</h2>
            </div>
        </div>
        <div class="status-card disputed">
            <div class="status-icon"><i class="fas fa-gavel"></i></div>
            <div class="status-info">
                <h4>Disputed</h4>
                <h2 id="disputedCount">2</h2>
            </div>
        </div>
        <div class="status-card manual-verification">
            <div class="status-icon"><i class="fas fa-user-check"></i></div>
            <div class="status-info">
                <h4>Manual Verification Required</h4>
                <h2 id="manualVerificationCount">6</h2>
            </div>
        </div>
        <div class="status-card partially-refunded">
            <div class="status-icon"><i class="fas fa-hand-holding-usd"></i></div>
            <div class="status-info">
                <h4>Partially Refunded</h4>
                <h2 id="partiallyRefundedCount">3</h2>
            </div>
        </div>
    </div>

    <!-- Row 3 - Analytics & Charts -->
    <div class="analytics-section">
        <div class="chart-container">
            <div class="chart-header">
                <h3>📊 Revenue Analytics</h3>
                <div class="chart-filters">
                    <button class="filter-btn active" data-period="today" onclick="updateDashboard('today')">Today</button>
                    <button class="filter-btn" data-period="week" onclick="updateDashboard('week')">Last Week</button>
                    <button class="filter-btn" data-period="month" onclick="updateDashboard('month')">Last Month</button>
                    <button class="filter-btn" data-period="year" onclick="updateDashboard('year')">Last Year</button>
                </div>
            </div>
            <div class="chart-body">
                <div class="sales-chart" id="salesChart">
                    <div class="bar-group">
                        <div class="bar" style="height: 85px;"></div>
                        <span>Mon</span>
                        <span class="bar-value">₹8.5K</span>
                    </div>
                    <div class="bar-group">
                        <div class="bar" style="height: 120px;"></div>
                        <span>Tue</span>
                        <span class="bar-value">₹12.2K</span>
                    </div>
                    <div class="bar-group">
                        <div class="bar" style="height: 70px;"></div>
                        <span>Wed</span>
                        <span class="bar-value">₹7.8K</span>
                    </div>
                    <div class="bar-group">
                        <div class="bar" style="height: 150px;"></div>
                        <span>Thu</span>
                        <span class="bar-value">₹15.4K</span>
                    </div>
                    <div class="bar-group">
                        <div class="bar" style="height: 200px;"></div>
                        <span>Fri</span>
                        <span class="bar-value">₹21.9K</span>
                    </div>
                    <div class="bar-group">
                        <div class="bar" style="height: 110px;"></div>
                        <span>Sat</span>
                        <span class="bar-value">₹11.3K</span>
                    </div>
                    <div class="bar-group">
                        <div class="bar" style="height: 60px;"></div>
                        <span>Sun</span>
                        <span class="bar-value">₹6.7K</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Quick Stats -->
        <div class="quick-stats">
            <div class="quick-stat-item">
                <div class="qs-icon" style="background: #DBEAFE; color: #2563EB;">
                    <i class="fas fa-users"></i>
                </div>
                <div class="qs-info">
                    <span class="qs-label">Total Customers</span>
                    <span class="qs-value" id="totalCustomers">3,478</span>
                    <span class="qs-trend up" id="customerTrend"><i class="fas fa-arrow-up"></i> 8.2%</span>
                </div>
            </div>
            <div class="quick-stat-item">
                <div class="qs-icon" style="background: #D1FAE5; color: #065F46;">
                    <i class="fas fa-boxes"></i>
                </div>
                <div class="qs-info">
                    <span class="qs-label">Products Sold</span>
                    <span class="qs-value" id="productsSold">865</span>
                    <span class="qs-trend up" id="productsTrend"><i class="fas fa-arrow-up"></i> 5.7%</span>
                </div>
            </div>
            <div class="quick-stat-item">
                <div class="qs-icon" style="background: #FEF3C7; color: #92400E;">
                    <i class="fas fa-star"></i>
                </div>
                <div class="qs-info">
                    <span class="qs-label">Avg. Rating</span>
                    <span class="qs-value" id="avgRating">4.7 ★</span>
                    <span class="qs-trend up" id="ratingTrend"><i class="fas fa-arrow-up"></i> 0.3%</span>
                </div>
            </div>
            <div class="quick-stat-item">
                <div class="qs-icon" style="background: #FEE2E2; color: #991B1B;">
                    <i class="fas fa-exclamation-triangle"></i>
                </div>
                <div class="qs-info">
                    <span class="qs-label">Low Stock Items</span>
                    <span class="qs-value" id="lowStockItems">15</span>
                    <span class="qs-trend down" id="stockTrend"><i class="fas fa-arrow-down"></i> Need restock</span>
                </div>
            </div>
        </div>
    </div>

    <!-- Row 4 - Top Selling & Recent Orders -->
    <div class="row-4-grid">
        <div class="top-selling">
            <h3>🏆 Top Selling Products</h3>
            <div class="product-rank" id="topProducts">
                <div class="rank-item">
                    <span class="rank">🥇</span>
                    <span class="product-name">Premium Wireless Headphones</span>
                    <span class="orders">342 Orders</span>
                    <span class="revenue">₹2,04,000</span>
                </div>
                <div class="rank-item">
                    <span class="rank">🥈</span>
                    <span class="product-name">Smartphone Stand Deluxe</span>
                    <span class="orders">287 Orders</span>
                    <span class="revenue">₹1,72,200</span>
                </div>
                <div class="rank-item">
                    <span class="rank">🥉</span>
                    <span class="product-name">Ergonomic Mouse Pad</span>
                    <span class="orders">245 Orders</span>
                    <span class="revenue">₹1,22,500</span>
                </div>
                <div class="rank-item">
                    <span class="rank">4️⃣</span>
                    <span class="product-name">USB-C Hub 5-in-1</span>
                    <span class="orders">198 Orders</span>
                    <span class="revenue">₹99,000</span>
                </div>
                <div class="rank-item">
                    <span class="rank">5️⃣</span>
                    <span class="product-name">Wireless Charging Pad</span>
                    <span class="orders">156 Orders</span>
                    <span class="revenue">₹78,000</span>
                </div>
            </div>
        </div>

        <div class="recent-orders">
            <h3>📋 Recent Orders</h3>
            <table>
                <thead>
                    <tr>
                        <th>Order ID</th>
                        <th>Customer</th>
                        <th>Amount</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody id="recentOrdersTable">
                    <tr>
                        <td><span class="order-id">#1024</span></td>
                        <td>Rajesh Kumar</td>
                        <td>₹1,200</td>
                        <td><span class="status-badge pending">Pending</span></td>
                        <td>
                            <button class="action-btn view"><i class="fas fa-eye"></i></button>
                            <button class="action-btn ship"><i class="fas fa-truck"></i></button>
                            <button class="action-btn invoice"><i class="fas fa-file-invoice"></i></button>
                        </td>
                    </tr>
                    <tr>
                        <td><span class="order-id">#1025</span></td>
                        <td>Priya Sharma</td>
                        <td>₹850</td>
                        <td><span class="status-badge shipped">Shipped</span></td>
                        <td>
                            <button class="action-btn view"><i class="fas fa-eye"></i></button>
                            <button class="action-btn ship"><i class="fas fa-truck"></i></button>
                            <button class="action-btn invoice"><i class="fas fa-file-invoice"></i></button>
                        </td>
                    </tr>
                    <tr>
                        <td><span class="order-id">#1026</span></td>
                        <td>Amit Verma</td>
                        <td>₹2,450</td>
                        <td><span class="status-badge delivered">Delivered</span></td>
                        <td>
                            <button class="action-btn view"><i class="fas fa-eye"></i></button>
                            <button class="action-btn ship"><i class="fas fa-truck"></i></button>
                            <button class="action-btn invoice"><i class="fas fa-file-invoice"></i></button>
                        </td>
                    </tr>
                    <tr>
                        <td><span class="order-id">#1027</span></td>
                        <td>Sneha Reddy</td>
                        <td>₹3,200</td>
                        <td><span class="status-badge awaiting">Awaiting Payment</span></td>
                        <td>
                            <button class="action-btn view"><i class="fas fa-eye"></i></button>
                            <button class="action-btn ship"><i class="fas fa-truck"></i></button>
                            <button class="action-btn invoice"><i class="fas fa-file-invoice"></i></button>
                        </td>
                    </tr>
                    <tr>
                        <td><span class="order-id">#1028</span></td>
                        <td>Vikram Singh</td>
                        <td>₹1,800</td>
                        <td><span class="status-badge cancelled">Cancelled</span></td>
                        <td>
                            <button class="action-btn view"><i class="fas fa-eye"></i></button>
                            <button class="action-btn ship"><i class="fas fa-truck"></i></button>
                            <button class="action-btn invoice"><i class="fas fa-file-invoice"></i></button>
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="table-footer">
                <span id="orderCount">Showing 5 of 1,250 orders</span>
                <button class="view-all-btn">View All Orders →</button>
            </div>
        </div>
    </div>

    <!-- Row 5 - Stock Alerts & Recent Activity -->
    <div class="row-5-grid">
        <div class="stock-alerts">
            <h3>⚠️ Stock Alerts</h3>
            <div id="stockAlertsList">
                <div class="alert-item danger">
                    <span class="alert-icon">🔴</span>
                    <span class="alert-product">Wireless Bluetooth Mouse</span>
                    <span class="alert-status danger">Only 3 Left</span>
                </div>
                <div class="alert-item warning">
                    <span class="alert-icon">🟡</span>
                    <span class="alert-product">Laptop Stand Pro</span>
                    <span class="alert-status warning">Only 2 Left</span>
                </div>
                <div class="alert-item danger">
                    <span class="alert-icon">🔴</span>
                    <span class="alert-product">Mechanical Gaming Keyboard</span>
                    <span class="alert-status danger">Out Of Stock</span>
                </div>
                <div class="alert-item warning">
                    <span class="alert-icon">🟡</span>
                    <span class="alert-product">Webcam HD 1080p</span>
                    <span class="alert-status warning">Only 5 Left</span>
                </div>
                <div class="alert-item success">
                    <span class="alert-icon">🟢</span>
                    <span class="alert-product">USB-C Cable 2M</span>
                    <span class="alert-status success">In Stock</span>
                </div>
            </div>
        </div>

        <div class="recent-activity">
            <h3>🔄 Recent Activity</h3>
            <div id="recentActivityList">
                <div class="activity-item">
                    <span class="time">10:20 AM</span>
                    <span class="action">Product Added: Wireless Mouse</span>
                    <span class="user">by Admin</span>
                </div>
                <div class="activity-item">
                    <span class="time">11:05 AM</span>
                    <span class="action">Order Received: #1024</span>
                    <span class="user">by Rajesh Kumar</span>
                </div>
                <div class="activity-item">
                    <span class="time">11:45 AM</span>
                    <span class="action">Customer Registered</span>
                    <span class="user">Priya Sharma</span>
                </div>
                <div class="activity-item">
                    <span class="time">12:10 PM</span>
                    <span class="action">Coupon Created: SUMMER25</span>
                    <span class="user">by Admin</span>
                </div>
                <div class="activity-item">
                    <span class="time">01:30 PM</span>
                    <span class="action">Order Shipped: #1025</span>
                    <span class="user">by Delivery Team</span>
                </div>
            </div>
        </div>
    </div>

    <!-- Row 6 - Order History -->
    <div class="order-history-section">
        <div class="history-header">
            <h3>📅 Order History</h3>
            <div class="history-filters">
                <button class="history-btn active" data-period="week" onclick="updateHistory('week')">Last Week</button>
                <button class="history-btn" data-period="month" onclick="updateHistory('month')">Last Month</button>
                <button class="history-btn" data-period="quarter" onclick="updateHistory('quarter')">Last 3 Months</button>
            </div>
        </div>
        <div class="history-grid" id="historyGrid">
            <div class="history-card">
                <div class="history-icon" style="background: #DBEAFE; color: #2563EB;">
                    <i class="fas fa-calendar-week"></i>
                </div>
                <div class="history-info">
                    <h4>Last Week Orders History</h4>
                    <div class="history-stats">
                        <span><strong>156</strong> Orders</span>
                        <span><strong>₹1,85,000</strong> Revenue</span>
                        <span><strong>+12%</strong> vs previous</span>
                    </div>
                </div>
            </div>
            <div class="history-card">
                <div class="history-icon" style="background: #D1FAE5; color: #065F46;">
                    <i class="fas fa-calendar-alt"></i>
                </div>
                <div class="history-info">
                    <h4>Last Month Orders History</h4>
                    <div class="history-stats">
                        <span><strong>845</strong> Orders</span>
                        <span><strong>₹9,45,000</strong> Revenue</span>
                        <span><strong>+8.5%</strong> vs previous</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <div class="dashboard-footer">
        <p>© 2026 E-Shop Admin Panel. All rights reserved.</p>
    </div>
</div>