<div class="page-breadcrumb">
    <div class="row">
        <div class="col-7 align-self-center">
            <h4 class="page-title text-truncate text-dark font-weight-medium mb-1">Aksi Galang Dana</h4>
            <div class="d-flex align-items-center">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb m-0 p-0">
                        <li class="breadcrumb-item"><a href="index.html" class="text-muted">Home</a></li>
                        <li class="breadcrumb-item text-muted active" aria-current="page">Aksi</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</div>
<!-- ============================================================== -->
<!-- End Bread crumb and right sidebar toggle -->
<!-- ============================================================== -->
<div class="container-fluid">
    <!-- ============================================================== -->
    <!-- Start Page Content -->
    <!-- ============================================================== -->
    <!-- basic table -->
    <form action="" method="POST" enctype="multipart/form-data" id="mainForm">
        <div class="row">

            <!-- Aksi -->
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Galang Bantuan</h4>
                        <div class="alert alert-danger alert-dismissible fade show validationAlert" role="alert" id="validationAlert"></div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="nama_aksi">Nama Aksi <span class="text-danger font-weight-bold">*</span></label>
                                    <input type="text" class="form-control" value="<?= isset($aksi) ? $aksi->nama_aksi : '' ?>" id="nama_aksi" name="nama_aksi" placeholder="Nama Aksi">
                                </div>
                                <div class="form-group">
                                    <label for="tanggal_selesai">Tanggal Mulai</label>
                                    <input type="date" class="form-control" name="tanggal_mulai" value="<?php echo isset($tglmulai) ? set_value('tanggal_mulai', date('Y-m-d', strtotime($tglmulai))) : set_value('tanggal_mulai'); ?>" disabled>
                                </div>
                                <div class="form-group">
                                    <label for="tanggal_selesai">Tanggal Selesai <span class="text-danger font-weight-bold">*</span></label>
                                    <input type="date" class="form-control" value="<?= isset($aksi) ? date('Y-m-d', strtotime($aksi->tanggal_selesai)) : '' ?>" id="tanggal_selesai" name="tanggal_selesai" placeholder="Tanggal Selesai">
                                </div>
                                <div class="form-group">
                                    <label for="deskripsi_aksi">Deskripsi Aksi <span class="text-danger font-weight-bold">*</span></label>
                                    <textarea name="deskripsi_aksi" id="deskripsi_aksi" class="form-control" cols="100" rows="4" placeholder="Deskripsi Aksi"><?= isset($aksi) ? $aksi->deskripsi_aksi : '' ?></textarea>
                                </div>
                            </div>
                            <div class="col-md-8">
                                <div class="form-group">
                                    <label for="foto">Pilih Foto</label><br>
                                    <input type="file" name="files" id="gambar_aksi" multiple>
                                    <div class="row">
                                        <?php foreach($aksi_gambar as $d) { ?>
                                            <div class="col-md-4 mt-3">
                                                <div class="position-relative gallery-container">
                                                    <div class="overlay">
                                                        <button type="button" class="btn btn-danger btnHapusFoto" data-id="<?= $d->id ?>">
                                                            <i class="fa fa-trash"></i> Hapus
                                                        </button>
                                                    </div>
                                                    <img src="<?= base_url('assets/images/aksi/'.$d->gambar) ?>" alt="<?= $d->gambar ?>" class="height-300px w-100" />
                                                </div>
                                            </div>
                                        <?php } ?>


                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>


            <!-- Aksi Biaya -->
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Aksi Biaya</h4>
                        <div class="alert alert-success alert-dismissible fade show d-none" role="alert" id="messageBiaya">
                            Biaya berhasil ditambahkan!
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="table-responsive">
                            <button type="button" class="btn btn-primary mb-3" data-toggle="modal" data-target="#modalBiaya" id="#btnTambahBiaya"><i class="fa fa-plus-circle"></i> Tambah</button>
                            <table id="biaya-table" class="table table-striped table-bordered no-wrap">
                                <thead>
                                    <tr>
                                        <th>Nama Biaya</th>
                                        <th>Biaya</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach($aksi_biaya as $d) { ?>
                                        <tr>
                                            <td><?= $d->nama_biaya_lainnya ?></td>
                                            <td><?= "Rp". number_format($d->biaya, 0, ",", "."); ?></td>
                                            <td>
                                                <button type="button" class="btn btn-warning btn-sm btnEdit" data-id="<?= $d->id_biaya_lainnya ?>" data-type="biaya"><i class="fa fa-edit"></i> Ubah</button>
                                                <button type="button" class="btn btn-danger btn-sm btnDelete" data-id="<?= $d->id_biaya_lainnya ?>" data-type="biaya"><i class="fa fa-trash"></i> Hapus</button>
                                            </td>
                                        </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>


            <!-- Aksi Barang -->
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Aksi Barang</h4>
                        <div class="alert alert-success alert-dismissible fade show d-none" role="alert" id="messageBarang">
                            Barang berhasil ditambahkan!
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="table-responsive">
                            <button type="button" class="btn btn-primary mb-3" data-toggle="modal" data-target="#modalBarang" id="#btnTambahBarang"><i class="fa fa-plus-circle"></i> Tambah</button>
                            <table id="barang-table" class="table table-striped table-bordered no-wrap">
                                <thead>
                                    <tr>
                                        <th>Nama Barang</th>
                                        <th>Jumlah</th>
                                        <th>Harga Satuan</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach($aksi_barang as $d) { ?>
                                        <tr>
                                            <td><?= $d->nama_barang ?></td>
                                            <td><?= $d->jumlah ?></td>
                                            <td><?= "Rp". number_format($d->harga_satuan, 0, ",", "."); ?></td>
                                            <td>
                                                <button type="button" class="btn btn-warning btn-sm btnEdit" data-id="<?= $d->id_barang ?>" data-type="barang"><i class="fa fa-edit"></i> Ubah</button>
                                                <button type="button" class="btn btn-danger btn-sm btnDelete" data-id="<?= $d->id_barang ?>" data-type="barang"><i class="fa fa-trash"></i> Hapus</button>
                                            </td>
                                        </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

        </div>
        <div class="row">
            <div class="col-12 d-flex justify-content-between">
                <h3 class="text-danger font-weight-bold">Total Harga : Rp<span id="target_donasi"><?= number_format($aksi->target_donasi, 0, ",", ".");  ?></span></h3>
                <div class="d-flex">
                    <button class="btn btn-primary mr-3" type="submit" id="btnSave"><i class="fa fa-save"></i> Simpan</button>
                    <a href="<?= site_url('aksi') ?>" class="btn btn-secondary"><i class="fa fa-times"></i> Batal</a>
                </div>
            </div>
        </div>
    </form>
</div>

<!-- Modal -->
<div class="modal fade" id="modalBiaya" tabindex="-1" role="dialog" aria-labelledby="modalBiayaLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="modalBiayaLabel">Tambah Biaya Lainnya</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
            <form action="" id="frmBiaya">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="biaya_lainnya">Biaya Lainnya <span class="text-danger font-weight-bold">*</span></label>
                        <select name="id_biaya_lainnya" id="id_biaya_lainnya" class="form-control" required>
                            <option value="" hidden>Pilih Biaya</option>
                            <?php foreach ($biaya_lainnya as $d) { ?>
                                <option value="<?= $d->id_biaya_lainnya ?>">
                                    <?= $d->nama_biaya_lainnya ?>
                                </option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="biaya">Biaya <span class="text-danger font-weight-bold">*</span></label>
                        <input type="text" class="form-control" name="biaya" id="biaya" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <button type="submit" id="btnSubmitBiaya" class="btn btn-primary" data-type="add">Simpan</button>
                </div>
            </form>
		</div>
	</div>
</div>


<!-- Modal -->
<div class="modal fade" id="modalBarang" tabindex="-1" role="dialog" aria-labelledby="modalBarangLabel"
	aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="modalBarangLabel">Tambah Barang</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<form action="" id="frmBarang">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="barang">Barang <span class="text-danger font-weight-bold">*</span></label>
                        <select name="id_barang" id="id_barang" class="form-control">
                            <option value="" hidden>Pilih Barang</option>
                            <?php foreach ($barang as $d) { ?>
                                <option value="<?= $d->id_barang ?>">
                                    <?= $d->nama_barang ?>
                                </option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="jumlah">Jumlah <span class="text-danger font-weight-bold">*</span></label>
                        <input type="number" class="form-control" id="jumlah" name="jumlah" required>
                    </div>
                    <div class="form-group">
                        <label for="harga_satuan">Harga Satuan <span class="text-danger font-weight-bold">*</span></label>
                        <input type="text" class="form-control" name="harga_satuan" id="harga_satuan" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <button type="submit" id="btnSubmitBarang" class="btn btn-primary" data-type="add">Simpan</button>
                </div>
            </form>
		</div>
	</div>
</div>

<!-- footer -->
<!-- ============================================================== -->
<footer class="footer text-center text-muted">
    All Rights Reserved by Adminmart. Designed and Developed by <a href="https://wrappixel.com">WrapPixel</a>.
</footer>
<!-- ============================================================== -->
<!-- End footer -->
<!-- ============================================================== -->
</div>