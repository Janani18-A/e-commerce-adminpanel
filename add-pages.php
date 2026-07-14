<?php
include 'config/config.php';
?>

<?php $current_page = 'add-pages'; ?>
<!DOCTYPE html>
<html lang="en">


   <?php include 'templates/head.php'; ?>

    <style>
        body {
            background: #f4f7fc;
            font-family:'Inter', sans-serif;
        }

        .content-area {
            margin-left: 260px;
            padding: 30px 30px 40px;
            min-height: 100vh;
            transition: margin-left 0.3s ease;
        }

        @media (max-width: 992px) {
            .content-area {
                margin-left: 0;
                padding: 20px 16px 30px;
            }
        }

        .page-header {
            display: flex;
            flex-wrap: wrap;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 28px;
            padding-bottom: 12px;
            border-bottom: 2px solid #e9edf4;
        }

        .page-title {
            font-size: 22px;
            font-weight: 700;
            color: #000000;
            margin: 0;
        }

        .card {
            border-radius: 16px;
            border: none;
            box-shadow: 0 8px 30px rgba(0, 0, 0, 0.05);
        }

        .card-body {
            padding: 28px 30px 30px;
        }

        .form-label {
            font-weight: 600;
            font-size: 14px;
            color: #1e293b;
        }

        .form-control,
        .form-select {
            border-radius: 10px;
            border: 1.5px solid #dce1eb;
            padding: 10px 14px;
            font-size: 14px;
        }

        .form-control:focus,
        .form-select:focus {
            border-color: #2a7de1;
            box-shadow: 0 0 0 3px rgba(42, 125, 225, 0.12);
        }

        .form-text {
            font-size: 13px;
            color: #64748b;
        }

        .slug-preview {
            background: #f1f5f9;
            padding: 6px 14px;
            border-radius: 6px;
            font-size: 14px;
            color: #1e293b;
            display: inline-block;
        }

        /* Rich Text Editor Toolbar */
        .editor-toolbar {
            display: flex;
            flex-wrap: wrap;
            gap: 4px;
            padding: 8px 12px;
            background: #f8fafd;
            border: 1.5px solid #dce1eb;
            border-bottom: none;
            border-radius: 10px 10px 0 0;
        }

        .editor-toolbar .btn-tool {
            background: transparent;
            border: none;
            padding: 4px 8px;
            border-radius: 4px;
            color: #475569;
            transition: 0.2s;
            font-size: 14px;
        }

        .editor-toolbar .btn-tool:hover {
            background: #e2e8f0;
            color: #0b2a4a;
        }

        .editor-toolbar .btn-tool.active {
            background: #dbeafe;
            color: #2a7de1;
        }

        .editor-toolbar .divider {
            width: 1px;
            background: #dce1eb;
            margin: 0 4px;
        }

        .editor-content {
            border: 1.5px solid #dce1eb;
            border-top: none;
            border-radius: 0 0 10px 10px;
            padding: 16px;
            min-height: 200px;
            background: #fff;
            outline: none;
            font-size: 14px;
            line-height: 1.7;
        }

        .editor-content:focus {
            border-color: #2a7de1;
            box-shadow: 0 0 0 3px rgba(42, 125, 225, 0.08);
        }

        .editor-content p {
            margin-bottom: 0.5rem;
        }

        .editor-content ul,
        .editor-content ol {
            padding-left: 1.5rem;
        }

        .section-title {
            font-size: 16px;
            font-weight: 700;
            color: #0b2a4a;
            padding-bottom: 8px;
            border-bottom: 2px solid #e9edf4;
            margin-bottom: 20px;
        }

        .btn-save {
            padding: 10px 40px;
            font-size: 16px;
            border-radius: 10px;
        }

        /* Toast */
        .toast-notification {
            position: fixed;
            bottom: 30px;
            right: 30px;
            background: #1e293b;
            color: #fff;
            padding: 14px 26px;
            border-radius: 14px;
            display: flex;
            align-items: center;
            gap: 14px;
            font-size: 15px;
            font-weight: 500;
            box-shadow: 0 12px 40px rgba(0, 0, 0, 0.25);
            transform: translateY(80px);
            opacity: 0;
            transition: transform 0.4s cubic-bezier(0.22, 1, 0.36, 1), opacity 0.4s ease;
            z-index: 9999;
            pointer-events: none;
        }

        .toast-notification.show {
            transform: translateY(0);
            opacity: 1;
            pointer-events: auto;
        }

        .toast-notification i {
            font-size: 22px;
            color: #34d399;
        }

        @media (max-width: 576px) {
            .toast-notification {
                bottom: 16px;
                right: 16px;
                left: 16px;
                padding: 12px 18px;
                font-size: 14px;
            }
        }
    </style>
</head>

<body>
    <!-- Navbar & Sidebar -->
    <?php include 'templates/navbar.php'; ?>
    <?php include 'templates/sidebar.php'; ?>

    <!-- MAIN CONTENT -->
    <div class="content-area">
        <div class="container-fluid">

            <!-- Page Header -->
            <div class="page-header">
                <h4 class="page-title">
                    <i class="fas fa-plus-circle me-2 text-primary"></i> ADD PAGE
                </h4>

            </div>

            <!-- Form Card -->
            <div class="card">
                <div class="card-body">

                    <form id="addPageForm" onsubmit="handleSave(event)">

                        <!-- ===== PAGE INFORMATION ===== -->
                        <h5 class="section-title"><i class="fas fa-info-circle me-2"></i>Page Information</h5>
                        <p class="text-muted small">Fill all information below.</p>

                        <!-- Name -->
                        <div class="mb-3">
                            <label for="pageName" class="form-label">Name</label>
                            <input type="text" class="form-control" id="pageName" placeholder="Enter a page name" required>
                        </div>

                        <!-- Slug -->
                        <div class="mb-3">
                            <label for="pageSlug" class="form-label">Slug</label>
                            <div class="d-flex align-items-center gap-2 mb-1">
                                <span class="slug-preview"><i class="fas fa-link me-1"></i>https://itorespot.in/ckse-shop/</span>
                                <span class="text-muted">/</span>
                            </div>
                            <input type="text" class="form-control" id="pageSlug" placeholder="Enter a page slug">
                            <div class="form-text">If you leave it blank, it will be generated automatically.</div>
                        </div>

                        <!-- Content with Editor -->
                        <div class="mb-3">
                            <label for="pageContent" class="form-label">Content</label>

                            <!-- Toolbar -->
                            <div class="editor-toolbar" id="editorToolbar">
                                <button type="button" class="btn-tool" data-command="bold" title="Bold"><i class="fas fa-bold"></i></button>
                                <button type="button" class="btn-tool" data-command="italic" title="Italic"><i class="fas fa-italic"></i></button>
                                <button type="button" class="btn-tool" data-command="underline" title="Underline"><i class="fas fa-underline"></i></button>
                                <span class="divider"></span>
                                <button type="button" class="btn-tool" data-command="insertUnorderedList" title="Bullet List"><i class="fas fa-list-ul"></i></button>
                                <button type="button" class="btn-tool" data-command="insertOrderedList" title="Numbered List"><i class="fas fa-list-ol"></i></button>
                                <span class="divider"></span>
                                <button type="button" class="btn-tool" data-command="justifyLeft" title="Align Left"><i class="fas fa-align-left"></i></button>
                                <button type="button" class="btn-tool" data-command="justifyCenter" title="Align Center"><i class="fas fa-align-center"></i></button>
                                <button type="button" class="btn-tool" data-command="justifyRight" title="Align Right"><i class="fas fa-align-right"></i></button>
                                <span class="divider"></span>
                                <button type="button" class="btn-tool" data-command="createLink" title="Insert Link"><i class="fas fa-link"></i></button>
                                <button type="button" class="btn-tool" data-command="unlink" title="Remove Link"><i class="fas fa-unlink"></i></button>
                                <span class="divider"></span>
                                <button type="button" class="btn-tool" data-command="removeFormat" title="Remove Formatting"><i class="fas fa-eraser"></i></button>
                            </div>

                            <!-- Editable Content Area -->
                            <div class="editor-content" id="pageContent" contenteditable="true">
                                <p>Start writing your page content here...</p>
                            </div>
                            <input type="hidden" id="contentHidden" name="content">
                        </div>

                        <!-- ===== SEO INFORMATION ===== -->
                        <h5 class="section-title mt-4"><i class="fas fa-search me-2"></i>SEO Information</h5>
                        <p class="text-muted small">Fill the information below to optimize your category ranking.</p>

                        <!-- Meta Title -->
                        <div class="mb-3">
                            <label for="metaTitle" class="form-label">Meta Title</label>
                            <input type="text" class="form-control" id="metaTitle" placeholder="Enter meta title">
                        </div>

                        <!-- Meta Description -->
                        <div class="mb-3">
                            <label for="metaDescription" class="form-label">Meta Description</label>
                            <textarea class="form-control" id="metaDescription" rows="3" placeholder="Enter meta description"></textarea>
                        </div>

                        <!-- Save Button -->
                        <div class="d-flex justify-content-end mt-4">
                            <button type="submit" class="btn btn-primary btn-save">
                                <i class="fas fa-save me-2"></i> Save
                            </button>
                        </div>

                    </form>

                </div>
            </div>

        </div>
    </div>

    <!-- Toast Notification -->
    <div class="toast-notification" id="toast">
        <i class="fas fa-check-circle"></i>
        <span id="toastMessage">Page saved successfully!</span>
    </div>

    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
   <!-- Bootstrap JS Bundle (Latest Stable) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
    <script src="assets/js/script.js"></script>

    <script>
        (function() {
                "use strict";

                // ---------------- Editor ----------------
                const editor = document.getElementById("pageContent");
                const toolbar = document.getElementById("editorToolbar");

                toolbar.addEventListener("click", function(e) {
                    const btn = e.target.closest(".btn-tool");
                    if (!btn) return;

                    const command = btn.dataset.command;

                    if (command === "createLink") {
                        const url = prompt("Enter URL", "https://");
                        if (url) document.execCommand(command, false, url);
                    } else {
                        document.execCommand(command, false, null);
                    }

                    editor.focus();
                });

                // ---------------- Slug ----------------
                const nameInput = document.getElementById("pageName");
                const slugInput = document.getElementById("pageSlug");

                nameInput.addEventListener("input", function() {
                    if (slugInput.value.trim() === "") {
                        slugInput.value = this.value
                            .toLowerCase()
                            .trim()
                            .replace(/[^a-z0-9\s-]/g, "")
                            .replace(/\s+/g, "-")
                            .replace(/-+/g, "-");
                    }
                });

                // ---------------- Toast ----------------
                const toast = document.getElementById("toast");
                const toastMsg = document.getElementById("toastMessage");

                function showToast(msg) {
                    toastMsg.textContent = msg;
                    toast.classList.add("show");

                    clearTimeout(toast.timer);

                    toast.timer = setTimeout(() => {
                        toast.classList.remove("show");
                    }, 2000);
                }

                // ---------------- Load Edit Data ----------------
                let editPage = JSON.parse(localStorage.getItem("editPage"));

                if (editPage) {

                    pageName.value = editPage.name;
                    pageSlug.value = editPage.slug;
                    pageContent.innerHTML = editPage.content || "";
                    metaTitle.value = editPage.metaTitle || "";
                    metaDescription.value = editPage.metaDescription || "";

                }
                window.handleSave = function(e) {

                    e.preventDefault();

                    let pages = JSON.parse(localStorage.getItem("pages")) || [];

                    const pageData = {
                        id: editPage ? editPage.id : Date.now(),
                        name: document.getElementById("pageName").value,
                        slug: document.getElementById("pageSlug").value,
                        content: document.getElementById("pageContent").innerHTML,
                        metaTitle: document.getElementById("metaTitle").value,
                        metaDescription: document.getElementById("metaDescription").value
                    };

                    if (editPage) {

                        const index = pages.findIndex(p => p.id == editPage.id);

                        if (index !== -1) {
                            pages[index] = pageData;
                        }

                        localStorage.removeItem("editPage");

                    } else {

                        pages.push(pageData);

                    }

                    localStorage.setItem("pages", JSON.stringify(pages));

                    showToast("Page Saved Successfully!");

                    setTimeout(() => {
                        location.href = "pages.php";
                    }, 1000);

                    return false;
                };

                nameInput.focus();
})();
    </script>

</body>

</html>