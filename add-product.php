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
        * { box-sizing: border-box; }
        body { font-family: 'Inter', sans-serif; background: #F8FAFC; }

        .form-section {
            background: #FFFFFF;
            border-radius: 0.75rem;
            border: 1px solid #E2E8F0;
            padding: 2rem;
        }
        .form-section .form-label {
            font-weight: 600;
            color: #1E293B;
            font-size: 0.85rem;
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
        .required-star { color: #EF4444; }

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

        .images-row {
            display: flex;
            gap: 20px;
            flex-wrap: wrap;
        }
        .images-row .image-upload-box {
            flex: 1;
            min-width: 200px;
        }
        .image-upload-box {
            border: 2px dashed #DBEAFE;
            border-radius: 12px;
            padding: 25px 20px;
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
            font-size: 32px;
            color: #94A3B8;
            margin-bottom: 6px;
        }
        .image-upload-box .upload-text {
            color: #64748B;
            font-size: 0.8rem;
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
            margin-top: 10px;
            position: relative;
            display: inline-block;
        }
        .image-preview img {
            width: 100px;
            height: 100px;
            object-fit: cover;
            border-radius: 10px;
            border: 2px solid #DBEAFE;
        }
        .image-preview .remove-btn {
            position: absolute;
            top: -8px;
            right: -8px;
            width: 26px;
            height: 26px;
            border-radius: 50%;
            background: #EF4444;
            color: #fff;
            border: none;
            font-size: 11px;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .image-preview .remove-btn:hover { background: #DC2626; }

        .additional-images-grid {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
            margin-top: 10px;
        }
        .additional-image-item {
            position: relative;
            width: 80px;
            height: 80px;
            border-radius: 8px;
            border: 1px solid #E2E8F0;
            overflow: hidden;
            background: #F8FAFC;
        }
        .additional-image-item img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }
        .additional-image-item .remove-btn {
            position: absolute;
            top: 3px;
            right: 3px;
            width: 20px;
            height: 20px;
            border-radius: 50%;
            background: #EF4444;
            color: #fff;
            border: none;
            font-size: 9px;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .additional-image-item .remove-btn:hover { background: #DC2626; }

        .variations-grid {
            display: grid;
            grid-template-columns: 1fr 1fr 1fr 1fr auto;
            gap: 10px;
            align-items: end;
            padding: 12px;
            background: #F8FAFC;
            border-radius: 0.5rem;
            border: 1px solid #E2E8F0;
            margin-bottom: 10px;
        }
        .variations-grid .form-label {
            font-size: 0.7rem;
            margin-bottom: 4px;
            color: #64748B;
        }
        .variations-grid .form-control,
        .variations-grid .form-select {
            font-size: 0.8rem;
            padding: 0.3rem 0.5rem;
        }
        .variations-grid .btn-remove-variation {
            color: #EF4444;
            background: none;
            border: none;
            font-size: 0.85rem;
            cursor: pointer;
            padding: 6px 10px;
            margin-top: 22px;
        }
        .variations-grid .btn-remove-variation:hover { color: #DC2626; }

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

        .toggle-switch {
            position: relative;
            width: 44px;
            height: 24px;
            display: inline-block;
        }
        .toggle-switch input {
            opacity: 0;
            width: 0;
            height: 0;
        }
        .toggle-slider {
            position: absolute;
            cursor: pointer;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: #CBD5E1;
            transition: .4s;
            border-radius: 24px;
        }
        .toggle-slider:before {
            position: absolute;
            content: "";
            height: 18px;
            width: 18px;
            left: 3px;
            bottom: 3px;
            background: white;
            transition: .4s;
            border-radius: 50%;
        }
        .toggle-switch input:checked + .toggle-slider { background: #2563EB; }
        .toggle-switch input:checked + .toggle-slider:before { transform: translateX(20px); }

        .toggle-label {
            font-size: 0.8rem;
            color: #64748B;
            margin-left: 8px;
        }

        

        .sidebar-toggle {
            display: none;
            background: transparent;
            border: none;
            color: #1E293B;
            font-size: 1.2rem;
            padding: 0 10px;
        }

        @media (max-width: 767.98px) {
            .main-content { margin-left: 0; padding: 10px 12px; }
            .form-section { padding: 1rem; }
            .images-row { flex-direction: column; }
            .variations-grid {
                grid-template-columns: 1fr 1fr;
            }
            .variations-grid .btn-remove-variation {
                grid-column: span 2;
                justify-self: end;
                margin-top: 0;
            }
            .image-preview img { width: 80px; height: 80px; }
            .additional-image-item { width: 65px; height: 65px; }
            .sidebar-toggle { display: block !important; }
            .breadcrumb-custom { font-size: 0.8rem; }
            .alert-success-custom { flex-direction: column; gap: 8px; align-items: flex-start; }
        }
        @media (max-width: 479.98px) {
            .main-content { padding: 6px 8px; }
            .form-section { padding: 0.75rem; }
            .variations-grid {
                grid-template-columns: 1fr;
            }
            .variations-grid .btn-remove-variation {
                grid-column: span 1;
            }
            .image-preview img { width: 70px; height: 70px; }
            .additional-image-item { width: 55px; height: 55px; }
            .breadcrumb-custom { font-size: 0.75rem; }
        }
    </style>
</head>
<body>
    <?php include 'templates/navbar.php'; ?>
    <?php include 'templates/sidebar.php'; ?>

    <div class="content-area main-content">
        <div id="add-product-page" class="page-section active-page">

            

            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                <h1 class="h2">Add New Product</h1>
                <a href="product.php" class="btn btn-outline-secondary btn-sm">
                    <i class="fas fa-arrow-left me-1"></i> Back to Products
                </a>
            </div>

            <!-- Alert Container -->
            <div id="alertContainer"></div>

            <div class="form-section">
                <form id="addProductForm" onsubmit="return saveProduct(event)">
                    <input type="hidden" name="add_product" value="1">

                    <div class="section-header">
                        <h6>Product Information</h6>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Product Name <span class="required-star">*</span></label>
                            <input type="text" class="form-control" id="productName" placeholder="Enter product name" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">SKU <span class="required-star">*</span></label>
                            <input type="text" class="form-control" id="productSku" placeholder="Enter unique SKU" required>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Slug <span class="required-star">*</span></label>
                            <input type="text" class="form-control" id="productSlug" placeholder="e.g., product-name" required>
                            <small class="text-muted">URL friendly version of the product name (auto-generated)</small>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Category <span class="required-star">*</span></label>
                            <select class="form-select" id="productCategory" required>
                                <option value="">Select Category</option>
                                <option value="Electronics">Electronics</option>
                                <option value="Accessories">Accessories</option>
                                <option value="Home">Home</option>
                                <option value="Smart Devices">Smart Devices</option>
                                <option value="Travel">Travel</option>
                                <option value="Industrial">Industrial</option>
                                <option value="Fashion">Fashion</option>
                            </select>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Sub Category</label>
                            <input type="text" class="form-control" id="productSubcategory" placeholder="Enter sub category">
                        </div>
                        <div class="col-md-6 mb-3">
                            <!-- Empty space for alignment -->
                        </div>
                    </div>

                    <div class="section-header">
                        <h6>Product Images</h6>
                    </div>

                    <div class="images-row">
                        <div class="image-upload-box" id="mainImageUpload">
                            <div class="upload-icon">
                                <i class="fas fa-cloud-upload-alt"></i>
                            </div>
                            <div class="upload-text">
                                <strong>Main Image</strong><br>
                                <small class="text-muted">PNG, JPG (Max 2MB)</small>
                            </div>
                            <input type="file" id="mainImage" accept="image/*" onchange="previewMainImage(event)">
                        </div>

                        <div class="image-upload-box" id="additionalImageUpload">
                            <div class="upload-icon">
                                <i class="fas fa-images"></i>
                            </div>
                            <div class="upload-text">
                                <strong>Additional Images</strong><br>
                                <small class="text-muted">Multiple images allowed</small>
                            </div>
                            <input type="file" id="additionalImages" accept="image/*" multiple onchange="previewAdditionalImages(event)">
                        </div>
                    </div>

                    <div class="row mt-3">
                        <div class="col-md-6">
                            <div class="image-preview" id="mainImagePreview" style="display: none;">
                                <img id="mainImagePreviewImg" src="#" alt="Main Image">
                                <button type="button" class="remove-btn" onclick="removeMainImage()">
                                    <i class="fas fa-times"></i>
                                </button>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="additional-images-grid" id="additionalImagesGrid"></div>
                        </div>
                    </div>

                    <div class="mb-3 mt-3">
                        <label class="form-label">Description</label>
                        <textarea class="form-control" id="productDescription" rows="3" placeholder="Detailed product description"></textarea>
                    </div>

                    <div class="section-header">
                        <h6>Price & Stock</h6>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Selling Price <span class="required-star">*</span></label>
                            <div class="input-group">
                                <span class="input-group-text">INR</span>
                                <input type="number" class="form-control" id="productPrice" placeholder="0.00" step="0.01" min="0.01" required>
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">MRP Price</label>
                            <div class="input-group">
                                <span class="input-group-text">INR</span>
                                <input type="number" class="form-control" id="productMrp" placeholder="0.00" step="0.01">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-4 mb-3">
                            <label class="form-label">Unit <span class="required-star">*</span></label>
                            <select class="form-select" id="unit" required>
                                <option value="piece">Piece</option>
                                <option value="kg">Kg</option>
                                <option value="g">Gram</option>
                                <option value="liter">Liter</option>
                                <option value="ml">ML</option>
                                <option value="box">Box</option>
                                <option value="pack">Pack</option>
                            </select>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label class="form-label">Minimum Purchase</label>
                            <input type="number" class="form-control" id="minPurchase" placeholder="1" min="1" value="1">
                        </div>
                        <div class="col-md-4 mb-3">
                            <label class="form-label">Maximum Purchase</label>
                            <input type="number" class="form-control" id="maxPurchase" placeholder="0 (unlimited)" min="0" value="0">
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Total Stocks <span class="required-star">*</span></label>
                            <div class="input-group">
                                <input type="number" class="form-control" id="productStock" placeholder="0" min="0" required>
                                <span class="input-group-text" id="unitLabel">piece</span>
                            </div>
                            <small class="text-muted">Enter how many stocks you have currently on this product</small>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Stock for Buy</label>
                            <div class="input-group">
                                <input type="number" class="form-control" id="stockForBuy" placeholder="0" min="0" value="0">
                                <span class="input-group-text">piece</span>
                            </div>
                            <small class="text-muted">Enter Customers Maximum Purchase quantity restrictions</small>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-4 mb-3">
                            <label class="form-label">Weight</label>
                            <div class="input-group">
                                <input type="number" class="form-control" id="weight" placeholder="0.00" step="0.01" value="0">
                                <span class="input-group-text">kg</span>
                            </div>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label class="form-label">Unlimited Stock</label>
                            <div class="d-flex align-items-center mt-2">
                                <label class="toggle-switch">
                                    <input type="checkbox" id="unlimitedStock">
                                    <span class="toggle-slider"></span>
                                </label>
                                <span class="toggle-label">Enable unlimited stock</span>
                            </div>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label class="form-label">Out of Stock</label>
                            <div class="d-flex align-items-center mt-2">
                                <label class="toggle-switch">
                                    <input type="checkbox" id="outOfStock">
                                    <span class="toggle-slider"></span>
                                </label>
                                <span class="toggle-label">Mark as out of stock</span>
                            </div>
                        </div>
                    </div>

                    <div class="section-header mt-4">
                        <h6>Status & Visibility</h6>
                    </div>

                    <div class="row">
                        <div class="col-md-4 mb-3">
                            <label class="form-label">Status <span class="required-star">*</span></label>
                            <select class="form-select" id="productStatus">
                                <option value="In Stock">In Stock</option>
                                <option value="Low Stock">Low Stock</option>
                                <option value="Out of Stock">Out of Stock</option>
                            </select>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label class="form-label">Visibility</label>
                            <select class="form-select" id="productVisibility">
                                <option value="Published">Published</option>
                                <option value="Draft">Draft</option>
                                <option value="Archived">Archived</option>
                            </select>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label class="form-label">Badge</label>
                            <select class="form-select" id="productBadge">
                                <option value="">None</option>
                                <option value="New">New</option>
                                <option value="Sale">Sale</option>
                                <option value="Hot">Hot</option>
                                <option value="Trending">Trending</option>
                                <option value="Limited">Limited</option>
                            </select>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Tags</label>
                        <input type="text" class="form-control" id="productTags" placeholder="new, featured, sale, trending">
                        <small class="text-muted">Comma separated tags</small>
                    </div>

                    <div class="section-header mt-4">
                        <h6>Product Variations</h6>
                    </div>

                    <div id="variationsContainer">
                        <div class="variations-grid">
                            <div>
                                <label class="form-label">Variation Name</label>
                                <input type="text" class="form-control" name="variation_name[]" placeholder="e.g., Size L">
                            </div>
                            <div>
                                <label class="form-label">SKU</label>
                                <input type="text" class="form-control" name="variation_sku[]" placeholder="SKU">
                            </div>
                            <div>
                                <label class="form-label">Price</label>
                                <input type="number" class="form-control" name="variation_price[]" placeholder="0.00" step="0.01">
                            </div>
                            <div>
                                <label class="form-label">Stock</label>
                                <input type="number" class="form-control" name="variation_stock[]" placeholder="0" min="0">
                            </div>
                            <div>
                                <button type="button" class="btn-remove-variation" onclick="removeVariation(this)">
                                    <i class="fas fa-times-circle"></i>
                                </button>
                            </div>
                        </div>
                    </div>

                    <button type="button" class="btn btn-sm btn-outline-primary mt-2" onclick="addVariation()">
                        <i class="fas fa-plus me-1"></i> Add Variation
                    </button>
                    <small class="d-block text-muted mt-2">Add variations like size, color, material etc.</small>

                    <div class="section-header mt-4">
                        <h6>SEO Information</h6>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">SEO Title</label>
                        <input type="text" class="form-control" id="seoTitle" placeholder="SEO title (50-60 characters)">
                        <small class="text-muted">Recommended length: 50-60 characters</small>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">SEO Description</label>
                        <textarea class="form-control" id="seoDescription" rows="2" placeholder="SEO description (150-160 characters)"></textarea>
                        <small class="text-muted">Recommended length: 150-160 characters</small>
                    </div>

                    <div class="d-flex gap-2 flex-wrap mt-4 pt-3 border-top">
                        <button type="submit" class="btn btn-primary" id="saveProductBtn">
                            Save Product
                        </button>
                        <a href="product.php" class="btn btn-secondary">
                            Cancel
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
        // PRODUCT DATA (Stored in localStorage)
        // ============================================================
        function getProducts() {
            return JSON.parse(localStorage.getItem('products') || '[]');
        }

        function saveProducts(products) {
            localStorage.setItem('products', JSON.stringify(products));
        }

        // Initialize products in localStorage if empty
        if (getProducts().length === 0) {
            const defaultProducts = [
                {id: 1, name: 'Lotus', sku: 'LOTUS-001', slug: 'lotus', category: 'Flowers', subcategory: 'N/A', price: '99.00', mrp: '100.00', stock: 9999, min_purchase: 1, max_purchase: 10, unit: 'piece', weight: '0.00', status: 'In Stock', badge: 'success', badge_text: '', color: '2563EB', visibility: 'Published', tags: '', unlimited_stock: true, out_of_stock: false, seo_title: 'Lotus', seo_description: '', description: '', main_image: '', additional_images: [], variations: [], visitors: 0},
                {id: 2, name: 'White and Red Rose Wedding Garland', sku: 'ROSE-002', slug: 'white-red-rose-wedding-garland', category: 'Wedding', subcategory: 'N/A', price: '199.00', mrp: '199.00', stock: 15, min_purchase: 1, max_purchase: 5, unit: 'piece', weight: '0.00', status: 'In Stock', badge: 'success', badge_text: '', color: 'F59E0B', visibility: 'Published', tags: '', unlimited_stock: false, out_of_stock: false, seo_title: 'White and Red Rose Wedding Garland', seo_description: '', description: '', main_image: '', additional_images: [], variations: [], visitors: 3},
                {id: 3, name: 'Vale', sku: 'VALE-003', slug: 'vale', category: 'Flowers', subcategory: 'N/A', price: '279.00', mrp: '279.00', stock: 20, min_purchase: 1, max_purchase: 2, unit: 'piece', weight: '0.00', status: 'In Stock', badge: 'success', badge_text: '', color: 'EF4444', visibility: 'Published', tags: '', unlimited_stock: false, out_of_stock: false, seo_title: 'Vale', seo_description: '', description: '', main_image: '', additional_images: [], variations: [], visitors: 2},
                {id: 4, name: 'Paradise Mixed Roses Bouquet', sku: 'PARADISE-004', slug: 'paradise-mixed-roses-bouquet', category: 'Bouquet', subcategory: 'N/A', price: '449.00', mrp: '449.00', stock: 12, min_purchase: 1, max_purchase: 3, unit: 'piece', weight: '0.00', status: 'In Stock', badge: 'success', badge_text: '', color: '8B5CF6', visibility: 'Published', tags: '', unlimited_stock: false, out_of_stock: false, seo_title: 'Paradise Mixed Roses Bouquet', seo_description: '', description: '', main_image: '', additional_images: [], variations: [], visitors: 0},
                {id: 5, name: 'Flowers Bouquet In Paper Packing', sku: 'PAPER-005', slug: 'flowers-bouquet-in-paper-packing', category: 'Bouquet', subcategory: 'N/A', price: '199.00', mrp: '199.00', stock: 30, min_purchase: 1, max_purchase: 5, unit: 'piece', weight: '0.00', status: 'In Stock', badge: 'success', badge_text: '', color: '06B6D4', visibility: 'Published', tags: '', unlimited_stock: false, out_of_stock: false, seo_title: 'Flowers Bouquet In Paper Packing', seo_description: '', description: '', main_image: '', additional_images: [], variations: [], visitors: 0},
                {id: 6, name: 'Flower Fantasy', sku: 'FANTASY-006', slug: 'flower-fantasy', category: 'Flowers', subcategory: 'N/A', price: '349.00', mrp: '349.00', stock: 17, min_purchase: 1, max_purchase: 2, unit: 'piece', weight: '0.00', status: 'In Stock', badge: 'success', badge_text: '', color: '1E293B', visibility: 'Published', tags: '', unlimited_stock: false, out_of_stock: false, seo_title: 'Flower Fantasy', seo_description: '', description: '', main_image: '', additional_images: [], variations: [], visitors: 0},
                {id: 7, name: 'Floral n Chocolatey Elegance', sku: 'CHOCOLATE-007', slug: 'floral-n-chocolatey-elegance', category: 'Gifts', subcategory: 'N/A', price: '599.00', mrp: '599.00', stock: 22, min_purchase: 1, max_purchase: 2, unit: 'piece', weight: '0.00', status: 'In Stock', badge: 'success', badge_text: '', color: 'EC4899', visibility: 'Published', tags: '', unlimited_stock: false, out_of_stock: false, seo_title: 'Floral n Chocolatey Elegance', seo_description: '', description: '', main_image: '', additional_images: [], variations: [], visitors: 0}
            ];
            saveProducts(defaultProducts);
        }

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

            document.getElementById('additionalImages').value = '';
        }

        function removeAdditionalImage(btn, fileName) {
            btn.closest('.additional-image-item').remove();
            additionalImageFiles = additionalImageFiles.filter(f => f.name !== fileName);
        }

        // ============================================================
        // AUTO GENERATE SLUG FROM PRODUCT NAME
        // ============================================================
        document.getElementById('productName')?.addEventListener('input', function() {
            var slugField = document.getElementById('productSlug');
            if (!slugField.value.trim()) {
                var name = this.value.trim().toLowerCase().replace(/[^a-zA-Z0-9]+/g, '-');
                slugField.value = name;
            }
        });

        // ============================================================
        // AUTO GENERATE SKU FROM PRODUCT NAME
        // ============================================================
        document.getElementById('productName')?.addEventListener('input', function() {
            var skuField = document.getElementById('productSku');
            if (!skuField.value.trim()) {
                var name = this.value.trim().toUpperCase().replace(/[^A-Z0-9]/g, '-');
                skuField.value = name + '-' + Date.now().toString().slice(-4);
            }
        });

        // ============================================================
        // AUTO UPDATE STATUS BASED ON STOCK
        // ============================================================
        document.getElementById('productStock')?.addEventListener('input', function() {
            var qty = parseInt(this.value) || 0;
            var statusSelect = document.getElementById('productStatus');
            if (qty <= 0) {
                statusSelect.value = 'Out of Stock';
            } else if (qty <= 10) {
                statusSelect.value = 'Low Stock';
            } else {
                statusSelect.value = 'In Stock';
            }
        });

        // ============================================================
        // UPDATE UNIT LABEL BASED ON UNIT SELECTION
        // ============================================================
        document.getElementById('unit')?.addEventListener('change', function() {
            const unit = this.value;
            document.getElementById('unitLabel').textContent = unit;
        });

        // ============================================================
        // VARIATIONS
        // ============================================================
        function addVariation() {
            const container = document.getElementById('variationsContainer');
            const template = `
                <div class="variations-grid">
                    <div>
                        <label class="form-label">Variation Name</label>
                        <input type="text" class="form-control" name="variation_name[]" placeholder="e.g., Size L">
                    </div>
                    <div>
                        <label class="form-label">SKU</label>
                        <input type="text" class="form-control" name="variation_sku[]" placeholder="SKU">
                    </div>
                    <div>
                        <label class="form-label">Price</label>
                        <input type="number" class="form-control" name="variation_price[]" placeholder="0.00" step="0.01">
                    </div>
                    <div>
                        <label class="form-label">Stock</label>
                        <input type="number" class="form-control" name="variation_stock[]" placeholder="0" min="0">
                    </div>
                    <div>
                        <button type="button" class="btn-remove-variation" onclick="removeVariation(this)">
                            <i class="fas fa-times-circle"></i>
                        </button>
                    </div>
                </div>
            `;
            container.insertAdjacentHTML('beforeend', template);
        }

        function removeVariation(btn) {
            const row = btn.closest('.variations-grid');
            if (document.querySelectorAll('.variations-grid').length > 1) {
                row.remove();
            } else {
                alert('You must have at least one variation row.');
            }
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
        // SHOW ALERT
        // ============================================================
        function showAlert(message, type = 'error') {
            const container = document.getElementById('alertContainer');
            
            if (type === 'success') {
                container.innerHTML = `
                    <div class="alert-success-custom">
                        <span>
                            <i class="fas fa-check-circle me-2"></i> 
                            <strong>${message}</strong>
                        </span>
                        <a href="product.php" class="alert-link">
                            <i class="fas fa-arrow-right me-1"></i> View Products
                        </a>
                    </div>
                `;
            } else {
                container.innerHTML = `
                    <div class="alert-error-custom">
                        <i class="fas fa-exclamation-circle me-2"></i> ${message}
                    </div>
                `;
            }

            // Scroll to alert
            container.scrollIntoView({ behavior: 'smooth', block: 'center' });

            // Auto hide after 5 seconds
            setTimeout(() => {
                const alert = container.querySelector('.alert-success-custom, .alert-error-custom');
                if (alert) {
                    alert.style.display = 'none';
                }
            }, 5000);
        }

        // ============================================================
        // SAVE PRODUCT
        // ============================================================
        function saveProduct(e) {
            e.preventDefault();

            // Get form values
            const name = document.getElementById('productName').value.trim();
            const sku = document.getElementById('productSku').value.trim();
            const slug = document.getElementById('productSlug').value.trim();
            const category = document.getElementById('productCategory').value;
            const subcategory = document.getElementById('productSubcategory').value.trim();
            const price = parseFloat(document.getElementById('productPrice').value);
            const mrp = parseFloat(document.getElementById('productMrp').value) || 0;
            const stock = parseInt(document.getElementById('productStock').value);
            const min_purchase = parseInt(document.getElementById('minPurchase').value) || 1;
            const max_purchase = parseInt(document.getElementById('maxPurchase').value) || 0;
            const unit = document.getElementById('unit').value;
            const weight = parseFloat(document.getElementById('weight').value) || 0;
            const status = document.getElementById('productStatus').value;
            const visibility = document.getElementById('productVisibility').value;
            const badge_text = document.getElementById('productBadge').value;
            const tags = document.getElementById('productTags').value.trim();
            const seo_title = document.getElementById('seoTitle').value.trim();
            const seo_description = document.getElementById('seoDescription').value.trim();
            const description = document.getElementById('productDescription').value.trim();

            // Get variations
            const variationNames = document.getElementsByName('variation_name[]');
            const variationSkus = document.getElementsByName('variation_sku[]');
            const variationPrices = document.getElementsByName('variation_price[]');
            const variationStocks = document.getElementsByName('variation_stock[]');
            const variations = [];
            for (let i = 0; i < variationNames.length; i++) {
                if (variationNames[i].value.trim()) {
                    variations.push({
                        name: variationNames[i].value.trim(),
                        sku: variationSkus[i]?.value.trim() || '',
                        price: parseFloat(variationPrices[i]?.value) || 0,
                        stock: parseInt(variationStocks[i]?.value) || 0
                    });
                }
            }

            // ============================================================
            // VALIDATION - Show proper error messages
            // ============================================================
            if (!name) {
                showAlert('Please enter product name', 'error');
                document.getElementById('productName').focus();
                return false;
            }
            if (!sku) {
                showAlert('Please enter SKU', 'error');
                document.getElementById('productSku').focus();
                return false;
            }
            if (!slug) {
                showAlert('Please enter slug', 'error');
                document.getElementById('productSlug').focus();
                return false;
            }
            if (!category) {
                showAlert('Please select a category', 'error');
                document.getElementById('productCategory').focus();
                return false;
            }
            if (!price || price <= 0) {
                showAlert('Please enter a valid selling price', 'error');
                document.getElementById('productPrice').focus();
                return false;
            }
            if (isNaN(stock) || stock < 0) {
                showAlert('Please enter valid stock quantity', 'error');
                document.getElementById('productStock').focus();
                return false;
            }

            // Create product object
            const colors = ['2563EB', 'F59E0B', 'EF4444', '8B5CF6', '06B6D4', '1E293B', 'EC4899', '10B981'];
            const color = colors[Math.floor(Math.random() * colors.length)];
            
            let badge = 'success';
            if (status === 'Low Stock') badge = 'warning';
            if (status === 'Out of Stock') badge = 'danger';

            // Get existing products
            const products = getProducts();
            const newId = products.length > 0 ? Math.max(...products.map(p => p.id)) + 1 : 1;

            const newProduct = {
                id: newId,
                name: name,
                sku: sku,
                slug: slug,
                category: category,
                subcategory: subcategory || 'N/A',
                price: price.toFixed(2),
                mrp: mrp ? mrp.toFixed(2) : '0.00',
                stock: stock,
                min_purchase: min_purchase,
                max_purchase: max_purchase,
                unit: unit,
                weight: weight ? weight.toFixed(2) : '0.00',
                status: status,
                badge: badge,
                badge_text: badge_text,
                color: color,
                visibility: visibility,
                tags: tags,
                unlimited_stock: document.getElementById('unlimitedStock').checked,
                out_of_stock: document.getElementById('outOfStock').checked,
                seo_title: seo_title || name,
                seo_description: seo_description || description,
                description: description,
                main_image: mainImageFile ? URL.createObjectURL(mainImageFile) : '',
                additional_images: additionalImageFiles.map(f => URL.createObjectURL(f)),
                variations: variations,
                visitors: 0
            };

            // Save to localStorage
            products.push(newProduct);
            saveProducts(products);

            // Show success message (but don't redirect with success param)
            showAlert(`Product '${name}' added successfully!`, 'success');

            // Reset form
            document.getElementById('addProductForm').reset();
            document.getElementById('mainImagePreview').style.display = 'none';
            document.getElementById('mainImageUpload').style.display = 'block';
            document.getElementById('additionalImagesGrid').innerHTML = '';
            mainImageFile = null;
            additionalImageFiles = [];
            document.getElementById('unitLabel').textContent = 'piece';

            // Redirect to product.php without any query parameter
            setTimeout(() => {
                window.location.href = 'product.php';
            }, 1500);

            console.log('Product saved:', newProduct);
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

            console.log('Add Product page initialized (100% JavaScript with localStorage)');
        });
    </script>
</body>
</html>