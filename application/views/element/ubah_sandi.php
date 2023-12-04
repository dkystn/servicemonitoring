<!-- Login Content -->
<div class="container-login" style="width:500px;">
    <div class="row justify-content-center">
        <div class="col-xl-10 col-lg-12 col-md-9">
            <div class="card shadow-sm my-5">
                <div class="card-body p-0">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="login-form" > 
                                <div class="text-center">
                                    <h1 class="h4 text-gray-900 mb-4">Edit Profil Saya p</h1>
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
        <?php echo form_error('confirm_password'); ?>
    </div>
    <div class="form-group">
        <button type="submit" value="Submit" class="btn btn-primary btn-block">Ubah Password</button>
    </div>
</form>

<script>
document.addEventListener("DOMContentLoaded", function () {
    const togglePassword = document.getElementById("togglePassword");
    const toggleConfirmPassword = document.getElementById("toggleConfirmPassword");
    const passwordInput = document.getElementById("password");
    const confirmPasswordInput = document.getElementById("confirm_password");

    togglePassword.addEventListener("click", function () {
        if (passwordInput.type === "password") {
            passwordInput.type = "text";
            togglePassword.innerHTML = '<i class="fa fa-eye-slash" aria-hidden="true"></i>';
        } else {
            passwordInput.type = "password";
            togglePassword.innerHTML = '<i class="fa fa-eye" aria-hidden="true"></i>';
        }
    });

    toggleConfirmPassword.addEventListener("click", function () {
        if (confirmPasswordInput.type === "password") {
            confirmPasswordInput.type = "text";
            toggleConfirmPassword.innerHTML = '<i class="fa fa-eye-slash" aria-hidden="true"></i>';
        } else {
            confirmPasswordInput.type = "password";
            toggleConfirmPassword.innerHTML = '<i class="fa fa-eye" aria-hidden="true"></i>';
        }
    });
});
</script>

                                
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Login Content -->