<?php
// Database Connection Test File
// Place this in your root directory and access: http://localhost/e-commerce-adminpanel/test-db.php

// Load configuration
require_once __DIR__ . '/config/config.php';

// Function to test database connection
function testDatabaseConnection()
{
    $results = [
        'status' => 'error',
        'message' => '',
        'details' => [],
        'tables' => [],
        'server_info' => '',
        'connection_time' => ''
    ];

    $start_time = microtime(true);

    try {
        // Attempt connection
        $conn = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);

        if (!$conn) {
            throw new Exception("Connection failed: " . mysqli_connect_error());
        }

        // Get server info
        $results['server_info'] = mysqli_get_server_info($conn);
        $results['connection_time'] = round((microtime(true) - $start_time) * 1000, 2) . ' ms';
        $results['status'] = 'success';
        $results['message'] = '✅ Database connection successful!';

        // Get database details
        $results['details']['host'] = DB_HOST;
        $results['details']['database'] = DB_NAME;
        $results['details']['user'] = DB_USER;
        $results['details']['charset'] = mysqli_character_set_name($conn);

        // Get all tables
        $tables_query = "SHOW TABLES";
        $tables_result = mysqli_query($conn, $tables_query);

        if ($tables_result) {
            while ($row = mysqli_fetch_array($tables_result)) {
                $table_name = $row[0];

                // Get table details
                $count_query = "SELECT COUNT(*) as count FROM `$table_name`";
                $count_result = mysqli_query($conn, $count_query);
                $row_count = mysqli_fetch_assoc($count_result)['count'] ?? 0;

                // Get table structure
                $structure_query = "DESCRIBE `$table_name`";
                $structure_result = mysqli_query($conn, $structure_query);
                $columns = [];
                while ($col = mysqli_fetch_assoc($structure_result)) {
                    $columns[] = $col;
                }

                $results['tables'][] = [
                    'name' => $table_name,
                    'rows' => $row_count,
                    'columns' => $columns,
                    'engine' => getTableEngine($conn, $table_name)
                ];
            }
        }

        mysqli_close($conn);
    } catch (Exception $e) {
        $results['status'] = 'error';
        $results['message'] = '❌ Database connection failed!';
        $results['error'] = $e->getMessage();

        // Check specific error types
        if (strpos($e->getMessage(), 'Unknown database') !== false) {
            $results['error_type'] = 'Database does not exist';
            $results['suggestion'] = 'Please create the database using phpMyAdmin or run the SQL script.';
        } elseif (strpos($e->getMessage(), 'Access denied') !== false) {
            $results['error_type'] = 'Invalid credentials';
            $results['suggestion'] = 'Please check your username and password in config/config.php';
        } elseif (strpos($e->getMessage(), 'Connection refused') !== false) {
            $results['error_type'] = 'Server not found';
            $results['suggestion'] = 'Make sure MySQL server is running on localhost';
        }
    }

    return $results;
}

// Helper function to get table engine
function getTableEngine($conn, $table_name)
{
    $query = "SELECT ENGINE FROM information_schema.TABLES 
              WHERE TABLE_SCHEMA = DATABASE() 
              AND TABLE_NAME = '$table_name'";
    $result = mysqli_query($conn, $query);
    if ($result && $row = mysqli_fetch_assoc($result)) {
        return $row['ENGINE'];
    }
    return 'Unknown';
}

// Run test
$test_results = testDatabaseConnection();

// Get PHP info
$php_version = phpversion();
$php_extensions = get_loaded_extensions();
$mysql_supported = extension_loaded('mysqli');

// Check if config constants are defined
$config_defined = defined('DB_HOST') && defined('DB_USER') && defined('DB_PASS') && defined('DB_NAME');
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Database Connection Test</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            padding: 40px 20px;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        .test-container {
            max-width: 1200px;
            margin: 0 auto;
        }

        .main-card {
            background: white;
            border-radius: 20px;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3);
            overflow: hidden;
        }

        .card-header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 30px;
            border-bottom: none;
        }

        .card-header h2 {
            font-weight: 700;
            margin: 0;
        }

        .card-header p {
            margin: 5px 0 0;
            opacity: 0.9;
        }

        .status-badge {
            padding: 8px 20px;
            border-radius: 50px;
            font-weight: 600;
            font-size: 14px;
            display: inline-block;
        }

        .status-success {
            background: #d4edda;
            color: #155724;
        }

        .status-error {
            background: #f8d7da;
            color: #721c24;
        }

        .status-warning {
            background: #fff3cd;
            color: #856404;
        }

        .info-card {
            border: none;
            border-radius: 15px;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.05);
            transition: transform 0.3s ease;
            height: 100%;
        }

        .info-card:hover {
            transform: translateY(-5px);
        }

        .info-card .card-body {
            padding: 25px;
        }

        .info-card .icon {
            width: 50px;
            height: 50px;
            border-radius: 12px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-size: 24px;
            margin-bottom: 15px;
        }

        .icon-success {
            background: #d4edda;
            color: #155724;
        }

        .icon-danger {
            background: #f8d7da;
            color: #721c24;
        }

        .icon-info {
            background: #d1ecf1;
            color: #0c5460;
        }

        .icon-warning {
            background: #fff3cd;
            color: #856404;
        }

        .table-details {
            background: #f8f9fa;
            border-radius: 10px;
            padding: 15px;
            margin-top: 10px;
        }

        .table-details table {
            margin: 0;
            font-size: 14px;
        }

        .table-details table th {
            font-weight: 600;
            color: #555;
        }

        .badge-engine {
            background: #e9ecef;
            color: #495057;
            padding: 5px 12px;
            border-radius: 20px;
            font-weight: 500;
            font-size: 12px;
        }

        .environment-details {
            background: #f8f9fa;
            border-radius: 15px;
            padding: 20px;
            margin-top: 20px;
        }

        .environment-details .row {
            margin-bottom: 10px;
        }

        .environment-details .label {
            font-weight: 600;
            color: #555;
        }

        .toast-container {
            position: fixed;
            top: 20px;
            right: 20px;
            z-index: 9999;
        }

        .highlight {
            background: #fff3cd;
            padding: 2px 8px;
            border-radius: 4px;
            font-weight: 600;
        }

        @media (max-width: 768px) {
            .card-header {
                padding: 20px;
            }

            .test-container {
                padding: 0;
            }
        }
    </style>
</head>

<body>
    <div class="toast-container" id="toastContainer"></div>

    <div class="test-container">
        <div class="main-card">
            <!-- Header -->
            <div class="card-header">
                <div class="row align-items-center">
                    <div class="col-md-8">
                        <h2><i class="fas fa-database me-3"></i>Database Connection Test</h2>
                        <p>Testing connection to MySQL database for your application</p>
                    </div>
                    <div class="col-md-4 text-md-end">
                        <span class="status-badge <?php echo $test_results['status'] === 'success' ? 'status-success' : 'status-error'; ?>">
                            <i class="fas <?php echo $test_results['status'] === 'success' ? 'fa-check-circle' : 'fa-times-circle'; ?> me-2"></i>
                            <?php echo $test_results['status'] === 'success' ? 'Connected' : 'Failed'; ?>
                        </span>
                    </div>
                </div>
            </div>

            <!-- Body -->
            <div class="card-body p-4">
                <?php if ($test_results['status'] === 'success'): ?>
                    <!-- Success Alert -->
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <i class="fas fa-check-circle me-2"></i>
                        <strong>Success!</strong> Database connection established successfully.
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                <?php else: ?>
                    <!-- Error Alert -->
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <i class="fas fa-exclamation-circle me-2"></i>
                        <strong>Error!</strong> <?php echo $test_results['message']; ?>
                        <?php if (isset($test_results['error'])): ?>
                            <br><small><?php echo htmlspecialchars($test_results['error']); ?></small>
                        <?php endif; ?>
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>

                    <?php if (isset($test_results['suggestion'])): ?>
                        <div class="alert alert-warning">
                            <i class="fas fa-lightbulb me-2"></i>
                            <strong>Suggestions:</strong> <?php echo $test_results['suggestion']; ?>
                        </div>
                    <?php endif; ?>
                <?php endif; ?>

                <!-- Connection Details -->
                <div class="row g-4 mb-4">
                    <div class="col-md-3">
                        <div class="info-card">
                            <div class="card-body">
                                <div class="icon icon-<?php echo $test_results['status'] === 'success' ? 'success' : 'danger'; ?>">
                                    <i class="fas fa-plug"></i>
                                </div>
                                <h6 class="mb-1">Connection</h6>
                                <p class="mb-0 text-muted small">
                                    <?php echo $test_results['status'] === 'success' ? 'Connected' : 'Failed'; ?>
                                </p>
                                <?php if ($test_results['status'] === 'success'): ?>
                                    <small class="text-success">
                                        <i class="fas fa-clock me-1"></i><?php echo $test_results['connection_time']; ?>
                                    </small>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="info-card">
                            <div class="card-body">
                                <div class="icon icon-info">
                                    <i class="fas fa-server"></i>
                                </div>
                                <h6 class="mb-1">Database</h6>
                                <p class="mb-0 text-muted small"><?php echo DB_NAME; ?></p>
                                <small class="text-muted">MySQL <?php echo $test_results['server_info'] ?? 'N/A'; ?></small>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="info-card">
                            <div class="card-body">
                                <div class="icon icon-success">
                                    <i class="fas fa-table"></i>
                                </div>
                                <h6 class="mb-1">Tables</h6>
                                <p class="mb-0 text-muted small">
                                    <?php echo count($test_results['tables'] ?? []); ?> found
                                </p>
                                <small class="text-muted">
                                    <?php
                                    $total_rows = 0;
                                    foreach ($test_results['tables'] ?? [] as $table) {
                                        $total_rows += $table['rows'];
                                    }
                                    echo $total_rows . ' total rows';
                                    ?>
                                </small>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="info-card">
                            <div class="card-body">
                                <div class="icon icon-warning">
                                    <i class="fas fa-user"></i>
                                </div>
                                <h6 class="mb-1">User</h6>
                                <p class="mb-0 text-muted small"><?php echo DB_USER; ?></p>
                                <small class="text-muted">
                                    <?php echo $test_results['status'] === 'success' ? 'Valid credentials' : 'Invalid credentials'; ?>
                                </small>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Environment Details -->
                <div class="environment-details">
                    <h6 class="mb-3"><i class="fas fa-info-circle me-2"></i>Environment Details</h6>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="row mb-2">
                                <div class="col-5 label">PHP Version</div>
                                <div class="col-7"><?php echo $php_version; ?></div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-5 label">MySQL Supported</div>
                                <div class="col-7">
                                    <?php if ($mysql_supported): ?>
                                        <span class="text-success"><i class="fas fa-check-circle"></i> Yes</span>
                                    <?php else: ?>
                                        <span class="text-danger"><i class="fas fa-times-circle"></i> No</span>
                                    <?php endif; ?>
                                </div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-5 label">Config Defined</div>
                                <div class="col-7">
                                    <?php if ($config_defined): ?>
                                        <span class="text-success"><i class="fas fa-check-circle"></i> Yes</span>
                                    <?php else: ?>
                                        <span class="text-danger"><i class="fas fa-times-circle"></i> No</span>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="row mb-2">
                                <div class="col-5 label">Extensions</div>
                                <div class="col-7">
                                    <?php if (in_array('mysqli', $php_extensions)): ?>
                                        <span class="text-success">✅ MySQLi</span>
                                    <?php endif; ?>
                                    <?php if (in_array('pdo_mysql', $php_extensions)): ?>
                                        <span class="text-success">✅ PDO</span>
                                    <?php endif; ?>
                                </div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-5 label">Config File</div>
                                <div class="col-7">
                                    <?php if (file_exists(__DIR__ . '/config/config.php')): ?>
                                        <span class="text-success">✅ Found</span>
                                    <?php else: ?>
                                        <span class="text-danger">❌ Missing</span>
                                    <?php endif; ?>
                                </div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-5 label">APP_URL</div>
                                <div class="col-7"><?php echo APP_URL; ?></div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Table Details -->
                <?php if (!empty($test_results['tables'])): ?>
                    <h6 class="mt-4 mb-3"><i class="fas fa-database me-2"></i>Database Tables</h6>

                    <?php foreach ($test_results['tables'] as $table): ?>
                        <div class="table-details mb-3">
                            <div class="d-flex justify-content-between align-items-center mb-2">
                                <h6 class="mb-0">
                                    <i class="fas fa-table me-2 text-primary"></i>
                                    <?php echo $table['name']; ?>
                                    <span class="badge bg-secondary ms-2"><?php echo $table['rows']; ?> rows</span>
                                </h6>
                                <span class="badge-engine">
                                    <i class="fas fa-cog me-1"></i><?php echo $table['engine']; ?>
                                </span>
                            </div>
                            <table class="table table-sm table-bordered mb-0">
                                <thead class="table-light">
                                    <tr>
                                        <th>Column</th>
                                        <th>Type</th>
                                        <th>Null</th>
                                        <th>Key</th>
                                        <th>Default</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($table['columns'] as $column): ?>
                                        <tr>
                                            <td><strong><?php echo $column['Field']; ?></strong></td>
                                            <td><?php echo $column['Type']; ?></td>
                                            <td><?php echo $column['Null']; ?></td>
                                            <td><?php echo $column['Key'] ?: '-'; ?></td>
                                            <td><?php echo $column['Default'] ?? 'NULL'; ?></td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <div class="alert alert-info mt-3">
                        <i class="fas fa-info-circle me-2"></i>
                        No tables found in the database. Please run the SQL script to create tables.
                    </div>
                <?php endif; ?>

                <!-- Config Information -->
                <div class="mt-4 p-3 bg-light rounded">
                    <h6><i class="fas fa-cog me-2"></i>Configuration</h6>
                    <div class="row">
                        <div class="col-md-6">
                            <pre style="background: #fff; padding: 10px; border-radius: 8px; font-size: 12px;">
// config/config.php
define('DB_HOST', '<?php echo DB_HOST; ?>');
define('DB_USER', '<?php echo DB_USER; ?>');
define('DB_PASS', '<?php echo str_repeat('*', strlen(DB_PASS)); ?>');
define('DB_NAME', '<?php echo DB_NAME; ?>');
define('APP_URL', '<?php echo APP_URL; ?>');
                            </pre>
                        </div>
                        <div class="col-md-6">
                            <?php if ($test_results['status'] === 'success'): ?>
                                <div class="alert alert-success mb-0">
                                    <i class="fas fa-check-circle me-2"></i>
                                    <strong>All systems ready!</strong><br>
                                    <small>You can now use the registration and login system.</small>
                                </div>
                            <?php else: ?>
                                <div class="alert alert-danger mb-0">
                                    <i class="fas fa-exclamation-triangle me-2"></i>
                                    <strong>Connection failed!</strong><br>
                                    <small>Please fix the issues above before proceeding.</small>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>

                <!-- Action Buttons -->
                <div class="mt-4 text-center">
                    <a href="<?php echo APP_URL; ?>/auth/register" class="btn btn-primary me-2">
                        <i class="fas fa-user-plus me-2"></i>Go to Register
                    </a>
                    <a href="<?php echo APP_URL; ?>/auth/login" class="btn btn-success me-2">
                        <i class="fas fa-sign-in-alt me-2"></i>Go to Login
                    </a>
                    <button onclick="location.reload()" class="btn btn-outline-secondary">
                        <i class="fas fa-sync-alt me-2"></i>Refresh Test
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        // Auto-dismiss alerts after 5 seconds
        document.addEventListener('DOMContentLoaded', function() {
            const alerts = document.querySelectorAll('.alert-dismissible');
            alerts.forEach(alert => {
                setTimeout(() => {
                    const closeBtn = alert.querySelector('.btn-close');
                    if (closeBtn) {
                        closeBtn.click();
                    }
                }, 5000);
            });
        });
    </script>
</body>

</html>