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
        <div class="settings-container">
            <!-- Header -->
            <div class="settings-header">
                <h1>⚙️ Settings</h1>
                <p>Manage your store configuration</p>
            </div>

            <!-- Tab Buttons -->
            <div class="tab-bar">
                <button class="tab-btn active" data-tab="general" onclick="switchTab('general')">
                    <i class="fas fa-cog"></i> <span>General</span>
                </button>
                <button class="tab-btn" data-tab="commerce" onclick="switchTab('commerce')">
                    <i class="fas fa-shopping-cart"></i> <span>Commerce</span>
                </button>
                <button class="tab-btn" data-tab="staff" onclick="switchTab('staff')">
                    <i class="fas fa-users"></i> <span>Staff</span>
                </button>
                <button class="tab-btn" data-tab="marketing" onclick="switchTab('marketing')">
                    <i class="fas fa-bullhorn"></i> <span>Marketing</span>
                </button>
                <button class="tab-btn" data-tab="website" onclick="switchTab('website')">
                    <i class="fas fa-globe"></i> <span>Website</span>
                </button>
            </div>

            <!-- Tab Content -->
            <div class="tab-content">

                <!-- ========================================================== -->
                <!-- TAB 1: GENERAL                                             -->
                <!-- ========================================================== -->
                <div class="tab-pane active" id="tab-general">
                    <div class="section-title">⚙️ General</div>
                    <div class="settings-grid">
                        <div class="settings-card clickable" onclick="window.location.href='system-preference.php'">
                            <div class="card-icon"><i class="fas fa-globe-americas"></i></div>
                            <div class="card-body">
                                <h4>🌐 System Preference</h4>
                                <p>Manage your store's language, currency, timezone, and regional preferences.</p>
                                <span class="card-link">Configure Settings <i class="fas fa-arrow-right"></i></span>
                            </div>
                        </div>
                        <div class="settings-card clickable" onclick="window.location.href='store-information.php'">
                            <div class="card-icon"><i class="fas fa-store"></i></div>
                            <div class="card-body">
                                <h4>🏪 Store Information</h4>
                                <p>Update your store details including name, contact, address, and branding.</p>
                                <span class="card-link">Manage Store <i class="fas fa-arrow-right"></i></span>
                            </div>
                        </div>
                        <div class="settings-card clickable" onclick="window.location.href='account-overview.php'">
                            <div class="card-icon"><i class="fas fa-user-circle"></i></div>
                            <div class="card-body">
                                <h4>👤 Account Overview</h4>
                                <p>View account status, balance, upgrade options, and visibility settings.</p>
                                <span class="card-link">View Account <i class="fas fa-arrow-right"></i></span>
                            </div>
                        </div>
                        <div class="settings-card clickable" onclick="window.location.href='notifications.php'">
                            <div class="card-icon"><i class="fas fa-bell"></i></div>
                            <div class="card-body">
                                <h4>🔔 Notifications</h4>
                                <p>Manage push notifications, email alerts, and subscription preferences.</p>
                                <span class="card-link">Manage Notifications <i class="fas fa-arrow-right"></i></span>
                            </div>
                        </div>
                        <div class="settings-card clickable" onclick="window.location.href='account-visibility.php'">
                            <div class="card-icon"><i class="fas fa-eye"></i></div>
                            <div class="card-body">
                                <h4>👀 Account Visibility</h4>
                                <p>Control who can see your account and profile information.</p>
                                <span class="card-link">Manage Visibility <i class="fas fa-arrow-right"></i></span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- ========================================================== -->
                <!-- TAB 2: COMMERCE                                             -->
                <!-- ========================================================== -->
                <div class="tab-pane" id="tab-commerce">
                    <div class="section-title">💳 Commerce</div>
                    <div class="settings-grid">
                        <div class="settings-card clickable" onclick="window.location.href='payments.php'">
                            <div class="card-icon"><i class="fas fa-credit-card"></i></div>
                            <div class="card-body">
                                <h4>💳 Payments</h4>
                                <p>Configure payment gateways and manage how customers pay for orders.</p>
                                <span class="card-link">Manage Payments <i class="fas fa-arrow-right"></i></span>
                            </div>
                        </div>
                        <div class="settings-card clickable" onclick="window.location.href='taxes.php'">
                            <div class="card-icon"><i class="fas fa-receipt"></i></div>
                            <div class="card-body">
                                <h4>🧾 Taxes</h4>
                                <p>Set up tax rules, GST settings, and regional tax configurations.</p>
                                <span class="card-link">Configure Taxes <i class="fas fa-arrow-right"></i></span>
                            </div>
                        </div>
                        <div class="settings-card clickable" onclick="window.location.href='locations.php'">
                            <div class="card-icon"><i class="fas fa-map-marker-alt"></i></div>
                            <div class="card-body">
                                <h4>📍 Locations</h4>
                                <p>Manage warehouse, pickup, and store locations used for fulfillment.</p>
                                <span class="card-link">Manage Locations <i class="fas fa-arrow-right"></i></span>
                            </div>
                        </div>
                        <div class="settings-card clickable" onclick="window.location.href='delivery-method.php'">
                            <div class="card-icon"><i class="fas fa-truck"></i></div>
                            <div class="card-body">
                                <h4>🚚 Delivery Method</h4>
                                <p>Configure shipping methods, delivery charges, and service areas.</p>
                                <span class="card-link">Manage Delivery <i class="fas fa-arrow-right"></i></span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- ========================================================== -->
                <!-- TAB 3: STAFF                                                -->
                <!-- ========================================================== -->
                <div class="tab-pane" id="tab-staff">
                    <div class="section-title">👥 Staff</div>
                    <div class="settings-grid">
                        <div class="settings-card clickable" onclick="window.location.href='staff-management.php'">
                            <div class="card-icon"><i class="fas fa-user-tie"></i></div>
                            <div class="card-body">
                                <h4>👨‍💼 Staff Management</h4>
                                <p>Control staff access, permissions, and administrative roles.</p>
                                <span class="card-link">Manage Team <i class="fas fa-arrow-right"></i></span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- ========================================================== -->
                <!-- TAB 4: MARKETING                                            -->
                <!-- ========================================================== -->
                <div class="tab-pane" id="tab-marketing">
                    <div class="section-title">📢 Marketing</div>
                    <div class="settings-grid">
                        <div class="settings-card clickable" onclick="window.location.href='social-links.php'">
                            <div class="card-icon"><i class="fas fa-share-alt"></i></div>
                            <div class="card-body">
                                <h4>🔗 Social Links</h4>
                                <p>Connect your social media profiles to increase brand visibility and engagement.</p>
                                <span class="card-link">Manage Links <i class="fas fa-arrow-right"></i></span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- ========================================================== -->
                <!-- TAB 5: WEBSITE                                              -->
                <!-- ========================================================== -->
                <div class="tab-pane" id="tab-website">
                    <div class="section-title">🌐 Website</div>
                    <div class="settings-grid">
                        <div class="settings-card clickable" onclick="window.location.href='sms-otp.php'">
                            <div class="card-icon"><i class="fas fa-sms"></i></div>
                            <div class="card-body">
                                <h4>📱 SMS OTP</h4>
                                <p>Enable secure phone verification and one-time password authentication for customers.</p>
                                <span class="card-link">Configure OTP <i class="fas fa-arrow-right"></i></span>
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

    <?php include '../templates/modal/logout-modal.php'; ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="../assets/js/script.js"></script>
</body>

</html>