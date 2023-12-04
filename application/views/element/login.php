<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.20/dist/sweetalert2.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <style>
        body{
            background-image: url("assets/img/bg_login.png");
            background-color: rgba(0, 0, 0, 0.1);
        }
        .login {
            background-color: white;
            height: 80vh;
            border-radius: 20px;
        }
        .login-form{
            padding-top: 80px;
            background-color: rgb(193, 250, 228);
            border-radius: 20px;
        }
        @media only screen and (max-width: 600px) {
        .login {
        background-color: white;
        height: 100vh;
        }
        .login-form{
            padding-top: 10px;
        }
        .container{
            width: 80%;
        }
        }
    </style>
</head>

<body >
    <div class="container mt-5" >
        <div class="row login " >
            <div class="col-md-6">
                <div class="row">
                    <div class="col-md-12">
                        <img class="mt-3" src="<?= base_url('assets/'); ?>img/logo/logo_2.png" alt="" width="50px">
                        <img class="mt-3" src="<?= base_url('assets/'); ?>img/logo/s.png" alt="" width="50px" style="margin-left: 10px;">
                    </div>
                    <div class="col-md-12 mt-4">
                        <img class="mt-3" src="<?= base_url('assets/'); ?>img/logo/login.jpg" alt="" width="100%" >
                    </div>
                </div>
            </div>
            <div class="col-md-6  login-form">
                <form method="post" action="<?= base_url('login/masuk_login') ?>">
                    <h1 class="text-center mt-2"> Service Monitoring</h1>
                    <h5 class="text-center mt-2" style="font-size: 15px;"> Selamat Datang di Halaman Login</h5>
                    <h1 class="text-center" style="font-size: 12px;">Login to Continue</h1>
                    <div class="container" style="width: 80%;">
                        <div class="row">
                        <div class="col-md-12 mt-3">
                            <input type="text" class="form-control" name="username" aria-describedby="emailHelp" placeholder="username">
                        </div>
                        <div class="col-md-12 mt-3 mb-4">
                            <div class="input-group">
                                <input type="password" name="password" class="form-control" placeholder="password" id="password-input">
                                <div class="input-group-append">
                                    <span class="input-group-text" id="toggle-password">
                                        <i class="fa fa-eye" id="eye-icon"></i>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <button type="submit" class="btn  mb-5" style="width: 100px; color: aliceblue; background-color: rgb(67, 148, 255);">Login</button>
                            <?php echo $this->session->flashdata('pesan'); ?>
                        </div>

                            
                        </div>
                    </div>
                </form>
            </div>
        </div>
        
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4"
        crossorigin="anonymous"></script>
        
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.20/dist/sweetalert2.min.js"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script>
    const passwordInput = document.getElementById('password-input');
    const togglePassword = document.getElementById('toggle-password');
    const eyeIcon = document.getElementById('eye-icon');

    togglePassword.addEventListener('click', function () {
        if (passwordInput.type === 'password') {
            passwordInput.type = 'text';
            eyeIcon.classList.remove('fa-eye');
            eyeIcon.classList.add('fa-eye-slash');
        } else {
            passwordInput.type = 'password';
            eyeIcon.classList.remove('fa-eye-slash');
            eyeIcon.classList.add('fa-eye');
        }
    });
</script>

</body>

</html>