<?php
include 'config/config.php';
?>


<!DOCTYPE html>
<html lang="en">

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
            max-width: 900px;
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
           SECTION HEADERS - NO ICONS
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
            padding: 30px 20px;
            text-align: center;
            cursor: pointer;
            transition: all 0.3s ease;
            background: #F8FAFC;
            position: relative;
            max-width: 400px;
        }
        .image-upload-box:hover {
            border-color: #2563EB;
            background: #EFF6FF;
        }
        .image-upload-box .upload-icon {
            font-size: 40px;
            color: #94A3B8;
            margin-bottom: 10px;
        }
        .image-upload-box .upload-text {
            color: #64748B;
            font-size: 0.875rem;
        }
        .image-upload-box .upload-text strong {
            color: #2563EB;
        }
        .image-upload-box .upload-text small {
            display: block;
            margin-top: 4px;
            color: #94A3B8;
            font-size: 0.75rem;
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
        .image-preview .remove-btn:hover { background: #DC2626; }

        .current-icon {
            display: inline-block;
            margin-top: 10px;
        }
        .current-icon img {
            width: 80px;
            height: 80px;
            object-fit: cover;
            border-radius: 10px;
            border: 2px solid #E2E8F0;
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
           PAGE HEADER
           ============================================ */
        .page-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            gap: 10px;
            padding-bottom: 12px;
            margin-bottom: 16px;
            border-bottom: 1px solid #E2E8F0;
        }
        .page-header h1 {
            font-size: 1.4rem;
            margin: 0;
        }

        /* ============================================
           BUTTONS - NO ICONS
           ============================================ */
        .btn {
            font-size: 0.85rem;
            padding: 0.4rem 1.2rem;
            border-radius: 0.4rem;
        }

        /* ============================================
           RESPONSIVE
           ============================================ */
        @media (max-width: 767.98px) {
            .sidebar-wrapper { width: 0; transform: translateX(-100%); transition: all 0.3s ease; }
            .sidebar-wrapper.open { width: 280px; transform: translateX(0); }
            .main-content { margin-left: 0; padding: 10px 12px; }
            .sidebar-toggle { display: block !important; }
            .form-section { padding: 1rem; max-width: 100%; }
            .alert-success-custom { flex-direction: column; gap: 8px; align-items: flex-start; }
            .image-upload-box { padding: 20px 15px; max-width: 100%; }
            .image-upload-box .upload-icon { font-size: 30px; }
            .page-header h1 { font-size: 1.2rem; }
        }
        @media (max-width: 479.98px) {
            .main-content { padding: 6px 8px; }
            .form-section { padding: 0.75rem; }
            .image-upload-box { padding: 15px 10px; }
            .image-upload-box .upload-icon { font-size: 24px; }
            .image-preview img { width: 70px; height: 70px; }
            .page-header h1 { font-size: 1rem; }
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
        <div id="edit-category-page" class="page-section active-page">
            
            

            <!-- Page Header -->
            <div class="page-header">
                <h1>Edit Category</h1>
                <div class="btn-toolbar">
                    <div class="btn-group">
                        <a href="product-categories.php" class="btn btn-sm btn-outline-secondary">
                            <i class="fas fa-arrow-left me-1"></i> Back to Categories
                        </a>
                    </div>
                </div>
            </div>

            <!-- Alert Container -->
            <div id="alertContainer"></div>

            <!-- Form -->
            <div class="form-section">
                <form id="editCategoryForm" onsubmit="return updateCategory(event)">
                    <input type="hidden" name="update_category" value="1">
                    <input type="hidden" name="category_id" id="categoryId" value="">

                    <!-- ========================================== -->
                    <!-- CATEGORY INFORMATION                      -->
                    <!-- ========================================== -->
                    <div class="section-header">
                        <h6>Category Information</h6>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Name <span class="required-star">*</span></label>
                            <input type="text" class="form-control" id="categoryName" name="category_name" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Slug</label>
                            <div class="text-muted mb-1" style="font-size: 0.8rem;">
                                <i class="fas fa-link me-1"></i> https://ztorespot.in/flowerpot/
                            </div>
                            <input type="text" class="form-control" id="categorySlug" name="category_slug" placeholder="Enter a category slug">
                            <small class="text-muted">If you leave it blank, it will be generated automatically.</small>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Parent</label>
                            <select class="form-select" id="categoryParent" name="category_parent">
                                <option value="">None</option>
                            </select>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Status</label>
                            <select class="form-select" id="categoryStatus" name="category_status">
                                <option value="Active">Active</option>
                                <option value="Inactive">Inactive</option>
                                <option value="Draft">Draft</option>
                            </select>
                        </div>
                    </div>

                    <!-- ========================================== -->
                    <!-- ICON UPLOAD                              -->
                    <!-- ========================================== -->
                    <div class="mb-3">
                        <label class="form-label">Icon</label>
                        <div class="text-muted mb-2" style="font-size: 0.8rem;">
                            <i class="fas fa-info-circle me-1"></i> Maximum image size is 10MB
                        </div>
                        
                        <div id="currentIconContainer"></div>
                        
                        <div class="image-upload-box" id="iconUpload">
                            <div class="upload-icon">
                                <i class="fas fa-cloud-upload-alt"></i>
                            </div>
                            <div class="upload-text">
                                <strong>Drag & Drop image here, or Browse</strong>
                                <small>Max size : 10MB</small>
                            </div>
                            <input type="file" id="categoryIcon" accept="image/*" onchange="previewIcon(event)">
                        </div>
                        <div class="image-preview" id="iconPreview" style="display: none;">
                            <img id="iconPreviewImg" src="#" alt="Category Icon">
                            <button type="button" class="remove-btn" onclick="removeIcon()">
                                <i class="fas fa-times"></i>
                            </button>
                        </div>
                    </div>

                    <!-- ========================================== -->
                    <!-- DESCRIPTION                              -->
                    <!-- ========================================== -->
                    <div class="mb-3">
                        <label class="form-label">Description</label>
                        <textarea class="form-control" id="categoryDescription" name="category_description" rows="4" placeholder="Category description"></textarea>
                    </div>

                    <!-- ========================================== -->
                    <!-- STATUS & MENU                            -->
                    <!-- ========================================== -->
                    <div class="section-header">
                        <h6>Status & Menu</h6>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Add to Menu</label>
                            <div class="d-flex align-items-center mt-2">
                                <label class="toggle-switch">
                                    <input type="checkbox" id="categoryMenu" name="category_menu">
                                    <span class="toggle-slider"></span>
                                </label>
                                <span class="toggle-label">Show in menu</span>
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <!-- Empty for alignment -->
                        </div>
                    </div>

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

                    <!-- Submit Buttons - No Icons -->
                    <div class="d-flex gap-2 flex-wrap mt-4 pt-3 border-top">
                        <button type="submit" class="btn btn-primary" id="updateCategoryBtn">
                            Update Category
                        </button>
                        <a href="product-categories.php" class="btn btn-secondary">
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
        // CATEGORY DATA - READ FROM LOCALSTORAGE
        // ============================================================
        function getCategories() {
            return JSON.parse(localStorage.getItem('categories') || '[]');
        }

        function saveCategories(categories) {
            localStorage.setItem('categories', JSON.stringify(categories));
        }

        // ============================================================
        // GET CATEGORY ID FROM URL
        // ============================================================
        function getCategoryId() {
            const urlParams = new URLSearchParams(window.location.search);
            return parseInt(urlParams.get('id')) || 0;
        }

        // ============================================================
        // LOAD CATEGORY DATA
        // ============================================================
        function loadCategory() {
            const id = getCategoryId();
            const categories = getCategories();
            const category = categories.find(c => c.id === id);

            if (!category) {
                window.location.href = 'product-categories.php';
                return;
            }

            // Fill form fields
            document.getElementById('categoryId').value = category.id;
            document.getElementById('categoryName').value = category.name || '';
            document.getElementById('categorySlug').value = category.slug || '';
            document.getElementById('categoryStatus').value = category.status || 'Active';
            document.getElementById('categoryDescription').value = category.description || '';
            document.getElementById('seoTitle').value = category.seo_title || '';
            document.getElementById('seoDescription').value = category.seo_description || '';

            // Set parent dropdown
            const parentSelect = document.getElementById('categoryParent');
            const categoriesList = getCategories();
            parentSelect.innerHTML = '<option value="">None</option>';
            categoriesList.forEach(c => {
                if (c.id !== category.id && c.parent === null) {
                    const selected = (category.parent === c.id) ? 'selected' : '';
                    parentSelect.innerHTML += `<option value="${c.id}" ${selected}>${c.name}</option>`;
                }
            });

            // Set menu toggle
            if (category.menu) {
                document.getElementById('categoryMenu').checked = true;
            }

            // Show current icon if exists
            const currentIconContainer = document.getElementById('currentIconContainer');
            if (category.icon) {
                currentIconContainer.innerHTML = `
                    <div class="current-icon">
                        <img src="${category.icon}" alt="Current Icon">
                        <small class="d-block text-muted mt-1">Current icon</small>
                    </div>
                `;
            }

            console.log('Category loaded:', category);
        }

        // ============================================================
        // ICON UPLOAD
        // ============================================================
        let iconFile = null;

        function previewIcon(event) {
            const file = event.target.files[0];
            if (file) {
                // Check file size (10MB max)
                if (file.size > 10 * 1024 * 1024) {
                    alert('File size exceeds 10MB limit. Please choose a smaller file.');
                    event.target.value = '';
                    return;
                }
                
                iconFile = file;
                const reader = new FileReader();
                reader.onload = function(e) {
                    document.getElementById('iconPreviewImg').src = e.target.result;
                    document.getElementById('iconPreview').style.display = 'inline-block';
                    document.getElementById('iconUpload').style.display = 'none';
                    document.getElementById('currentIconContainer').innerHTML = '';
                }
                reader.readAsDataURL(file);
            }
        }

        function removeIcon() {
            iconFile = null;
            document.getElementById('iconPreview').style.display = 'none';
            document.getElementById('iconUpload').style.display = 'block';
            document.getElementById('categoryIcon').value = '';
            // Reload current icon
            loadCategory();
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
        // AUTO GENERATE SLUG FROM NAME
        // ============================================================
        document.getElementById('categoryName')?.addEventListener('input', function() {
            var slugField = document.getElementById('categorySlug');
            if (!slugField.value.trim()) {
                var name = this.value.trim().toLowerCase().replace(/[^a-zA-Z0-9]+/g, '-');
                slugField.value = name;
            }
        });

        // ============================================================
        // SHOW ALERT
        // ============================================================
        function showAlert(message, type = 'success') {
            const container = document.getElementById('alertContainer');
            
            if (type === 'success') {
                container.innerHTML = `
                    <div class="alert-success-custom">
                        <span>
                            <i class="fas fa-check-circle me-2"></i> 
                            <strong>${message}</strong>
                        </span>
                        <a href="product-categories.php" class="alert-link">
                            <i class="fas fa-arrow-right me-1"></i> View Categories
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

            setTimeout(() => {
                const alert = container.querySelector('.alert-success-custom, .alert-error-custom');
                if (alert) alert.style.display = 'none';
            }, 5000);
        }

        // ============================================================
        // UPDATE CATEGORY
        // ============================================================
        function updateCategory(e) {
            e.preventDefault();

            const id = parseInt(document.getElementById('categoryId').value);
            const name = document.getElementById('categoryName').value.trim();
            const slug = document.getElementById('categorySlug').value.trim();
            const parent = document.getElementById('categoryParent').value;
            const status = document.getElementById('categoryStatus').value;
            const description = document.getElementById('categoryDescription').value.trim();
            const seo_title = document.getElementById('seoTitle').value.trim();
            const seo_description = document.getElementById('seoDescription').value.trim();
            const menu = document.getElementById('categoryMenu').checked;

            // Validate
            if (!name) {
                showAlert('Please enter category name', 'error');
                document.getElementById('categoryName').focus();
                return false;
            }

            // Auto generate slug if empty
            const finalSlug = slug || name.toLowerCase().replace(/[^a-zA-Z0-9]+/g, '-');

            // Get categories and update
            const categories = getCategories();
            const categoryIndex = categories.findIndex(c => c.id === id);
            
            if (categoryIndex === -1) {
                showAlert('Category not found', 'error');
                return false;
            }

            // Determine badge class
            let badgeClass = 'active';
            if (status === 'Inactive') badgeClass = 'inactive';
            if (status === 'Draft') badgeClass = 'draft';

            // Update category
            categories[categoryIndex] = {
                ...categories[categoryIndex],
                name: name,
                slug: finalSlug,
                parent: parent || null,
                status: status,
                badge: badgeClass,
                menu: menu,
                description: description,
                seo_title: seo_title || name,
                seo_description: seo_description || description,
                icon: iconFile ? URL.createObjectURL(iconFile) : categories[categoryIndex].icon || ''
            };

            saveCategories(categories);

            // Show success message on edit page
            showAlert(`Category '${name}' updated successfully!`, 'success');

            // Redirect to categories page WITHOUT any query parameter
            setTimeout(() => {
                window.location.href = 'product-categories.php';
            }, 1500);

            return false;
        }

        // ============================================================
        // SIDEBAR TOGGLE
        // ============================================================
        document.addEventListener('DOMContentLoaded', function() {
            loadCategory();

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

            console.log('Edit Category page initialized (100% JavaScript with localStorage)');
        });
    </script>
</body>
</html>