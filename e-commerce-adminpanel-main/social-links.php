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
        <div class="settings-container">
            <!-- Header -->
            <div class="settings-header" style="display: flex; justify-content: space-between; align-items: center;">
                <div>
                    <h1 style="font-size: 22px; font-weight: 700; color: #1E293B;">🔗 Social Links</h1>
                    <p style="font-size: 14px; color: #64748B; margin-top: 4px;">Connect your social media profiles to increase brand visibility and engagement.</p>
                </div>
                <a href="settings.php" class="btn btn-secondary" style="padding: 8px 20px; border-radius: 8px; font-weight: 600; background: #F1F5F9; color: #1E293B; text-decoration: none; border: none;">
                    <i class="fas fa-arrow-left"></i> Back to Settings
                </a>
            </div>

            <?php if ($success_message): ?>
                <div class="alert alert-success" style="margin-top: 15px; border-radius: 8px;">
                    <i class="fas fa-check-circle"></i> <?php echo $success_message; ?>
                </div>
                <script>
                    setTimeout(function() {
                        showToast('<?php echo $success_message; ?>', 'success');
                    }, 500);
                </script>
            <?php endif; ?>

            <form method="POST" action="" onsubmit="return saveSocialLinks();">
                <div style="background: #FFFFFF; border-radius: 12px; border: 1px solid #DBEAFE; padding: 30px; margin-top: 20px;">
                    
                    <!-- Enable Social Links Toggle -->
                    <div class="toggle-group" style="display: flex; align-items: center; gap: 12px; padding: 12px 16px; background: #F8FAFC; border-radius: 10px; margin-bottom: 20px;">
                        <label class="toggle-switch" style="position: relative; width: 48px; height: 26px; flex-shrink: 0; cursor: pointer;">
                            <input type="checkbox" name="enable_social" value="1" checked 
                                   style="opacity: 0; width: 0; height: 0; position: absolute;" 
                                   onchange="toggleSocialLinks(this)">
                            <span style="position: absolute; cursor: pointer; top: 0; left: 0; right: 0; bottom: 0; background: #2563EB; border-radius: 34px; transition: 0.3s;">
                                <span style="position: absolute; height: 20px; width: 20px; left: 3px; bottom: 3px; background: #FFFFFF; border-radius: 50%; transition: 0.3s; transform: translateX(22px);"></span>
                            </span>
                        </label>
                        <div>
                            <div style="font-size: 14px; color: #1E293B; font-weight: 500;">Enable Social Links</div>
                            <div style="font-size: 12px; color: #94A3B8; margin-top: 2px;">Show social links on store</div>
                        </div>
                        <span id="socialStatus" style="margin-left: auto; font-size: 12px; color: #10B981; font-weight: 500;">Enabled</span>
                    </div>

                    <!-- Social Links Content -->
                    <div id="socialLinksContent">
                        <div class="mb-3">
                            <label class="form-label fw-bold"><i class="fab fa-facebook" style="color: #1877F2;"></i> Facebook</label>
                            <input type="url" class="form-control" name="facebook" value="https://facebook.com/mystore" placeholder="Enter Facebook URL">
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-bold"><i class="fab fa-instagram" style="color: #E4405F;"></i> Instagram</label>
                            <input type="url" class="form-control" name="instagram" value="https://instagram.com/mystore" placeholder="Enter Instagram URL">
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-bold"><i class="fab fa-twitter" style="color: #1DA1F2;"></i> Twitter/X</label>
                            <input type="url" class="form-control" name="twitter" value="https://twitter.com/mystore" placeholder="Enter Twitter URL">
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-bold"><i class="fab fa-youtube" style="color: #FF0000;"></i> YouTube</label>
                            <input type="url" class="form-control" name="youtube" value="https://youtube.com/mystore" placeholder="Enter YouTube URL">
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-bold"><i class="fab fa-linkedin" style="color: #0A66C2;"></i> LinkedIn</label>
                            <input type="url" class="form-control" name="linkedin" value="https://linkedin.com/mystore" placeholder="Enter LinkedIn URL">
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-bold"><i class="fab fa-whatsapp" style="color: #25D366;"></i> WhatsApp</label>
                            <input type="tel" class="form-control" name="whatsapp" value="+91 9876543210" placeholder="Enter WhatsApp number">
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-bold"><i class="fab fa-telegram" style="color: #0088CC;"></i> Telegram</label>
                            <input type="url" class="form-control" name="telegram" value="https://t.me/mystore" placeholder="Enter Telegram URL">
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-bold"><i class="fab fa-pinterest" style="color: #E60023;"></i> Pinterest</label>
                            <input type="url" class="form-control" name="pinterest" value="https://pinterest.com/mystore" placeholder="Enter Pinterest URL">
                        </div>
                    </div>

                    <!-- Buttons -->
                    <div class="d-flex gap-3 mt-4">
                        <button type="submit" class="btn btn-primary" style="padding: 10px 30px; border-radius: 8px; font-weight: 600; background: #2563EB; color: #FFFFFF; border: none;">
                            <i class="fas fa-save"></i> Save Changes
                        </button>
                        <a href="settings.php" class="btn btn-secondary" style="padding: 10px 30px; border-radius: 8px; font-weight: 600; background: #F1F5F9; color: #1E293B; text-decoration: none; border: none;">
                            Cancel
                        </a>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="../assets/js/script.js"></script>
</body>
</html>