<?php
include 'config/config.php';
?>

<?php
$current_page = 'discounts';

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php include 'templates/head.php'; ?>

    <style>
        .form-section {
            background: #FFFFFF;
            border-radius: 0.75rem;
            border: 1px solid #E2E8F0;
            padding: 2rem;
        }
        .form-section .form-label { 
            font-weight: 500; 
            color: #1E293B; 
            font-size: 0.875rem;
        }
        .form-section .form-control,
        .form-section .form-select {
            border-radius: 0.5rem;
            border-color: #E2E8F0;
            font-size: 0.875rem;
        }
        .form-section .form-control:focus,
        .form-section .form-select:focus {
            border-color: #2563EB;
            box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.15);
        }
        
        .alert-success-custom {
            background: #D1FAE5;
            color: #065F46;
            border-left: 4px solid #10B981;
            padding: 12px 16px;
            border-radius: 8px;
            margin-bottom: 1rem;
            display: flex;
            align-items: center;
            justify-content: space-between;
            flex-wrap: wrap;
        }
        .alert-success-custom .alert-link {
            color: #2563EB;
            font-weight: 600;
            text-decoration: none;
            padding: 4px 12px;
            background: white;
            border-radius: 6px;
            transition: all 0.3s ease;
        }
        .alert-success-custom .alert-link:hover {
            background: #DBEAFE;
            text-decoration: underline;
        }
        .alert-error-custom {
            background: #FEE2E2;
            color: #991B1B;
            border-left: 4px solid #EF4444;
            padding: 12px 16px;
            border-radius: 8px;
            margin-bottom: 1rem;
        }
        .sidebar-toggle { 
            display: none; 
            background: transparent; 
            border: none; 
            color: #1E293B; 
            font-size: 1.2rem; 
            padding: 0 10px; 
        }
        .section-header {
            background: #F8FAFC;
            padding: 10px 16px;
            border-radius: 0.5rem;
            border: 1px solid #E2E8F0;
            margin-bottom: 1.5rem;
        }
        .section-header h6 {
            margin: 0;
            font-weight: 600;
            color: #1E293B;
            font-size: 0.95rem;
        }
        .required-star {
            color: #EF4444;
        }

        @media (max-width: 767.98px) {
            .sidebar-wrapper { width: 0; transform: translateX(-100%); transition: all 0.3s ease; }
            .sidebar-wrapper.open { width: 280px; transform: translateX(0); }
            .main-content { margin-left: 0; padding: 10px 12px; }
            .sidebar-toggle { display: block !important; }
            .form-section { padding: 1rem; }
            .alert-success-custom { flex-direction: column; gap: 8px; align-items: flex-start; }
        }
        @media (max-width: 479.98px) {
            .main-content { padding: 6px 8px; }
            .form-section { padding: 0.75rem; }
        }
    </style>
</head>
<body>
    <!-- Navbar -->
    <?php include 'templates/navbar.php'; ?>
    
    <!-- Sidebar -->
    <?php include 'templates/sidebar.php'; ?>

    <!-- Main Content -->
    <div class="content-area main-content">
        <div id="add-coupon-page" class="page-section active-page">
            
            

            <!-- Page Header -->
            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                <h1 class="h2">Add New Coupon</h1>
                <div class="btn-toolbar mb-2 mb-md-0">
                    <div class="btn-group me-2">
                        <a href="discount.php" class="btn btn-sm btn-outline-secondary">
                            <i class="fas fa-arrow-left me-1"></i> Back to Coupons
                        </a>
                    </div>
                </div>
            </div>

            <!-- Alert Container -->
            <div id="alertContainer"></div>

            <!-- Form -->
            <div class="form-section">
                <form id="addCouponForm" onsubmit="return saveCoupon(event)">
                    <input type="hidden" name="add_discount" value="1">

                    <!-- ========================================== -->
                    <!-- COUPON DETAILS                            -->
                    <!-- ========================================== -->
                    <div class="section-header">
                        <h6>Coupon Details</h6>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Code <span class="required-star">*</span></label>
                            <input type="text" class="form-control" id="couponCode" placeholder="Enter coupon code" required>
                            <small class="text-muted">Enter a coupon code</small>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Coupon Type</label>
                            <select class="form-select" id="couponType">
                                <option value="Percentage">Percentage</option>
                                <option value="Fixed Amount">Fixed Amount</option>
                                <option value="Free Shipping">Free Shipping</option>
                                <option value="Buy X Get Y">Buy X Get Y</option>
                            </select>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Discount <span class="required-star">*</span></label>
                            <div class="input-group">
                                <input type="number" class="form-control" id="discountValue" placeholder="0" step="0.01" min="0" required>
                                <span class="input-group-text" id="discountSymbol">%</span>
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Apply coupon</label>
                            <select class="form-select" id="applyCoupon">
                                <option value="All Products">All Products</option>
                                <option value="Specific Category">Specific Category</option>
                                <option value="Specific Product">Specific Product</option>
                            </select>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Minimum quantity of products</label>
                            <input type="number" class="form-control" id="minQuantity" placeholder="0" min="0" value="0">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Minimum purchase amount</label>
                            <input type="number" class="form-control" id="minAmount" placeholder="0.00" step="0.01" min="0" value="0">
                        </div>
                    </div>

                    <!-- ========================================== -->
                    <!-- CUSTOMER ELIGIBILITY                      -->
                    <!-- ========================================== -->
                    <div class="section-header mt-4">
                        <h6>Customer Eligibility</h6>
                    </div>

                    <div class="row">
                        <div class="col-md-12 mb-3">
                            <label class="form-label">Eligibility</label>
                            <select class="form-select" id="customerEligibility">
                                <option value="Everyone">Everyone</option>
                                <option value="Regular Customers">Regular Customers</option>
                                <option value="New Customers">New Customers</option>
                            </select>
                        </div>
                    </div>

                    <!-- ========================================== -->
                    <!-- USAGE LIMITS                              -->
                    <!-- ========================================== -->
                    <div class="section-header mt-4">
                        <h6>Usage Limits</h6>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Limit number of times this discount can be used in total <span class="required-star">*</span></label>
                            <input type="number" class="form-control" id="usageLimitTotal" placeholder="0" min="0" value="0" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Limit number of times this discount can be used per customer <span class="required-star">*</span></label>
                            <input type="number" class="form-control" id="usageLimitPerCustomer" placeholder="0" min="0" value="0" required>
                        </div>
                    </div>

                    <!-- ========================================== -->
                    <!-- COUPON VALIDITY                           -->
                    <!-- ========================================== -->
                    <div class="section-header mt-4">
                        <h6>Coupon Validity</h6>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">From <span class="required-star">*</span></label>
                            <input type="date" class="form-control" id="validFrom" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Till <span class="required-star">*</span></label>
                            <input type="date" class="form-control" id="validTill" required>
                        </div>
                    </div>

                    <!-- ========================================== -->
                    <!-- STATUS                                    -->
                    <!-- ========================================== -->
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Status</label>
                            <select class="form-select" id="couponStatus">
                                <option value="Active">Active</option>
                                <option value="Inactive">Inactive</option>
                                <option value="Scheduled">Scheduled</option>
                                <option value="Expired">Expired</option>
                            </select>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Description</label>
                            <textarea class="form-control" id="couponDescription" rows="2" placeholder="Coupon description"></textarea>
                        </div>
                    </div>

                    <!-- Submit Buttons -->
                    <div class="d-flex gap-2 flex-wrap mt-4 pt-3 border-top">
                        <button type="submit" class="btn btn-primary" id="saveCouponBtn">
                            Save
                        </button>
                        <a href="discount.php" class="btn btn-secondary">
                            Cancel
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>

   <!-- Bootstrap JS Bundle (Latest Stable) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
    <script src="assets/js/script.js"></script>
    
    <script>
        // ============================================================
        // COUPON DATA - READ FROM LOCALSTORAGE
        // ============================================================
        function getCoupons() {
            return JSON.parse(localStorage.getItem('coupons') || '[]');
        }

        function saveCoupons(coupons) {
            localStorage.setItem('coupons', JSON.stringify(coupons));
        }

        // Initialize coupons in localStorage if empty
        if (getCoupons().length === 0) {
            const defaultCoupons = [
                {id: 1, code: 'SUMMER20', type: 'Percentage', discount: 20, apply: 'All Products', eligibility: 'Everyone', usage_total: 150, usage_per_customer: 5, valid_from: '2026-06-01', valid_till: '2026-07-31', status: 'Active', description: 'Summer sale discount', created_at: new Date().toISOString()},
                {id: 2, code: 'FREESHIP', type: 'Free Shipping', discount: 0, apply: 'All Products', eligibility: 'Everyone', usage_total: 75, usage_per_customer: 3, valid_from: '2026-06-15', valid_till: '2026-08-15', status: 'Active', description: 'Free shipping on all orders', created_at: new Date().toISOString()},
                {id: 3, code: 'WELCOME10', type: 'Percentage', discount: 10, apply: 'All Products', eligibility: 'New Customers', usage_total: 200, usage_per_customer: 2, valid_from: '2026-01-01', valid_till: '2026-12-31', status: 'Active', description: 'Welcome discount for new customers', created_at: new Date().toISOString()},
                {id: 4, code: 'HOLIDAY25', type: 'Percentage', discount: 25, apply: 'All Products', eligibility: 'Everyone', usage_total: 50, usage_per_customer: 2, valid_from: '2026-12-01', valid_till: '2026-12-25', status: 'Scheduled', description: 'Holiday special discount', created_at: new Date().toISOString()},
                {id: 5, code: 'FLASH50', type: 'Percentage', discount: 50, apply: 'Specific Category', eligibility: 'Everyone', usage_total: 30, usage_per_customer: 1, valid_from: '2026-06-01', valid_till: '2026-06-30', status: 'Expired', description: 'Flash sale on smart devices', created_at: new Date().toISOString()}
            ];
            saveCoupons(defaultCoupons);
        }

        // ============================================================
        // UPDATE DISCOUNT SYMBOL BASED ON TYPE
        // ============================================================
        document.getElementById('couponType')?.addEventListener('change', function() {
            const symbol = document.getElementById('discountSymbol');
            const valueInput = document.getElementById('discountValue');
            const type = this.value;
            
            if (type === 'Percentage') {
                symbol.textContent = '%';
                valueInput.placeholder = '0';
                valueInput.step = '0.01';
            } else if (type === 'Fixed Amount') {
                symbol.textContent = '$';
                valueInput.placeholder = '0.00';
                valueInput.step = '0.01';
            } else if (type === 'Free Shipping') {
                symbol.textContent = 'Free';
                valueInput.value = 0;
                valueInput.readOnly = true;
                valueInput.placeholder = 'Free';
            } else if (type === 'Buy X Get Y') {
                symbol.textContent = 'Buy X';
                valueInput.placeholder = '0';
                valueInput.step = '1';
            }
        });

        // ============================================================
        // SET DEFAULT DATES
        // ============================================================
        function setDefaultDates() {
            const today = new Date();
            const fromDate = today.toISOString().split('T')[0];
            
            const tillDate = new Date(today);
            tillDate.setMonth(tillDate.getMonth() + 3);
            const tillDateStr = tillDate.toISOString().split('T')[0];
            
            document.getElementById('validFrom').value = fromDate;
            document.getElementById('validTill').value = tillDateStr;
        }

        // ============================================================
        // SHOW ALERT
        // ============================================================
        function showAlert(message, type = 'success') {
            const container = document.getElementById('alertContainer');
            const colors = {
                success: { bg: '#D1FAE5', color: '#065F46', border: '#10B981', icon: 'check-circle' },
                error: { bg: '#FEE2E2', color: '#991B1B', border: '#EF4444', icon: 'exclamation-circle' }
            };
            const c = colors[type] || colors.success;
            
            container.innerHTML = `
                <div class="alert-success-custom" style="background: ${c.bg}; color: ${c.color}; border-left-color: ${c.border};">
                    <span>
                        <i class="fas fa-${c.icon} me-2"></i>
                        <strong>${message}</strong>
                    </span>
                    <a href="discount.php" class="alert-link">
                        <i class="fas fa-arrow-right me-1"></i> View Coupons
                    </a>
                </div>
            `;

            setTimeout(() => {
                const alert = container.querySelector('.alert-success-custom');
                if (alert) alert.style.display = 'none';
            }, 5000);
        }

        // ============================================================
        // SAVE COUPON
        // ============================================================
        function saveCoupon(e) {
            e.preventDefault();

            // Get form values
            const code = document.getElementById('couponCode').value.trim().toUpperCase();
            const type = document.getElementById('couponType').value;
            const discount = parseFloat(document.getElementById('discountValue').value);
            const apply = document.getElementById('applyCoupon').value;
            const eligibility = document.getElementById('customerEligibility').value;
            const usage_total = parseInt(document.getElementById('usageLimitTotal').value) || 0;
            const usage_per_customer = parseInt(document.getElementById('usageLimitPerCustomer').value) || 0;
            const valid_from = document.getElementById('validFrom').value;
            const valid_till = document.getElementById('validTill').value;
            const status = document.getElementById('couponStatus').value;
            const description = document.getElementById('couponDescription').value.trim();

            // Validate
            if (!code) {
                alert('Please enter coupon code');
                document.getElementById('couponCode').focus();
                return false;
            }
            if (type !== 'Free Shipping' && (!discount || discount <= 0)) {
                alert('Please enter valid discount value');
                document.getElementById('discountValue').focus();
                return false;
            }
            if (!valid_from) {
                alert('Please select valid from date');
                document.getElementById('validFrom').focus();
                return false;
            }
            if (!valid_till) {
                alert('Please select valid till date');
                document.getElementById('validTill').focus();
                return false;
            }
            if (new Date(valid_from) > new Date(valid_till)) {
                alert('Valid from date cannot be after valid till date');
                document.getElementById('validFrom').focus();
                return false;
            }

            // Get existing coupons
            const coupons = getCoupons();
            const newId = coupons.length > 0 ? Math.max(...coupons.map(c => c.id)) + 1 : 1;

            // Create new coupon
            const newCoupon = {
                id: newId,
                code: code,
                type: type,
                discount: discount || 0,
                apply: apply,
                eligibility: eligibility,
                usage_total: usage_total,
                usage_per_customer: usage_per_customer,
                valid_from: valid_from,
                valid_till: valid_till,
                status: status,
                description: description,
                created_at: new Date().toISOString()
            };

            // Save to localStorage
            coupons.push(newCoupon);
            saveCoupons(coupons);

            // Show success message
            showAlert(`Coupon '${code}' added successfully!`, 'success');

            // Reset form
            document.getElementById('addCouponForm').reset();
            setDefaultDates();
            document.getElementById('couponStatus').value = 'Active';
            document.getElementById('discountSymbol').textContent = '%';

            // Redirect after 1.5 seconds
            setTimeout(() => {
                window.location.href = 'discount.php';
            }, 1500);

            console.log('Coupon saved:', newCoupon);
            return false;
        }

        // ============================================================
        // SIDEBAR TOGGLE (Mobile)
        // ============================================================
        document.addEventListener('DOMContentLoaded', function() {
            setDefaultDates();

            var sidebarToggle = document.querySelector('.sidebar-toggle');
            if (sidebarToggle) {
                sidebarToggle.addEventListener('click', function () {
                    document.querySelector('.sidebar-wrapper')?.classList.toggle('open');
                });
            }

            document.addEventListener('click', function (e) {
                if (window.innerWidth < 768) {
                    var sidebar = document.querySelector('.sidebar-wrapper');
                    var toggle = document.querySelector('.sidebar-toggle');
                    if (sidebar && toggle && !sidebar.contains(e.target) && !toggle.contains(e.target)) {
                        sidebar.classList.remove('open');
                    }
                }
            });

            console.log('Add Coupon page initialized (100% JavaScript with localStorage)');
        });
    </script>
</body>
</html>