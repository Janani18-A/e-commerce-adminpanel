<div class="sidebar-custom">
    <div class="sidebar-header mt-4">
        <h2>
            <svg class="icon">
                <use href="assets/icons/icons.svg#icon-store" />
            </svg>
            <span>E-Shop</span>
        </h2>
    </div>
    <ul class="sidebar-menu">
        <li class="active">
           <a href="<?= APP_URL; ?>">
                <svg class="icon">
                    <use href="assets/icons/icons.svg#icon-dashboard" />
                </svg>
                <span>Dashboard</span>
            </a>
        </li>
        <li>
            <a href="orders.php">
                <svg class="icon">
                    <use href="assets/icons/icons.svg#icon-orders" />
                </svg>
                <span>Orders</span>
            </a>
        </li>
        <li>
            <a href="shipped-orders.php">
                <svg class="icon">
                    <use href="assets/icons/icons.svg#icon-shipped" />
                </svg>
                <span>Shipped Orders</span>
            </a>
        </li>
        <li>
            <a href="customers.php">
                <svg class="icon">
                    <use href="assets/icons/icons.svg#icon-customers" />
                </svg>
                <span>Customers</span>
            </a>
        </li>
        <li>
            <a href="product_v1.php">
                <svg class="icon">
                    <use href="assets/icons/icons.svg#icon-products" />
                </svg>
                <span>Products V1</span>
            </a>
        </li>
     
        <li>
            <a href="product_v2.php">
                <svg class="icon">
                    <use href="assets/icons/icons.svg#icon-shopping-bag"></use>
                </svg>
                <span>Products V2</span>
            </a>
        </li>
        <li>
            <a href="product-categories.php">
                <svg class="icon">
                    <use href="assets/icons/icons.svg#icon-categories"></use>
                </svg>
                <span>Products Categories</span>
            </a>
        </li>
        <li>
            <a href="product-report.php">
                <svg class="icon">
                    <use href="assets/icons/icons.svg#icon-product-report" />
                </svg>
                <span>Product Report</span>
            </a>
        </li>
        <li>
            <a href="sales-reports.php">
                <svg class="icon">
                    <use href="assets/icons/icons.svg#icon-sales-report" />
                </svg>
                <span>Sales Report</span>
            </a>
        </li>
        <li>
            <a href="stock-management.php">
                <svg class="icon">
                    <use href="assets/icons/icons.svg#icon-stock" />
                </svg>
                <span>Stock Management</span>
            </a>
        </li>


        <li>
            <a href="pages.php">
                <svg class="icon">
                    <use href="assets/icons/icons.svg#icon-pages" />
                </svg>
                <span>Pages</span>
            </a>
        </li>

        <li>
            <a href="discount.php">
                <svg class="icon">
                    <use href="assets/icons/icons.svg#icon-discounts" />
                </svg>
                <span>Discounts</span>
            </a>
        </li>
        <li class="<?php echo basename($_SERVER['PHP_SELF']) == 'user-activity.php' ? 'active' : ''; ?>">
            <a href="user-activity.php">
                <svg class="icon">
                    <use href="assets/icons/icons.svg#icon-activity" />
                </svg>
                <span>User Activity</span>
            </a>
        </li>
        <li>
            <a href="settings.php">
                <svg class="icon">
                    <use href="assets/icons/icons.svg#icon-settings" />
                </svg>
                <span>Settings</span>
            </a>
        </li>

    </ul>
</div>