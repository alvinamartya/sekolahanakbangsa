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
				<div class="row">
					<input type="hidden" value=<?php echo $data->id_barang ?> name="id_barang">
					<div class="col">
						Nama barang
						<input type="text" name="nama_barang" class="form-control" required value="<?php echo $data->nama_barang ?>"><br>
					</div>
				</div>
				<div class="row">
					<div class="col">
						Deskripsi Barang
						<input type="text" name="deskripsi_barang" class="form-control" required value="<?php echo $data->deskripsi_barang ?>"><br>
					</div>
				</div>
				<a href="<?php echo site_url('Barang') ?>" class="btn btn-secondary">Kembali</a>
				<input type="submit" id="btnSubmit" class="btn btn-primary" value="Perbarui">
			</form>
		</div>
	</div>
</div>