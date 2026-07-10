<div class="navbar-custom">
    <div class="nav-left">
       
        
        <!-- Hamburger Menu Button -->
        <button class="menu-toggle" id="menuToggle" aria-label="Toggle navigation">
            <i class="fas fa-bars"></i>
        </button>
        
        <!-- Logo -->
        <h2>
            <svg class="icon"><use href="assets/icons/icons.svg#icon-store"/></svg>
            Admin Panel
        </h2>
    </div>
    
    <div class="nav-center">
        <!-- Search or other center content -->
    </div>
    
    <div class="nav-right">
        <div class="notification">
            <svg class="icon"><use href="assets/icons/icons.svg#icon-bell"/></svg>
            <span class="badge">5</span>
        </div>
        <div class="admin-profile" onclick="toggleProfileDropdown(event)">
            <img src="assets/images/admin.jpg" alt="Admin">
            <span>Jennifer</span>
            <svg class="icon"><use href="assets/icons/icons.svg#icon-chevron-down"/></svg>
        </div>
        <!-- Profile Dropdown -->
        <div class="profile-dropdown" id="profileDropdown">
            <div class="dropdown-header">
                <img src="assets/images/admin.jpg" alt="Admin">
                <div>
                    <h4>Jennifer</h4>
                    <span>Admin</span>
                </div>
            </div>
            <div class="dropdown-divider"></div>
            <a href="#" onclick="openProfileModal(event)">
                <svg class="icon"><use href="assets/icons/icons.svg#icon-user"/></svg>
                <span>My Profile</span>
            </a>
            <div class="dropdown-divider"></div>
            <a href="#" onclick="openLogoutModal(event)" class="logout-link">
                <svg class="icon"><use href="assets/icons/icons.svg#icon-logout"/></svg>
                <span>Logout</span>
            </a>
        </div>
    </div>
</div>

<!-- Profile Modal -->
<div class="modal fade" id="profileModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-sm modal-dialog-centered">
        <div class="modal-content" style="border-radius: 16px; border: none; box-shadow: 0 20px 60px rgba(0,0,0,0.15); max-width: 320px;">
            <div class="modal-body text-center" style="padding: 25px 20px 20px;">
                <button type="button" class="btn-close" data-bs-dismiss="modal" style="position: absolute; right: 12px; top: 12px;"></button>
                <div class="profile-avatar" style="display: inline-block; margin-bottom: 8px; position: relative;">
                    <img src="assets/images/admin.jpg" alt="Admin" style="width: 70px; height: 70px; border-radius: 50%; object-fit: cover; border: 3px solid #DBEAFE;">
                    <div class="profile-status online" style="position: absolute; bottom: 2px; right: 2px; width: 14px; height: 14px; border-radius: 50%; border: 2px solid #FFFFFF; background: #10B981;"></div>
                </div>
                <h5 style="font-weight: 700; color: #1E293B; margin-bottom: 2px;">Jennifer</h5>
                <p style="color: #64748B; font-size: 13px; margin-bottom: 12px;">Administrator</p>
                <div style="text-align: left; background: #F8FAFC; border-radius: 8px; padding: 12px 15px; margin-bottom: 12px;">
                    <div style="display: flex; align-items: center; gap: 10px; padding: 4px 0; font-size: 13px; color: #1E293B;">
                        <i class="fas fa-envelope" style="width: 16px; color: #2563EB;"></i>
                        <span>jennifer@admin.com</span>
                    </div>
                    <div style="display: flex; align-items: center; gap: 10px; padding: 4px 0; font-size: 13px; color: #1E293B;">
                        <i class="fas fa-calendar-alt" style="width: 16px; color: #2563EB;"></i>
                        <span>Joined: Jan 2025</span>
                    </div>
                </div>
                <button class="btn btn-primary btn-sm" onclick="editProfile()" style="padding: 6px 20px; border-radius: 8px; font-weight: 600; background: #2563EB; color: #FFFFFF; border: none; width: 100%;">
                    <i class="fas fa-edit"></i> Edit Profile
                </button>
            </div>
        </div>
    </div>
</div>