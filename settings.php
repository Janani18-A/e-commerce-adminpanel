<?php
include 'config/config.php';
?>
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
    <link rel="stylesheet" href="<?= APP_URL; ?>/assets/css/style.css">
    <style>
        .settings-card {
            transition: all 0.2s ease;
            height: 100%;
            min-height: 100px;
            padding: 1.25rem !important;
            width: 100%;
        }

        .settings-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
        }

        .card-icon {
            width: 44px;
            height: 44px;
            min-width: 44px;
            flex-shrink: 0;
        }

        .settings-card .card-body {
            padding: 0;
            min-width: 0;
            flex: 1;
        }

        .settings-card h4 {
            font-size: 0.95rem;
            white-space: nowrap;
            /* Prevents text wrapping */
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .settings-card p {
            font-size: 0.8rem;
            white-space: nowrap;
            /* Prevents text wrapping */
            overflow: hidden;
            text-overflow: ellipsis;
            margin-bottom: 0.25rem;
        }

        .settings-card .card-link {
            font-size: 0.78rem;
            white-space: nowrap;
        }

        /* Tab button responsive */
        .tab-bar .tab-btn {
            font-size: 0.85rem;
            padding: 0.5rem 1.2rem;
            white-space: nowrap;
        }

        .tab-bar .tab-btn span {
            display: inline;
        }

        /* WIDER GRID - 2 columns on desktop */
        .settings-grid .col-12 {
            padding-left: 8px;
            padding-right: 8px;
        }

        @media (min-width: 576px) {
            .settings-grid .col-sm-6 {
                flex: 0 0 50%;
                max-width: 50%;
            }
        }

        @media (min-width: 992px) {
            .settings-grid .col-lg-6 {
                flex: 0 0 50%;
                max-width: 50%;
            }
        }

        /* Mobile responsive */
        @media (max-width: 576px) {
            .settings-card {
                min-height: 80px;
                padding: 0.85rem !important;
            }

            .settings-card h4 {
                font-size: 0.82rem;
                white-space: nowrap;
            }

            .settings-card p {
                font-size: 0.68rem;
                white-space: nowrap;
            }

            .settings-card .card-link {
                font-size: 0.68rem;
                white-space: nowrap;
            }

            .card-icon {
                width: 32px;
                height: 32px;
                min-width: 32px;
            }

            .card-icon i {
                font-size: 0.85rem !important;
            }

            .tab-bar {
                padding: 0.5rem 0.75rem !important;
                gap: 0.25rem !important;
                overflow-x: auto;
                flex-wrap: nowrap;
                -webkit-overflow-scrolling: touch;
            }

            .tab-bar .tab-btn {
                font-size: 0.7rem;
                padding: 0.35rem 0.6rem;
                flex-shrink: 0;
            }

            .tab-bar .tab-btn span {
                display: none;
            }

            .tab-bar .tab-btn i {
                font-size: 1rem;
            }

            .settings-header h1 {
                font-size: 1.1rem !important;
            }

            .settings-header p {
                font-size: 0.7rem !important;
            }

            .section-title {
                font-size: 0.95rem !important;
            }

            .tab-content {
                padding: 0.75rem !important;
            }

            .settings-grid {
                gap: 0.5rem !important;
            }

            .settings-grid .col-12 {
                padding-left: 4px;
                padding-right: 4px;
            }
        }

        @media (min-width: 577px) and (max-width: 768px) {
            .settings-card {
                padding: 1rem !important;
            }

            .settings-card h4 {
                font-size: 0.85rem;
                white-space: nowrap;
            }

            .settings-card p {
                font-size: 0.72rem;
                white-space: nowrap;
            }

            .tab-bar .tab-btn {
                font-size: 0.75rem;
                padding: 0.4rem 0.9rem;
            }

            .tab-content {
                padding: 1rem !important;
            }
        }

        @media (min-width: 769px) and (max-width: 991px) {
            .settings-card h4 {
                font-size: 0.88rem;
                white-space: nowrap;
            }

            .settings-card p {
                font-size: 0.75rem;
                white-space: nowrap;
            }
        }
    </style>
</head>

<body>
    <?php include('templates/navbar.php'); ?>
    <?php include('templates/sidebar.php'); ?>

    <div class="content-area">
        <div class="settings-container bg-white border rounded-4 overflow-hidden">
            <!-- Header -->
            <div class="settings-header p-3 p-md-4 border-bottom">
                <h1 class="fs-4 fw-bold text-dark mb-0"> Settings</h1>
                <p class="text-secondary small mb-0">Manage your store configuration</p>
            </div>

            <!-- Tab Buttons -->
            <div class="tab-bar d-flex gap-1 px-2 px-md-4 pt-2 pt-md-3 bg-white border-bottom flex-nowrap overflow-auto">
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
            <div class="tab-content p-3 p-md-4 bg-light" style="min-height:350px;">

                <!-- ========================================================== -->
                <!-- TAB 1: GENERAL                                             -->
                <!-- ========================================================== -->
                <div class="tab-pane active" id="tab-general">
                    <div class="section-title fs-5 fw-bold text-dark pb-2 mb-3 border-bottom">General</div>
                    <div class="settings-grid row g-2 g-md-3">
                        <!-- Changed col-lg-4 to col-lg-6 for wider cards -->
                        <div class="col-12 col-sm-6 col-lg-6">
                            <div class="settings-card bg-white p-3 rounded-3 border d-flex align-items-start gap-3 cursor-pointer" onclick="window.location.href='system-preference.php'">
                                <div class="card-icon bg-primary bg-opacity-10 text-primary rounded-3 d-flex align-items-center justify-content-center flex-shrink-0"><i class="fas fa-globe-americas fs-5"></i></div>
                                <div class="card-body flex-grow-1">
                                    <h4 class="fs-6 fw-semibold text-dark mb-1">System Preference</h4>
                                    <p class="small text-secondary mb-1">Language, currency, timezone</p>
                                    <span class="card-link text-primary fw-semibold text-decoration-none small d-inline-flex align-items-center gap-1">Configure <i class="fas fa-arrow-right fs-6"></i></span>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-sm-6 col-lg-6">
                            <div class="settings-card bg-white p-3 rounded-3 border d-flex align-items-start gap-3 cursor-pointer" onclick="window.location.href='store-information.php'">
                                <div class="card-icon bg-primary bg-opacity-10 text-primary rounded-3 d-flex align-items-center justify-content-center flex-shrink-0"><i class="fas fa-store fs-5"></i></div>
                                <div class="card-body flex-grow-1">
                                    <h4 class="fs-6 fw-semibold text-dark mb-1">Store Information</h4>
                                    <p class="small text-secondary mb-1">Name, contact, address, branding</p>
                                    <span class="card-link text-primary fw-semibold text-decoration-none small d-inline-flex align-items-center gap-1">Manage <i class="fas fa-arrow-right fs-6"></i></span>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-sm-6 col-lg-6">
                            <div class="settings-card bg-white p-3 rounded-3 border d-flex align-items-start gap-3 cursor-pointer" onclick="window.location.href='account-overview.php'">
                                <div class="card-icon bg-primary bg-opacity-10 text-primary rounded-3 d-flex align-items-center justify-content-center flex-shrink-0"><i class="fas fa-user-circle fs-5"></i></div>
                                <div class="card-body flex-grow-1">
                                    <h4 class="fs-6 fw-semibold text-dark mb-1">Account Overview</h4>
                                    <p class="small text-secondary mb-1">Status, balance, upgrade options</p>
                                    <span class="card-link text-primary fw-semibold text-decoration-none small d-inline-flex align-items-center gap-1">View <i class="fas fa-arrow-right fs-6"></i></span>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-sm-6 col-lg-6">
                            <div class="settings-card bg-white p-3 rounded-3 border d-flex align-items-start gap-3 cursor-pointer" onclick="window.location.href='notifications.php'">
                                <div class="card-icon bg-primary bg-opacity-10 text-primary rounded-3 d-flex align-items-center justify-content-center flex-shrink-0"><i class="fas fa-bell fs-5"></i></div>
                                <div class="card-body flex-grow-1">
                                    <h4 class="fs-6 fw-semibold text-dark mb-1">Notifications</h4>
                                    <p class="small text-secondary mb-1">Push, email alerts, subscriptions</p>
                                    <span class="card-link text-primary fw-semibold text-decoration-none small d-inline-flex align-items-center gap-1">Manage <i class="fas fa-arrow-right fs-6"></i></span>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-sm-6 col-lg-6">
                            <div class="settings-card bg-white p-3 rounded-3 border d-flex align-items-start gap-3 cursor-pointer" onclick="window.location.href='account-visibility.php'">
                                <div class="card-icon bg-primary bg-opacity-10 text-primary rounded-3 d-flex align-items-center justify-content-center flex-shrink-0"><i class="fas fa-eye fs-5"></i></div>
                                <div class="card-body flex-grow-1">
                                    <h4 class="fs-6 fw-semibold text-dark mb-1">Account Visibility</h4>
                                    <p class="small text-secondary mb-1">Who can see your account?</p>
                                    <span class="card-link text-primary fw-semibold text-decoration-none small d-inline-flex align-items-center gap-1">Manage <i class="fas fa-arrow-right fs-6"></i></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- ========================================================== -->
                <!-- TAB 2: COMMERCE                                             -->
                <!-- ========================================================== -->
                <div class="tab-pane" id="tab-commerce">
                    <div class="section-title fs-5 fw-bold text-dark pb-2 mb-3 border-bottom">Commerce</div>
                    <div class="settings-grid row g-2 g-md-3">
                        <div class="col-12 col-sm-6 col-lg-6">
                            <div class="settings-card bg-white p-3 rounded-3 border d-flex align-items-start gap-3 cursor-pointer" onclick="window.location.href='payments.php'">
                                <div class="card-icon bg-primary bg-opacity-10 text-primary rounded-3 d-flex align-items-center justify-content-center flex-shrink-0"><i class="fas fa-credit-card fs-5"></i></div>
                                <div class="card-body flex-grow-1">
                                    <h4 class="fs-6 fw-semibold text-dark mb-1">Payments</h4>
                                    <p class="small text-secondary mb-1">Gateways, customer payments</p>
                                    <span class="card-link text-primary fw-semibold text-decoration-none small d-inline-flex align-items-center gap-1">Manage <i class="fas fa-arrow-right fs-6"></i></span>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-sm-6 col-lg-6">
                            <div class="settings-card bg-white p-3 rounded-3 border d-flex align-items-start gap-3 cursor-pointer" onclick="window.location.href='taxes.php'">
                                <div class="card-icon bg-primary bg-opacity-10 text-primary rounded-3 d-flex align-items-center justify-content-center flex-shrink-0"><i class="fas fa-receipt fs-5"></i></div>
                                <div class="card-body flex-grow-1">
                                    <h4 class="fs-6 fw-semibold text-dark mb-1">Taxes</h4>
                                    <p class="small text-secondary mb-1">Rules, GST, regional config</p>
                                    <span class="card-link text-primary fw-semibold text-decoration-none small d-inline-flex align-items-center gap-1">Configure <i class="fas fa-arrow-right fs-6"></i></span>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-sm-6 col-lg-6">
                            <div class="settings-card bg-white p-3 rounded-3 border d-flex align-items-start gap-3 cursor-pointer" onclick="window.location.href='locations.php'">
                                <div class="card-icon bg-primary bg-opacity-10 text-primary rounded-3 d-flex align-items-center justify-content-center flex-shrink-0"><i class="fas fa-map-marker-alt fs-5"></i></div>
                                <div class="card-body flex-grow-1">
                                    <h4 class="fs-6 fw-semibold text-dark mb-1">Locations</h4>
                                    <p class="small text-secondary mb-1">Warehouse, pickup, stores</p>
                                    <span class="card-link text-primary fw-semibold text-decoration-none small d-inline-flex align-items-center gap-1">Manage <i class="fas fa-arrow-right fs-6"></i></span>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-sm-6 col-lg-6">
                            <div class="settings-card bg-white p-3 rounded-3 border d-flex align-items-start gap-3 cursor-pointer" onclick="window.location.href='delivery-method.php'">
                                <div class="card-icon bg-primary bg-opacity-10 text-primary rounded-3 d-flex align-items-center justify-content-center flex-shrink-0"><i class="fas fa-truck fs-5"></i></div>
                                <div class="card-body flex-grow-1">
                                    <h4 class="fs-6 fw-semibold text-dark mb-1">Delivery Method</h4>
                                    <p class="small text-secondary mb-1">Shipping, charges, service areas</p>
                                    <span class="card-link text-primary fw-semibold text-decoration-none small d-inline-flex align-items-center gap-1">Manage <i class="fas fa-arrow-right fs-6"></i></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- ========================================================== -->
                <!-- TAB 3: STAFF                                                -->
                <!-- ========================================================== -->
                <div class="tab-pane" id="tab-staff">
                    <div class="section-title fs-5 fw-bold text-dark pb-2 mb-3 border-bottom">Staff</div>
                    <div class="settings-grid row g-2 g-md-3">
                        <div class="col-12 col-sm-6 col-lg-6">
                            <div class="settings-card bg-white p-3 rounded-3 border d-flex align-items-start gap-3 cursor-pointer" onclick="window.location.href='staff-management.php'">
                                <div class="card-icon bg-primary bg-opacity-10 text-primary rounded-3 d-flex align-items-center justify-content-center flex-shrink-0"><i class="fas fa-user-tie fs-5"></i></div>
                                <div class="card-body flex-grow-1">
                                    <h4 class="fs-6 fw-semibold text-dark mb-1">Staff Management</h4>
                                    <p class="small text-secondary mb-1">Access, permissions, roles</p>
                                    <span class="card-link text-primary fw-semibold text-decoration-none small d-inline-flex align-items-center gap-1">Manage <i class="fas fa-arrow-right fs-6"></i></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- ========================================================== -->
                <!-- TAB 4: MARKETING                                            -->
                <!-- ========================================================== -->
                <div class="tab-pane" id="tab-marketing">
                    <div class="section-title fs-5 fw-bold text-dark pb-2 mb-3 border-bottom">Marketing</div>
                    <div class="settings-grid row g-2 g-md-3">
                        <div class="col-12 col-sm-6 col-lg-6">
                            <div class="settings-card bg-white p-3 rounded-3 border d-flex align-items-start gap-3 cursor-pointer" onclick="window.location.href='social-links.php'">
                                <div class="card-icon bg-primary bg-opacity-10 text-primary rounded-3 d-flex align-items-center justify-content-center flex-shrink-0"><i class="fas fa-share-alt fs-5"></i></div>
                                <div class="card-body flex-grow-1">
                                    <h4 class="fs-6 fw-semibold text-dark mb-1">Social Links</h4>
                                    <p class="small text-secondary mb-1">Connect social media profiles</p>
                                    <span class="card-link text-primary fw-semibold text-decoration-none small d-inline-flex align-items-center gap-1">Manage <i class="fas fa-arrow-right fs-6"></i></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- ========================================================== -->
                <!-- TAB 5: WEBSITE                                              -->
                <!-- ========================================================== -->
                <div class="tab-pane" id="tab-website">
                    <div class="section-title fs-5 fw-bold text-dark pb-2 mb-3 border-bottom">Website</div>
                    <div class="settings-grid row g-2 g-md-3">
                        <div class="col-12 col-sm-6 col-lg-6">
                            <div class="settings-card bg-white p-3 rounded-3 border d-flex align-items-start gap-3 cursor-pointer" onclick="window.location.href='sms-otp.php'">
                                <div class="card-icon bg-primary bg-opacity-10 text-primary rounded-3 d-flex align-items-center justify-content-center flex-shrink-0"><i class="fas fa-sms fs-5"></i></div>
                                <div class="card-body flex-grow-1">
                                    <h4 class="fs-6 fw-semibold text-dark mb-1">SMS OTP</h4>
                                    <p class="small text-secondary mb-1">Phone verification, OTP auth</p>
                                    <span class="card-link text-primary fw-semibold text-decoration-none small d-inline-flex align-items-center gap-1">Configure <i class="fas fa-arrow-right fs-6"></i></span>
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
    <script src="<?= APP_URL; ?>/assets/js/script.js"></script>

    <script>
        function switchTab(tabName) {
            document.querySelectorAll('.tab-btn').forEach(btn => {
                btn.classList.remove('active');
                btn.classList.remove('btn-primary');
                btn.classList.add('btn-outline-secondary');
            });

            const activeBtn = document.querySelector(`.tab-btn[data-tab="${tabName}"]`);
            if (activeBtn) {
                activeBtn.classList.add('active');
                activeBtn.classList.add('btn-primary');
                activeBtn.classList.remove('btn-outline-secondary');
            }

            document.querySelectorAll('.tab-pane').forEach(pane => {
                pane.classList.remove('active');
                pane.style.display = 'none';
            });

            const activePane = document.getElementById(`tab-${tabName}`);
            if (activePane) {
                activePane.classList.add('active');
                activePane.style.display = 'block';
            }
        }

        document.addEventListener('DOMContentLoaded', function() {
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