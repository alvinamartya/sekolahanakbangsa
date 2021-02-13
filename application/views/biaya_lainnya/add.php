<div class="page-breadcrumb">
    <div class="row">
        <div class="col-7 align-self-center">
            <h4 class="page-title text-truncate text-dark font-weight-medium mb-1">Biaya Lainnya</h4>
            <div class="d-flex align-items-center">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb m-0 p-0">
                        <li class="breadcrumb-item"><a href="index.html" class="text-muted">Home</a></li>
                        <li class="breadcrumb-item"><a href="<?= site_url('biaya_lainnya') ?>" class="text-muted">Biaya Lainnya</a></li>
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
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <?php if ($this->session->flashdata('success')) { ?>
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <?= $this->session->flashdata('success') ?>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    <?php } ?>
                    <form action="<?= site_url('biaya_lainnya/add') ?>" method="POST">
                        <div class="form-group">
                            <label for="nama_biaya_lainnya">Nama Biaya Lainnya <span class="text-danger font-weight-bold">*</span></label>
                            <input type="text" class="form-control <?php echo (form_error('nama_biaya_lainnya') != null ? 'is-invalid' : '') ?>" value="<?= isset($biaya_lainnya) ? $biaya_lainnya->nama_biaya_lainnya : '' ?>" id="nama_biaya_lainnya" name="nama_biaya_lainnya" aria-describedby="schoolNameHelp" placeholder="Nama Biaya Lainnya">
                            <div class="invalid-feedback"><?php echo form_error('nama_biaya_lainnya'); ?></div>
                        </div>

                        <div class="form-group">
                            <label for="deskripsi_biaya_lainnya">Deskripsi Biaya Lainnya <span class="text-danger font-weight-bold">*</span></label>
                            <textarea name="deskripsi_biaya_lainnya" id="deskripsi_biaya_lainnya" class="form-control <?php echo (form_error('deskripsi_biaya_lainnya') != null ? 'is-invalid' : '') ?>" cols="100" rows="4" placeholder="Deskripsi Biaya Lainnya"><?= isset($biaya_lainnya) ? $biaya_lainnya->deskripsi_biaya_lainnya : '' ?></textarea>
                            <div class="invalid-feedback"><?php echo form_error('deskripsi_biaya_lainnya'); ?></div>
                        </div>

                        <div>
                            <button id="btn-save" type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Simpan</button>
                            <a href="<?= site_url('biaya-lainnya') ?>" class="btn btn-danger"><i class="fa fa-reply"></i> Kembali</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>