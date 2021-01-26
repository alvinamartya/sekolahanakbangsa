<div class="page-breadcrumb">
	<div class="form-group">
		<div class="col-7 align-self-center">
			<h4 class="page-title text-truncate text-dark font-weight-medium mb-1">Cluster Relawan</h4>
			<div class="d-flex align-items-center">
				<nav aria-label="breadcrumb">
					<ol class="breadcrumb m-0 p-0">
						<li class="breadcrumb-item"><a href="index.html" class="text-muted">Home</a></li>
						<li class="breadcrumb-item"><a href="<?= site_url('cluster') ?>" class="text-muted">Cluster</a></li>
						<li class="breadcrumb-item text-muted active" aria-current="page">Edit</li>
					</ol>
				</nav>
			</div>
		</div>
	</div>
</div>
<!-- EDIT CLUSTER -->

<div class="container-fluid">
	<div class="card">
		<div class="card-body">
			<form method="post" action="<?php echo base_url('cluster/edit') ?>" autocomplete="off">
				<input type="hidden" name="id_cluster_relawan" value="<?php echo $cluster->id_cluster_relawan ?>">

				<div class="form-group">
					<label for="nama_cluster">Nama Cluster</label>
					<input type="text" name="nama_cluster" class="form-control <?php echo (form_error('nama_cluster') != null ? 'is-invalid' : '') ?>" value="<?php echo $cluster->nama_cluster ?>">
					<div class="invalid-feedback"><?php echo form_error('nama_cluster'); ?></div>
				</div>

				<div class="form-group">
					<label for="ideskripsi">Deskripsi Cluster</label>
					<textarea id="ideskripsi" class="form-control <?php echo (form_error('deskripsi_cluster') != null ? 'is-invalid' : '') ?>" name="deskripsi_cluster"><?php echo $cluster->deskripsi_cluster ?></textarea>
					<div class="invalid-feedback"><?php echo form_error('deskripsi_cluster'); ?></div>
				</div>

				<input type="submit" id="btnSubmit" class="btn btn-primary" value="Perbarui">
				<a href="<?php echo base_url('cluster') ?>" class="btn btn-danger">Kembali</a>
			</form>
		</div>
	</div>
</div>
