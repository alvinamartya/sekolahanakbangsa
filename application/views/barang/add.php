<div class="page-breadcrumb">
    <div class="row">
        <div class="col-7 align-self-center">
            <h4 class="page-title text-truncate text-dark font-weight-medium mb-1">Barang</h4>
            <div class="d-flex align-items-center">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb m-0 p-0">
                        <li class="breadcrumb-item"><a href="index.html" class="text-muted">Home</a></li>
                        <li class="breadcrumb-item"><a href="<?= site_url('barang') ?>" class="text-muted">Barang</a></li>
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
                    <form action="<?= site_url('barang/add') ?>" method="POST">
                        <div class="form-group">
                            <label for="nama_barang">Nama Barang</label>
                            <input type="text" class="form-control <?php echo (form_error('nama_barang') != null ? 'is-invalid' : '') ?>" value="<?= isset($barang) ? $barang->nama_barang : '' ?>" id="nama_barang" name="nama_barang" aria-describedby="schoolNameHelp" placeholder="Nama Barang">
                            <div class="invalid-feedback"><?php echo form_error('nama_barang'); ?></div>
                        </div>

                        <div class="form-group">
                            <label for="deskripsi_barang">Deskripsi Barang</label>
                            <textarea name="deskripsi_barang" id="deskripsi_barang" class="form-control <?php echo (form_error('deskripsi_barang') != null ? 'is-invalid' : '') ?>" cols="100" rows="4" placeholder="Deskripsi Barang"><?= isset($barang) ? $barang->deskripsi_barang : '' ?></textarea>
                            <div class="invalid-feedback"><?php echo form_error('deskripsi_barang'); ?></div>
                        </div>

                        <div>
                            <button id="btn-save" type="submit" class="btn btn-primary">Simpan</button>
                            <a href="<?= site_url('barang') ?>" class="btn btn-danger">Kembali</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>