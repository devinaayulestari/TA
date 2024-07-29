<footer>
	<div class="footer clearfix mb-0 text-muted">
		<div class="float-start">
			<p>&copy; <span id="currentYear"></span> Mazer</p>
		</div>
		<div class="float-end">
			<p>
				Crafted with
				<span class="text-danger"><i class="bi bi-heart"></i></span>
			</p>
		</div>
	</div>
</footer>

<!-- Tambahkan skrip untuk memperbarui tahun -->
<script>
	// Fungsi untuk mendapatkan tahun saat ini
	function updateYear() {
		var year = new Date().getFullYear();
		// Temukan elemen dengan id "currentYear" dan perbarui teksnya
		document.getElementById("currentYear").textContent = year;
	}
	// Panggil fungsi saat halaman dimuat
	updateYear();
</script>