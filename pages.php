<?php $current_page = 'pages'; ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pages</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Font Awesome 6 -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

    <!-- DataTables -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.8/css/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" href="assets/css/style.css">
    
</head>

<body>
    <!-- Navbar -->
    <?php include 'templates/navbar.php'; ?>
    <!-- Sidebar -->
     <?php include 'templates/sidebar.php'; ?>

    <!-- MAIN CONTENT WRAPPER -->
    <div class="content-area">
        <div class="container-fluid">

            <!-- Header -->
            <div class="page-header">
                <h4 class="page-title">
                    <i class="fas fa-file-alt"></i> Pages
                </h4>
                <nav>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">Dashboard</li>
                        <li class="breadcrumb-item active">Pages</li>
                    </ol>
                </nav>
            </div>

            <!-- ==========================
                    PAGE LIST
            =========================== -->
            <div id="pagesList">

                <div class="card border-0 shadow-sm">

                    <div class="card-body">

                        <div class="d-flex justify-content-end mb-4">
                            <button class="btn btn-success" id="addPageBtn">
                                <i class="fas fa-plus"></i> Add Page
                            </button>
                        </div>

                        <table id="pagesTable" class="table table-hover align-middle">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Slug</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <!-- Data loaded by JavaScript -->
                            </tbody>
                        </table>

                    </div>

                </div>

            </div>

            <!-- ==========================
                    ADD / EDIT PAGE FORM
            =========================== -->
            <div id="addPageSection" style="display:none;">

                <!-- Page Information -->
                <div class="card border-0 shadow-sm mb-4">

                    <div class="card-header">
                        <h5>
                            <i class="fas fa-info-circle text-primary me-2"></i> Page Information
                        </h5>
                        <small>Fill all information below to create or edit a page.</small>
                    </div>

                    <div class="card-body">

                        <div class="mb-3">
                            <label class="form-label">Name <span class="text-danger">*</span></label>
                            <input type="text" id="pageName" class="form-control" placeholder="Enter a page name">
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Slug</label>
                            <div class="input-group">
                                <span class="input-group-text">https://example.com/</span>
                                <input type="text" id="pageSlug" class="form-control" placeholder="page-slug">
                            </div>
                            <small class="text-muted">If left empty, it will be generated automatically from the
                                name.</small>
                        </div>

                        <div class="mb-0">
                            <label class="form-label">Content</label>
                            <textarea id="pageContent" rows="8" class="form-control"></textarea>
                        </div>

                    </div>

                </div>

                <!-- SEO Information -->
                <div class="card border-0 shadow-sm">

                    <div class="card-header">
                        <h5>
                            <i class="fas fa-search text-warning me-2"></i> SEO Information
                        </h5>
                        <small>Fill the information below to optimize search engine visibility.</small>
                    </div>

                    <div class="card-body">

                        <div class="mb-3">
                            <label class="form-label">Meta Title</label>
                            <input type="text" class="form-control" id="metaTitle" placeholder="Enter meta title">
                            <small class="text-muted">Recommended length: 50-60 characters.</small>
                        </div>

                        <div class="mb-4">
                            <label class="form-label">Meta Description</label>
                            <textarea class="form-control" rows="4" id="metaDescription"
                                placeholder="Enter meta description"></textarea>
                            <small class="text-muted">Recommended length: 150-160 characters.</small>
                        </div>

                        <div class="d-flex flex-wrap gap-2">
                            <button class="btn btn-primary" id="savePage">
                                <i class="fas fa-save"></i> Save Page
                            </button>
                            <button class="btn btn-secondary" id="cancelPage">
                                <i class="fas fa-times"></i> Cancel
                            </button>
                        </div>

                    </div>

                </div>

            </div>

        </div>
    </div><!-- /content-area -->

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

    <!-- Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <!-- DataTables -->
    <script src="https://cdn.datatables.net/1.13.8/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.8/js/dataTables.bootstrap5.min.js"></script>
    <script src="assets/js/script.js"></script>
    

</body>

</html>