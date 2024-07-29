<div class="page-heading">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Dashboard</h3>
                <p class="text-subtitle text-muted">Halaman Dashboard.</p>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item active" aria-current="page">
                            Dashboard
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
        <div class="row" id="table-head">
                <div class="card">
                    <div class="card-header text-center">
                        <h4 class="card-title">Detail Pemohon Akses Database</h4>
                    </div>
                    <div class="card-content">
                        <!-- table head dark -->
                        <table class="table mb-0">
                            <tbody>
                                <tr>
                                    <td>Nama Lembaga</td>
                                    <td><?=$user['nama_lembaga']?></td>
                                </tr>
                                <tr>
                                    <td>Nama Lengkap</td>
                                    <td><?=$user['nama_lengkap']?></td>
                                </tr>
                                <tr>
                                    <td>Email</td>
                                    <td><?=$user['email']?></td>
                                </tr>
                                <tr>
                                    <td>Nomer Telepon</td>
                                    <td><?=$user['nomer_telepon']?></td>
                                </tr>
                                <tr>
                                    <td>Type Pengguna</td>
                                    <td><?=$user['role']?></td>
                                </tr>
                                <tr>
                                    <td>Surat Permohonan</td>
                                    <td><a href="<?=base_url('assets/img/berkas/').$user['surat_permohonan']?>" target="_blank" rel="noopener noreferrer">lihat</a></td>
                                </tr>
                                <tr>
                                    <td>KTP</td>
                                    <td><a href="<?=base_url('assets/img/berkas/').$user['ktp']?>" target="_blank" rel="noopener noreferrer">lihat</a></td>
                                </tr>
                                <tr>
                                    <td>SK</td>
                                    <td><a href="<?=base_url('assets/img/berkas/').$user['sk']?>" target="_blank" rel="noopener noreferrer">lihat</a></td>
                                </tr>
                                <tr>
                                    <td>Surat Pernyataan</td>
                                    <td><a href="<?=base_url('assets/img/berkas/').$user['surat_pernyataan']?>" target="_blank" rel="noopener noreferrer">lihat</a></td>
                                </tr>
                            </tbody>
                        </table>
                        <div class="col-12 d-flex justify-content-end">
                        <a onclick="setujui('<?=$user['data_id']?>')" class="btn btn-primary me-1 mb-1">Setujui</a>
                        <a onclick="showtolak()"
                            class="btn btn-light-secondary me-1 mb-1">Tolak</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section id="tolak_form" style="display:none">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Alasan Di tolak</h4>
            </div>
            <div class="card-content">
                <div class="card-body">
                    <form class="form form-vertical" action="<?=base_url('admin/tolak')?>" id="form" method="POST">
                        <div class="form-body">
                            <div class="form-floating">
                                <input type="hidden" value="<?=$user['data_id']?>" name="id">
                                <textarea name="pesan" class="form-control" placeholder="Leave a comment here" id="floatingTextarea"></textarea>
                                <label for="floatingTextarea">Comments</label>
                            </div>
                        </div>
                        <a onclick="tolak()"
                    class="btn btn-light-secondary me-1 mb-1">Tolak</a>
                    </form>
                </div>
            </div>
        </div>
    </section>
</div>
<script>
    function showtolak() {
        $('#tolak_form').css("display", "");
    }
    function tolak(){
        const swalWithBootstrapButtons = Swal.mixin({
        customClass: {
            confirmButton: "btn btn-success",
            cancelButton: "btn btn-danger"
        },
        buttonsStyling: false
        });
        swalWithBootstrapButtons.fire({
        title: "apakah anda yakin?",
        text: "Kamu Tidak akan Bisa Kembali!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonText: "iya!",
        cancelButtonText: "Tidak!",
        reverseButtons: true
        }).then((result) => {
        if (result.isConfirmed) {
            $('#form').submit();
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
    function setujui(id){
        const swalWithBootstrapButtons = Swal.mixin({
        customClass: {
            confirmButton: "btn btn-success",
            cancelButton: "btn btn-danger"
        },
        buttonsStyling: false
        });
        swalWithBootstrapButtons.fire({
        title: "apakah anda yakin?",
        text: "Kamu Tidak Akan Bisa Kembali!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonText: "iya!",
        cancelButtonText: "Tidak!",
        reverseButtons: true
        }).then((result) => {
        if (result.isConfirmed) {
            window.location.href="<?=base_url('admin/setujui/')?>"+id
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