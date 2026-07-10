<!-- Navbar -->
<nav class="navbar navbar-expand-lg bg-white border-bottom fixed-top px-3 px-md-4" style="height:70px;border-color:#DBEAFE;z-index:1030;">
    <div class="container-fluid d-flex align-items-center justify-content-between h-100 p-0 position-relative">
        
        <!-- Left Section -->
        <div class="d-flex align-items-center gap-3">
            <!-- Logo -->
            <h2 class="fs-5 fw-bold text-dark mb-0 d-flex align-items-center gap-2">
                <svg class="icon" style="width:22px;height:22px;color:#2563EB;fill:none;stroke:currentColor;stroke-width:2;stroke-linecap:round;stroke-linejoin:round;flex-shrink:0;">
                    <use href="assets/icons/icons.svg#icon-store"/>
                </svg>
                <span>Admin Panel</span>
            </h2>
            
            <!-- Hamburger Menu Button -->
            <button class="btn btn-light border-0 p-2 d-flex align-items-center justify-content-center" 
                    id="menuToggle" 
                    aria-label="Toggle navigation" 
                    style="width:38px;height:38px;color:#1E293B;font-size:22px;cursor:pointer;border-radius:8px;transition:all 0.3s;background:transparent;"
                    onmouseover="this.style.background='#F1F5F9'" 
                    onmouseout="this.style.background='transparent'">
                <i class="fas fa-bars"></i>
            </button>
        </div>
        
        <!-- Center Section -->
        <div class="d-none d-md-block flex-grow-1 mx-3" style="max-width:450px;"></div>
        
        <!-- Right Section -->
        <div class="d-flex align-items-center gap-2 gap-md-3">
            <!-- Notification -->
            <div class="position-relative" style="cursor:pointer;">
                <svg class="icon" style="width:22px;height:22px;color:#2563EB;fill:none;stroke:currentColor;stroke-width:2;stroke-linecap:round;stroke-linejoin:round;flex-shrink:0;">
                    <use href="assets/icons/icons.svg#icon-bell"/>
                </svg>
                <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger" 
                      style="font-size:10px;padding:2px 7px;margin-top:-6px;margin-left:-6px;">5</span>
            </div>
            
            <!-- Admin Profile -->
            <div class="admin-profile d-flex align-items-center gap-2" style="cursor:pointer;position:relative;">
                <img src="assets/images/admin.jpg" alt="Admin" class="rounded-circle border" 
                     style="width:36px;height:36px;border-color:#DBEAFE;object-fit:cover;">
                <span class="fw-semibold text-dark d-none d-sm-inline" style="font-size:14px;">Jennifer</span>
                <svg class="icon" style="width:14px;height:14px;color:#94A3B8;fill:none;stroke:currentColor;stroke-width:2;stroke-linecap:round;stroke-linejoin:round;flex-shrink:0;">
                    <use href="assets/icons/icons.svg#icon-chevron-down"/>
                </svg>
                
                <!-- Profile Dropdown -->
                <div class="profile-dropdown position-absolute top-100 end-0 mt-2 bg-white border rounded-3 shadow-lg" 
                     id="profileDropdown" 
                     style="display:none;min-width:220px;z-index:1050;padding:8px 0;border-color:#DBEAFE;">
                    <div class="d-flex align-items-center gap-3 px-4 py-3 border-bottom">
                        <img src="assets/images/admin.jpg" alt="Admin" class="rounded-circle border" 
                             style="width:44px;height:44px;border-color:#DBEAFE;object-fit:cover;">
                        <div>
                            <h4 class="fw-bold text-dark mb-0" style="font-size:14px;">Jennifer</h4>
                            <span class="text-secondary" style="font-size:12px;">Admin</span>
                        </div>
                    </div>
                    <a href="#" onclick="openProfileModal(event)" 
                       class="d-flex align-items-center gap-3 px-4 py-2 text-decoration-none text-dark" 
                       style="transition:0.2s;"
                       onmouseover="this.style.background='#F8FAFC'" 
                       onmouseout="this.style.background='transparent'">
                        <svg class="icon" style="width:18px;height:18px;color:#64748B;fill:none;stroke:currentColor;stroke-width:2;stroke-linecap:round;stroke-linejoin:round;flex-shrink:0;">
                            <use href="assets/icons/icons.svg#icon-user"/>
                        </svg>
                        <span style="font-size:14px;">My Profile</span>
                    </a>
                    <div class="dropdown-divider my-1" style="border-color:#F1F5F9;"></div>
                    <a href="#" onclick="openLogoutModal(event)" 
                       class="d-flex align-items-center gap-3 px-4 py-2 text-decoration-none text-danger" 
                       style="transition:0.2s;"
                       onmouseover="this.style.background='#F8FAFC'" 
                       onmouseout="this.style.background='transparent'">
                        <svg class="icon" style="width:18px;height:18px;color:currentColor;fill:none;stroke:currentColor;stroke-width:2;stroke-linecap:round;stroke-linejoin:round;flex-shrink:0;">
                            <use href="assets/icons/icons.svg#icon-logout"/>
                        </svg>
                        <span style="font-size:14px;">Logout</span>
                    </a>
                </div>
            </div>
        </div>
    </div>
</nav>

<!-- Profile Modal -->
<div class="modal fade" id="profileModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-sm modal-dialog-centered">
        <div class="modal-content" style="border-radius:16px;border:none;box-shadow:0 20px 60px rgba(0,0,0,0.15);max-width:320px;">
            <div class="modal-body text-center" style="padding:25px 20px 20px;position:relative;">
                <button type="button" class="btn-close position-absolute top-0 end-0 m-3" data-bs-dismiss="modal"></button>
                <div class="profile-avatar d-inline-block mb-2 position-relative">
                    <img src="assets/images/admin.jpg" alt="Admin" style="width:70px;height:70px;border-radius:50%;object-fit:cover;border:3px solid #DBEAFE;">
                    <div class="profile-status online position-absolute bottom-0 end-0" style="width:14px;height:14px;border-radius:50%;border:2px solid #FFFFFF;background:#10B981;"></div>
                </div>
                <h5 class="fw-bold text-dark mb-1" style="font-size:18px;">Jennifer</h5>
                <p class="text-secondary" style="font-size:13px;margin-bottom:12px;">Administrator</p>
                <div class="text-start bg-light rounded-3 p-3 mb-3" style="background:#F8FAFC;">
                    <div class="d-flex align-items-center gap-2 py-1" style="font-size:13px;color:#1E293B;">
                        <i class="fas fa-envelope text-primary" style="width:16px;"></i>
                        <span>jennifer@admin.com</span>
                    </div>
                    <div class="d-flex align-items-center gap-2 py-1" style="font-size:13px;color:#1E293B;">
                        <i class="fas fa-calendar-alt text-primary" style="width:16px;"></i>
                        <span>Joined: Jan 2025</span>
                    </div>
                </div>
                <button class="btn btn-primary btn-sm w-100" onclick="editProfile()" style="padding:6px 20px;border-radius:8px;font-weight:600;background:#2563EB;color:#FFFFFF;border:none;">
                    <i class="fas fa-edit"></i> Edit Profile
                </button>
            </div>
        </div>
    </div>
</div>

<!-- ============================================================ -->
<!-- LOGOUT CONFIRMATION MODAL                                    -->
<!-- ============================================================ -->
<div class="modal fade" id="logoutModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-sm modal-dialog-centered">
        <div class="modal-content" style="border-radius: 16px; border: none; box-shadow: 0 20px 60px rgba(0,0,0,0.15);">
            <div class="modal-body text-center" style="padding: 30px 25px 20px;">
                <div style="font-size: 60px; margin-bottom: 15px;">🚪</div>
                <h5 style="font-weight: 700; color: #1E293B; margin-bottom: 8px;">Logout Confirmation</h5>
                <p style="color: #64748B; font-size: 14px; margin-bottom: 20px;">Are you sure you want to logout from your account?</p>
                
                <div class="d-flex gap-2 justify-content-center">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" style="padding: 8px 25px; border-radius: 8px; font-weight: 600; background: #F1F5F9; color: #1E293B; border: none;">
                        Cancel
                    </button>
                    <button type="button" class="btn btn-danger" onclick="confirmLogout()" style="padding: 8px 25px; border-radius: 8px; font-weight: 600; background: #EF4444; border: none;">
                        <i class="fas fa-sign-out-alt"></i> Logout
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Sidebar Overlay -->
<div class="sidebar-overlay" id="sidebarOverlay"></div>

<!-- JavaScript -->
<script>
// ============================================================
// PROFILE DROPDOWN TOGGLE
// ============================================================

document.addEventListener('DOMContentLoaded', function() {
    // Profile Dropdown
    const adminProfile = document.querySelector('.admin-profile');
    const profileDropdown = document.getElementById('profileDropdown');
    
    if (adminProfile && profileDropdown) {
        adminProfile.addEventListener('click', function(e) {
            e.stopPropagation();
            if (profileDropdown.style.display === 'block') {
                profileDropdown.style.display = 'none';
            } else {
                profileDropdown.style.display = 'block';
            }
        });
    }
    
    // Close dropdown when clicking outside
    document.addEventListener('click', function(e) {
        const dropdown = document.getElementById('profileDropdown');
        const profile = document.querySelector('.admin-profile');
        if (dropdown && profile && !dropdown.contains(e.target) && !profile.contains(e.target)) {
            dropdown.style.display = 'none';
        }
    });
    
    // ============================================================
    // SIDEBAR TOGGLE - HAMBURGER MENU - FIXED FOR ALL DEVICES
    // ============================================================
    
    const menuToggle = document.getElementById('menuToggle');
    const sidebar = document.querySelector('.sidebar-custom');
    const overlay = document.getElementById('sidebarOverlay');
    
    // Debug - log elements
    console.log('Menu Toggle:', menuToggle);
    console.log('Sidebar:', sidebar);
    console.log('Overlay:', overlay);
    
    if (menuToggle && sidebar) {
        // Toggle sidebar on hamburger click
        menuToggle.addEventListener('click', function(e) {
            e.preventDefault();
            e.stopPropagation();
            sidebar.classList.toggle('open');
            if (overlay) {
                overlay.classList.toggle('active');
            }
            console.log('Sidebar toggled. ClassList:', sidebar.classList);
        });
        
        // Also try touch event for mobile
        menuToggle.addEventListener('touchstart', function(e) {
            e.preventDefault();
            e.stopPropagation();
            sidebar.classList.toggle('open');
            if (overlay) {
                overlay.classList.toggle('active');
            }
        });
    }
    
    // Close sidebar when clicking overlay
    if (overlay) {
        overlay.addEventListener('click', function() {
            sidebar.classList.remove('open');
            overlay.classList.remove('active');
        });
    }
    
    // Close sidebar when clicking outside (mobile)
    document.addEventListener('click', function(e) {
        if (window.innerWidth <= 767) {
            if (sidebar && menuToggle && 
                !sidebar.contains(e.target) && 
                !menuToggle.contains(e.target)) {
                sidebar.classList.remove('open');
                if (overlay) {
                    overlay.classList.remove('active');
                }
            }
        }
    });
    
    // Close sidebar on window resize to desktop
    window.addEventListener('resize', function() {
        if (window.innerWidth > 767 && sidebar) {
            sidebar.classList.remove('open');
            if (overlay) {
                overlay.classList.remove('active');
            }
        }
    });
});

// ============================================================
// OTHER FUNCTIONS
// ============================================================

function openProfileModal(e) {
    if (e) e.preventDefault();
    const dropdown = document.getElementById('profileDropdown');
    if (dropdown) dropdown.style.display = 'none';
    const modal = new bootstrap.Modal(document.getElementById('profileModal'));
    modal.show();
}

function editProfile() {
    if (typeof showToast === 'function') {
        showToast('Edit profile form will open here!', 'info');
    } else {
        alert('Edit profile clicked!');
    }
    bootstrap.Modal.getInstance(document.getElementById('profileModal')).hide();
}

function openLogoutModal(e) {
    if (e) e.preventDefault();
    const dropdown = document.getElementById('profileDropdown');
    if (dropdown) dropdown.style.display = 'none';
    const modal = new bootstrap.Modal(document.getElementById('logoutModal'));
    modal.show();
}

function confirmLogout() {
    const btn = document.querySelector('#logoutModal .btn-danger');
    if (btn) {
        btn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Logging out...';
        btn.disabled = true;
        setTimeout(function() {
            const modal = bootstrap.Modal.getInstance(document.getElementById('logoutModal'));
            if (modal) modal.hide();
            window.location.href = 'index.php';
        }, 800);
    } else {
        window.location.href = 'index.php';
    }
}

function closeSidebar() {
    const sidebar = document.querySelector('.sidebar-custom');
    const overlay = document.getElementById('sidebarOverlay');
    if (sidebar) {
        sidebar.classList.remove('open');
    }
    if (overlay) {
        overlay.classList.remove('active');
    }
}
</script>