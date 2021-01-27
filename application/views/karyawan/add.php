<div class="page-breadcrumb">
	<div class="row">
		<div class="col-7 align-self-center">
			<h4 class="page-title text-truncate text-dark font-weight-medium mb-1">Karyawan</h4>
			<div class="d-flex align-items-center">
				<nav aria-label="breadcrumb">
					<ol class="breadcrumb m-0 p-0">
						<li class="breadcrumb-item"><a href="index.html" class="text-muted">Home</a></li>
						<li class="breadcrumb-item"><a href="<?= site_url('karyawan') ?>" class="text-muted">Karyawan</a></li>
						<li class="breadcrumb-item text-muted active" aria-current="page">Tambah</li>
					</ol>
				</nav>
			</div>
		</div>
	</div>
</div>
<!-- ============================================================== -->
<!-- End Bread crumb and right sidebar toggle -->
<!-- ============================================================== -->
<!-- TAMBAH KARYAWAN -->

<div class="container-fluid">
	<div class="card">
		<div class="card-body">
			<form method="post" action="<?php echo base_url('Karyawan/add') ?>" autocomplete="off">
				<!-- <div class="row">
					<div class="col">
						Hak Akses
						<select name="role" class="form-control" disabled>
							<option value="Donatur">Donatur</option>
							<option value="Relawan">Relawan</option>
							<option value="Karyawan" selected>Karyawan</option>
						</select>
					</div>
				</div> -->

				<div class="form-group">
					<label for="nama_karyawan">Nama Karyawan</label>
					<input type="text" name="nama_karyawan" class="form-control <?php echo (form_error('nama_karyawan') != null ? 'is-invalid' : '') ?>" value="<?php echo set_value('nama_karyawan'); ?>">
					<div class="invalid-feedback"><?php echo form_error('nama_karyawan'); ?></div>
				</div>

				<div class="form-group">
					<label for="" class="d-block">Jenis Kelamin</label>
					<div class="form-check form-check-inline">
						<input class="form-check-input" checked type="radio" id="L" name="jenis_kelamin" value="L" <?php echo (set_value('jenis_kelamin') == 'L' ? 'checked' : '') ?>>
						<label class="form-check-label" for="L">Laki-laki</label>
					</div>
					<div class="form-check form-check-inline">
						<input class="form-check-input" type="radio" id="P" name="jenis_kelamin" value="P" <?php echo (set_value('jenis_kelamin') == 'P' ? 'checked' : '') ?>>
						<label class="form-check-label" for="P">Perempuan</label>
					</div>
					<!-- <small class="text-danger"><?php echo form_error('jenis_kelamin') ?></small> -->
				</div>

				<!-- <div class="row">
					<div class="col">
						Jabatan pengguna
						<select disabled name="jabatan_karyawan" class="form-control">
							<option value="Admin" selected>Admin</option>
							<option value="Super Admin">Super Admin</option>
						</select>
						<br>
					</div>
				</div> -->

				<div class="form-group">
					<label for="nik">NIK</label>
					<input type="number" name="nik" class="form-control <?php echo (form_error('nik') != null ? 'is-invalid' : '') ?>" value="<?php echo set_value('nik'); ?>">
					<div class="invalid-feedback"><?php echo form_error('nik'); ?></div>
				</div>
				<div class="form-group">
					<label for="no_telepon">No Telepon</label>
					<input type="number" name="no_telepon" class="form-control <?php echo (form_error('no_telepon') != null ? 'is-invalid' : '') ?>" value="<?php echo set_value('no_telepon'); ?>">
					<div class="invalid-feedback"><?php echo form_error('no_telepon'); ?></div>
				</div>

				<div class="form-group">
					<label for="email">Email Pengguna</label>
					<input type="email" name="email" class="form-control <?php echo (form_error('email') != null ? 'is-invalid' : '') ?>" value="<?php echo set_value('email'); ?>">
					<div class="invalid-feedback"><?php echo form_error('email'); ?></div>
				</div>

				<div class="form-group">
					<label for="tempat_lahir">Tempat lahir</label>
					<input type="text" name="tempat_lahir" class="form-control <?php echo (form_error('tempat_lahir') != null ? 'is-invalid' : '') ?>" value="<?php echo set_value('tempat_lahir'); ?>">
					<div class="invalid-feedback"><?php echo form_error('tempat_lahir'); ?></div>
				</div>

				<div class="form-group">
					<label for="tempat_lahir">Tanggal lahir</label>
					<input type="date" name="tanggal_lahir" value="1971-01-01" class="form-control">
				</div>

				<div class="form-group">
					<label for="username">Nama Pengguna</label>
					<input type="text" name="username" class="form-control <?php echo (form_error('username') != null ? 'is-invalid' : '') ?>" value="<?php echo set_value('username'); ?>">
					<div class="invalid-feedback"><?php echo form_error('username'); ?></div>
				</div>

				<div class="form-group">
					<label for="username">Kata Sandi</label>
					<input type="password" name="password" id="password" class="form-control <?php echo (form_error('password') != null ? 'is-invalid' : '') ?>" value="<?php echo set_value('password'); ?>">
					<div class="invalid-feedback"><?php echo form_error('password'); ?></div>
				</div>

				<div class="form-group">
					<label for="ver_password">Konfirmasi Kata Sandi</label>
					<input type="password" name="ver_password" id="ver_password" class="form-control <?php echo (form_error('ver_password') != null ? 'is-invalid' : '') ?>" value="<?php echo set_value('ver_password'); ?>">
					<div id="ipassword"></div>
					<div class="invalid-feedback"><?php echo form_error('ver_password'); ?></div>
					
				</div>

				<div>
					<button id="btn-save" type="submit" class="btn btn-primary">Simpan</button>
					<a href="<?= site_url('karyawan') ?>" class="btn btn-danger">Kembali</a>
				</div>
			</form>
		</div>
	</div>
</div>
<script>
	function check() {

		// ambil data dari inputan password dan verifikasi
		var pass = document.getElementById("password").value;
		var vpass = document.getElementById("ver_password").value;

		// pengecekan apakah ada isinya, jika kosong fungsi dihentikan
		if (pass == "" || vpass == "") {
			return;
		}

		// pengecekan apakah password dan verifikasi sudah sama
		if (pass != vpass) {
			document.getElementById("ipassword").innerHTML = "Kata sandi tidak sesuai!";
			document.getElementById("ipassword").style.color = "red";
			//document.getElementById("btn-save").disabled = true;
		} else {
			document.getElementById("ipassword").innerHTML = "Kata sandi sesuai!";
			document.getElementById("ipassword").style.color = "green"
			//document.getElementById("btn-save").disabled = false;
		}
	}
</script>