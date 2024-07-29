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
    
    <script
  src="https://code.jquery.com/jquery-3.7.1.slim.min.js"
  integrity="sha256-kmHvs0B+OpCW5GVHUNjv9rOmY0IvSIRcf7zGUDTDQM8="
  crossorigin="anonymous"></script>
</head>

<body>
    <div id="auth">
        <div class="row h-100">
            <div class="col-lg-5 col-12">
                <div id="auth-left">
                    <h1 class="auth-title">Masukkan Kode Verifikasi Email</h1>
                    
                    <?php if ($this->session->flashdata('gagal')) : ?>
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <?= $this->session->flashdata('gagal'); ?>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    <?php endif; ?>
                    <form action="<?= $email ? base_url('Auth/is_verif')."\" method='GET'" : base_url('Auth/verif') ."\" method='GET'"?>" id="form_verif">
                        
                        <div class="form-group position-relative has-icon-left mb-4">
                            <input type="text"class="form-control form-control-xl" placeholder="Masukkan Email"  name="email" value="<?=$email?>" <?= $email? "readonly" : ""?> id="inputEmail"/>
                            <div class="form-control-icon">
                                <i class="bi bi-person"></i>
                            </div>
                        </div>
                        <?php if($email):?>
                        <div class="form-group position-relative has-icon-left mb-4">
                            <input type="text" class="form-control form-control-xl" placeholder="masukkan kode verifikasi" name="kode" />
                            <div class="form-control-icon">
                                <i class="bi bi-person"></i>
                            </div>
                        </div>
                        <?php endif ?>
                        <button class="btn btn-primary btn-block btn-lg shadow-lg mt-5" type="submit">
                        <?= $email? "Verifikasi" : " Kirim Kode"?>
                        </button>
                        <div class="text-center mt-3 text-lg fs-3">
                            <p class="text-gray-600">Tidak menerima link aktivasi di email? klik <a onclick="location.reload()" class="font-bold"> di sini</a></p>
                        </div>
                       
                    </form>
                </div>
            </div>
            <div class="col-lg-7 d-none d-lg-block">
                <div id="auth-right">
                    <img src="" alt="">
                </div>
            </div>
        </div>
    </div>
    <script>
        // $('input[name=Email]').on( "keydown",function(){
        //     const url ="<?=base_url('auth/verif/')?>"+encodeURI($("#inputEmail").val());
        //     console.log(url);
        //     $('#form_verif').attr('action', url);
        // });
    </script>
</body>

</html>