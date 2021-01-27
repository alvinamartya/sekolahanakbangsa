<!-- EDIT KARYAWAN -->
<div class="page-breadcrumb">
	<div class="form-group">
		<div class="col-7 align-self-center">
			<h4 class="page-title text-truncate text-dark font-weight-medium mb-1">Karyawan</h4>
			<div class="d-flex align-items-center">
				<nav aria-label="breadcrumb">
					<ol class="breadcrumb m-0 p-0">
						<li class="breadcrumb-item"><a href="index.html" class="text-muted">Home</a></li>
						<li class="breadcrumb-item"><a href="<?= site_url('karyawan') ?>" class="text-muted">Karyawan</a></li>
						<li class="breadcrumb-item text-muted active" aria-current="page">Edit</li>
					</ol>
				</nav>
			</div>
		</div>
	</div>
</div>

<div class="container-fluid">
	<div class="card">
		<div class="card-body">
			<form method="post" action="<?php echo base_url('Karyawan/edit') ?>" autocomplete="off">
				<br>
				<div class="form-group">
					<input type="hidden" value=<?php echo $data->id_karyawan ?> name="id_karyawan">
					<label for="nama_karyawan">Nama Karyawan</label>
					<input type="text" name="nama_karyawan" class="form-control <?php echo (form_error('nama_karyawan') != null ? 'is-invalid' : '') ?>" value="<?php echo $data->nama_karyawan ?>">
					<div class="invalid-feedback"><?php echo form_error('nama_karyawan'); ?></div>
				</div>
				<div class="form-group">
					<label for="" class="d-block">Jenis Kelamin</label>
					<div class="form-check form-check-inline">
						<input class="form-check-input" <?php if ($data->jenis_kelamin == "L") echo 'checked' ?> type="radio" id="L" name="jenis_kelamin" value="L" <?php echo (set_value('jenis_kelamin') == 'L' ? 'checked' : '') ?>>
						<label class="form-check-label" for="L">Laki-laki</label>
					</div>
					<div class="form-check form-check-inline">
						<input class="form-check-input" <?php if ($data->jenis_kelamin == "P") echo 'checked' ?> type="radio" id="P" name="jenis_kelamin" value="P" <?php echo (set_value('jenis_kelamin') == 'P' ? 'checked' : '') ?>>
						<label class="form-check-label" for="P">Perempuan</label>
					</div>
				</div>
				<div class="form-group">
					<label for="nik">NIK</label>
					<input type="number" name="nik" class="form-control <?php echo (form_error('nik') != null ? 'is-invalid' : '') ?>" value="<?php echo $data->nik ?>">
					<div class="invalid-feedback"><?php echo form_error('nik'); ?></div>
				</div>
				<div class="form-group">
					<label for="no_telepon">No Telepon</label>
					<input type="number" name="no_telepon" class="form-control <?php echo (form_error('no_telepon') != null ? 'is-invalid' : '') ?>" value="<?php echo $data->no_telepon ?>">
					<div class="invalid-feedback"><?php echo form_error('no_telepon'); ?></div>
				</div>
				<div class="form-group">
					<label for="email">Email</label>
					<input type="email" name="email" class="form-control <?php echo (form_error('email') != null ? 'is-invalid' : '') ?>" value="<?php echo $data->email ?>">
					<div class="invalid-feedback"><?php echo form_error('email'); ?></div>
				</div>
				<div class="form-group">
					<label for="tempat_lahir">Tempat Lahir</label>
					<input type="text" name="tempat_lahir" class="form-control <?php echo (form_error('tempat_lahir') != null ? 'is-invalid' : '') ?>" value="<?php echo $data->tempat_lahir ?>">
					<div class="invalid-feedback"><?php echo form_error('tempat_lahir'); ?></div>
				</div>
				<div class="form-group">
					<label for="tanggal_lahir">Tanggal Lahir</label>
					<input type="date" name="tanggal_lahir" class="form-control <?php echo (form_error('tanggal_lahir') != null ? 'is-invalid' : '') ?>" value="<?php echo date("Y-m-d", strtotime($data->tanggal_lahir)); ?>">
					<div class="invalid-feedback"><?php echo form_error('tanggal_lahir'); ?></div>
				</div>
				<br>
				<input type="submit" id="btnSubmit" class="btn btn-primary" value="Perbarui">
				<a href="<?php echo site_url('Karyawan') ?>" class="btn btn-danger">Kembali</a>
			</form>
		</div>
	</div>
</div>