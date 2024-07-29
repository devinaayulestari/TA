<div class="page-heading">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Data User</h3>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="index.html">User</a>
                        </li> 
                        <li class="breadcrumb-item active" aria-current="page">
                            Data User
                        </li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    <section class="section">
        <?php if ($this->session->flashdata('berhasil')) : ?>
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <?= $this->session->flashdata('berhasil'); ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php endif; ?>
        <div class="card">
            <div class="card-header">
                <h5 class="card-title"></h5>
            </div>
            <div class="card-body">
                <ul class="nav nav-tabs  justify-content-center" id="myTab" role="tablist">
                    <li class="nav-item" role="presentation">
                        <a class="nav-link active" id="home-tab" data-bs-toggle="tab" href="#home" role="tab"
                            aria-controls="home" aria-selected="true">data pribadi</a>
                    </li>
                    <li class="nav-item" role="presentation">
                        <a class="nav-link" id="profile-tab" data-bs-toggle="tab" href="#profile" role="tab"
                            aria-controls="profile" aria-selected="false">berkas pendaftaran</a>
                    </li>
                </ul>
                <?php echo form_open_multipart("home/ubah", array('id'=>'form_ubah'));?>
                    <div class="tab-content" id="myTabContent">
                        <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title">Data Pribadi</h4>
                                </div>
                                <div class="card-content">
                                <div class="card-body">
                                    
                                        <div class="form-body">
                                            <div class="row">
                                            <div class="col-12">
                                                    <div class="form-group has-icon-left">
                                                        <label for="first-name-icon">Nama Lembaga</label>
                                                        <div class="position-relative">
                                                            <input type="text"value="<?=$data_user['nama_lembaga']?>" name="nama_lembaga" class="form-control"
                                                                placeholder="Input with icon left" id="nama_lembaga">
                                                            <div class="form-control-icon">
                                                                <i class="bi bi-person"></i>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-12">
                                                    <div class="form-group has-icon-left">
                                                        <label for="first-name-icon">Nama Lengkap PIC</label>
                                                        <div class="position-relative">
                                                            <input type="text" value="<?=$data_user['nama_lengkap']?>"name="nama_lengkap"class="form-control"
                                                                placeholder="Input with icon left" id="nama_lengkap">
                                                            <div class="form-control-icon">
                                                                <i class="bi bi-person"></i>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-12">
                                                    <div class="form-group has-icon-left">
                                                        <label for="email-id-icon">Email</label>
                                                        <div class="position-relative">
                                                            <input type="text" value="<?=$data_user['email']?>" name="email"class="form-control" placeholder="Email"
                                                                id="email-id-icon">
                                                                <input type="hidden" value="<?=$data_user['id']?>" name="id_user"class="form-control" placeholder="Email"
                                                                id="email">
                                                            <div class="form-control-icon">
                                                                <i class="bi bi-envelope"></i>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-12">
                                                    <div class="form-group has-icon-left">
                                                        <label for="mobile-id-icon">Nomor Telepon PIC </label>
                                                        <div class="position-relative">
                                                            <input type="text" value="<?=$data_user['nomer_telepon']?>"name="nomer_telepon"class="form-control" placeholder="Mobile"
                                                                id="nomer_telepon">
                                                            <div class="form-control-icon">
                                                                <i class="bi bi-phone"></i>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-12">
                                                    <div class="form-group has-icon-left">
                                                        <label for="first-name-icon">Type Pengguna</label>
                                                        <div class="position-relative">
                                                            <select class="form-control" name="type_pengguna">
                                                                <option value="OPD">OPD</option>
                                                                <option value="Umum">Umum</option>
                                                            </select>
                                                            <div class="form-control-icon">
                                                                <i class="bi bi-lock"></i>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-12 d-flex justify-content-end">
                                                <a onclick="next()" class="btn btn-primary me-1 mb-1">Next</a>
                                                    <button type="reset"
                                                        class="btn btn-light-secondary me-1 mb-1">Reset</button>
                                                </div>
                                            </div>
                                        </div>
                                    
                                </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title">Melengkapi Syarat Pendaftaran</h4>
                                </div>
                                <div class="card-content">
                                    <div class="card-body">
                                    
                                            <div class="form-body">
                                                <div class="row">
                                                    <div class="col-12">
                                                        <div class="form-group has-icon-left">
                                                            <label for="first-name-icon">Surat Permohonan Dinas</label>
                                                            <div class="position-relative">
                                                                <input type="file" class="form-control"
                                                                    placeholder="Input with icon left" name="surat_permohonan" id="first-name-icon">
                                                                <div class="form-control-icon">
                                                                    <i class="bi bi-person"></i>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-12">

                                                        <div class="form-group has-icon-left">
                                                            <label for="email-id-icon">Kartu Tanda Penduduk</label>
                                                            <div class="position-relative">
                                                                <input type="file" class="form-control" placeholder="Email"
                                                                    id="email-id-icon" name="ktp">
                                                                <div class="form-control-icon">
                                                                    <i class="bi bi-envelope"></i>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-12">
                                                        <div class="form-group has-icon-left">
                                                            <label for="mobile-id-icon">Sk OPD/ Komunitas</label>
                                                            <div class="position-relative">
                                                                <input type="file" class="form-control" placeholder="Mobile"
                                                                    id="mobile-id-icon"name="sk">
                                                                <div class="form-control-icon">
                                                                    <i class="bi bi-phone"></i>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-12">
                                                        <div class="form-group has-icon-left">
                                                            <label for="password-id-icon">Surat Pernyataan PIC</label>
                                                            <div class="position-relative">
                                                                <input type="file" class="form-control" placeholder="Password"
                                                                    id="password-id-icon"name="surat_pernyataan">
                                                                <div class="form-control-icon">
                                                                    <i class="bi bi-lock"></i>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-12 d-flex justify-content-end">
                                                    <a onclick="update()" class="btn btn-primary me-1 mb-1">Update</a>
                                                        <button type="reset"
                                                            class="btn btn-light-secondary me-1 mb-1">Reset</button>
                                                    </div>
                                                </div>
                                            </div>
                                    
                                    </div>
                                </div>
                            </div>
                        </div>
                    
                    </div>
                </form>
            </div>
        </div>
    </section>
    <section id="tolak_form">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Alasan Di tolak</h4>
            </div>
            <div class="card-content">
                <div class="card-body">
                    <form class="form form-vertical" action="<?=base_url('admin/tolak')?>" id="form" method="POST">
                        <div class="form-body">
                            <div class="form-floating">
                                <p><?=$data_user['pesan']?></p>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
</div>
<script>
    function next(){
        let nama_lembaga = document.getElementById ('nama_lembaga')
        let nama_lengkap = document.getElementById('nama_lengkap')
        let email = document.getElementById('email')
        let nomer_telepon = document.getElementById('nome')
        let nama_lengkap = document.getElementById('nama_lengkap')
        Email
        Nomor Telepon PIC
        Type Pengguna
        Surat Permohonan Dinas
        Kartu Tanda Penduduk

        document.getElementById('profile-tab').classList.add("active");
        document.getElementById('profile').classList.add("show");
        document.getElementById('profile').classList.add("active");
        document.getElementById('home-tab').classList.remove("active");
        document.getElementById('home').classList.remove("show");
        document.getElementById('home').classList.remove("active");
        console.log("aaa");
    }
    function update(){
        const swalWithBootstrapButtons = Swal.mixin({
        customClass: {
            confirmButton: "btn btn-success",
            cancelButton: "btn btn-danger"
        },
        buttonsStyling: false
        });
        swalWithBootstrapButtons.fire({
        title: "apakah anda yakin?",
        text: "Apkah kamu benar benar sudah yakin!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonText: "iya!",
        cancelButtonText: "Tidak!",
        reverseButtons: true
        }).then((result) => {
        if (result.isConfirmed) {
            $('#form_ubah').submit()
        } else if (
            /* Read more about handling dismissals below */
            result.dismiss === Swal.DismissReason.cancel
        ) {
            swalWithBootstrapButtons.fire({
            title: "Cancelled",
            text: "Your imaginary file is safe :)",
            icon: "error"
            });
        }
        });

    }
</script>