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
					<input type="text" name="nama_karyawan" class="form-control" required>
				</div>

				<div class="form-group">
					<label for="" class="d-block">Jenis Kelamin</label>
					<div class="form-check form-check-inline">
						<input class="form-check-input" type="radio" id="L" name="jenis_kelamin" value="L" <?php echo (set_value('jenis_kelamin') == 'L' ? 'checked' : '') ?>>
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
					<label for="no_telepon">No Telepon</label>
					<input type="number" name="no_telepon" class="form-control" required><br>
				</div>

				<div class="form-group">
					<label for="email">Email Pengguna</label>
					<input type="email" name="email" class="form-control" required><br>
				</div>

				<div class="form-group">
					<label for="tempat_lahir">Tempat lahir</label>
					<input type="text" name="tempat_lahir" class="form-control" required><br>
				</div>

				<div class="form-group">
					<label for="tempat_lahir">Tanggal lahir</label>
					<input type="date" name="tanggal_lahir" value="1971-01-01" class="form-control" required><br>
				</div>

				<div class="form-group">
					<label for="username">Nama Pengguna</label>
					<input type="text" name="username" class="form-control" required><br>
				</div>

				<div class="form-group">
					<label for="username">Katasandi</label>
					<input type="password" name="password" class="form-control" required><br>
				</div>

				<div class="form-group">
					<label for="ver_password">Konfirmasi Katasandi</label>
					<input type="password" name="ver_password" id="ver_password" class="form-control" required>
				</div>

				<div>
					<button id="btn-save" type="submit" class="btn btn-primary">Simpan</button>
					<a href="<?= site_url('karyawan') ?>" class="btn btn-danger">Batal</a>
				</div>
			</form>
		</div>
	</div>
</div>