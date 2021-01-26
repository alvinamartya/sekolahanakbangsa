<div class="page-breadcrumb">
	<div class="row">
		<div class="col-7 align-self-center">
			<h4 class="page-title text-truncate text-dark font-weight-medium mb-1">Biaya Lainnya</h4>
			<div class="d-flex align-items-center">
				<nav aria-label="breadcrumb">
					<ol class="breadcrumb m-0 p-0">
						<li class="breadcrumb-item"><a href="index.html" class="text-muted">Home</a></li>
						<li class="breadcrumb-item"><a href="<?= site_url('biaya_lainnya') ?>" class="text-muted">Biaya Lainnya</a></li>
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
			<form method="post" action="<?php echo base_url('biaya_lainnya/edit') ?>" autocomplete="off">
				<input type="hidden" value=<?php echo $data->id_biaya_lainnya ?> name="id_biaya_lainnya">

				<div class="form-group">
					<label for="nama_biaya_lainnya">Nama Biaya Lainnya</label>
					<input type="text" name="nama_biaya_lainnya" class="form-control <?php echo (form_error('nama_biaya_lainnya') != null ? 'is-invalid' : '') ?>" value="<?php echo $data->nama_biaya_lainnya ?>">
					<div class="invalid-feedback"><?php echo form_error('nama_biaya_lainnya'); ?></div>
				</div>
				<div class="form-group">
					<label for="deskripsi_biaya_lainnya">Deskripsi Biaya Lainnya</label>
					<textarea name="deskripsi_biaya_lainnya" id="deskripsi_biaya_lainnya" class="form-control <?php echo (form_error('deskripsi_biaya_lainnya') != null ? 'is-invalid' : '') ?>" cols="100" rows="4" placeholder="Deskripsi Biaya Lainnya"><?php echo $data->deskripsi_biaya_lainnya ?></textarea>
					<div class="invalid-feedback"><?php echo form_error('deskripsi_biaya_lainnya'); ?></div>
				</div>

				<input type="submit" id="btnSubmit" class="btn btn-primary" value="Perbarui">
				<a href="<?php echo site_url('biaya-lainnya') ?>" class="btn btn-danger">Kembali</a>
			</form>
		</div>
	</div>
</div>