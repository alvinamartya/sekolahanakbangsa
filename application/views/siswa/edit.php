<div class="page-breadcrumb">
	<div class="row">
		<div class="col-7 align-self-center">
			<h4 class="page-title text-truncate text-dark font-weight-medium mb-1">Siswa</h4>
			<div class="d-flex align-items-center">
				<nav aria-label="breadcrumb">
					<ol class="breadcrumb m-0 p-0">
						<li class="breadcrumb-item"><a href="index.html" class="text-muted">Home</a></li>
						<li class="breadcrumb-item"><a href="<?= site_url('siswa') ?>" class="text-muted">Siswa</a></li>
						<li class="breadcrumb-item text-muted active" aria-current="page">Ubah</li>
					</ol>
				</nav>
			</div>
		</div>
	</div>
</div>

<div class="container-fluid">
	<div class="card">
		<div class="card-body">
			<form method="post" action="<?php echo base_url('siswa/edit') ?>" autocomplete="off">
				<input type="hidden" value=<?php echo $data->id_siswa ?> name="id_siswa">
				<div class="form-group">
					<label for="nama_siswa">Nama Siswa <span class="text-danger font-weight-bold">*</span></label>
					<input type="text" class="form-control <?php echo (form_error('nama_siswa') != null ? 'is-invalid' : '') ?>" id="nama_siswa" name="nama_siswa" aria-describedby="schoolNameHelp" value="<?php echo $data->nama_siswa ?>" placeholder="Nama Siswa">
					<div class="invalid-feedback"><?php echo form_error('nama_siswa'); ?></div>
				</div>

				<div class="form-group">
					<label for="nisn">NISN</label>
					<!-- <?php var_dump($data) ?> -->
					<input type="number" class="form-control <?php echo (form_error('nisn') != null ? 'is-invalid' : '') ?>" id="nisn" name="nisn" aria-describedby="schoolNameHelp" value="<?= $data->nisn ?>" placeholder="NISN">
					<div class="invalid-feedback"><?php echo form_error('nisn'); ?></div>
				</div>

				<div class="form-group">
					<label for="tempat_lahir">Tempat Lahir <span class="text-danger font-weight-bold">*</span></label>
					<input type="text" class="form-control <?php echo (form_error('tempat_lahir') != null ? 'is-invalid' : '') ?>" id=" tempat_lahir" name="tempat_lahir" aria-describedby="schoolNameHelp" value="<?= $data->tempat_lahir ?>" placeholder="Tempat Lahir">
					<div class="invalid-feedback"><?php echo form_error('tempat_lahir'); ?></div>
				</div>

				<div class="form-group">
					<label for="tanggal_lahir">Tanggal Lahir <span class="text-danger font-weight-bold">*</span></label>
					<input type="date" name="tanggal_lahir" class="form-control <?php echo (form_error('tanggal_lahir') != null ? 'is-invalid' : '') ?>" value="<?php echo date('Y-m-d', strtotime($data->tanggal_lahir)) ?>">
					<div class="invalid-feedback"><?php echo form_error('tanggal_lahir'); ?></div>
				</div>

				<div class="form-group">
					<label for="id_sekolah">Sekolah <span class="text-danger font-weight-bold">*</span></label>
					<select name="id_sekolah" id="id_sekolah" class="form-control <?php echo (form_error('id_sekolah') != null ? 'is-invalid' : '') ?>">
						<?php foreach ($sekolah as $s) { ?>
							<option value="<?= $s->id_sekolah ?>" <?= $s->id_sekolah == $data->id_sekolah ? "selected" : "" ?>>
								<?= $s->nama_sekolah ?>
							</option>
						<?php } ?>
					</select>
					<div class="invalid-feedback"><?php echo form_error('id_sekolah'); ?></div>
				</div>

				<div class="form-group">
					<label for="" class="d-block">Jenis Kelamin <span class="text-danger font-weight-bold">*</span></label>
					<div class="form-check form-check-inline">
						<input class="form-check-input" <?php if ($data->jenis_kelamin == "L") echo 'checked' ?> type="radio" id="L" name="jenis_kelamin" value="L" <?php echo (set_value('jenis_kelamin') == 'L' ? 'checked' : '') ?>>
						<label class="form-check-label" for="L">Laki-laki</label>
					</div>
					<div class="form-check form-check-inline">
						<input class="form-check-input" <?php if ($data->jenis_kelamin == "P") echo 'checked' ?> type="radio" id="P" name="jenis_kelamin" value="P" <?php echo (set_value('jenis_kelamin') == 'P' ? 'checked' : '') ?>>
						<label class="form-check-label" for="P">Perempuan</label>
					</div>
				</div>

				<div>
					<button type="submit" id="btnSubmit" class="btn btn-primary"><i class="fa fa-pencil-alt"></i> Perbarui</button>
					<a href="<?= site_url('siswa') ?>" class="btn btn-danger"><i class="fa fa-reply"></i> Kembali</a>
				</div>
			</form>
		</div>
	</div>
</div>