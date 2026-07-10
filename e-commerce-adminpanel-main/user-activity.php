<?php
$current_page = 'user-activity';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Activity - Admin Panel</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/style.css">
   
</head>
<body>
    <?php include 'templates/navbar.php'; ?>
     <?php include 'templates/sidebar.php'; ?>
    
    <div class="content-area">
        <!-- Page Header -->
        <div class="page-header">
            <div class="header-left">
                <h1>👥 User Activity</h1>
                <p>Track real-time user actions and behaviors across your store</p>
            </div>
            <div class="header-right">
                <button class="btn-refresh" onclick="refreshActivity()">
                    <i class="fas fa-sync-alt"></i> Refresh
                </button>
                <button class="btn-export" onclick="exportActivity()">
                    <i class="fas fa-file-export"></i> Export
                </button>
            </div>
        </div>

        <!-- ============================================ -->
        <!-- SECTION 1: DATE FILTERS                      -->
        <!-- ============================================ -->
        <div class="filter-section">
            <div class="date-filters">
                <button class="filter-btn active" onclick="filterDate('today')">Today</button>
                <button class="filter-btn" onclick="filterDate('yesterday')">Yesterday</button>
                <button class="filter-btn" onclick="filterDate('week')">Last 7 Days</button>
                <button class="filter-btn" onclick="filterDate('month')">Last 30 Days</button>
                <button class="filter-btn" onclick="filterDate('custom')">Custom</button>
            </div>
        </div>

        <!-- ============================================ -->
        <!-- SECTION 2: KPI CARDS (5 Cards)               -->
        <!-- ============================================ -->
        <div class="kpi-grid">
            <div class="kpi-card">
                <div class="kpi-icon" style="background: #DBEAFE; color: #2563EB;">
                    <i class="fas fa-eye"></i>
                </div>
                <div class="kpi-info">
                    <h3 id="viewsCount">1,247</h3>
                    <p>Views</p>
                    <span class="trend up"><i class="fas fa-arrow-up"></i> 12%</span>
                </div>
            </div>
            <div class="kpi-card">
                <div class="kpi-icon" style="background: #FEF3C7; color: #F59E0B;">
                    <i class="fas fa-heart"></i>
                </div>
                <div class="kpi-info">
                    <h3 id="wishlistCount">342</h3>
                    <p>Wishlist</p>
                    <span class="trend up"><i class="fas fa-arrow-up"></i> 18%</span>
                </div>
            </div>
            <div class="kpi-card">
                <div class="kpi-icon" style="background: #FEF3C7; color: #F59E0B;">
                    <i class="fas fa-shopping-cart"></i>
                </div>
                <div class="kpi-info">
                    <h3 id="cartsCount">456</h3>
                    <p>Carts</p>
                    <span class="trend up"><i class="fas fa-arrow-up"></i> 8%</span>
                </div>
            </div>
            <div class="kpi-card">
                <div class="kpi-icon" style="background: #DBEAFE; color: #2563EB;">
                    <i class="fas fa-check-circle"></i>
                </div>
                <div class="kpi-info">
                    <h3 id="checkoutCount">234</h3>
                    <p>Checkout</p>
                    <span class="trend down"><i class="fas fa-arrow-down"></i> 3%</span>
                </div>
            </div>
            <div class="kpi-card">
                <div class="kpi-icon" style="background: #D1FAE5; color: #10B981;">
                    <i class="fas fa-credit-card"></i>
                </div>
                <div class="kpi-info">
                    <h3 id="purchasesCount">189</h3>
                    <p>Purchases</p>
                    <span class="trend up"><i class="fas fa-arrow-up"></i> 15%</span>
                </div>
            </div>
        </div>

        <!-- ============================================ -->
        <!-- SECTION 3: CONVERSION FUNNEL                -->
        <!-- ============================================ -->
        <div class="funnel-section">
            <div class="funnel-header">
                <h3>📊 Conversion Funnel</h3>
                <span class="funnel-date">Last 30 Days</span>
            </div>
            <div class="funnel-container">
                <div class="funnel-item">
                    <div class="funnel-label">
                        <span>Visitors</span>
                        <span class="funnel-count">1,000</span>
                        <span class="funnel-drop">(-0)</span>
                    </div>
                    <div class="funnel-bar">
                        <div class="funnel-progress" style="width: 100%; background: #2563EB;"></div>
                    </div>
                </div>
                <div class="funnel-item">
                    <div class="funnel-label">
                        <span>Views</span>
                        <span class="funnel-count">750</span>
                        <span class="funnel-drop">(-250)</span>
                    </div>
                    <div class="funnel-bar">
                        <div class="funnel-progress" style="width: 75%; background: #60A5FA;"></div>
                    </div>
                </div>
                <div class="funnel-item">
                    <div class="funnel-label">
                        <span>Cart</span>
                        <span class="funnel-count">300</span>
                        <span class="funnel-drop">(-450)</span>
                    </div>
                    <div class="funnel-bar">
                        <div class="funnel-progress" style="width: 40%; background: #F59E0B;"></div>
                    </div>
                </div>
                <div class="funnel-item">
                    <div class="funnel-label">
                        <span>Checkout</span>
                        <span class="funnel-count">180</span>
                        <span class="funnel-drop">(-120)</span>
                    </div>
                    <div class="funnel-bar">
                        <div class="funnel-progress" style="width: 24%; background: #F59E0B;"></div>
                    </div>
                </div>
                <div class="funnel-item">
                    <div class="funnel-label">
                        <span>Purchase</span>
                        <span class="funnel-count">120</span>
                        <span class="funnel-drop">(-60)</span>
                    </div>
                    <div class="funnel-bar">
                        <div class="funnel-progress" style="width: 16%; background: #10B981;"></div>
                    </div>
                </div>
            </div>
            <div class="funnel-stats">
                <span>View → Cart: <strong>40%</strong></span>
                <span>Cart → Checkout: <strong>60%</strong></span>
                <span>Checkout → Purchase: <strong>67%</strong></span>
            </div>
            <div class="funnel-exit">
                <span>📍 Top Exit Page: <strong>/Product/iPhone15</strong></span>
                <span>Exit Rate: <strong class="text-danger">42%</strong></span>
            </div>
        </div>

        <!-- ============================================ -->
        <!-- SECTION 4: LIVE ACTIVITY + ACTIVE USERS     -->
        <!-- ============================================ -->
        <div class="live-activity-row">
            <div class="live-feed">
                <div class="live-header">
                    <h3><span class="live-dot"></span> Live Activity Feed</h3>
                    <span class="live-badge">Live</span>
                </div>
                <div class="live-items" id="liveFeed">
                    <div class="live-item">
                        <span class="live-icon">🛒</span>
                        <span class="live-action">10:20 AM - Janani added iPhone Case to Cart</span>
                    </div>
                    <div class="live-item">
                        <span class="live-icon">💳</span>
                        <span class="live-action">10:35 AM - Janani started Checkout</span>
                    </div>
                    <div class="live-item">
                        <span class="live-icon">✅</span>
                        <span class="live-action">10:38 AM - Janani completed Purchase #1024</span>
                    </div>
                    <div class="live-item">
                        <span class="live-icon">❤️</span>
                        <span class="live-action">11:00 AM - Hari added Headphones to Wishlist</span>
                    </div>
                    <div class="live-item">
                        <span class="live-icon">👁</span>
                        <span class="live-action">11:15 AM - Kumar viewed Samsung TV</span>
                    </div>
                </div>
            </div>
            <div class="active-users">
                <div class="active-header">
                    <h3><span class="active-dot"></span> Active Users Now</h3>
                    <span class="active-count">12 Online</span>
                </div>
                <div class="active-list">
                    <div class="active-item">
                        <span class="user-avatar">👤</span>
                        <span>Hari - Viewing Product</span>
                    </div>
                    <div class="active-item">
                        <span class="user-avatar">👤</span>
                        <span>Janani - Checkout Page</span>
                    </div>
                    <div class="active-item">
                        <span class="user-avatar">👤</span>
                        <span>Kumar - Added To Cart</span>
                    </div>
                    <div class="active-item">
                        <span class="user-avatar">👤</span>
                        <span>Priya - Browsing Category</span>
                    </div>
                    <div class="active-item">
                        <span class="user-avatar">👤</span>
                        <span>Arun - Payment Page</span>
                    </div>
                </div>
            </div>
        </div>

      

        <!-- ============================================ -->
<!-- SECTION 6: ABANDONED CARTS                   -->
<!-- ============================================ -->
<div class="abandoned-section">
    <div class="abandoned-header">
        <h3>🛒 Abandoned Carts</h3>
        <div class="abandoned-stats">
            <span>Total: <strong>12</strong></span>
            <span>Potential Revenue: <strong>₹18,500</strong></span>
        </div>
    </div>
    <div class="abandoned-list">
        <!-- Janani Card -->
        <div class="abandoned-card">
            <div class="cart-user">
                <span class="user-icon">👤</span>
                <span class="user-name">Janani</span>
            </div>
            <div class="cart-details">
                <span class="cart-amount">₹2,500</span>
                <span class="cart-items">3 Products</span>
                <span class="cart-time">Last Seen: 15 mins ago</span>
            </div>
            <div class="cart-actions">
                <button class="btn-whatsapp" onclick="sendWhatsApp('Janani', '₹2,500')">
                    <i class="fab fa-whatsapp"></i>
                </button>
                <button class="btn-email" onclick="sendEmail('Janani', '₹2,500')">
                    <i class="fas fa-envelope"></i>
                </button>
                <button class="btn-recover" onclick="recoverCart('Janani')">
                    <i class="fas fa-sync-alt"></i> Recover
                </button>
            </div>
        </div>

        <!-- Kumar Card -->
        <div class="abandoned-card">
            <div class="cart-user">
                <span class="user-icon">👤</span>
                <span class="user-name">Kumar</span>
            </div>
            <div class="cart-details">
                <span class="cart-amount">₹1,800</span>
                <span class="cart-items">2 Products</span>
                <span class="cart-time">Last Seen: 1 hour ago</span>
            </div>
            <div class="cart-actions">
                <button class="btn-whatsapp" onclick="sendWhatsApp('Kumar', '₹1,800')">
                    <i class="fab fa-whatsapp"></i>
                </button>
                <button class="btn-email" onclick="sendEmail('Kumar', '₹1,800')">
                    <i class="fas fa-envelope"></i>
                </button>
                <button class="btn-recover" onclick="recoverCart('Kumar')">
                    <i class="fas fa-sync-alt"></i> Recover
                </button>
            </div>
        </div>
    </div>
</div>

        <!-- ============================================ -->
        <!-- SECTION 7: RECENT ACTIVITY TIMELINE          -->
        <!-- ============================================ -->
        <div class="timeline-section">
            <div class="timeline-header">
                <h3>🔥 Recent Customer Activities</h3>
                <span class="timeline-badge">Last 24 Hours</span>
            </div>
            <div class="timeline-list">
                <div class="timeline-item">
                    <span class="tl-icon">🛒</span>
                    <span class="tl-time">10:20 AM</span>
                    <span class="tl-action">Janani added iPhone Case to Cart</span>
                </div>
                <div class="timeline-item">
                    <span class="tl-icon">💳</span>
                    <span class="tl-time">10:35 AM</span>
                    <span class="tl-action">Janani started Checkout</span>
                </div>
                <div class="timeline-item">
                    <span class="tl-icon">✅</span>
                    <span class="tl-time">10:38 AM</span>
                    <span class="tl-action">Janani completed Purchase #1024</span>
                </div>
                <div class="timeline-item">
                    <span class="tl-icon">❤️</span>
                    <span class="tl-time">11:00 AM</span>
                    <span class="tl-action">Hari added Headphones to Wishlist</span>
                </div>
                <div class="timeline-item">
                    <span class="tl-icon">👁</span>
                    <span class="tl-time">11:15 AM</span>
                    <span class="tl-action">Kumar viewed Samsung TV</span>
                </div>
                <div class="timeline-item">
                    <span class="tl-icon">🔍</span>
                    <span class="tl-time">11:30 AM</span>
                    <span class="tl-action">Priya searched "Wireless Mouse"</span>
                </div>
                <div class="timeline-item">
                    <span class="tl-icon">📝</span>
                    <span class="tl-time">11:45 AM</span>
                    <span class="tl-action">Arun registered new account</span>
                </div>
                <div class="timeline-item">
                    <span class="tl-icon">🔑</span>
                    <span class="tl-time">12:00 PM</span>
                    <span class="tl-action">Janani logged in</span>
                </div>
                <div class="timeline-item">
                    <span class="tl-icon">⭐</span>
                    <span class="tl-time">12:15 PM</span>
                    <span class="tl-action">Hari submitted 5★ review for Headphones</span>
                </div>
                <div class="timeline-item">
                    <span class="tl-icon">📤</span>
                    <span class="tl-time">12:30 PM</span>
                    <span class="tl-action">Priya shared Product on Facebook</span>
                </div>
            </div>
        </div>

        <!-- ============================================ -->
        <!-- SECTION 8: ACTIVITY TABLE                   -->
        <!-- ============================================ -->
        <div class="table-section">
            <div class="table-header">
                <div class="table-left">
                    <h3>📋 All Activities</h3>
                    <span class="table-subtitle">Customer actions only</span>
                </div>
                <div class="table-right">
                    <div class="search-box">
                        <i class="fas fa-search"></i>
                        <input type="text" id="activitySearch" placeholder="Search activities..." onkeyup="searchActivity()">
                    </div>
                    <select class="action-filter" id="actionFilter" onchange="filterAction()">
                        <option value="all">All Actions</option>
                        <option value="cart">🛒 Cart</option>
                        <option value="wishlist">❤️ Wishlist</option>
                        <option value="view">👁 View</option>
                        <option value="search">🔍 Search</option>
                        <option value="register">📝 Register</option>
                        <option value="login">🔑 Login</option>
                        <option value="review">⭐ Review</option>
                        <option value="share">📤 Share</option>
                        <option value="checkout">💳 Checkout</option>
                        <option value="purchase">✅ Purchase</option>
                    </select>
                </div>
            </div>
            <div class="table-responsive">
                <table class="activity-table" id="activityTable">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>User</th>
                            <th>Action</th>
                            <th>Details</th>
                            <th>Time</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody id="activityTableBody">
                        <tr>
                            <td>1</td>
                            <td><strong>Janani</strong></td>
                            <td><span class="action-badge cart">🛒 Cart</span></td>
                            <td>iPhone Case</td>
                            <td>10:20 AM</td>
                            <td><span class="status-badge success">✅</span></td>
                            <td><button class="action-btn view"><i class="fas fa-eye"></i></button></td>
                        </tr>
                        <tr>
                            <td>2</td>
                            <td><strong>Hari</strong></td>
                            <td><span class="action-badge wishlist">❤️ Wishlist</span></td>
                            <td>Headphones</td>
                            <td>11:00 AM</td>
                            <td><span class="status-badge success">✅</span></td>
                            <td><button class="action-btn view"><i class="fas fa-eye"></i></button></td>
                        </tr>
                        <tr>
                            <td>3</td>
                            <td><strong>Kumar</strong></td>
                            <td><span class="action-badge view">👁 View</span></td>
                            <td>Samsung TV</td>
                            <td>11:15 AM</td>
                            <td><span class="status-badge success">✅</span></td>
                            <td><button class="action-btn view"><i class="fas fa-eye"></i></button></td>
                        </tr>
                        <tr>
                            <td>4</td>
                            <td><strong>Priya</strong></td>
                            <td><span class="action-badge search">🔍 Search</span></td>
                            <td>Wireless Mouse</td>
                            <td>11:30 AM</td>
                            <td><span class="status-badge success">✅</span></td>
                            <td><button class="action-btn view"><i class="fas fa-eye"></i></button></td>
                        </tr>
                        <tr>
                            <td>5</td>
                            <td><strong>Arun</strong></td>
                            <td><span class="action-badge register">📝 Register</span></td>
                            <td>New Account</td>
                            <td>11:45 AM</td>
                            <td><span class="status-badge success">✅</span></td>
                            <td><button class="action-btn view"><i class="fas fa-eye"></i></button></td>
                        </tr>
                        <tr>
                            <td>6</td>
                            <td><strong>Janani</strong></td>
                            <td><span class="action-badge login">🔑 Login</span></td>
                            <td>User Login</td>
                            <td>12:00 PM</td>
                            <td><span class="status-badge success">✅</span></td>
                            <td><button class="action-btn view"><i class="fas fa-eye"></i></button></td>
                        </tr>
                        <tr>
                            <td>7</td>
                            <td><strong>Hari</strong></td>
                            <td><span class="action-badge review">⭐ Review</span></td>
                            <td>5★ for Headphones</td>
                            <td>12:15 PM</td>
                            <td><span class="status-badge success">✅</span></td>
                            <td><button class="action-btn view"><i class="fas fa-eye"></i></button></td>
                        </tr>
                        <tr>
                            <td>8</td>
                            <td><strong>Priya</strong></td>
                            <td><span class="action-badge share">📤 Share</span></td>
                            <td>Facebook Share</td>
                            <td>12:30 PM</td>
                            <td><span class="status-badge success">✅</span></td>
                            <td><button class="action-btn view"><i class="fas fa-eye"></i></button></td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="table-footer">
                <div class="footer-left">
                    <span id="entryInfo">Showing 1 to 8 of 156 entries</span>
                </div>
                <div class="footer-right">
                    <button class="pagination-btn" onclick="prevPage()"><i class="fas fa-chevron-left"></i></button>
                    <button class="pagination-btn active" onclick="goToPage(1)">1</button>
                    <button class="pagination-btn" onclick="goToPage(2)">2</button>
                    <button class="pagination-btn" onclick="goToPage(3)">3</button>
                    <button class="pagination-btn" onclick="goToPage(4)">4</button>
                    <button class="pagination-btn" onclick="goToPage(5)">5</button>
                    <button class="pagination-btn" onclick="nextPage()"><i class="fas fa-chevron-right"></i></button>
                </div>
            </div>
        </div>

        

       
    </div>


    <!-- Include Logout Modal -->
    <?php include 'templates/modal/logout-modal.php'; ?>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="assets/js/script.js"></script>
   
</body>
</html>