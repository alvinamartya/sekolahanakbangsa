<div class="page-breadcrumb">
	<div class="row">
		<div class="col-7 align-self-center">
			<h4 class="page-title text-truncate text-dark font-weight-medium mb-1">Barang</h4>
			<div class="d-flex align-items-center">
				<nav aria-label="breadcrumb">
					<ol class="breadcrumb m-0 p-0">
						<li class="breadcrumb-item"><a href="index.html" class="text-muted">Home</a></li>
						<li class="breadcrumb-item"><a href="<?= site_url('barang') ?>" class="text-muted">Barang</a></li>
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
			<form method="post" action="<?php echo base_url('barang/edit') ?>" autocomplete="off">
				<input type="hidden" value=<?php echo $data->id_barang ?> name="id_barang">

				<div class="form-group">
					<label for="nama_barang">Nama Barang <span class="text-danger font-weight-bold">*</span></label>
					<input type="text" name="nama_barang" class="form-control <?php echo (form_error('nama_barang') != null ? 'is-invalid' : '') ?>" value="<?php echo $data->nama_barang ?>">
					<div class="invalid-feedback"><?php echo form_error('nama_barang'); ?></div>
				</div>

				<div class="form-group">
					<label for="deskripsi_barang">Deskripsi Barang <span class="text-danger font-weight-bold">*</span></label>
					<textarea name="deskripsi_barang" id="deskripsi_barang" class="form-control <?php echo (form_error('deskripsi_barang') != null ? 'is-invalid' : '') ?>" cols="100" rows="4" placeholder="Deskripsi Barang"><?= $data->deskripsi_barang ?></textarea>
					<div class="invalid-feedback"><?php echo form_error('deskripsi_barang'); ?></div>
				</div>

				<button type="submit" id="btnSubmit" class="btn btn-primary"><i class="fa fa-pencil-alt"></i> Perbarui</button>
				<a href="<?php echo site_url('barang') ?>" class="btn btn-danger"><i class="fa fa-reply"></i> Kembali</a>
			</form>
		</div>
	</div>
</div>