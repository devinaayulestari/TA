<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Login</title>
    <link rel="stylesheet" href="<?= base_url('assets/css/main/app.css') ?>" />
    <link rel="stylesheet" href="<?= base_url('assets/css/pages/auth.css') ?>" />

    <link rel="shortcut icon" href="<?= base_url('assets/images/logo/favicon.svg') ?>" type="image/x-icon" />
    <link rel="shortcut icon" href="<?= base_url('assets/images/logo/favicon.png') ?>" type="image/png" />
</head>

<body>
    <div id="auth">
        <div class="row h-100">
            <div class="col-lg-5 col-12">
                <div id="auth-left">
                    <h1 class="auth-title">Silahkan Login</h1>
                    
                    <?php if ($this->session->flashdata('gagal')) : ?>
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <?= $this->session->flashdata('gagal'); ?>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    <?php endif; ?>
                    <?php if ($this->session->flashdata('succes')) : ?>
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <?= $this->session->flashdata('succes'); ?>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    <?php endif; ?>
                    <form action="<?= base_url('auth/isResetPass') ?>" method="POST">
                        
                        <div class="form-group position-relative has-icon-left mb-4">
                            <input type="text"class="form-control form-control-xl" placeholder="Email@gmail.com" name="email" />
                            <div class="form-control-icon">
                                <i class="bi bi-person"></i>
                            </div>
                        </div>
                        <button class="btn btn-primary btn-block btn-lg shadow-lg mt-5" type="submit">
                            Reset
                        </button>
                        <div class="text-center mt-3 text-lg fs-3">
                            <p class="text-gray-600">Sudah memiliki akun? Silahkan Login<a href="<?= base_url('Auth/login') ?>" class="font-bold"> di sini</a></p>
                        </div>
                       
                    </form>
                </div>
            </div>
            <div class="col-lg-7 d-none d-lg-block">
                <div id="auth-right">
                    <img src="<?= base_url('assets/images/coverasli.JPG') ?>" alt=""  width="105%" height="100%">
                </div>
            </div>
        </div>
    </div>
</body>

</html>