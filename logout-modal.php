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