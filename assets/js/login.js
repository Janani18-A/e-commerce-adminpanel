$(document).ready(function () {
    // Use the global APP_URL variable
    var baseUrl = typeof APP_URL !== 'undefined' ? APP_URL : window.location.origin + '/e-commerce-adminpanel';

    console.log("APP_URL:", baseUrl); // Debug: Check if APP_URL is set

    // Toastr Configuration
    toastr.options = {
        "closeButton": true,
        "debug": false,
        "newestOnTop": true,
        "progressBar": true,
        "positionClass": "toast-top-right",
        "preventDuplicates": true,
        "showDuration": "300",
        "hideDuration": "1000",
        "timeOut": "5000",
        "extendedTimeOut": "1000",
        "showEasing": "swing",
        "hideEasing": "linear",
        "showMethod": "fadeIn",
        "hideMethod": "fadeOut"
    };

    // Password Toggle
    $("#togglePassword").on("click", function () {
        let input = $("#password");
        let icon = $(this).find("i");

        if (input.attr("type") === "password") {
            input.attr("type", "text");
            icon.removeClass("fa-eye").addClass("fa-eye-slash");
        } else {
            input.attr("type", "password");
            icon.removeClass("fa-eye-slash").addClass("fa-eye");
        }
    });

    // Real-time validation on input
    $(".form-control").on("input", function () {
        $(this).removeClass("is-invalid is-valid");
        $(this).siblings(".invalid-feedback").text("");
    });

    // Validate field on blur
    $("#username").on("blur", function () {
        validateField($(this));
    });

    $("#password").on("blur", function () {
        validateField($(this));
    });

    // Field validation function
    function validateField(input) {
        let id = input.attr("id");
        let value = input.val().trim();
        let isValid = true;
        let errorMessage = "";

        if (id === "username") {
            if (!value) {
                isValid = false;
                errorMessage = "Username is required";
            } else if (value.length < 3) {
                isValid = false;
                errorMessage = "Username must be at least 3 characters";
            }
        }

        if (id === "password") {
            if (!value) {
                isValid = false;
                errorMessage = "Password is required";
            } else if (value.length < 6) {
                isValid = false;
                errorMessage = "Password must be at least 6 characters";
            }
        }

        if (!isValid && value) {
            input.addClass("is-invalid");
            input.removeClass("is-valid");
            input.siblings(".invalid-feedback").text(errorMessage);
        } else if (isValid && value) {
            input.removeClass("is-invalid");
            input.addClass("is-valid");
            input.siblings(".invalid-feedback").text("");
        } else {
            input.removeClass("is-invalid is-valid");
            input.siblings(".invalid-feedback").text("");
        }

        return isValid;
    }

    // Login form submit
    $("#loginForm").on("submit", function (event) {
        event.preventDefault();

        // Cancel any speech synthesis
        window.speechSynthesis.cancel();

        // Validate all fields
        let isValid = true;
        let fields = ["#username", "#password"];

        $.each(fields, function (index, selector) {
            let input = $(selector);
            if (!validateField(input)) {
                isValid = false;
            }
        });

        if (!isValid) {
            toastr.warning("Please fix all errors before submitting");
            return;
        }

        // Get form data
        let formData = new FormData(this);
        formData.append("step", "login");

        // Get button
        let btn = $("#loginBtn");
        let originalText = btn.html();

        // Disable button and show loading
        btn.attr("disabled", true);
        btn.html('<span class="spinner-border spinner-border-sm me-2"></span>Loading...');

        // AJAX Request - Use baseUrl
        $.ajax({
            url: baseUrl + "/ajax/login.php",
            type: "POST",
            contentType: false,
            processData: false,
            data: formData,
            dataType: "json",
            success: function (response) {
                console.log("Response:", response); // Debug: Check response

                // Speech synthesis for message
                var msg = new SpeechSynthesisUtterance(response.message);
                window.speechSynthesis.speak(msg);

                if (response.success) {
                    // Show success message
                    toastr.success(response.message);

                    // Redirect after delay
                    setTimeout(function () {
                        window.location.href = response.redirectUrl || baseUrl + "/index.php";
                    }, 1500);
                } else {
                    // Show error message
                    toastr.error(response.message);

                    // Show field-specific errors
                    if (response.errors) {
                        $.each(response.errors, function (field, error) {
                            let input = $("#" + field);
                            if (input.length) {
                                input.addClass("is-invalid");
                                input.siblings(".invalid-feedback").text(error);
                            }
                        });
                    }

                    // Enable button
                    btn.attr("disabled", false);
                    btn.html(originalText);
                }
            },
            error: function (xhr, status, error) {
                console.log("XHR:", xhr); // Debug: Check XHR response
                console.log("Status:", status);
                console.log("Error:", error);
                console.log("Response Text:", xhr.responseText);

                let errorMsg = "Something went wrong. Please try again.";

                try {
                    let response = JSON.parse(xhr.responseText);
                    if (response.message) {
                        errorMsg = response.message;
                    }
                } catch (e) {
                    console.log("Could not parse JSON response");
                }

                toastr.error(errorMsg);
                btn.attr("disabled", false);
                btn.html(originalText);
            }
        });
    });

    // Auto focus username
    $("#username").focus();
});