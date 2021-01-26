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
				<div class="row">
					<input type="hidden" value=<?php echo $data->id_biaya_lainnya ?> name="id_biaya_lainnya">
					<div class="col">
						Nama Biaya Lainnya
						<input type="text" name="nama_biaya_lainnya" class="form-control" required value="<?php echo $data->nama_biaya_lainnya ?>"><br>
					</div>
				</div>
				<div class="row">
					<div class="col">
						Deskripsi Biaya Lainnya
						<input type="text" name="deskripsi_biaya_lainnya" class="form-control" required value="<?php echo $data->deskripsi_biaya_lainnya ?>"><br>
					</div>
				</div>
				<a href="<?php echo site_url('Biaya_lainnya') ?>" class="btn btn-secondary">Kembali</a>
				<input type="submit" id="btnSubmit" class="btn btn-primary" value="Perbarui">
			</form>
		</div>
	</div>
</div>