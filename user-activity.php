<?php
$current_page = 'user-activity';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Activity - Admin Panel</title>
    <!-- Bootstrap 5 + Icons + Font Awesome -->
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
        <div class="bg-white border rounded-3 p-4 mb-4 d-flex flex-wrap justify-content-between align-items-center">
            <div>
                <h1 class="fs-4 fw-bold text-dark mb-0">User Activity</h1>
                <p class="text-secondary mb-0 small">Track real-time user actions and behaviors across your store</p>
            </div>
            <div class="d-flex gap-2 mt-2 mt-sm-0">
                <button class="btn btn-outline-primary btn-sm" id="refreshBtn">
                    <i class="fas fa-sync-alt me-1"></i> Refresh
                </button>
                <button class="btn btn-primary btn-sm" id="exportBtn">
                    <i class="fas fa-file-export me-1"></i> Export
                </button>
            </div>
        </div>

        <!-- FILTER SECTION -->
        <div class="bg-white border rounded-3 p-3 mb-4">
            <div class="d-flex flex-wrap gap-2" id="dateFilters">
                <button class="btn btn-outline-primary btn-sm active" data-filter="today">Today</button>
                <button class="btn btn-outline-primary btn-sm" data-filter="yesterday">Yesterday</button>
                <button class="btn btn-outline-primary btn-sm" data-filter="week">Last 7 Days</button>
                <button class="btn btn-outline-primary btn-sm" data-filter="month">Last 30 Days</button>
                <button class="btn btn-outline-primary btn-sm" data-filter="custom">Custom</button>
            </div>
        </div>

        <!-- KPI CARDS -->
        <div class="row g-3 mb-4">
            <div class="col-6 col-md-3 col-xl-2">
                <div class="bg-white border rounded-3 p-3 d-flex align-items-center gap-3 h-100">
                    <div class="bg-primary bg-opacity-10 text-primary rounded-3 d-flex align-items-center justify-content-center" style="width:44px;height:44px;"><i class="fas fa-eye fs-5"></i></div>
                    <div><h3 class="fs-4 fw-bold mb-0" id="viewsCount">1,247</h3><p class="text-secondary small mb-0">Views</p><span class="text-success small fw-semibold"><i class="fas fa-arrow-up"></i> 12%</span></div>
                </div>
            </div>
            <div class="col-6 col-md-3 col-xl-2">
                <div class="bg-white border rounded-3 p-3 d-flex align-items-center gap-3 h-100">
                    <div class="bg-warning bg-opacity-10 text-warning rounded-3 d-flex align-items-center justify-content-center" style="width:44px;height:44px;"><i class="fas fa-heart fs-5"></i></div>
                    <div><h3 class="fs-4 fw-bold mb-0" id="wishlistCount">342</h3><p class="text-secondary small mb-0">Wishlist</p><span class="text-success small fw-semibold"><i class="fas fa-arrow-up"></i> 18%</span></div>
                </div>
            </div>
            <div class="col-6 col-md-3 col-xl-2">
                <div class="bg-white border rounded-3 p-3 d-flex align-items-center gap-3 h-100">
                    <div class="bg-warning bg-opacity-10 text-warning rounded-3 d-flex align-items-center justify-content-center" style="width:44px;height:44px;"><i class="fas fa-shopping-cart fs-5"></i></div>
                    <div><h3 class="fs-4 fw-bold mb-0" id="cartsCount">456</h3><p class="text-secondary small mb-0">Carts</p><span class="text-success small fw-semibold"><i class="fas fa-arrow-up"></i> 8%</span></div>
                </div>
            </div>
            <div class="col-6 col-md-3 col-xl-2">
                <div class="bg-white border rounded-3 p-3 d-flex align-items-center gap-3 h-100">
                    <div class="bg-primary bg-opacity-10 text-primary rounded-3 d-flex align-items-center justify-content-center" style="width:44px;height:44px;"><i class="fas fa-check-circle fs-5"></i></div>
                    <div><h3 class="fs-4 fw-bold mb-0" id="checkoutCount">234</h3><p class="text-secondary small mb-0">Checkout</p><span class="text-danger small fw-semibold"><i class="fas fa-arrow-down"></i> 3%</span></div>
                </div>
            </div>
            <div class="col-6 col-md-3 col-xl-2">
                <div class="bg-white border rounded-3 p-3 d-flex align-items-center gap-3 h-100">
                    <div class="bg-success bg-opacity-10 text-success rounded-3 d-flex align-items-center justify-content-center" style="width:44px;height:44px;"><i class="fas fa-credit-card fs-5"></i></div>
                    <div><h3 class="fs-4 fw-bold mb-0" id="purchasesCount">189</h3><p class="text-secondary small mb-0">Purchases</p><span class="text-success small fw-semibold"><i class="fas fa-arrow-up"></i> 15%</span></div>
                </div>
            </div>
        </div>

        <!-- ABANDONED CARTS -->
        <div class="bg-white border rounded-3 p-4 mb-4">
            <div class="d-flex flex-wrap justify-content-between align-items-center mb-3">
                <h3 class="fs-5 fw-bold mb-0">Abandoned Carts</h3>
                <div class="d-flex gap-3 small text-secondary"><span>Total: <strong class="text-dark">12</strong></span><span>Potential Revenue: <strong class="text-dark">₹18,500</strong></span></div>
            </div>
            <div class="d-flex flex-column gap-3" id="abandonedCartsList">
                <div class="bg-light border rounded-3 p-3 d-flex flex-wrap align-items-center gap-3">
                    <div class="d-flex align-items-center gap-2"><span class="fs-4">👤</span><span class="fw-semibold">Janani</span></div>
                    <div class="d-flex flex-wrap gap-3 flex-grow-1"><span class="fw-bold text-primary">₹2,500</span><span class="text-secondary">3 Products</span><span class="text-secondary small">Last Seen: 15 mins ago</span></div>
                    <div class="d-flex gap-2">
                        <button class="btn btn-success btn-sm whatsapp-btn" data-user="Janani" data-amount="₹2,500"><i class="fab fa-whatsapp"></i></button>
                        <button class="btn btn-outline-primary btn-sm email-btn" data-user="Janani" data-amount="₹2,500"><i class="fas fa-envelope"></i></button>
                        <button class="btn btn-primary btn-sm recover-btn" data-user="Janani"><i class="fas fa-sync-alt me-1"></i>Recover</button>
                    </div>
                </div>
                <div class="bg-light border rounded-3 p-3 d-flex flex-wrap align-items-center gap-3">
                    <div class="d-flex align-items-center gap-2"><span class="fs-4">👤</span><span class="fw-semibold">Kumar</span></div>
                    <div class="d-flex flex-wrap gap-3 flex-grow-1"><span class="fw-bold text-primary">₹1,800</span><span class="text-secondary">2 Products</span><span class="text-secondary small">Last Seen: 1 hour ago</span></div>
                    <div class="d-flex gap-2">
                        <button class="btn btn-success btn-sm whatsapp-btn" data-user="Kumar" data-amount="₹1,800"><i class="fab fa-whatsapp"></i></button>
                        <button class="btn btn-outline-primary btn-sm email-btn" data-user="Kumar" data-amount="₹1,800"><i class="fas fa-envelope"></i></button>
                        <button class="btn btn-primary btn-sm recover-btn" data-user="Kumar"><i class="fas fa-sync-alt me-1"></i>Recover</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- TIMELINE -->
        <div class="bg-white border rounded-3 p-4 mb-4">
            <div class="d-flex flex-wrap justify-content-between align-items-center mb-3">
                <h3 class="fs-5 fw-bold mb-0"> Recent Customer Activities</h3>
                <span class="badge bg-primary bg-opacity-10 text-primary">Last 24 Hours</span>
            </div>
            <div class="d-flex flex-column gap-2" style="max-height:350px;overflow-y:auto;" id="timelineList">
                <div class="bg-light rounded-2 p-2 d-flex flex-wrap align-items-center gap-3"><span class="fs-6">🛒</span><span class="text-secondary small">10:20 AM</span><span>Janani added iPhone Case to Cart</span></div>
                <div class="bg-light rounded-2 p-2 d-flex flex-wrap align-items-center gap-3"><span class="fs-6">💳</span><span class="text-secondary small">10:35 AM</span><span>Janani started Checkout</span></div>
                <div class="bg-light rounded-2 p-2 d-flex flex-wrap align-items-center gap-3"><span class="fs-6">✅</span><span class="text-secondary small">10:38 AM</span><span>Janani completed Purchase #1024</span></div>
                <div class="bg-light rounded-2 p-2 d-flex flex-wrap align-items-center gap-3"><span class="fs-6">❤️</span><span class="text-secondary small">11:00 AM</span><span>Hari added Headphones to Wishlist</span></div>
                <div class="bg-light rounded-2 p-2 d-flex flex-wrap align-items-center gap-3"><span class="fs-6">👁</span><span class="text-secondary small">11:15 AM</span><span>Kumar viewed Samsung TV</span></div>
                <div class="bg-light rounded-2 p-2 d-flex flex-wrap align-items-center gap-3"><span class="fs-6">🔍</span><span class="text-secondary small">11:30 AM</span><span>Priya searched "Wireless Mouse"</span></div>
                <div class="bg-light rounded-2 p-2 d-flex flex-wrap align-items-center gap-3"><span class="fs-6">📝</span><span class="text-secondary small">11:45 AM</span><span>Arun registered new account</span></div>
                <div class="bg-light rounded-2 p-2 d-flex flex-wrap align-items-center gap-3"><span class="fs-6">🔑</span><span class="text-secondary small">12:00 PM</span><span>Janani logged in</span></div>
                <div class="bg-light rounded-2 p-2 d-flex flex-wrap align-items-center gap-3"><span class="fs-6">⭐</span><span class="text-secondary small">12:15 PM</span><span>Hari submitted 5★ review for Headphones</span></div>
                <div class="bg-light rounded-2 p-2 d-flex flex-wrap align-items-center gap-3"><span class="fs-6">📤</span><span class="text-secondary small">12:30 PM</span><span>Priya shared Product on Facebook</span></div>
            </div>
        </div>

        <!-- ACTIVITY TABLE -->
        <div class="bg-white border rounded-3 p-4 mb-4">
            <div class="d-flex flex-wrap justify-content-between align-items-center mb-3">
                <div><h3 class="fs-5 fw-bold mb-0">All Activities</h3><span class="text-secondary small">Customer actions only</span></div>
                <div class="d-flex flex-wrap gap-2">
                    <div class="position-relative"><i class="fas fa-search position-absolute top-50 start-0 translate-middle-y ms-3 text-secondary"></i><input type="text" id="activitySearch" class="form-control form-control-sm ps-5" placeholder="Search activities..." style="width:180px;"></div>
                    <select class="form-select form-select-sm" id="actionFilter" style="width:150px;">
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
                <table class="table table-hover table-sm" id="activityTable">
                    <thead class="table-light"><tr><th>#</th><th>User</th><th>Action</th><th>Details</th><th>Time</th><th>Status</th><th>Action</th></tr></thead>
                    <tbody id="activityTableBody">
                        <tr><td>1</td><td><strong>Janani</strong></td><td><span class="badge bg-warning bg-opacity-25 text-dark">🛒 Cart</span></td><td>iPhone Case</td><td>10:20 AM</td><td><span class="text-success">✅</span></td><td><button class="btn btn-outline-primary btn-sm view-btn"><i class="fas fa-eye"></i></button></td></tr>
                        <tr><td>2</td><td><strong>Hari</strong></td><td><span class="badge bg-warning bg-opacity-25 text-dark">❤️ Wishlist</span></td><td>Headphones</td><td>11:00 AM</td><td><span class="text-success">✅</span></td><td><button class="btn btn-outline-primary btn-sm view-btn"><i class="fas fa-eye"></i></button></td></tr>
                        <tr><td>3</td><td><strong>Kumar</strong></td><td><span class="badge bg-primary bg-opacity-10 text-primary">👁 View</span></td><td>Samsung TV</td><td>11:15 AM</td><td><span class="text-success">✅</span></td><td><button class="btn btn-outline-primary btn-sm view-btn"><i class="fas fa-eye"></i></button></td></tr>
                        <tr><td>4</td><td><strong>Priya</strong></td><td><span class="badge bg-primary bg-opacity-10 text-primary">🔍 Search</span></td><td>Wireless Mouse</td><td>11:30 AM</td><td><span class="text-success">✅</span></td><td><button class="btn btn-outline-primary btn-sm view-btn"><i class="fas fa-eye"></i></button></td></tr>
                        <tr><td>5</td><td><strong>Arun</strong></td><td><span class="badge bg-success bg-opacity-10 text-success">📝 Register</span></td><td>New Account</td><td>11:45 AM</td><td><span class="text-success">✅</span></td><td><button class="btn btn-outline-primary btn-sm view-btn"><i class="fas fa-eye"></i></button></td></tr>
                        <tr><td>6</td><td><strong>Janani</strong></td><td><span class="badge bg-success bg-opacity-10 text-success">🔑 Login</span></td><td>User Login</td><td>12:00 PM</td><td><span class="text-success">✅</span></td><td><button class="btn btn-outline-primary btn-sm view-btn"><i class="fas fa-eye"></i></button></td></tr>
                        <tr><td>7</td><td><strong>Hari</strong></td><td><span class="badge bg-warning bg-opacity-25 text-dark">⭐ Review</span></td><td>5★ for Headphones</td><td>12:15 PM</td><td><span class="text-success">✅</span></td><td><button class="btn btn-outline-primary btn-sm view-btn"><i class="fas fa-eye"></i></button></td></tr>
                        <tr><td>8</td><td><strong>Priya</strong></td><td><span class="badge bg-primary bg-opacity-10 text-primary">📤 Share</span></td><td>Facebook Share</td><td>12:30 PM</td><td><span class="text-success">✅</span></td><td><button class="btn btn-outline-primary btn-sm view-btn"><i class="fas fa-eye"></i></button></td></tr>
                    </tbody>
                </table>
            </div>
            <div class="d-flex flex-wrap justify-content-between align-items-center mt-3 pt-3 border-top">
                <span class="small text-secondary" id="entryInfo">Showing 1 to 8 of 156 entries</span>
                <div class="d-flex gap-1" id="paginationControls">
                    <button class="btn btn-outline-secondary btn-sm prev-page"><i class="fas fa-chevron-left"></i></button>
                    <button class="btn btn-primary btn-sm active page-btn" data-page="1">1</button>
                    <button class="btn btn-outline-secondary btn-sm page-btn" data-page="2">2</button>
                    <button class="btn btn-outline-secondary btn-sm page-btn" data-page="3">3</button>
                    <button class="btn btn-outline-secondary btn-sm page-btn" data-page="4">4</button>
                    <button class="btn btn-outline-secondary btn-sm page-btn" data-page="5">5</button>
                    <button class="btn btn-outline-secondary btn-sm next-page"><i class="fas fa-chevron-right"></i></button>
                </div>
            </div>
        </div>

    </div>

    <!-- Include Logout Modal -->
    <?php include 'logout-modal.php'; ?>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="assets/js/script.js"></script>

    <script>
    document.addEventListener('DOMContentLoaded', function() {
        // Export button - triggers download
        document.getElementById('exportBtn')?.addEventListener('click', function() {
            // Get table data
            const table = document.getElementById('activityTable');
            const rows = table.querySelectorAll('tbody tr');
            let csv = 'User,Action,Details,Time,Status\n';
            
            rows.forEach(row => {
                if (row.style.display !== 'none') {
                    const cells = row.querySelectorAll('td');
                    // Skip first column (#) and last column (Action button)
                    const user = cells[1]?.textContent?.trim() || '';
                    const action = cells[2]?.textContent?.trim() || '';
                    const details = cells[3]?.textContent?.trim() || '';
                    const time = cells[4]?.textContent?.trim() || '';
                    const status = cells[5]?.textContent?.trim() || '';
                    csv += `"${user}","${action}","${details}","${time}","${status}"\n`;
                }
            });

            // Create download
            const blob = new Blob([csv], { type: 'text/csv' });
            const url = window.URL.createObjectURL(blob);
            const a = document.createElement('a');
            a.href = url;
            a.download = 'user_activity_export.csv';
            document.body.appendChild(a);
            a.click();
            document.body.removeChild(a);
            window.URL.revokeObjectURL(url);

            // Show success toast/message
            const toast = document.createElement('div');
            toast.className = 'alert alert-success position-fixed bottom-0 end-0 m-3';
            toast.style.zIndex = '9999';
            toast.innerHTML = '<i class="fas fa-check-circle me-2"></i> Activity exported successfully!';
            document.body.appendChild(toast);
            setTimeout(() => toast.remove(), 3000);
        });

        // Refresh button
        document.getElementById('refreshBtn')?.addEventListener('click', function() {
            if (typeof refreshActivity === 'function') {
                refreshActivity();
            } else {
                const toast = document.createElement('div');
                toast.className = 'alert alert-info position-fixed bottom-0 end-0 m-3';
                toast.style.zIndex = '9999';
                toast.innerHTML = '<i class="fas fa-sync-alt me-2"></i> Activity refreshed!';
                document.body.appendChild(toast);
                setTimeout(() => toast.remove(), 2000);
            }
        });

        // Date filter buttons
        document.querySelectorAll('#dateFilters .btn').forEach(btn => {
            btn.addEventListener('click', function() {
                document.querySelectorAll('#dateFilters .btn').forEach(b => b.classList.remove('active'));
                this.classList.add('active');
                const filter = this.dataset.filter;
                if (typeof filterDate === 'function') {
                    filterDate(filter);
                } else {
                    const toast = document.createElement('div');
                    toast.className = 'alert alert-info position-fixed bottom-0 end-0 m-3';
                    toast.style.zIndex = '9999';
                    toast.innerHTML = '<i class="fas fa-filter me-2"></i> Filter: ' + filter;
                    document.body.appendChild(toast);
                    setTimeout(() => toast.remove(), 2000);
                }
            });
        });

        // WhatsApp buttons
        document.querySelectorAll('.whatsapp-btn').forEach(btn => {
            btn.addEventListener('click', function() {
                const user = this.dataset.user;
                const amount = this.dataset.amount;
                if (typeof sendWhatsApp === 'function') {
                    sendWhatsApp(user, amount);
                } else {
                    alert('WhatsApp to ' + user + ' for ' + amount);
                }
            });
        });

        // Email buttons
        document.querySelectorAll('.email-btn').forEach(btn => {
            btn.addEventListener('click', function() {
                const user = this.dataset.user;
                const amount = this.dataset.amount;
                if (typeof sendEmail === 'function') {
                    sendEmail(user, amount);
                } else {
                    alert('Email to ' + user + ' for ' + amount);
                }
            });
        });

        // Recover buttons
        document.querySelectorAll('.recover-btn').forEach(btn => {
            btn.addEventListener('click', function() {
                const user = this.dataset.user;
                if (typeof recoverCart === 'function') {
                    recoverCart(user);
                } else {
                    alert('Recovering cart for ' + user);
                }
            });
        });

        // Search functionality
        document.getElementById('activitySearch')?.addEventListener('keyup', function() {
            const searchTerm = this.value.toLowerCase();
            const rows = document.querySelectorAll('#activityTableBody tr');
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
            document.getElementById('entryInfo').textContent = 'Showing 1 to ' + visibleCount + ' of ' + rows.length + ' entries';
        });

        // Action filter
        document.getElementById('actionFilter')?.addEventListener('change', function() {
            const filter = this.value;
            const rows = document.querySelectorAll('#activityTableBody tr');
            let visibleCount = 0;
            rows.forEach(row => {
                const actionBadge = row.querySelector('.badge');
                if (actionBadge) {
                    const actionText = actionBadge.textContent.trim();
                    if (filter === 'all' || actionText.includes(filter)) {
                        row.style.display = '';
                        visibleCount++;
                    } else {
                        row.style.display = 'none';
                    }
                }
            });
            document.getElementById('entryInfo').textContent = 'Showing 1 to ' + visibleCount + ' of ' + rows.length + ' entries';
        });

        // View buttons
        document.querySelectorAll('.view-btn').forEach(btn => {
            btn.addEventListener('click', function() {
                const row = this.closest('tr');
                const user = row.querySelector('td:nth-child(2)')?.textContent?.trim() || 'User';
                const details = row.querySelector('td:nth-child(4)')?.textContent?.trim() || '';
                if (typeof viewActivity === 'function') {
                    viewActivity(user, details);
                } else {
                    alert('Viewing activity for: ' + user + ' - ' + details);
                }
            });
        });

        // Pagination
        document.querySelectorAll('.page-btn').forEach(btn => {
            btn.addEventListener('click', function() {
                document.querySelectorAll('.page-btn').forEach(b => b.classList.remove('active'));
                this.classList.add('active');
                const page = this.dataset.page;
                if (typeof goToPage === 'function') {
                    goToPage(page);
                } else {
                    alert('Go to page ' + page);
                }
            });
        });

        document.querySelector('.prev-page')?.addEventListener('click', function() {
            if (typeof prevPage === 'function') {
                prevPage();
            } else {
                alert('Previous page');
            }
        });

        document.querySelector('.next-page')?.addEventListener('click', function() {
            if (typeof nextPage === 'function') {
                nextPage();
            } else {
                alert('Next page');
            }
        });
    });
    </script>
</body>
</html>