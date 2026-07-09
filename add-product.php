<?php
$current_page = 'products';
session_start();

// Initialize products in session if not exists
if (!isset($_SESSION['products']) || empty($_SESSION['products'])) {
    $_SESSION['products'] = [
        ['id' => 1, 'name' => 'Product Alpha', 'sku' => 'ALPHA-001', 'category' => 'Electronics', 'price' => '$49.99', 'stock' => 150, 'status' => 'In Stock', 'badge' => 'success', 'color' => '2563EB'],
        ['id' => 2, 'name' => 'Product Beta', 'sku' => 'BETA-002', 'category' => 'Accessories', 'price' => '$89.00', 'stock' => 25, 'status' => 'Low Stock', 'badge' => 'warning', 'color' => 'F59E0B'],
        ['id' => 3, 'name' => 'Product Gamma', 'sku' => 'GAMMA-003', 'category' => 'Home', 'price' => '$120.00', 'stock' => 0, 'status' => 'Out of Stock', 'badge' => 'danger', 'color' => 'EF4444'],
        ['id' => 4, 'name' => 'Product Delta', 'sku' => 'DELTA-004', 'category' => 'Smart Devices', 'price' => '$199.99', 'stock' => 75, 'status' => 'In Stock', 'badge' => 'success', 'color' => '8B5CF6'],
        ['id' => 5, 'name' => 'Product Epsilon', 'sku' => 'EPSILON-005', 'category' => 'Travel', 'price' => '$34.50', 'stock' => 120, 'status' => 'In Stock', 'badge' => 'success', 'color' => '06B6D4'],
        ['id' => 6, 'name' => 'Product Zeta', 'sku' => 'ZETA-006', 'category' => 'Industrial', 'price' => '$75.00', 'stock' => 8, 'status' => 'Low Stock', 'badge' => 'warning', 'color' => '1E293B']
    ];
}

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add_product'])) {
    $name = trim($_POST['product_name'] ?? '');
    $sku = trim($_POST['product_sku'] ?? '');
    $category = trim($_POST['product_category'] ?? '');
    $status = trim($_POST['product_status'] ?? 'In Stock');
    $price = floatval($_POST['product_price'] ?? 0);
    $stock = intval($_POST['product_stock'] ?? 0);
    $description = trim($_POST['product_description'] ?? '');

    if (!empty($name) && !empty($sku) && $price > 0 && $stock >= 0) {
        $badge = 'success';
        if ($status === 'Low Stock') $badge = 'warning';
        if ($status === 'Out of Stock') $badge = 'danger';

        $colors = ['2563EB', 'F59E0B', 'EF4444', '8B5CF6', '06B6D4', '1E293B', 'EC4899', '10B981'];
        $color = $colors[array_rand($colors)];

        $newProduct = [
            'id' => count($_SESSION['products']) + 1,
            'name' => $name,
            'sku' => $sku,
            'category' => $category ?: 'Uncategorized',
            'price' => '$' . number_format($price, 2),
            'stock' => $stock,
            'status' => $status,
            'badge' => $badge,
            'color' => $color,
            'description' => $description
        ];

        $_SESSION['products'][] = $newProduct;
        $success = true;
        $successMessage = "Product '$name' added successfully!";

        $_POST = array();
    } else {
        $error = "Please fill all required fields correctly.";
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Product - Admin Panel</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/style.css">

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
        }

        .form-section .form-control,
        .form-section .form-select {
            border-radius: 0.5rem;
            border-color: #E2E8F0;
        }

        .form-section .form-control:focus,
        .form-section .form-select:focus {
            border-color: #2563EB;
            box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.15);
        }

        /* Image Upload Styles */
        .image-upload-box {
            border: 2px dashed #DBEAFE;
            border-radius: 12px;
            padding: 30px 20px;
            text-align: center;
            cursor: pointer;
            transition: all 0.3s ease;
            background: #F8FAFC;
            position: relative;
        }

        .image-upload-box:hover {
            border-color: #2563EB;
            background: #EFF6FF;
        }

        .image-upload-box .upload-icon {
            font-size: 48px;
            color: #94A3B8;
            margin-bottom: 10px;
        }

        .image-upload-box .upload-text {
            color: #64748B;
            font-size: 14px;
        }

        .image-upload-box .upload-text strong {
            color: #2563EB;
        }

        .image-upload-box input[type="file"] {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            opacity: 0;
            cursor: pointer;
        }

        .image-preview {
            display: none;
            margin-top: 12px;
            position: relative;
            display: inline-block;
        }

        .image-preview img {
            width: 120px;
            height: 120px;
            object-fit: cover;
            border-radius: 10px;
            border: 2px solid #DBEAFE;
        }

        .image-preview .remove-btn {
            position: absolute;
            top: -8px;
            right: -8px;
            width: 28px;
            height: 28px;
            border-radius: 50%;
            background: #EF4444;
            color: #fff;
            border: none;
            font-size: 12px;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .image-preview .remove-btn:hover {
            background: #DC2626;
        }

        /* Additional Images Grid */
        .additional-images-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(100px, 1fr));
            gap: 12px;
            margin-top: 12px;
        }

        .additional-image-item {
            position: relative;
            border-radius: 8px;
            border: 1px solid #E2E8F0;
            overflow: hidden;
            background: #F8FAFC;
            aspect-ratio: 1;
        }

        .additional-image-item img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .additional-image-item .remove-btn {
            position: absolute;
            top: 4px;
            right: 4px;
            width: 22px;
            height: 22px;
            border-radius: 50%;
            background: #EF4444;
            color: #fff;
            border: none;
            font-size: 10px;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .additional-image-item .remove-btn:hover {
            background: #DC2626;
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

        @media (max-width: 767.98px) {
            .main-content {
                margin-left: 0;
                padding: 10px 12px;
            }

            .form-section {
                padding: 1rem;
            }

            .alert-success-custom {
                flex-direction: column;
                gap: 8px;
                align-items: flex-start;
            }

            .additional-images-grid {
                grid-template-columns: repeat(auto-fill, minmax(80px, 1fr));
            }
        }

        @media (max-width: 479.98px) {
            .main-content {
                padding: 6px 8px;
            }

            .form-section {
                padding: 0.75rem;
            }
        }
    </style>
</head>

<body>
    <?php include 'templates/navbar.php'; ?>
    <?php include 'templates/sidebar.php'; ?>

    <div class="content-area main-content">
        <div id="add-product-page" class="page-section active-page">

            <!-- Page Header -->
            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                <h1 class="h2">Add New Product</h1>
                <a href="product.php" class="btn btn-outline-secondary btn-sm">
                    <i class="fas fa-arrow-left me-1"></i> Back to Products
                </a>
            </div>

            <!-- Success Message -->
            <?php if (isset($success) && $success): ?>
                <div class="alert-success-custom">
                    <span>
                        <i class="fas fa-check-circle me-2"></i>
                        <strong><?= $successMessage ?></strong>
                    </span>
                    <a href="product.php" class="alert-link">
                        <i class="fas fa-arrow-right me-1"></i> View Products
                    </a>
                </div>
            <?php endif; ?>

            <?php if (isset($error)): ?>
                <div class="alert-error-custom">
                    <i class="fas fa-exclamation-circle me-2"></i> <?= $error ?>
                </div>
            <?php endif; ?>

            <!-- Form -->
            <div class="form-section">
                <form id="addProductForm" action="" method="POST" enctype="multipart/form-data">
                    <input type="hidden" name="add_product" value="1">

                    <div class="row">
                        <!-- Product Name -->
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Product Name <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="productName" name="product_name" placeholder="Enter product name" value="<?= htmlspecialchars($_POST['product_name'] ?? '') ?>" required>
                        </div>
                        <!-- SKU -->
                        <div class="col-md-6 mb-3">
                            <label class="form-label">SKU <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="productSku" name="product_sku" placeholder="Enter SKU" value="<?= htmlspecialchars($_POST['product_sku'] ?? '') ?>" required>
                        </div>
                    </div>

                    <div class="row">
                        <!-- Category -->
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Category</label>
                            <select class="form-select" id="productCategory" name="product_category">
                                <option value="">Select Category</option>
                                <option <?= ($_POST['product_category'] ?? '') === 'Electronics' ? 'selected' : '' ?>>Electronics</option>
                                <option <?= ($_POST['product_category'] ?? '') === 'Accessories' ? 'selected' : '' ?>>Accessories</option>
                                <option <?= ($_POST['product_category'] ?? '') === 'Home' ? 'selected' : '' ?>>Home</option>
                                <option <?= ($_POST['product_category'] ?? '') === 'Smart Devices' ? 'selected' : '' ?>>Smart Devices</option>
                                <option <?= ($_POST['product_category'] ?? '') === 'Travel' ? 'selected' : '' ?>>Travel</option>
                                <option <?= ($_POST['product_category'] ?? '') === 'Industrial' ? 'selected' : '' ?>>Industrial</option>
                            </select>
                        </div>
                        <!-- Status -->
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Status</label>
                            <select class="form-select" id="productStatus" name="product_status">
                                <option <?= ($_POST['product_status'] ?? '') === 'In Stock' ? 'selected' : '' ?>>In Stock</option>
                                <option <?= ($_POST['product_status'] ?? '') === 'Low Stock' ? 'selected' : '' ?>>Low Stock</option>
                                <option <?= ($_POST['product_status'] ?? '') === 'Out of Stock' ? 'selected' : '' ?>>Out of Stock</option>
                            </select>
                        </div>
                    </div>

                    <div class="row">
                        <!-- Price -->
                        <div class="col-md-4 mb-3">
                            <label class="form-label">Price <span class="text-danger">*</span></label>
                            <input type="number" class="form-control" id="productPrice" name="product_price" placeholder="0.00" step="0.01" value="<?= htmlspecialchars($_POST['product_price'] ?? '') ?>" required>
                        </div>
                        <!-- Stock -->
                        <div class="col-md-4 mb-3">
                            <label class="form-label">Stock Quantity <span class="text-danger">*</span></label>
                            <input type="number" class="form-control" id="productStock" name="product_stock" placeholder="0" value="<?= htmlspecialchars($_POST['product_stock'] ?? '') ?>" required>
                        </div>
                        <!-- Weight -->
                        <div class="col-md-4 mb-3">
                            <label class="form-label">Weight (kg)</label>
                            <input type="number" class="form-control" id="productWeight" name="product_weight" placeholder="0.00" step="0.01" value="<?= htmlspecialchars($_POST['product_weight'] ?? '') ?>">
                        </div>
                    </div>

                    <!-- Description -->
                    <div class="mb-3">
                        <label class="form-label">Description</label>
                        <textarea class="form-control" id="productDescription" name="product_description" rows="3" placeholder="Product description"><?= htmlspecialchars($_POST['product_description'] ?? '') ?></textarea>
                    </div>

                    <!-- ============================================ -->
                    <!-- MAIN IMAGE UPLOAD                          -->
                    <!-- ============================================ -->
                    <div class="mb-3">
                        <label class="form-label">Main Product Image <span class="text-danger">*</span></label>
                        <div class="image-upload-box" id="mainImageUpload">
                            <div class="upload-icon">
                                <i class="fas fa-cloud-upload-alt"></i>
                            </div>
                            <div class="upload-text">
                                <strong>Click to upload</strong> or drag and drop<br>
                                <small class="text-muted">PNG, JPG, WEBP (Max 2MB)</small>
                            </div>
                            <input type="file" id="mainImage" name="main_image" accept="image/*" onchange="previewMainImage(event)">
                        </div>
                        <div class="image-preview" id="mainImagePreview">
                            <img id="mainImagePreviewImg" src="#" alt="Main Image">
                            <button type="button" class="remove-btn" onclick="removeMainImage()">
                                <i class="fas fa-times"></i>
                            </button>
                        </div>
                    </div>

                    <!-- ============================================ -->
                    <!-- ADDITIONAL IMAGES                          -->
                    <!-- ============================================ -->
                    <div class="mb-3">
                        <label class="form-label">Additional Images</label>
                        <div class="image-upload-box" id="additionalImageUpload">
                            <div class="upload-icon">
                                <i class="fas fa-images"></i>
                            </div>
                            <div class="upload-text">
                                <strong>Click to upload</strong> additional images<br>
                                <small class="text-muted">PNG, JPG, WEBP (Max 2MB each)</small>
                            </div>
                            <input type="file" id="additionalImages" name="additional_images[]" accept="image/*" multiple onchange="previewAdditionalImages(event)">
                        </div>
                        <div class="additional-images-grid" id="additionalImagesGrid">
                            <!-- Additional images will appear here -->
                        </div>
                        <small class="text-muted">You can upload multiple images. First image will be used as thumbnail.</small>
                    </div>

                    <!-- Submit Buttons -->
                    <div class="d-flex gap-2 mt-3">
                        <button type="submit" class="btn btn-primary" id="saveProductBtn">
                            <i class="fas fa-save me-1"></i> Save Product
                        </button>
                        <a href="product.php" class="btn btn-secondary">
                            <i class="fas fa-times me-1"></i> Cancel
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="assets/js/script.js"></script>

    <script>
        // ============================================================
        // MAIN IMAGE UPLOAD
        // ============================================================
        let mainImageFile = null;

        function previewMainImage(event) {
            const file = event.target.files[0];
            if (file) {
                mainImageFile = file;
                const reader = new FileReader();
                reader.onload = function(e) {
                    document.getElementById('mainImagePreviewImg').src = e.target.result;
                    document.getElementById('mainImagePreview').style.display = 'inline-block';
                    document.getElementById('mainImageUpload').style.display = 'none';
                }
                reader.readAsDataURL(file);
            }
        }

        function removeMainImage() {
            mainImageFile = null;
            document.getElementById('mainImagePreview').style.display = 'none';
            document.getElementById('mainImageUpload').style.display = 'block';
            document.getElementById('mainImage').value = '';
        }

        // ============================================================
        // ADDITIONAL IMAGES UPLOAD
        // ============================================================
        let additionalImageFiles = [];

        function previewAdditionalImages(event) {
            const files = event.target.files;
            const grid = document.getElementById('additionalImagesGrid');

            for (let i = 0; i < files.length; i++) {
                const file = files[i];
                additionalImageFiles.push(file);

                const reader = new FileReader();
                reader.onload = function(e) {
                    const div = document.createElement('div');
                    div.className = 'additional-image-item';
                    div.innerHTML = `
                        <img src="${e.target.result}" alt="Additional Image">
                        <button type="button" class="remove-btn" onclick="removeAdditionalImage(this, '${file.name}')">
                            <i class="fas fa-times"></i>
                        </button>
                    `;
                    grid.appendChild(div);
                }
                reader.readAsDataURL(file);
            }

            // Reset input to allow re-selecting same files
            document.getElementById('additionalImages').value = '';
        }

        function removeAdditionalImage(btn, fileName) {
            btn.closest('.additional-image-item').remove();
            // Remove from array
            additionalImageFiles = additionalImageFiles.filter(f => f.name !== fileName);
        }

        // ============================================================
        // DRAG AND DROP SUPPORT
        // ============================================================
        document.querySelectorAll('.image-upload-box').forEach(box => {
            box.addEventListener('dragover', function(e) {
                e.preventDefault();
                this.style.borderColor = '#2563EB';
                this.style.background = '#EFF6FF';
            });

            box.addEventListener('dragleave', function(e) {
                e.preventDefault();
                this.style.borderColor = '#DBEAFE';
                this.style.background = '#F8FAFC';
            });

            box.addEventListener('drop', function(e) {
                e.preventDefault();
                this.style.borderColor = '#DBEAFE';
                this.style.background = '#F8FAFC';

                const files = e.dataTransfer.files;
                const input = this.querySelector('input[type="file"]');
                if (input) {
                    input.files = files;
                    input.dispatchEvent(new Event('change'));
                }
            });
        });

        // ============================================================
        // FORM VALIDATION
        // ============================================================
        document.getElementById('addProductForm')?.addEventListener('submit', function(e) {
            var name = document.getElementById('productName')?.value.trim() || '';
            var sku = document.getElementById('productSku')?.value.trim() || '';
            var price = document.getElementById('productPrice')?.value || '';
            var stock = document.getElementById('productStock')?.value || '';

            if (!name) {
                e.preventDefault();
                alert('Please enter product name');
                return false;
            }
            if (!sku) {
                e.preventDefault();
                alert('Please enter SKU');
                return false;
            }
            if (!price || price <= 0) {
                e.preventDefault();
                alert('Please enter a valid price');
                return false;
            }
            if (stock === '' || stock < 0) {
                e.preventDefault();
                alert('Please enter valid stock quantity');
                return false;
            }

            // Optional: Check if main image is uploaded
            if (!mainImageFile) {
                if (!confirm('No main image uploaded. Continue without image?')) {
                    e.preventDefault();
                    return false;
                }
            }

            return true;
        });

        console.log('Add Product page initialized with image upload');
    </script>
</body>

</html>