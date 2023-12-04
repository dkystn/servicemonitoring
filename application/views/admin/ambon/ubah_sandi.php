<style>
    .bg-center{
    display: flex;
    justify-content: center;
    }
</style>
<!-- Login Content -->
<div class="container-login ">
    <div class="row ">
        <div class="col-lg-12 ">
            <div class="text-center">
                <h1 class="h4 text-gray-900 mb-4">Edit Profil Saya</h1>
            </div>
            <form class="user" action="<?php echo site_url('element/change_password'); ?>" method="post">
                <div class="form-group">
                    <label for="password">Password</label>
                    <div class="input-group">
                        <input type="password" class="form-control" id="password" name="password" value="<?php echo set_value('password'); ?>">
                        <div class="input-group-append">
                            <span class="input-group-text" id="togglePassword">
                                <i class="fa fa-eye" aria-hidden="true"></i>
                            </span>
                        </div>
                    </div>
                    <?php echo form_error('password'); ?>
                </div>
                <div class="form-group">
                    <label for="confirm_password">Confirm Password</label>
                    <div class="input-group">
                        <input type="password" class="form-control" id="confirm_password" name="confirm_password" value="<?php echo set_value('confirm_password'); ?>">
                        <div class="input-group-append">
                            <span class="input-group-text" id="toggleConfirmPassword">
                                <i class="fa fa-eye" aria-hidden="true"></i>
                            </span>
                        </div>
                    </div>
                    <div id="passwordMismatch" class="text-danger"></div>
                    <?php echo form_error('confirm_password'); ?>
                </div>
                <div class="form-group">
                    <button type="submit" value="Submit" class="btn btn-primary btn-block" id="submitButton" disabled>Ubah Password</button>
                </div>
            </form>

            <script>
            document.addEventListener("DOMContentLoaded", function () {
                const togglePassword = document.getElementById("togglePassword");
                const toggleConfirmPassword = document.getElementById("toggleConfirmPassword");
                const passwordInput = document.getElementById("password");
                const confirmPasswordInput = document.getElementById("confirm_password");
                const passwordMismatch = document.getElementById("passwordMismatch");
                const submitButton = document.getElementById("submitButton");

                togglePassword.addEventListener("click", togglePasswordVisibility);
                toggleConfirmPassword.addEventListener("click", toggleConfirmPasswordVisibility);
                passwordInput.addEventListener("input", validatePasswords);
                confirmPasswordInput.addEventListener("input", validatePasswords);

                function togglePasswordVisibility() {
                    toggleVisibility(passwordInput);
                }

                function toggleConfirmPasswordVisibility() {
                    toggleVisibility(confirmPasswordInput);
                }

                function toggleVisibility(inputElement) {
                    if (inputElement.type === "password") {
                        inputElement.type = "text";
                    } else {
                        inputElement.type = "password";
                    }
                }

                function validatePasswords() {
                    const passwordValue = passwordInput.value;
                    const confirmPasswordValue = confirmPasswordInput.value;

                    if (passwordValue !== confirmPasswordValue) {
                        passwordMismatch.textContent = "Pastikan Password dan Confirm  Password Sama !";
                        submitButton.disabled = true;
                    } else {
                        passwordMismatch.textContent = "";
                        submitButton.disabled = false;
                    }
                }
            });
            </script>
        </div>
    </div>
</div>

<!-- Login Content -->