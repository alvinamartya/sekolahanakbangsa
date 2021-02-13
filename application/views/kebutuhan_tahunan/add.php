<div class="page-breadcrumb">
    <div class="row">
        <div class="col-7 align-self-center">
            <h4 class="page-title text-truncate text-dark font-weight-medium mb-1">Kebutuhan Tahunan</h4>
            <div class="d-flex align-items-center">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb m-0 p-0">
                        <li class="breadcrumb-item"><a href="index.html" class="text-muted">Home</a></li>
                        <li class="breadcrumb-item text-muted active" aria-current="page">Kebutuhan Tahunan</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</div>
<!-- ============================================================== -->
<!-- End Bread crumb and right sidebar toggle -->
<!-- ============================================================== -->
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
                        <h4 class="card-title">Kebutuhan Tahunan</h4>
                        <div class="alert alert-danger alert-dismissible fade show validationAlert" role="alert" id="validationAlert"></div>
                        <div class="form-group">
                            <label for="year">Tahun <span class="text-danger font-weight-bold">*</span></label>
                            <input type="text" id="year" name="year" class="yearpicker form-control" value="" />
                        </div>

                        <div class="form-group">
                            <label for="desc">Deskripsi <span class="text-danger font-weight-bold">*</span></label>
                            <textarea name="desc" id="desc" cols="30" rows="5" class="form-control"></textarea>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Aksi Biaya -->
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title text-center" style="font-size: 26px;">Detail Biaya Lainnya</h4>
                        <div class="alert alert-success alert-dismissible fade show d-none" role="alert" id="messageBiaya">
                            Biaya berhasil ditambahkan!
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="table-responsive">
                            <button type="button" class="btn btn-primary mb-3" data-toggle="modal" data-target="#modalBiaya"><i class="fa fa-plus-circle"></i> Tambah</button>
                            <table id="biaya-table" class="table table-striped table-bordered no-wrap">
                                <thead>
                                    <tr>
                                        <th>Nama Biaya</th>
                                        <th>Biaya</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>

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
                        <h4 class="card-title text-center" style="font-size: 26px;">Detail Barang</h4>
                        <div class="alert alert-success alert-dismissible fade show d-none" role="alert" id="messageBarang">
                            Barang berhasil ditambahkan!
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="table-responsive">
                            <button type="button" class="btn btn-primary mb-3" data-toggle="modal" data-target="#modalBarang"><i class="fa fa-plus-circle"></i> Tambah</button>
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

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

        </div>

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="col-12 d-flex justify-content-between">
                            <h3 class="text-danger font-weight-bold">Total Kebutuhan : Rp<span id="target_donasi">0</span></h3>
                            <div class="d-flex">
                                <button class="btn btn-primary mr-3" type="button" id="btnSave"><i class="fa fa-save"></i> Simpan</button>
                                <a href="<?= site_url('kebutuhan-tahunan') ?>" class="btn btn-secondary"><i class="fa fa-times"></i> Batal</a>
                            </div>
                        </div>
                    </div>
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
                        <label for="biaya_lainnya">Biaya Lainnya</label>
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
                        <label for="biaya">Biaya</label>
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
<div class="modal fade" id="modalBarang" tabindex="-1" role="dialog" aria-labelledby="modalBarangLabel" aria-hidden="true">
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
                        <label for="barang">Barang</label>
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
                        <label for="jumlah">Jumlah</label>
                        <input type="number" min="1" class="form-control" id="jumlah" name="jumlah" required>
                    </div>
                    <div class="form-group">
                        <label for="harga_satuan">Harga Satuan</label>
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
</div>
</div>
<script>
    $(document).ready(function() {
        const dd = new Date();
        $(".yearpicker").yearpicker({
            year: dd.getFullYear(),
            startYear: 2012,
            endYear: 2030
        });
    });
</script>