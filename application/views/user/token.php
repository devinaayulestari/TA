<div class="page-heading">
	<div class="page-title">
		<div class="row">
			<div class="col-12 col-md-6 order-md-1 order-last">
				<h3>Data User</h3>
				<p class="text-subtitle text-muted">Halaman Data User.</p>
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
				<h5 class="card-title">TOKEN JWT</h5>
			</div>
			<div class="card-body">
				<div class="row">
					<div class="col-md-12">
						<div class="form-group">
							<label for="tokenV">Token</label>
							<small class="text-muted"><i></i></small>
							<div class="input-group">
								<input type="text" class="form-control" id="tokenV" value="<?= $token ?>" readonly>
								<div class="input-group-append">
									<button class="btn btn-outline-primary" type="button" id="copyButton">Copy</button>
								</div>
							</div>
							<!-- Catatan  -->
							<small class="note text-warning">Catatan: “Token akan muncul saat permohonan sudah di setujui oleh admin”.</small>
						</div>
					</div>

				</div>
			</div>
		</div>
	</section>
</div>
<script>
	// Fungsi Copy
	document.getElementById("copyButton").addEventListener("click", function() {
		// Ambil elemen input
		var input = document.getElementById("tokenV");
		// Pilih teks dalam input
		input.select();
		input.setSelectionRange(0, 99999); // Untuk perangkat mobile
		// Salin teks yang dipilih ke clipboard
		document.execCommand("copy");
		// Berikan umpan balik kepada pengguna
		Swal.fire({
			icon: 'success',
			title: 'Copied!',
			text: 'Token copied to clipboard: ' + input.value
		});
	});
</script>