<?php
include 'config/config.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <?php include 'templates/head.php'; ?>

    <style>
        /* ============================================
           FORM SECTION
           ============================================ */
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
        .required-star {
            color: #EF4444;
        }

        /* ============================================
           SECTION HEADERS
           ============================================ */
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

        /* ============================================
           IMAGE UPLOAD
           ============================================ */
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

        .images-row {
            display: flex;
            gap: 20px;
            flex-wrap: wrap;
        }
        .images-row .image-upload-box {
            flex: 1;
            min-width: 200px;
        }

        /* ============================================
           TOGGLE SWITCH
           ============================================ */
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

        /* ============================================
           VARIATIONS - Full layout (no Color/Size)
           ============================================ */
        .variations-grid {
            display: grid;
            grid-template-columns: 1fr 1fr 1fr;
            gap: 15px 20px;
            padding: 20px;
            background: #F8FAFC;
            border-radius: 0.5rem;
            border: 1px solid #E2E8F0;
            margin-bottom: 10px;
            position: relative;
        }
        .variations-grid .form-label {
            font-size: 0.75rem;
            margin-bottom: 4px;
            color: #64748B;
            font-weight: 600;
        }
        .variations-grid .form-control,
        .variations-grid .form-select {
            font-size: 0.85rem;
            padding: 0.4rem 0.6rem;
            border-radius: 0.4rem;
        }
        .variations-grid .btn-remove-variation {
            position: absolute;
            top: 10px;
            right: 10px;
            color: #EF4444;
            background: none;
            border: none;
            font-size: 1rem;
            cursor: pointer;
            padding: 4px 8px;
        }
        .variations-grid .btn-remove-variation:hover { color: #DC2626; }

        .variations-grid .full-width {
            grid-column: 1 / -1;
        }

        /* Scrollable variation container */
        #variationsContainer {
            max-height: 600px;
            overflow-y: auto;
            overflow-x: auto;
            padding-right: 5px;
        }
        #variationsContainer::-webkit-scrollbar {
            width: 6px;
            height: 6px;
        }
        #variationsContainer::-webkit-scrollbar-track {
            background: #F1F5F9;
            border-radius: 10px;
        }
        #variationsContainer::-webkit-scrollbar-thumb {
            background: #CBD5E1;
            border-radius: 10px;
        }
        #variationsContainer::-webkit-scrollbar-thumb:hover {
            background: #94A3B8;
        }

        /* Toggle switch inside variation */
        .variation-toggle {
            display: flex;
            align-items: center;
            gap: 10px;
            margin-top: 6px;
        }
        .variation-toggle .toggle-switch {
            position: relative;
            width: 40px;
            height: 22px;
            display: inline-block;
        }
        .variation-toggle .toggle-switch input {
            opacity: 0;
            width: 0;
            height: 0;
        }
        .variation-toggle .toggle-slider {
            position: absolute;
            cursor: pointer;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: #CBD5E1;
            transition: .3s;
            border-radius: 22px;
        }
        .variation-toggle .toggle-slider:before {
            position: absolute;
            content: "";
            height: 16px;
            width: 16px;
            left: 3px;
            bottom: 3px;
            background: white;
            transition: .3s;
            border-radius: 50%;
        }
        .variation-toggle .toggle-switch input:checked + .toggle-slider { background: #2563EB; }
        .variation-toggle .toggle-switch input:checked + .toggle-slider:before { transform: translateX(18px); }
        .variation-toggle .toggle-label {
            font-size: 0.8rem;
            color: #64748B;
        }

        /* Variation image upload */
        .variation-image-box {
            border: 2px dashed #DBEAFE;
            border-radius: 8px;
            padding: 12px;
            text-align: center;
            cursor: pointer;
            transition: all 0.3s ease;
            background: #FFFFFF;
            position: relative;
        }
        .variation-image-box:hover {
            border-color: #2563EB;
            background: #EFF6FF;
        }
        .variation-image-box .upload-icon {
            font-size: 20px;
            color: #94A3B8;
        }
        .variation-image-box .upload-text {
            color: #64748B;
            font-size: 0.7rem;
        }
        .variation-image-box input[type="file"] {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            opacity: 0;
            cursor: pointer;
        }
        .variation-image-preview {
            display: none;
            position: relative;
            margin-top: 5px;
        }
        .variation-image-preview img {
            width: 60px;
            height: 60px;
            object-fit: cover;
            border-radius: 6px;
            border: 1px solid #DBEAFE;
        }
        .variation-image-preview .remove-btn {
            position: absolute;
            top: -6px;
            right: -6px;
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

        /* Weight with unit dropdown */
        .weight-input-group {
            display: flex;
            align-items: stretch;
        }
        .weight-input-group .form-control {
            border-radius: 0.4rem 0 0 0.4rem;
            border-right: none;
            flex: 1;
            min-width: 0;
        }
        .weight-input-group .form-select {
            border-radius: 0 0.4rem 0.4rem 0;
            width: auto;
            flex: 0 0 75px;
            padding: 0.35rem 0.3rem;
            font-size: 0.75rem;
        }
        .weight-input-group .form-control:focus + .form-select,
        .weight-input-group .form-select:focus {
            border-color: #2563EB;
            box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.15);
        }

        /* ============================================
           ALERTS
           ============================================ */
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

        /* ============================================
           SIDEBAR TOGGLE
           ============================================ */
        .sidebar-toggle {
            display: none;
            background: transparent;
            border: none;
            color: #1E293B;
            font-size: 1.2rem;
            padding: 0 10px;
        }

        /* ============================================
           RESPONSIVE
           ============================================ */
        @media (max-width: 991.98px) {
            .variations-grid {
                grid-template-columns: 1fr 1fr;
            }
        }
        @media (max-width: 767.98px) {
            .sidebar-wrapper { width: 0; transform: translateX(-100%); transition: all 0.3s ease; }
            .sidebar-wrapper.open { width: 280px; transform: translateX(0); }
            .main-content { margin-left: 0; padding: 10px 12px; }
            .sidebar-toggle { display: block !important; }
            .form-section { padding: 1rem; }
            .alert-success-custom { flex-direction: column; gap: 8px; align-items: flex-start; }
            .images-row { flex-direction: column; }
            .variations-grid {
                grid-template-columns: 1fr;
            }
            .variations-grid .full-width {
                grid-column: 1;
            }
            .weight-input-group .form-select {
                flex: 0 0 65px;
            }
        }
        @media (max-width: 479.98px) {
            .main-content { padding: 6px 8px; }
            .form-section { padding: 0.75rem; }
            .variations-grid {
                grid-template-columns: 1fr;
            }
            .weight-input-group .form-select {
                flex: 0 0 60px;
            }
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
        <div id="edit-product-page" class="page-section active-page">
            
            <!-- Page Header -->
            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                <h1 class="h2">Edit Product</h1>
                <div class="btn-toolbar mb-2 mb-md-0">
                    <div class="btn-group me-2">
                        <a href="product_v2.php" class="btn btn-sm btn-outline-secondary">
                            <i class="fas fa-arrow-left me-1"></i> Back to Products
                        </a>
                    </div>
                </div>
            </div>

            <!-- Alert Container -->
            <div id="alertContainer"></div>

            <!-- Form -->
            <div class="form-section">
                <form id="editProductForm" onsubmit="return updateProduct(event)">
                    <input type="hidden" name="update_product" value="1">
                    <input type="hidden" name="product_id" id="productId" value="">

                    <!-- ========================================== -->
                    <!-- PRODUCT INFORMATION                       -->
                    <!-- ========================================== -->
                    <div class="section-header">
                        <h6>Product Information</h6>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Product Name <span class="required-star">*</span></label>
                            <input type="text" class="form-control" id="productName" name="product_name" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">SKU <span class="required-star">*</span></label>
                            <input type="text" class="form-control" id="productSku" name="product_sku" required>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Slug <span class="required-star">*</span></label>
                            <input type="text" class="form-control" id="productSlug" name="product_slug" placeholder="e.g., product-name" required>
                            <small class="text-muted">URL friendly version of the product name</small>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Category <span class="required-star">*</span></label>
                            <select class="form-select" id="productCategory" name="product_category" required>
                                <option value="">Select Category</option>
                                <option value="Electronics">Electronics</option>
                                <option value="Accessories">Accessories</option>
                                <option value="Home">Home</option>
                                <option value="Smart Devices">Smart Devices</option>
                                <option value="Travel">Travel</option>
                                <option value="Industrial">Industrial</option>
                                <option value="Flowers">Flowers</option>
                                <option value="Wedding">Wedding</option>
                                <option value="Bouquet">Bouquet</option>
                                <option value="Gifts">Gifts</option>
                            </select>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Sub Category</label>
                            <input type="text" class="form-control" id="productSubcategory" name="product_subcategory" placeholder="Enter sub category">
                        </div>
                        <div class="col-md-6 mb-3">
                            <!-- Empty space for alignment -->
                        </div>
                    </div>

                    <!-- ========================================== -->
                    <!-- PRODUCT IMAGES                            -->
                    <!-- ========================================== -->
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

                    <!-- ========================================== -->
                    <!-- DESCRIPTION                               -->
                    <!-- ========================================== -->
                    <div class="mb-3 mt-3">
                        <label class="form-label">Description</label>
                        <textarea class="form-control" id="productDescription" name="product_description" rows="3" placeholder="Detailed product description"></textarea>
                    </div>

                    <!-- ========================================== -->
                    <!-- PRICE & STOCK                             -->
                    <!-- ========================================== -->
                    <div class="section-header">
                        <h6>Price & Stock</h6>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Selling Price <span class="required-star">*</span></label>
                            <div class="input-group">
                                <span class="input-group-text">INR</span>
                                <input type="number" class="form-control" id="productPrice" name="product_price" step="0.01" min="0.01" required>
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">MRP Price</label>
                            <div class="input-group">
                                <span class="input-group-text">INR</span>
                                <input type="number" class="form-control" id="productMrp" name="product_mrp" step="0.01">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-4 mb-3">
                            <label class="form-label">Unit <span class="required-star">*</span></label>
                            <select class="form-select" id="unit" name="unit" required>
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
                            <input type="number" class="form-control" id="minPurchase" name="min_purchase" min="1" value="1">
                        </div>
                        <div class="col-md-4 mb-3">
                            <label class="form-label">Maximum Purchase</label>
                            <input type="number" class="form-control" id="maxPurchase" name="max_purchase" min="0" value="0">
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Total Stocks <span class="required-star">*</span></label>
                            <div class="input-group">
                                <input type="text" class="form-control" id="productStock" name="product_stock" required>
                                <span class="input-group-text" id="unitLabel">piece</span>
                            </div>
                            <small class="text-muted">Enter how many stocks you have currently on this product</small>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Stock for Buy</label>
                            <div class="input-group">
                                <input type="number" class="form-control" id="stockForBuy" name="stock_for_buy" min="0" value="0">
                                <span class="input-group-text">piece</span>
                            </div>
                            <small class="text-muted">Enter Customers Maximum Purchase quantity restrictions</small>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-4 mb-3">
                            <label class="form-label">Unlimited Stock</label>
                            <div class="d-flex align-items-center mt-2">
                                <label class="toggle-switch">
                                    <input type="checkbox" id="unlimitedStock" name="unlimited_stock">
                                    <span class="toggle-slider"></span>
                                </label>
                                <span class="toggle-label">Enable unlimited stock</span>
                            </div>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label class="form-label">Out of Stock</label>
                            <div class="d-flex align-items-center mt-2">
                                <label class="toggle-switch">
                                    <input type="checkbox" id="outOfStock" name="out_of_stock">
                                    <span class="toggle-slider"></span>
                                </label>
                                <span class="toggle-label">Mark as out of stock</span>
                            </div>
                        </div>
                    </div>

                    <!-- ========================================== -->
                    <!-- STATUS & VISIBILITY                       -->
                    <!-- ========================================== -->
                    <div class="section-header mt-4">
                        <h6>Status & Visibility</h6>
                    </div>

                    <div class="row">
                        <div class="col-md-4 mb-3">
                            <label class="form-label">Status <span class="required-star">*</span></label>
                            <select class="form-select" id="productStatus" name="product_status">
                                <option value="In Stock">In Stock</option>
                                <option value="Low Stock">Low Stock</option>
                                <option value="Out of Stock">Out of Stock</option>
                            </select>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label class="form-label">Visibility</label>
                            <select class="form-select" id="productVisibility" name="product_visibility">
                                <option value="Published">Published</option>
                                <option value="Draft">Draft</option>
                                <option value="Archived">Archived</option>
                            </select>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label class="form-label">Badge</label>
                            <select class="form-select" id="productBadge" name="product_badge">
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
                        <input type="text" class="form-control" id="productTags" name="product_tags" placeholder="new, featured, sale, trending">
                        <small class="text-muted">Comma separated tags</small>
                    </div>

                    <!-- ========================================== -->
                    <!-- PRODUCT VARIATIONS - Full layout (no Color/Size) -->
                    <!-- ========================================== -->
                    <div class="section-header mt-4">
                        <h6>Product Variation 2</h6>
                    </div>

                    <div id="variationsContainer"></div>

                    <button type="button" class="btn btn-sm btn-outline-primary mt-2" onclick="addVariation()">
                        <i class="fas fa-plus me-1"></i> Add Variation
                    </button>
                    <small class="d-block text-muted mt-2">Add product variations with price, stock, weight and other details.</small>

                    <!-- ========================================== -->
                    <!-- SEO INFORMATION                           -->
                    <!-- ========================================== -->
                    <div class="section-header mt-4">
                        <h6>SEO Information</h6>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">SEO Title</label>
                        <input type="text" class="form-control" id="seoTitle" name="seo_title" placeholder="SEO title (50-60 characters)">
                        <small class="text-muted">Recommended length: 50-60 characters</small>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">SEO Description</label>
                        <textarea class="form-control" id="seoDescription" name="seo_description" rows="2" placeholder="SEO description (150-160 characters)"></textarea>
                        <small class="text-muted">Recommended length: 150-160 characters</small>
                    </div>

                    <!-- Submit Buttons -->
                    <div class="d-flex gap-2 flex-wrap mt-4 pt-3 border-top">
                        <button type="submit" class="btn btn-primary" id="updateProductBtn">
                            Update Product
                        </button>
                        <a href="product_v2.php" class="btn btn-secondary">
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
        // PRODUCT DATA - READ FROM LOCALSTORAGE
        // ============================================================
        function getProducts() {
            return JSON.parse(localStorage.getItem('products') || '[]');
        }

        function saveProducts(products) {
            localStorage.setItem('products', JSON.stringify(products));
        }

        // ============================================================
        // GET PRODUCT ID FROM URL
        // ============================================================
        function getProductId() {
            const urlParams = new URLSearchParams(window.location.search);
            return parseInt(urlParams.get('id')) || 0;
        }

        // ============================================================
        // LOAD PRODUCT DATA
        // ============================================================
        function loadProduct() {
            const id = getProductId();
            const products = getProducts();
            const product = products.find(p => p.id === id);

            if (!product) {
                window.location.href = 'product_v2.php';
                return;
            }

            // Fill form fields
            document.getElementById('productId').value = product.id;
            document.getElementById('productName').value = product.name || '';
            document.getElementById('productSku').value = product.sku || '';
            document.getElementById('productSlug').value = product.slug || '';
            document.getElementById('productCategory').value = product.category || '';
            document.getElementById('productSubcategory').value = product.subcategory || '';
            document.getElementById('productPrice').value = parseFloat(product.price) || 0;
            document.getElementById('productMrp').value = parseFloat(product.mrp) || 0;
            document.getElementById('productStock').value = product.unlimited_stock ? 'Unlimited' : product.stock;
            document.getElementById('unit').value = product.unit || 'piece';
            document.getElementById('unitLabel').textContent = product.unit || 'piece';
            document.getElementById('minPurchase').value = product.min_purchase || 1;
            document.getElementById('maxPurchase').value = product.max_purchase || 0;
            document.getElementById('productStatus').value = product.status || 'In Stock';
            document.getElementById('productVisibility').value = product.visibility || 'Published';
            document.getElementById('productBadge').value = product.badge_text || '';
            document.getElementById('productTags').value = product.tags || '';
            document.getElementById('productDescription').value = product.description || '';
            document.getElementById('seoTitle').value = product.seo_title || '';
            document.getElementById('seoDescription').value = product.seo_description || '';

            if (product.unlimited_stock) {
                document.getElementById('unlimitedStock').checked = true;
            }
            if (product.out_of_stock) {
                document.getElementById('outOfStock').checked = true;
            }

            // Load variations - Full format (no Color/Size)
            const container = document.getElementById('variationsContainer');
            container.innerHTML = '';
            if (product.variations && product.variations.length > 0) {
                product.variations.forEach(v => {
                    addVariationWithData(v);
                });
            } else {
                // Add default empty variation row
                addVariation();
            }

            // Show current main image if exists
            if (product.main_image) {
                document.getElementById('mainImagePreviewImg').src = product.main_image;
                document.getElementById('mainImagePreview').style.display = 'inline-block';
                document.getElementById('mainImageUpload').style.display = 'none';
            }

            // Show additional images if exist
            const grid = document.getElementById('additionalImagesGrid');
            grid.innerHTML = '';
            if (product.additional_images && product.additional_images.length > 0) {
                product.additional_images.forEach(img => {
                    const div = document.createElement('div');
                    div.className = 'additional-image-item';
                    div.innerHTML = `
                        <img src="${img}" alt="Additional Image">
                        <button type="button" class="remove-btn" onclick="removeAdditionalImage(this, '${img}')">
                            <i class="fas fa-times"></i>
                        </button>
                    `;
                    grid.appendChild(div);
                });
            }

            console.log('Product loaded:', product);
        }

        // ============================================================
        // ADD VARIATION WITH DATA - Full format (no Color/Size)
        // ============================================================
        function addVariationWithData(variation) {
            const container = document.getElementById('variationsContainer');
            const name = variation.name || '';
            const price = variation.price || 0;
            const mrp = variation.mrp || 0;
            const unit = variation.unit || 'piece';
            const min_purchase = variation.min_purchase || 1;
            const stock = variation.stock || 0;
            const stock_for_buy = variation.stock_for_buy || 0;
            const unlimited_stock = variation.unlimited_stock || false;
            const weight = variation.weight || 0;
            const weight_unit = variation.weight_unit || 'kg';
            const sku = variation.sku || '';
            const image = variation.image || '';

            const template = `
                <div class="variations-grid">
                    <button type="button" class="btn-remove-variation" onclick="removeVariation(this)">
                        <i class="fas fa-times-circle"></i>
                    </button>

                    <div class="full-width">
                        <label class="form-label">Variation <span class="required-star">*</span></label>
                        <input type="text" class="form-control" name="variation_name[]" placeholder="e.g. Red" value="${name}" required>
                    </div>

                    <div>
                        <label class="form-label">Price <span class="required-star">*</span></label>
                        <input type="number" class="form-control" name="variation_price[]" placeholder="0" step="0.01" min="0.01" value="${price}" required>
                    </div>

                    <div>
                        <label class="form-label">MRP Price <span class="required-star">*</span></label>
                        <input type="number" class="form-control" name="variation_mrp[]" placeholder="0" step="0.01" min="0.01" value="${mrp}" required>
                    </div>

                    <div>
                        <label class="form-label">Unit <span class="required-star">*</span></label>
                        <select class="form-select" name="variation_unit[]" required>
                            <option value="piece" ${unit === 'piece' ? 'selected' : ''}>piece</option>
                            <option value="kg" ${unit === 'kg' ? 'selected' : ''}>kg</option>
                            <option value="g" ${unit === 'g' ? 'selected' : ''}>g</option>
                            <option value="liter" ${unit === 'liter' ? 'selected' : ''}>liter</option>
                            <option value="ml" ${unit === 'ml' ? 'selected' : ''}>ml</option>
                            <option value="box" ${unit === 'box' ? 'selected' : ''}>box</option>
                            <option value="pack" ${unit === 'pack' ? 'selected' : ''}>pack</option>
                        </select>
                    </div>

                    <div>
                        <label class="form-label">Enter Minimum Purchase</label>
                        <input type="number" class="form-control" name="variation_min_purchase[]" placeholder="0" min="0" value="${min_purchase}">
                    </div>

                    <div>
                        <label class="form-label">Stock</label>
                        <div class="input-group">
                            <input type="number" class="form-control" name="variation_stock[]" placeholder="0" min="0" value="${stock}">
                            <span class="input-group-text">piece</span>
                        </div>
                    </div>

                    <div>
                        <label class="form-label">Stock for buy</label>
                        <div class="input-group">
                            <input type="number" class="form-control" name="variation_stock_for_buy[]" placeholder="0" min="0" value="${stock_for_buy}">
                            <span class="input-group-text">piece</span>
                        </div>
                        <small class="text-muted">Maximum stock for single buy</small>
                    </div>

                    <div>
                        <label class="form-label">Unlimited Stock</label>
                        <div class="variation-toggle">
                            <label class="toggle-switch">
                                <input type="checkbox" name="variation_unlimited_stock[]" ${unlimited_stock ? 'checked' : ''}>
                                <span class="toggle-slider"></span>
                            </label>
                            <span class="toggle-label">☐</span>
                        </div>
                    </div>

                    <div>
                        <label class="form-label">Weight</label>
                        <div class="weight-input-group">
                            <input type="number" class="form-control" name="variation_weight[]" placeholder="0" step="0.01" min="0" value="${weight}">
                            <select class="form-select" name="variation_weight_unit[]">
                                <option value="kg" ${weight_unit === 'kg' ? 'selected' : ''}>kg</option>
                                <option value="g" ${weight_unit === 'g' ? 'selected' : ''}>g</option>
                                <option value="mg" ${weight_unit === 'mg' ? 'selected' : ''}>mg</option>
                                <option value="lb" ${weight_unit === 'lb' ? 'selected' : ''}>lb</option>
                                <option value="oz" ${weight_unit === 'oz' ? 'selected' : ''}>oz</option>
                                <option value="litre" ${weight_unit === 'litre' ? 'selected' : ''}>litre</option>
                                <option value="ml" ${weight_unit === 'ml' ? 'selected' : ''}>ml</option>
                                <option value="ton" ${weight_unit === 'ton' ? 'selected' : ''}>ton</option>
                                <option value="piece" ${weight_unit === 'piece' ? 'selected' : ''}>piece</option>
                            </select>
                        </div>
                    </div>

                    <div>
                        <label class="form-label">SKU</label>
                        <input type="text" class="form-control" name="variation_sku[]" placeholder="Stock Keeping Unit" value="${sku}">
                    </div>

                    <div>
                        <label class="form-label">Image</label>
                        <div class="variation-image-box" onclick="this.querySelector('input[type=file]').click()" ${image ? 'style="display:none;"' : ''}>
                            <div class="upload-icon">
                                <i class="fas fa-cloud-upload-alt"></i>
                            </div>
                            <div class="upload-text">
                                Choose File
                            </div>
                            <input type="file" accept="image/*" onchange="previewVariationImage(this)">
                        </div>
                        <div class="variation-image-preview" ${image ? 'style="display:block;"' : ''}>
                            <img src="${image}" alt="Variation Image">
                            <button type="button" class="remove-btn" onclick="removeVariationImage(this)">
                                <i class="fas fa-times"></i>
                            </button>
                        </div>
                    </div>
                </div>
            `;
            container.insertAdjacentHTML('beforeend', template);
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
        // VARIATION IMAGE UPLOAD
        // ============================================================
        function previewVariationImage(input) {
            const file = input.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    const preview = input.closest('.variation-image-box').nextElementSibling;
                    const img = preview.querySelector('img');
                    img.src = e.target.result;
                    preview.style.display = 'block';
                    input.closest('.variation-image-box').style.display = 'none';
                }
                reader.readAsDataURL(file);
            }
        }

        function removeVariationImage(btn) {
            const preview = btn.closest('.variation-image-preview');
            const box = preview.previousElementSibling;
            preview.style.display = 'none';
            box.style.display = 'block';
            const input = box.querySelector('input[type="file"]');
            if (input) input.value = '';
        }

        // ============================================================
        // VARIATIONS - Add new empty variation
        // ============================================================
        function addVariation() {
            const container = document.getElementById('variationsContainer');
            const template = `
                <div class="variations-grid">
                    <button type="button" class="btn-remove-variation" onclick="removeVariation(this)">
                        <i class="fas fa-times-circle"></i>
                    </button>

                    <div class="full-width">
                        <label class="form-label">Variation <span class="required-star">*</span></label>
                        <input type="text" class="form-control" name="variation_name[]" placeholder="e.g. Red" required>
                    </div>

                    <div>
                        <label class="form-label">Price <span class="required-star">*</span></label>
                        <input type="number" class="form-control" name="variation_price[]" placeholder="0" step="0.01" min="0.01" required>
                    </div>

                    <div>
                        <label class="form-label">MRP Price <span class="required-star">*</span></label>
                        <input type="number" class="form-control" name="variation_mrp[]" placeholder="0" step="0.01" min="0.01" required>
                    </div>

                    <div>
                        <label class="form-label">Unit <span class="required-star">*</span></label>
                        <select class="form-select" name="variation_unit[]" required>
                            <option value="piece">piece</option>
                            <option value="kg">kg</option>
                            <option value="g">g</option>
                            <option value="liter">liter</option>
                            <option value="ml">ml</option>
                            <option value="box">box</option>
                            <option value="pack">pack</option>
                        </select>
                    </div>

                    <div>
                        <label class="form-label">Enter Minimum Purchase</label>
                        <input type="number" class="form-control" name="variation_min_purchase[]" placeholder="0" min="0" value="1">
                    </div>

                    <div>
                        <label class="form-label">Stock</label>
                        <div class="input-group">
                            <input type="number" class="form-control" name="variation_stock[]" placeholder="0" min="0" value="0">
                            <span class="input-group-text">piece</span>
                        </div>
                    </div>

                    <div>
                        <label class="form-label">Stock for buy</label>
                        <div class="input-group">
                            <input type="number" class="form-control" name="variation_stock_for_buy[]" placeholder="0" min="0" value="0">
                            <span class="input-group-text">piece</span>
                        </div>
                        <small class="text-muted">Maximum stock for single buy</small>
                    </div>

                    <div>
                        <label class="form-label">Unlimited Stock</label>
                        <div class="variation-toggle">
                            <label class="toggle-switch">
                                <input type="checkbox" name="variation_unlimited_stock[]">
                                <span class="toggle-slider"></span>
                            </label>
                            
                        </div>
                    </div>

                    <div>
                        <label class="form-label">Weight</label>
                        <div class="weight-input-group">
                            <input type="number" class="form-control" name="variation_weight[]" placeholder="0" step="0.01" min="0" value="0">
                            <select class="form-select" name="variation_weight_unit[]">
                                <option value="kg">kg</option>
                                <option value="g">g</option>
                                <option value="mg">mg</option>
                                <option value="lb">lb</option>
                                <option value="oz">oz</option>
                                <option value="litre">litre</option>
                                <option value="ml">ml</option>
                                <option value="ton">ton</option>
                                <option value="piece">piece</option>
                            </select>
                        </div>
                    </div>

                    <div>
                        <label class="form-label">SKU</label>
                        <input type="text" class="form-control" name="variation_sku[]" placeholder="Stock Keeping Unit">
                    </div>

                    <div>
                        <label class="form-label">Image</label>
                        <div class="variation-image-box" onclick="this.querySelector('input[type=file]').click()">
                            <div class="upload-icon">
                                <i class="fas fa-cloud-upload-alt"></i>
                            </div>
                            <div class="upload-text">
                                Choose File
                            </div>
                            <input type="file" accept="image/*" onchange="previewVariationImage(this)">
                        </div>
                        <div class="variation-image-preview">
                            <img src="#" alt="Variation Image">
                            <button type="button" class="remove-btn" onclick="removeVariationImage(this)">
                                <i class="fas fa-times"></i>
                            </button>
                        </div>
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
        // UPDATE UNIT LABEL
        // ============================================================
        document.getElementById('unit')?.addEventListener('change', function() {
            const unit = this.value;
            document.getElementById('unitLabel').textContent = unit;
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
                    <a href="product_v2.php" class="alert-link">
                        <i class="fas fa-arrow-right me-1"></i> View Products
                    </a>
                </div>
            `;

            setTimeout(() => {
                const alert = container.querySelector('.alert-success-custom');
                if (alert) alert.style.display = 'none';
            }, 5000);
        }

        // ============================================================
        // UPDATE PRODUCT
        // ============================================================
        function updateProduct(e) {
            e.preventDefault();

            const id = parseInt(document.getElementById('productId').value);
            const name = document.getElementById('productName').value.trim();
            const sku = document.getElementById('productSku').value.trim();
            const slug = document.getElementById('productSlug').value.trim();
            const category = document.getElementById('productCategory').value;
            const subcategory = document.getElementById('productSubcategory').value.trim();
            const price = parseFloat(document.getElementById('productPrice').value);
            const mrp = parseFloat(document.getElementById('productMrp').value) || 0;
            const stock = document.getElementById('productStock').value.trim();
            const min_purchase = parseInt(document.getElementById('minPurchase').value) || 1;
            const max_purchase = parseInt(document.getElementById('maxPurchase').value) || 0;
            const unit = document.getElementById('unit').value;
            const status = document.getElementById('productStatus').value;
            const visibility = document.getElementById('productVisibility').value;
            const badge_text = document.getElementById('productBadge').value;
            const tags = document.getElementById('productTags').value.trim();
            const seo_title = document.getElementById('seoTitle').value.trim();
            const seo_description = document.getElementById('seoDescription').value.trim();
            const description = document.getElementById('productDescription').value.trim();

            // Validate
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
            if (stock === '' || parseInt(stock) < 0) {
                showAlert('Please enter valid stock quantity', 'error');
                document.getElementById('productStock').focus();
                return false;
            }

            // Get variations - Full format (no Color/Size)
            const variationNames = document.getElementsByName('variation_name[]');
            const variationPrices = document.getElementsByName('variation_price[]');
            const variationMrps = document.getElementsByName('variation_mrp[]');
            const variationUnits = document.getElementsByName('variation_unit[]');
            const variationMinPurchase = document.getElementsByName('variation_min_purchase[]');
            const variationStock = document.getElementsByName('variation_stock[]');
            const variationStockForBuy = document.getElementsByName('variation_stock_for_buy[]');
            const variationUnlimitedStock = document.getElementsByName('variation_unlimited_stock[]');
            const variationWeight = document.getElementsByName('variation_weight[]');
            const variationWeightUnit = document.getElementsByName('variation_weight_unit[]');
            const variationSku = document.getElementsByName('variation_sku[]');

            const variations = [];
            for (let i = 0; i < variationNames.length; i++) {
                if (variationNames[i].value.trim()) {
                    // Get image if exists
                    const box = variationNames[i].closest('.variations-grid').querySelector('.variation-image-box');
                    const preview = box ? box.nextElementSibling : null;
                    let image = '';
                    if (preview && preview.style.display !== 'none') {
                        const img = preview.querySelector('img');
                        if (img) image = img.src;
                    }

                    variations.push({
                        name: variationNames[i].value.trim(),
                        price: parseFloat(variationPrices[i]?.value) || 0,
                        mrp: parseFloat(variationMrps[i]?.value) || 0,
                        unit: variationUnits[i]?.value || 'piece',
                        min_purchase: parseInt(variationMinPurchase[i]?.value) || 1,
                        stock: parseInt(variationStock[i]?.value) || 0,
                        stock_for_buy: parseInt(variationStockForBuy[i]?.value) || 0,
                        unlimited_stock: variationUnlimitedStock[i]?.checked || false,
                        weight: parseFloat(variationWeight[i]?.value) || 0,
                        weight_unit: variationWeightUnit[i]?.value || 'kg',
                        sku: variationSku[i]?.value.trim() || '',
                        image: image
                    });
                }
            }

            let badge = 'success';
            if (status === 'Low Stock') badge = 'warning';
            if (status === 'Out of Stock') badge = 'danger';

            // Get products and update
            const products = getProducts();
            const productIndex = products.findIndex(p => p.id === id);
            
            if (productIndex === -1) {
                showAlert('Product not found', 'error');
                return false;
            }

            // Update product
            products[productIndex] = {
                ...products[productIndex],
                name: name,
                sku: sku,
                slug: slug,
                category: category,
                subcategory: subcategory || 'N/A',
                price: price.toFixed(2),
                mrp: mrp ? mrp.toFixed(2) : '0.00',
                stock: stock === 'Unlimited' ? 9999 : parseInt(stock),
                min_purchase: min_purchase,
                max_purchase: max_purchase,
                unit: unit,
                status: status,
                badge: badge,
                badge_text: badge_text,
                visibility: visibility,
                tags: tags,
                unlimited_stock: document.getElementById('unlimitedStock').checked,
                out_of_stock: document.getElementById('outOfStock').checked,
                seo_title: seo_title || name,
                seo_description: seo_description || description,
                description: description,
                variations: variations,
                main_image: mainImageFile ? URL.createObjectURL(mainImageFile) : products[productIndex].main_image || '',
                additional_images: additionalImageFiles.map(f => URL.createObjectURL(f))
            };

            saveProducts(products);

            // Show success message
            showAlert(`Product '${name}' updated successfully!`, 'success');

            // Redirect to product.php
            setTimeout(() => {
                window.location.href = 'product_v2.php';
            }, 1500);

            return false;
        }

        // ============================================================
        // SIDEBAR TOGGLE
        // ============================================================
        document.addEventListener('DOMContentLoaded', function() {
            loadProduct();

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

            console.log('Edit Product page initialized with full variation layout (no Color/Size)');
        });
    </script>
</body>
</html>