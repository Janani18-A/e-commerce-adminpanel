<?php
include 'config/config.php';
?>


<?php
$current_page = 'stock-management';

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
        <div id="add-stock-page" class="page-section active-page">
            
            

            <!-- Page Header -->
            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                <h1 class="h2">Add Stock Item</h1>
                <div class="btn-toolbar mb-2 mb-md-0">
                    <div class="btn-group me-2">
                        <a href="stock-management.php" class="btn btn-sm btn-outline-secondary">
                            <i class="fas fa-arrow-left me-1"></i> Back to Stock
                        </a>
                    </div>
                </div>
            </div>

            <!-- Alert Container -->
            <div id="alertContainer"></div>

            <!-- Form -->
            <div class="form-section">
                <form id="addStockForm" onsubmit="return saveStockItem(event)">
                    <input type="hidden" name="add_stock_item" value="1">
                    
                    <!-- Item Name & SKU -->
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Item Name <span class="required-star">*</span></label>
                            <input type="text" class="form-control" id="itemName" placeholder="Enter item name" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">SKU <span class="required-star">*</span></label>
                            <input type="text" class="form-control" id="itemSku" placeholder="Enter SKU" required>
                        </div>
                    </div>

                    <!-- Category & Unit -->
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Category</label>
                            <select class="form-select" id="itemCategory">
                                <option value="">Select Category</option>
                                <option value="Raw Materials">Raw Materials</option>
                                <option value="Packaging">Packaging</option>
                                <option value="Finished Goods">Finished Goods</option>
                                <option value="Supplies">Supplies</option>
                                <option value="Equipment">Equipment</option>
                            </select>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Unit <span class="required-star">*</span></label>
                            <select class="form-select" id="itemUnit" required>
                                <option value="">Select Unit</option>
                                <option value="kg">Kilogram (kg)</option>
                                <option value="g">Gram (g)</option>
                                <option value="liters">Liters (L)</option>
                                <option value="ml">Milliliters (ml)</option>
                                <option value="units">Units</option>
                                <option value="boxes">Boxes</option>
                                <option value="rolls">Rolls</option>
                                <option value="pcs">Pieces (pcs)</option>
                                <option value="packs">Packs</option>
                            </select>
                        </div>
                    </div>

                    <!-- Quantity & Status -->
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Quantity <span class="required-star">*</span></label>
                            <input type="number" class="form-control" id="itemQuantity" placeholder="0" min="0" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Status</label>
                            <select class="form-select" id="itemStatus">
                                <option value="In Stock">In Stock</option>
                                <option value="Low Stock">Low Stock</option>
                                <option value="Out of Stock">Out of Stock</option>
                            </select>
                        </div>
                    </div>

                    <!-- Supplier & Location -->
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Supplier</label>
                            <input type="text" class="form-control" id="itemSupplier" placeholder="Enter supplier name">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Location</label>
                            <input type="text" class="form-control" id="itemLocation" placeholder="Enter storage location">
                        </div>
                    </div>

                    <!-- Description -->
                    <div class="mb-3">
                        <label class="form-label">Description</label>
                        <textarea class="form-control" id="itemDescription" rows="4" placeholder="Item description (optional)"></textarea>
                    </div>

                    <!-- Buttons -->
                    <div class="d-flex gap-2 flex-wrap">
                        <button type="submit" class="btn btn-primary" id="saveItemBtn">
                            Save Stock Item
                        </button>
                        <a href="stock-management.php" class="btn btn-secondary">
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
        // STOCK DATA - READ FROM LOCALSTORAGE
        // ============================================================
        function getStockItems() {
            return JSON.parse(localStorage.getItem('stock_items') || '[]');
        }

        function saveStockItems(items) {
            localStorage.setItem('stock_items', JSON.stringify(items));
        }

        // Initialize stock items in localStorage if empty
        if (getStockItems().length === 0) {
            const defaultItems = [
                {id: 1, item_name: 'Item Alpha', sku: 'STK-001', category: 'Raw Materials', quantity: 150, unit: 'kg', supplier: 'Supplier A', location: 'Warehouse 1', status: 'In Stock', badge: 'success', color: '2563EB', image: '', description: ''},
                {id: 2, item_name: 'Item Beta', sku: 'STK-002', category: 'Packaging', quantity: 25, unit: 'boxes', supplier: 'Supplier B', location: 'Warehouse 2', status: 'Low Stock', badge: 'warning', color: 'F59E0B', image: '', description: ''},
                {id: 3, item_name: 'Item Gamma', sku: 'STK-003', category: 'Finished Goods', quantity: 0, unit: 'units', supplier: 'Supplier C', location: 'Warehouse 1', status: 'Out of Stock', badge: 'danger', color: 'EF4444', image: '', description: ''},
                {id: 4, item_name: 'Item Delta', sku: 'STK-004', category: 'Raw Materials', quantity: 75, unit: 'liters', supplier: 'Supplier A', location: 'Warehouse 3', status: 'In Stock', badge: 'success', color: '8B5CF6', image: '', description: ''},
                {id: 5, item_name: 'Item Epsilon', sku: 'STK-005', category: 'Packaging', quantity: 120, unit: 'rolls', supplier: 'Supplier D', location: 'Warehouse 2', status: 'In Stock', badge: 'success', color: '06B6D4', image: '', description: ''},
                {id: 6, item_name: 'Item Zeta', sku: 'STK-006', category: 'Finished Goods', quantity: 8, unit: 'units', supplier: 'Supplier B', location: 'Warehouse 1', status: 'Low Stock', badge: 'warning', color: '1E293B', image: '', description: ''}
            ];
            saveStockItems(defaultItems);
        }

        // ============================================================
        // AUTO UPDATE STATUS BASED ON QUANTITY
        // ============================================================
        document.getElementById('itemQuantity')?.addEventListener('input', function() {
            var qty = parseInt(this.value) || 0;
            var statusSelect = document.getElementById('itemStatus');
            if (qty <= 0) {
                statusSelect.value = 'Out of Stock';
            } else if (qty <= 10) {
                statusSelect.value = 'Low Stock';
            } else {
                statusSelect.value = 'In Stock';
            }
        });

        // ============================================================
        // AUTO GENERATE SKU FROM ITEM NAME
        // ============================================================
        document.getElementById('itemName')?.addEventListener('input', function() {
            var skuField = document.getElementById('itemSku');
            if (!skuField.value.trim()) {
                var name = this.value.trim().toUpperCase().replace(/[^A-Z0-9]/g, '-');
                skuField.value = 'STK-' + name;
            }
        });

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
                    <div class="d-flex gap-2 flex-wrap">
                        <a href="stock-management.php" class="alert-link">
                            <i class="fas fa-list me-1"></i> View All Stock
                        </a>
                        <a href="add-stock.php" class="alert-link">
                            <i class="fas fa-plus me-1"></i> Add Another
                        </a>
                    </div>
                </div>
            `;

            setTimeout(() => {
                const alert = container.querySelector('.alert-success-custom');
                if (alert) alert.style.display = 'none';
            }, 5000);
        }

        // ============================================================
        // SAVE STOCK ITEM
        // ============================================================
        function saveStockItem(e) {
            e.preventDefault();

            // Get form values
            const item_name = document.getElementById('itemName').value.trim();
            const sku = document.getElementById('itemSku').value.trim();
            const category = document.getElementById('itemCategory').value;
            const quantity = parseInt(document.getElementById('itemQuantity').value);
            const unit = document.getElementById('itemUnit').value;
            const supplier = document.getElementById('itemSupplier').value.trim();
            const location = document.getElementById('itemLocation').value.trim();
            const status = document.getElementById('itemStatus').value;
            const description = document.getElementById('itemDescription').value.trim();

            // Validate
            if (!item_name) {
                alert('Please enter item name');
                document.getElementById('itemName').focus();
                return false;
            }
            if (!sku) {
                alert('Please enter SKU');
                document.getElementById('itemSku').focus();
                return false;
            }
            if (!category) {
                alert('Please select a category');
                document.getElementById('itemCategory').focus();
                return false;
            }
            if (isNaN(quantity) || quantity < 0) {
                alert('Please enter valid quantity (0 or more)');
                document.getElementById('itemQuantity').focus();
                return false;
            }
            if (!unit) {
                alert('Please select a unit');
                document.getElementById('itemUnit').focus();
                return false;
            }

            // Determine badge
            let badge = 'success';
            if (status === 'Low Stock') badge = 'warning';
            if (status === 'Out of Stock') badge = 'danger';

            // Colors
            const colors = ['2563EB', 'F59E0B', 'EF4444', '8B5CF6', '06B6D4', '1E293B', 'EC4899', '10B981'];
            const color = colors[Math.floor(Math.random() * colors.length)];

            // Get existing items
            const items = getStockItems();
            const newId = items.length > 0 ? Math.max(...items.map(i => i.id)) + 1 : 1;

            // Create new item - Using same structure as stock-management.php
            const newItem = {
                id: newId,
                item_name: item_name,
                sku: sku,
                category: category || 'Uncategorized',
                quantity: quantity,
                unit: unit,
                supplier: supplier || 'N/A',
                location: location || 'N/A',
                status: status,
                badge: badge,
                color: color,
                description: description,
                image: ''
            };

            // Save to localStorage
            items.push(newItem);
            saveStockItems(items);

            // Show success message
            showAlert(`Stock item '${item_name}' added successfully!`, 'success');

            // Reset form
            document.getElementById('addStockForm').reset();
            document.getElementById('itemStatus').value = 'In Stock';

            // Redirect after 1.5 seconds
            setTimeout(() => {
                window.location.href = 'stock-management.php?added=1';
            }, 1500);

            console.log('Stock item saved:', newItem);
            return false;
        }

        // ============================================================
        // SIDEBAR TOGGLE (Mobile)
        // ============================================================
        document.addEventListener('DOMContentLoaded', function() {
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

            // Auto focus on first field
            document.getElementById('itemName')?.focus();

            console.log('Add Stock Item page initialized (100% JavaScript with localStorage)');
        });
    </script>
</body>
</html>