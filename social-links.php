<?php
$current_page = 'settings';
$success_message = '';
$error_message = '';

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $enable_social = isset($_POST['enable_social']) ? 1 : 0;
    $facebook = $_POST['facebook'] ?? '';
    $instagram = $_POST['instagram'] ?? '';
    $twitter = $_POST['twitter'] ?? '';
    $youtube = $_POST['youtube'] ?? '';
    $linkedin = $_POST['linkedin'] ?? '';
    $whatsapp = $_POST['whatsapp'] ?? '';
    $telegram = $_POST['telegram'] ?? '';
    $pinterest = $_POST['pinterest'] ?? '';
    
    $success_message = 'Social links saved successfully!';
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Social Links - Settings</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>
    <?php include ('templates/navbar.php'); ?>
    <?php include('templates/sidebar.php'); ?>

    <div class="content-area">
        <div class="settings-container bg-white border rounded-4 overflow-hidden">
            <!-- Header -->
            <div class="settings-header p-4 border-bottom d-flex flex-wrap justify-content-between align-items-center">
                <div>
                    <h1 class="fs-4 fw-bold text-dark mb-0">🔗 Social Links</h1>
                    <p class="text-secondary small mb-0">Connect your social media profiles to increase brand visibility and engagement.</p>
                </div>
                <a href="settings.php" class="btn btn-light border mt-2 mt-sm-0">
                    <i class="fas fa-arrow-left"></i> Back to Settings
                </a>
            </div>

            <?php if ($success_message): ?>
                <div class="alert alert-success m-3 rounded-3">
                    <i class="fas fa-check-circle"></i> <?php echo $success_message; ?>
                </div>
                <script>
                    setTimeout(function() {
                        if (typeof showToast === 'function') {
                            showToast('<?php echo $success_message; ?>', 'success');
                        }
                    }, 500);
                </script>
            <?php endif; ?>

            <form method="POST" action="" onsubmit="return saveSocialLinks();" class="p-3">
                <div class="bg-white border rounded-3 p-4">
                    
                    <!-- Enable Social Links Toggle -->
                    <div class="bg-light rounded-3 p-3 d-flex align-items-center gap-3 mb-3">
                        <div class="form-check form-switch mb-0">
                            <input class="form-check-input" type="checkbox" name="enable_social" value="1" checked 
                                   style="width:48px; height:26px; cursor:pointer;" 
                                   onchange="toggleSocialLinks(this)" id="socialToggle">
                        </div>
                        <div class="flex-grow-1">
                            <div class="fw-medium text-dark small">Enable Social Links</div>
                            <div class="text-secondary small">Show social links on store</div>
                        </div>
                        <span id="socialStatus" class="text-success fw-medium small">Enabled</span>
                    </div>

                    <!-- Social Links Content -->
                    <div id="socialLinksContent">
                        <div class="mb-3">
                            <label class="form-label fw-semibold small"><i class="fab fa-facebook text-primary"></i> Facebook</label>
                            <input type="url" class="form-control" name="facebook" value="https://facebook.com/mystore" placeholder="Enter Facebook URL">
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-semibold small"><i class="fab fa-instagram text-danger"></i> Instagram</label>
                            <input type="url" class="form-control" name="instagram" value="https://instagram.com/mystore" placeholder="Enter Instagram URL">
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-semibold small"><i class="fab fa-twitter text-info"></i> Twitter/X</label>
                            <input type="url" class="form-control" name="twitter" value="https://twitter.com/mystore" placeholder="Enter Twitter URL">
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-semibold small"><i class="fab fa-youtube text-danger"></i> YouTube</label>
                            <input type="url" class="form-control" name="youtube" value="https://youtube.com/mystore" placeholder="Enter YouTube URL">
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-semibold small"><i class="fab fa-linkedin text-primary"></i> LinkedIn</label>
                            <input type="url" class="form-control" name="linkedin" value="https://linkedin.com/mystore" placeholder="Enter LinkedIn URL">
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-semibold small"><i class="fab fa-whatsapp text-success"></i> WhatsApp</label>
                            <input type="tel" class="form-control" name="whatsapp" value="+91 9876543210" placeholder="Enter WhatsApp number">
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-semibold small"><i class="fab fa-telegram text-primary"></i> Telegram</label>
                            <input type="url" class="form-control" name="telegram" value="https://t.me/mystore" placeholder="Enter Telegram URL">
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-semibold small"><i class="fab fa-pinterest text-danger"></i> Pinterest</label>
                            <input type="url" class="form-control" name="pinterest" value="https://pinterest.com/mystore" placeholder="Enter Pinterest URL">
                        </div>
                    </div>

                    <!-- Buttons -->
                    <div class="d-flex gap-3 mt-4">
                        <button type="submit" class="btn btn-primary px-4 py-2">
                            <i class="fas fa-save"></i> Save Changes
                        </button>
                        <a href="settings.php" class="btn btn-light border px-4 py-2">
                            Cancel
                        </a>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="../assets/js/script.js"></script>

    <script>
    // Toggle Social Links
    function toggleSocialLinks(checkbox) {
        const statusElement = document.getElementById('socialStatus');
        const contentEl = document.getElementById('socialLinksContent');
        
        if (checkbox.checked) {
            // ENABLED - Show all social link fields
            if (statusElement) {
                statusElement.textContent = 'Enabled';
                statusElement.className = 'text-success fw-medium small';
            }
            if (contentEl) {
                contentEl.style.display = 'block';
                contentEl.style.opacity = '1';
                contentEl.style.pointerEvents = 'auto';
                // Enable all inputs inside
                const inputs = contentEl.querySelectorAll('input');
                inputs.forEach(input => {
                    input.disabled = false;
                    input.style.opacity = '1';
                    input.style.background = '#FFFFFF';
                });
            }
        } else {
            // DISABLED - Hide all social link fields
            if (statusElement) {
                statusElement.textContent = 'Disabled';
                statusElement.className = 'text-secondary fw-medium small';
            }
            if (contentEl) {
                contentEl.style.display = 'none';
                contentEl.style.opacity = '0.5';
                contentEl.style.pointerEvents = 'none';
                // Disable all inputs inside
                const inputs = contentEl.querySelectorAll('input');
                inputs.forEach(input => {
                    input.disabled = true;
                    input.style.opacity = '0.5';
                    input.style.background = '#F1F5F9';
                });
            }
        }
    }

    // Save Social Links
    function saveSocialLinks() {
        const enabled = document.querySelector('input[name="enable_social"]')?.checked;
        
        if (typeof showToast === 'function') {
            showToast('✅ Social links ' + (enabled ? 'enabled' : 'disabled') + ' and saved!', 'success');
        } else {
            alert('Social links saved successfully!');
        }
        
        return true;
    }

    // Initialize on page load - ensure content is visible
    document.addEventListener('DOMContentLoaded', function() {
        const mainCheckbox = document.getElementById('socialToggle');
        if (mainCheckbox && mainCheckbox.checked) {
            document.getElementById('socialLinksContent').style.display = 'block';
        }
    });
    </script>
</body>
</html>