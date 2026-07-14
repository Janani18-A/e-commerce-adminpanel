<?php
include 'config/config.php';
?>


<?php
$current_page = 'categories';

?>
<!DOCTYPE html>
<html lang="en">

    
 <?php include 'templates/head.php'; ?>

    <style>
        /* ============================================
           FORM SECTION - LEFT ALIGNED, COMPACT
           ============================================ */
        .form-section {
            background: #FFFFFF;
            border-radius: 0.75rem;
            border: 1px solid #E2E8F0;
            padding: 1.5rem;
            max-width: 900px;
        }
        .form-section .form-label {
            font-weight: 600;
            color: #1E293B;
            font-size: 0.8rem;
            margin-bottom: 4px;
        }
        .form-section .form-control,
        .form-section .form-select {
            border-radius: 0.4rem;
            border-color: #E2E8F0;
            font-size: 0.8rem;
            padding: 0.35rem 0.6rem;
            height: 38px;
        }
        .form-section .form-control:focus,
        .form-section .form-select:focus {
            border-color: #2563EB;
            box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.12);
        }
        .form-section textarea.form-control {
            height: auto;
            min-height: 80px;
            padding: 0.35rem 0.6rem;
        }
        .required-star {
            color: #EF4444;
        }

        /* ============================================
           SECTION HEADERS - COMPACT
           ============================================ */
        .section-header {
            background: #F8FAFC;
            padding: 6px 14px;
            border-radius: 0.4rem;
            border: 1px solid #E2E8F0;
            margin-bottom: 1rem;
        }
        .section-header h6 {
            margin: 0;
            font-weight: 600;
            color: #1E293B;
            font-size: 0.85rem;
        }

        /* ============================================
           IMAGE UPLOAD - COMPACT
           ============================================ */
        .image-upload-box {
            border: 2px dashed #DBEAFE;
            border-radius: 10px;
            padding: 20px 15px;
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
            font-size: 28px;
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
        .image-upload-box .upload-text small {
            display: block;
            margin-top: 2px;
            color: #94A3B8;
            font-size: 0.7rem;
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
            width: 80px;
            height: 80px;
            object-fit: cover;
            border-radius: 8px;
            border: 2px solid #DBEAFE;
        }
        .image-preview .remove-btn {
            position: absolute;
            top: -8px;
            right: -8px;
            width: 24px;
            height: 24px;
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
        .image-preview .remove-btn:hover { background: #DC2626; }

        /* ============================================
           TOGGLE SWITCH - COMPACT
           ============================================ */
        .toggle-switch {
            position: relative;
            width: 38px;
            height: 20px;
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
            transition: .3s;
            border-radius: 20px;
        }
        .toggle-slider:before {
            position: absolute;
            content: "";
            height: 16px;
            width: 16px;
            left: 2px;
            bottom: 2px;
            background: white;
            transition: .3s;
            border-radius: 50%;
        }
        .toggle-switch input:checked + .toggle-slider { background: #2563EB; }
        .toggle-switch input:checked + .toggle-slider:before { transform: translateX(18px); }

        .toggle-label {
            font-size: 0.75rem;
            color: #64748B;
            margin-left: 6px;
        }

        /* ============================================
           ALERTS - COMPACT
           ============================================ */
        .alert-success-custom {
            background: #D1FAE5;
            color: #065F46;
            border-left: 4px solid #10B981;
            padding: 10px 14px;
            border-radius: 6px;
            margin-bottom: 1rem;
            display: flex;
            align-items: center;
            justify-content: space-between;
            flex-wrap: wrap;
            font-size: 0.85rem;
        }
        .alert-success-custom .alert-link {
            color: #2563EB;
            font-weight: 600;
            text-decoration: none;
            padding: 3px 10px;
            background: white;
            border-radius: 4px;
            transition: all 0.3s ease;
            font-size: 0.8rem;
        }
        .alert-success-custom .alert-link:hover {
            background: #DBEAFE;
            text-decoration: underline;
        }
        .alert-error-custom {
            background: #FEE2E2;
            color: #991B1B;
            border-left: 4px solid #EF4444;
            padding: 10px 14px;
            border-radius: 6px;
            margin-bottom: 1rem;
            font-size: 0.85rem;
        }

        /* ============================================
           BREADCRUMB - COMPACT
           ============================================ */
        .breadcrumb-custom {
            font-size: 0.8rem;
            color: #64748B;
        }
        .breadcrumb-custom a { color: #2563EB; text-decoration: none; }
        .breadcrumb-custom a:hover { text-decoration: underline; }
        .breadcrumb-custom i { margin: 0 6px; font-size: 0.6rem; color: #94A3B8; }

        /* ============================================
           PAGE HEADER - COMPACT
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
           BUTTONS - COMPACT
           ============================================ */
        .btn {
            font-size: 0.8rem;
            padding: 0.35rem 1rem;
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
            .image-upload-box { padding: 15px 10px; max-width: 100%; }
            .image-upload-box .upload-icon { font-size: 24px; }
            .page-header h1 { font-size: 1.2rem; }
        }
        @media (max-width: 479.98px) {
            .main-content { padding: 6px 8px; }
            .form-section { padding: 0.75rem; }
            .image-upload-box { padding: 12px 8px; }
            .image-upload-box .upload-icon { font-size: 20px; }
            .image-preview img { width: 60px; height: 60px; }
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
        <div id="add-category-page" class="page-section active-page">
            
            

            <!-- Page Header -->
            <div class="page-header">
                <h1>Add New Category</h1>
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
                <form id="addCategoryForm" onsubmit="return saveCategory(event)">
                    <input type="hidden" name="add_category" value="1">

                    <!-- ========================================== -->
                    <!-- CATEGORY INFORMATION                      -->
                    <!-- ========================================== -->
                    <div class="section-header">
                        <h6>Category Information</h6>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Name <span class="required-star">*</span></label>
                            <input type="text" class="form-control" id="categoryName" placeholder="Enter a category name" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Slug</label>
                            <div class="text-muted mb-1" style="font-size: 0.7rem;">
                                <i class="fas fa-link me-1"></i> https://flowerpot/
                            </div>
                            <input type="text" class="form-control" id="categorySlug" placeholder="Enter a category slug">
                            <small class="text-muted" style="font-size: 0.7rem;">If you leave it blank, it will be generated automatically.</small>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Parent</label>
                            <select class="form-select" id="categoryParent">
                                <option value="">None</option>
                            </select>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Status</label>
                            <select class="form-select" id="categoryStatus">
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
                        <div class="text-muted mb-2" style="font-size: 0.7rem;">
                            <i class="fas fa-info-circle me-1"></i> Maximum image size is 10MB
                        </div>
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
                        <textarea class="form-control" id="categoryDescription" rows="3" placeholder="Category description"></textarea>
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
                                    <input type="checkbox" id="categoryMenu" checked>
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
                        <input type="text" class="form-control" id="seoTitle" placeholder="SEO title (50-60 characters)">
                        <small class="text-muted" style="font-size: 0.7rem;">Recommended length: 50-60 characters</small>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">SEO Description</label>
                        <textarea class="form-control" id="seoDescription" rows="2" placeholder="SEO description (150-160 characters)"></textarea>
                        <small class="text-muted" style="font-size: 0.7rem;">Recommended length: 150-160 characters</small>
                    </div>

                    <!-- Submit Buttons -->
                    <div class="d-flex gap-2 flex-wrap mt-4 pt-3 border-top">
                        <button type="submit" class="btn btn-primary" id="saveCategoryBtn">
                            Save Category
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

        // Initialize categories in localStorage if empty
        if (getCategories().length === 0) {
            const defaultCategories = [
                {id: 1, name: 'Electronics', slug: 'electronics', parent: null, menu: true, visitors: '1,245', status: 'Active', badge: 'active', color: '#2563EB', letter: 'E', description: 'Electronic items and gadgets', icon: '', seo_title: 'Electronics', seo_description: 'Electronic items and gadgets'},
                {id: 2, name: 'Accessories', slug: 'accessories', parent: null, menu: true, visitors: '876', status: 'Active', badge: 'active', color: '#10B981', letter: 'A', description: 'Accessories for daily use', icon: '', seo_title: 'Accessories', seo_description: 'Accessories for daily use'},
                {id: 3, name: 'Home & Living', slug: 'home-living', parent: null, menu: false, visitors: '543', status: 'Inactive', badge: 'inactive', color: '#F59E0B', letter: 'H', description: 'Home and living products', icon: '', seo_title: 'Home & Living', seo_description: 'Home and living products'},
                {id: 4, name: 'Smart Devices', slug: 'smart-devices', parent: 1, menu: true, visitors: '2,109', status: 'Active', badge: 'active', color: '#8B5CF6', letter: 'S', description: 'Smart devices and gadgets', icon: '', seo_title: 'Smart Devices', seo_description: 'Smart devices and gadgets'},
                {id: 5, name: 'Travel', slug: 'travel', parent: null, menu: false, visitors: '432', status: 'Draft', badge: 'draft', color: '#EF4444', letter: 'T', description: 'Travel essentials', icon: '', seo_title: 'Travel', seo_description: 'Travel essentials'},
                {id: 6, name: 'Industrial', slug: 'industrial', parent: null, menu: true, visitors: '321', status: 'Active', badge: 'active', color: '#1E293B', letter: 'I', description: 'Industrial products', icon: '', seo_title: 'Industrial', seo_description: 'Industrial products'}
            ];
            saveCategories(defaultCategories);
        }

        // ============================================================
        // LOAD PARENT DROPDOWN
        // ============================================================
        function loadParentDropdown() {
            const categories = getCategories();
            const parentSelect = document.getElementById('categoryParent');
            const currentValue = parentSelect.value;
            
            parentSelect.innerHTML = '<option value="">None</option>';
            categories.forEach(c => {
                if (c.parent === null) {
                    parentSelect.innerHTML += `<option value="${c.id}">${c.name}</option>`;
                }
            });
            
            if (currentValue) {
                parentSelect.value = currentValue;
            }
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
                }
                reader.readAsDataURL(file);
            }
        }

        function removeIcon() {
            iconFile = null;
            document.getElementById('iconPreview').style.display = 'none';
            document.getElementById('iconUpload').style.display = 'block';
            document.getElementById('categoryIcon').value = '';
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

            setTimeout(() => {
                const alert = container.querySelector('.alert-success-custom, .alert-error-custom');
                if (alert) alert.style.display = 'none';
            }, 5000);
        }

        // ============================================================
        // SAVE CATEGORY
        // ============================================================
        function saveCategory(e) {
            e.preventDefault();

            // Get form values
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

            // Determine badge class
            let badgeClass = 'active';
            if (status === 'Inactive') badgeClass = 'inactive';
            if (status === 'Draft') badgeClass = 'draft';

            // Colors and letter
            const colors = ['#2563EB', '#10B981', '#F59E0B', '#8B5CF6', '#EF4444', '#1E293B', '#06B6D4', '#EC4899'];
            const color = colors[Math.floor(Math.random() * colors.length)];
            const letter = name.charAt(0).toUpperCase();

            // Get existing categories
            const categories = getCategories();
            const newId = categories.length > 0 ? Math.max(...categories.map(c => c.id)) + 1 : 1;

            // Create new category
            const newCategory = {
                id: newId,
                name: name,
                slug: finalSlug,
                parent: parent || null,
                menu: menu,
                visitors: '0',
                status: status,
                badge: badgeClass,
                color: color,
                letter: letter,
                description: description,
                icon: iconFile ? URL.createObjectURL(iconFile) : '',
                seo_title: seo_title || name,
                seo_description: seo_description || description
            };

            // Save to localStorage
            categories.push(newCategory);
            saveCategories(categories);

            // Show success message
            showAlert(`Category '${name}' added successfully!`, 'success');

            // Reset form
            document.getElementById('addCategoryForm').reset();
            document.getElementById('iconPreview').style.display = 'none';
            document.getElementById('iconUpload').style.display = 'block';
            document.getElementById('categoryIcon').value = '';
            iconFile = null;
            document.getElementById('categoryMenu').checked = true;

            // Redirect to categories page
            setTimeout(() => {
                window.location.href = 'product-categories.php';
            }, 1500);

            console.log('Category saved:', newCategory);
            return false;
        }

        // ============================================================
        // SIDEBAR TOGGLE (Mobile)
        // ============================================================
        document.addEventListener('DOMContentLoaded', function() {
            loadParentDropdown();

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

            console.log('Add Category page initialized (100% JavaScript with localStorage)');
        });
    </script>
</body>
</html>