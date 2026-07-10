<?php
$current_page = 'settings';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Settings - Admin Panel</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../assets/css/style.css">
</head>

<body>
    <?php include ('templates/navbar.php'); ?>
   <?php include('templates/sidebar.php'); ?>

    <div class="content-area">
        <div class="settings-container bg-white border rounded-4 overflow-hidden">
            <!-- Header -->
            <div class="settings-header p-4 border-bottom">
                <h1 class="fs-4 fw-bold text-dark mb-0">⚙️ Settings</h1>
                <p class="text-secondary small mb-0">Manage your store configuration</p>
            </div>

            <!-- Tab Buttons -->
            <div class="tab-bar d-flex gap-1 px-4 pt-3 bg-white border-bottom flex-wrap">
                <button class="tab-btn btn btn-primary btn-sm active" data-tab="general" onclick="switchTab('general')">
                    <i class="fas fa-cog"></i> <span>General</span>
                </button>
                <button class="tab-btn btn btn-outline-secondary btn-sm" data-tab="commerce" onclick="switchTab('commerce')">
                    <i class="fas fa-shopping-cart"></i> <span>Commerce</span>
                </button>
                <button class="tab-btn btn btn-outline-secondary btn-sm" data-tab="staff" onclick="switchTab('staff')">
                    <i class="fas fa-users"></i> <span>Staff</span>
                </button>
                <button class="tab-btn btn btn-outline-secondary btn-sm" data-tab="marketing" onclick="switchTab('marketing')">
                    <i class="fas fa-bullhorn"></i> <span>Marketing</span>
                </button>
                <button class="tab-btn btn btn-outline-secondary btn-sm" data-tab="website" onclick="switchTab('website')">
                    <i class="fas fa-globe"></i> <span>Website</span>
                </button>
            </div>

           <!-- Tab Content -->
            <div class="tab-content p-4 bg-light" style="min-height:350px;">

                <!-- ========================================================== -->
                <!-- TAB 1: GENERAL                                             -->
                <!-- ========================================================== -->
                <div class="tab-pane active" id="tab-general">
                    <div class="section-title fs-5 fw-bold text-dark pb-2 mb-3 border-bottom">⚙️ General</div>
                    <div class="settings-grid row g-3">
                        <div class="col-md-6">
                            <div class="settings-card bg-white p-3 rounded-3 border d-flex align-items-start gap-3 cursor-pointer" onclick="window.location.href='system-preference.php'">
                                <div class="card-icon bg-primary bg-opacity-10 text-primary rounded-3 d-flex align-items-center justify-content-center flex-shrink-0" style="width:44px;height:44px;"><i class="fas fa-globe-americas fs-5"></i></div>
                                <div class="card-body flex-grow-1">
                                    <h4 class="fs-6 fw-semibold text-dark mb-1">🌐 System Preference</h4>
                                    <p class="small text-secondary mb-1">Manage your store's language, currency, timezone, and regional preferences.</p>
                                    <span class="card-link text-primary fw-semibold text-decoration-none small d-inline-flex align-items-center gap-1">Configure Settings <i class="fas fa-arrow-right fs-6"></i></span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="settings-card bg-white p-3 rounded-3 border d-flex align-items-start gap-3 cursor-pointer" onclick="window.location.href='store-information.php'">
                                <div class="card-icon bg-primary bg-opacity-10 text-primary rounded-3 d-flex align-items-center justify-content-center flex-shrink-0" style="width:44px;height:44px;"><i class="fas fa-store fs-5"></i></div>
                                <div class="card-body flex-grow-1">
                                    <h4 class="fs-6 fw-semibold text-dark mb-1">🏪 Store Information</h4>
                                    <p class="small text-secondary mb-1">Update your store details including name, contact, address, and branding.</p>
                                    <span class="card-link text-primary fw-semibold text-decoration-none small d-inline-flex align-items-center gap-1">Manage Store <i class="fas fa-arrow-right fs-6"></i></span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="settings-card bg-white p-3 rounded-3 border d-flex align-items-start gap-3 cursor-pointer" onclick="window.location.href='account-overview.php'">
                                <div class="card-icon bg-primary bg-opacity-10 text-primary rounded-3 d-flex align-items-center justify-content-center flex-shrink-0" style="width:44px;height:44px;"><i class="fas fa-user-circle fs-5"></i></div>
                                <div class="card-body flex-grow-1">
                                    <h4 class="fs-6 fw-semibold text-dark mb-1">👤 Account Overview</h4>
                                    <p class="small text-secondary mb-1">View account status, balance, upgrade options, and visibility settings.</p>
                                    <span class="card-link text-primary fw-semibold text-decoration-none small d-inline-flex align-items-center gap-1">View Account <i class="fas fa-arrow-right fs-6"></i></span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="settings-card bg-white p-3 rounded-3 border d-flex align-items-start gap-3 cursor-pointer" onclick="window.location.href='notifications.php'">
                                <div class="card-icon bg-primary bg-opacity-10 text-primary rounded-3 d-flex align-items-center justify-content-center flex-shrink-0" style="width:44px;height:44px;"><i class="fas fa-bell fs-5"></i></div>
                                <div class="card-body flex-grow-1">
                                    <h4 class="fs-6 fw-semibold text-dark mb-1">🔔 Notifications</h4>
                                    <p class="small text-secondary mb-1">Manage push notifications, email alerts, and subscription preferences.</p>
                                    <span class="card-link text-primary fw-semibold text-decoration-none small d-inline-flex align-items-center gap-1">Manage Notifications <i class="fas fa-arrow-right fs-6"></i></span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="settings-card bg-white p-3 rounded-3 border d-flex align-items-start gap-3 cursor-pointer" onclick="window.location.href='account-visibility.php'">
                                <div class="card-icon bg-primary bg-opacity-10 text-primary rounded-3 d-flex align-items-center justify-content-center flex-shrink-0" style="width:44px;height:44px;"><i class="fas fa-eye fs-5"></i></div>
                                <div class="card-body flex-grow-1">
                                    <h4 class="fs-6 fw-semibold text-dark mb-1">👀 Account Visibility</h4>
                                    <p class="small text-secondary mb-1">Control who can see your account and profile information.</p>
                                    <span class="card-link text-primary fw-semibold text-decoration-none small d-inline-flex align-items-center gap-1">Manage Visibility <i class="fas fa-arrow-right fs-6"></i></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- ========================================================== -->
                <!-- TAB 2: COMMERCE                                             -->
                <!-- ========================================================== -->
                <div class="tab-pane" id="tab-commerce">
                    <div class="section-title fs-5 fw-bold text-dark pb-2 mb-3 border-bottom">💳 Commerce</div>
                    <div class="settings-grid row g-3">
                        <div class="col-md-6">
                            <div class="settings-card bg-white p-3 rounded-3 border d-flex align-items-start gap-3 cursor-pointer" onclick="window.location.href='payments.php'">
                                <div class="card-icon bg-primary bg-opacity-10 text-primary rounded-3 d-flex align-items-center justify-content-center flex-shrink-0" style="width:44px;height:44px;"><i class="fas fa-credit-card fs-5"></i></div>
                                <div class="card-body flex-grow-1">
                                    <h4 class="fs-6 fw-semibold text-dark mb-1">💳 Payments</h4>
                                    <p class="small text-secondary mb-1">Configure payment gateways and manage how customers pay for orders.</p>
                                    <span class="card-link text-primary fw-semibold text-decoration-none small d-inline-flex align-items-center gap-1">Manage Payments <i class="fas fa-arrow-right fs-6"></i></span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="settings-card bg-white p-3 rounded-3 border d-flex align-items-start gap-3 cursor-pointer" onclick="window.location.href='taxes.php'">
                                <div class="card-icon bg-primary bg-opacity-10 text-primary rounded-3 d-flex align-items-center justify-content-center flex-shrink-0" style="width:44px;height:44px;"><i class="fas fa-receipt fs-5"></i></div>
                                <div class="card-body flex-grow-1">
                                    <h4 class="fs-6 fw-semibold text-dark mb-1">🧾 Taxes</h4>
                                    <p class="small text-secondary mb-1">Set up tax rules, GST settings, and regional tax configurations.</p>
                                    <span class="card-link text-primary fw-semibold text-decoration-none small d-inline-flex align-items-center gap-1">Configure Taxes <i class="fas fa-arrow-right fs-6"></i></span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="settings-card bg-white p-3 rounded-3 border d-flex align-items-start gap-3 cursor-pointer" onclick="window.location.href='locations.php'">
                                <div class="card-icon bg-primary bg-opacity-10 text-primary rounded-3 d-flex align-items-center justify-content-center flex-shrink-0" style="width:44px;height:44px;"><i class="fas fa-map-marker-alt fs-5"></i></div>
                                <div class="card-body flex-grow-1">
                                    <h4 class="fs-6 fw-semibold text-dark mb-1">📍 Locations</h4>
                                    <p class="small text-secondary mb-1">Manage warehouse, pickup, and store locations used for fulfillment.</p>
                                    <span class="card-link text-primary fw-semibold text-decoration-none small d-inline-flex align-items-center gap-1">Manage Locations <i class="fas fa-arrow-right fs-6"></i></span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="settings-card bg-white p-3 rounded-3 border d-flex align-items-start gap-3 cursor-pointer" onclick="window.location.href='delivery-method.php'">
                                <div class="card-icon bg-primary bg-opacity-10 text-primary rounded-3 d-flex align-items-center justify-content-center flex-shrink-0" style="width:44px;height:44px;"><i class="fas fa-truck fs-5"></i></div>
                                <div class="card-body flex-grow-1">
                                    <h4 class="fs-6 fw-semibold text-dark mb-1">🚚 Delivery Method</h4>
                                    <p class="small text-secondary mb-1">Configure shipping methods, delivery charges, and service areas.</p>
                                    <span class="card-link text-primary fw-semibold text-decoration-none small d-inline-flex align-items-center gap-1">Manage Delivery <i class="fas fa-arrow-right fs-6"></i></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- ========================================================== -->
                <!-- TAB 3: STAFF                                                -->
                <!-- ========================================================== -->
                <div class="tab-pane" id="tab-staff">
                    <div class="section-title fs-5 fw-bold text-dark pb-2 mb-3 border-bottom">👥 Staff</div>
                    <div class="settings-grid row g-3">
                        <div class="col-md-6">
                            <div class="settings-card bg-white p-3 rounded-3 border d-flex align-items-start gap-3 cursor-pointer" onclick="window.location.href='staff-management.php'">
                                <div class="card-icon bg-primary bg-opacity-10 text-primary rounded-3 d-flex align-items-center justify-content-center flex-shrink-0" style="width:44px;height:44px;"><i class="fas fa-user-tie fs-5"></i></div>
                                <div class="card-body flex-grow-1">
                                    <h4 class="fs-6 fw-semibold text-dark mb-1">👨‍💼 Staff Management</h4>
                                    <p class="small text-secondary mb-1">Control staff access, permissions, and administrative roles.</p>
                                    <span class="card-link text-primary fw-semibold text-decoration-none small d-inline-flex align-items-center gap-1">Manage Team <i class="fas fa-arrow-right fs-6"></i></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- ========================================================== -->
                <!-- TAB 4: MARKETING                                            -->
                <!-- ========================================================== -->
                <div class="tab-pane" id="tab-marketing">
                    <div class="section-title fs-5 fw-bold text-dark pb-2 mb-3 border-bottom">📢 Marketing</div>
                    <div class="settings-grid row g-3">
                        <div class="col-md-6">
                            <div class="settings-card bg-white p-3 rounded-3 border d-flex align-items-start gap-3 cursor-pointer" onclick="window.location.href='social-links.php'">
                                <div class="card-icon bg-primary bg-opacity-10 text-primary rounded-3 d-flex align-items-center justify-content-center flex-shrink-0" style="width:44px;height:44px;"><i class="fas fa-share-alt fs-5"></i></div>
                                <div class="card-body flex-grow-1">
                                    <h4 class="fs-6 fw-semibold text-dark mb-1">🔗 Social Links</h4>
                                    <p class="small text-secondary mb-1">Connect your social media profiles to increase brand visibility and engagement.</p>
                                    <span class="card-link text-primary fw-semibold text-decoration-none small d-inline-flex align-items-center gap-1">Manage Links <i class="fas fa-arrow-right fs-6"></i></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- ========================================================== -->
                <!-- TAB 5: WEBSITE                                              -->
                <!-- ========================================================== -->
                <div class="tab-pane" id="tab-website">
                    <div class="section-title fs-5 fw-bold text-dark pb-2 mb-3 border-bottom">🌐 Website</div>
                    <div class="settings-grid row g-3">
                        <div class="col-md-6">
                            <div class="settings-card bg-white p-3 rounded-3 border d-flex align-items-start gap-3 cursor-pointer" onclick="window.location.href='sms-otp.php'">
                                <div class="card-icon bg-primary bg-opacity-10 text-primary rounded-3 d-flex align-items-center justify-content-center flex-shrink-0" style="width:44px;height:44px;"><i class="fas fa-sms fs-5"></i></div>
                                <div class="card-body flex-grow-1">
                                    <h4 class="fs-6 fw-semibold text-dark mb-1">📱 SMS OTP</h4>
                                    <p class="small text-secondary mb-1">Enable secure phone verification and one-time password authentication for customers.</p>
                                    <span class="card-link text-primary fw-semibold text-decoration-none small d-inline-flex align-items-center gap-1">Configure OTP <i class="fas fa-arrow-right fs-6"></i></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div> 
        </div>
    </div>

    <!-- Toast -->
    <div class="position-fixed bottom-0 end-0 p-3" style="z-index: 9999;">
        <div id="settingsToast" class="toast align-items-center text-white bg-success border-0" role="alert">
            <div class="d-flex">
                <div class="toast-body"><i class="fas fa-check-circle me-2"></i> <span id="toastMessage">Saved!</span></div>
                <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast"></button>
            </div>
        </div>
    </div>

    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="../assets/js/script.js"></script>

    <script>
    // Tab switching function - maintains compatibility with existing JS
    function switchTab(tabName) {
        // Remove active class from all tabs
        document.querySelectorAll('.tab-btn').forEach(btn => {
            btn.classList.remove('active');
            btn.classList.remove('btn-primary');
            btn.classList.add('btn-outline-secondary');
        });
        
        // Add active class to clicked tab
        const activeBtn = document.querySelector(`.tab-btn[data-tab="${tabName}"]`);
        if (activeBtn) {
            activeBtn.classList.add('active');
            activeBtn.classList.add('btn-primary');
            activeBtn.classList.remove('btn-outline-secondary');
        }
        
        // Hide all tab panes
        document.querySelectorAll('.tab-pane').forEach(pane => {
            pane.classList.remove('active');
            pane.style.display = 'none';
        });
        
        // Show selected tab pane
        const activePane = document.getElementById(`tab-${tabName}`);
        if (activePane) {
            activePane.classList.add('active');
            activePane.style.display = 'block';
        }
    }

    // Initialize - show first tab
    document.addEventListener('DOMContentLoaded', function() {
        // Ensure only general tab is visible initially
        document.querySelectorAll('.tab-pane').forEach(pane => {
            if (pane.id === 'tab-general') {
                pane.classList.add('active');
                pane.style.display = 'block';
            } else {
                pane.classList.remove('active');
                pane.style.display = 'none';
            }
        });
    });
    </script>
</body>

</html>