$(document).ready(function () {
    // Get base URL dynamically
    var baseUrl = window.location.origin + '/e-commerce-adminpanel';

    // Registration button click
    $(".register").on("click", function (event) {
        event.preventDefault();

        // Cancel any speech synthesis
        window.speechSynthesis.cancel();

        // Create FormData
        let formData = new FormData(document.getElementById("registerForm"));
        formData.append("step", "register");

        // Get button
        let btn = $(this);
        let originalText = btn.html();

        // Disable button and show loading
        btn.attr("disabled", true);
        btn.html('<span class="spinner-border spinner-border-sm me-2"></span>Loading...');

        // AJAX Request
        $.ajax({
            url: baseUrl + "/ajax/register.php",
            type: "POST",
            contentType: false,
            processData: false,
            data: formData,
            dataType: "json",
            success: function (response) {
                // Speech synthesis for message
                var msg = new SpeechSynthesisUtterance(response.message);
                window.speechSynthesis.speak(msg);

                if (response.success) {
                    // Show success message
                    toastr.success(response.message);

                    // Reset form
                    $("#registerForm")[0].reset();
                    $(".form-control").removeClass("is-valid is-invalid");

                    // Redirect after delay
                    setTimeout(function () {
                        window.location.href = response.redirectUrl || baseUrl + "/auth/login.php";
                    }, 2000);
                } else {
                    // Show error message
                    toastr.error(response.message);

                    // Show field-specific errors
                    if (response.errors) {
                        $.each(response.errors, function (field, error) {
                            let input = $("#" + field);
                            if (input.length) {
                                input.addClass("is-invalid");
                                let feedback = input.siblings(".invalid-feedback");
                                if (feedback.length) {
                                    feedback.text(error);
                                }
                            }
                        });
                    }

                    // Enable button
                    btn.attr("disabled", false);
                    btn.html(originalText);
                }
            },
            error: function (xhr, status, error) {
                // Handle error
                let errorMsg = "Something went wrong. Please try again.";
                if (xhr.responseText) {
                    try {
                        let response = JSON.parse(xhr.responseText);
                        if (response.message) {
                            errorMsg = response.message;
                        }
                    } catch (e) { }
                }
                toastr.error(errorMsg);
                btn.attr("disabled", false);
                btn.html(originalText);
                console.error("AJAX Error:", error);
                console.error("Status:", status);
                console.error("Response:", xhr.responseText);
            }
        });
    });

    // Real-time validation on input
    $(".form-control").on("input", function () {
        $(this).removeClass("is-invalid");
        $(this).siblings(".invalid-feedback").text("");
    });

    // Password strength checker
    $("#password").on("keyup", function () {
        let password = $(this).val();
        let strength = 0;

        if (password.length >= 6) strength++;
        if (password.match(/[A-Z]/)) strength++;
        if (password.match(/[a-z]/)) strength++;
        if (password.match(/[0-9]/)) strength++;

        let strengthBar = $("#passwordStrength");
        strengthBar.removeClass("strength-weak strength-medium strength-good strength-strong");

        if (password.length > 0) {
            if (strength <= 1) {
                strengthBar.addClass("strength-weak");
            } else if (strength === 2) {
                strengthBar.addClass("strength-medium");
            } else if (strength === 3) {
                strengthBar.addClass("strength-good");
            } else {
                strengthBar.addClass("strength-strong");
            }
        } else {
            strengthBar.css("width", "0%");
        }

        // Update requirements
        updateRequirement("req-length", password.length >= 6);
        updateRequirement("req-uppercase", password.match(/[A-Z]/));
        updateRequirement("req-lowercase", password.match(/[a-z]/));
        updateRequirement("req-number", password.match(/[0-9]/));
    });

    function updateRequirement(id, isValid) {
        let element = $("#" + id);
        if (isValid) {
            element.removeClass("invalid").addClass("valid");
            element.find("i").removeClass("fa-circle").addClass("fa-check-circle");
        } else {
            element.removeClass("valid").addClass("invalid");
            element.find("i").removeClass("fa-check-circle").addClass("fa-circle");
        }
    }

    // Confirm password validation
    $("#confirm_password").on("keyup", function () {
        let password = $("#password").val();
        let confirm = $(this).val();

        if (confirm && confirm !== password) {
            $(this).addClass("is-invalid");
            $(this).removeClass("is-valid");
            $(this).siblings(".invalid-feedback").text("Passwords do not match");
        } else if (confirm && confirm === password) {
            $(this).removeClass("is-invalid").addClass("is-valid");
            $(this).siblings(".invalid-feedback").text("");
        } else {
            $(this).removeClass("is-invalid is-valid");
            $(this).siblings(".invalid-feedback").text("");
        }
    });

    // Toggle password visibility
    $(".password-toggle").on("click", function () {
        let input = $(this).siblings("input");
        let icon = $(this).find("i");

        if (input.attr("type") === "password") {
            input.attr("type", "text");
            icon.removeClass("fa-eye").addClass("fa-eye-slash");
        } else {
            input.attr("type", "password");
            icon.removeClass("fa-eye-slash").addClass("fa-eye");
        }
    });

    // Mobile number - only numbers
    $("#mobile").on("input", function () {
        $(this).val($(this).val().replace(/[^0-9]/g, ""));
        if ($(this).val().length > 10) {
            $(this).val($(this).val().slice(0, 10));
        }
    });

    // Auto-focus first input
    $("#name").focus();

    // Toastr Configuration
    toastr.options = {
        "closeButton": true,
        "debug": false,
        "newestOnTop": true,
        "progressBar": true,
        "positionClass": "toast-top-right",
        "preventDuplicates": true,
        "onclick": null,
        "showDuration": "300",
        "hideDuration": "1000",
        "timeOut": "5000",
        "extendedTimeOut": "1000",
        "showEasing": "swing",
        "hideEasing": "linear",
        "showMethod": "fadeIn",
        "hideMethod": "fadeOut"
    };
});