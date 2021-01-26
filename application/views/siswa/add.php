<div class="page-breadcrumb">
    <div class="row">
        <div class="col-7 align-self-center">
            <h4 class="page-title text-truncate text-dark font-weight-medium mb-1">Siswa</h4>
            <div class="d-flex align-items-center">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb m-0 p-0">
                        <li class="breadcrumb-item"><a href="index.html" class="text-muted">Home</a></li>
                        <li class="breadcrumb-item"><a href="<?= site_url('siswa') ?>" class="text-muted">Siswa</a></li>
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
                    <form action="<?= site_url('siswa/add') ?>" method="POST">
                        <div class="form-group">
                            <label for="nama_siswa">Nama Siswa</label>
                            <input type="text" class="form-control <?php echo (form_error('nama_siswa') != null ? 'is-invalid' : '') ?>" id="nama_siswa" name="nama_siswa" aria-describedby="schoolNameHelp" value="<?php echo set_value('nama_siswa'); ?>" placeholder="Nama Siswa">
                            <div class="invalid-feedback"><?php echo form_error('nama_siswa'); ?></div>
                        </div>

                        <div class="form-group">
                            <label for="nisn">NISN</label>
                            <input type="text" class="form-control <?php echo (form_error('nisn') != null ? 'is-invalid' : '') ?>" id="nisn" name="nisn" aria-describedby="schoolNameHelp" value="<?php echo set_value('nisn'); ?>" placeholder="NISN">
                            <div class="invalid-feedback"><?php echo form_error('nisn'); ?></div>
                        </div>

                        <div class="form-group">
                            <label for="tempat_lahir">Tempat Lahir</label>
                            <textarea name="tempat_lahir" id="tempat_lahir" class="form-control <?php echo (form_error('tempat_lahir') != null ? 'is-invalid' : '') ?>" cols="100" rows="4" value="<?php echo set_value('tempat_lahir'); ?>" placeholder="Tempat Lahir"></textarea>
                            <div class="invalid-feedback"><?php echo form_error('tempat_lahir'); ?></div>
                        </div>

                        <div class="form-group">
                            <label for="tempat_lahir">Tanggal lahir</label>
                            <input type="date" name="tanggal_lahir" class="form-control" value="<?php echo set_value('tanggal_lahir'); ?>" required><br>
                        </div>

                        <div class="form-group">
                            <label for="" class="d-block">Jenis Kelamin</label>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" id="L" name="jenis_kelamin" value="L" <?php echo (set_value('jenis_kelamin') == 'L' ? 'checked' : '') ?>>
                                <label class="form-check-label" for="L">Laki-laki</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" id="P" name="jenis_kelamin" value="P" <?php echo (set_value('jenis_kelamin') == 'P' ? 'checked' : '') ?>>
                                <label class="form-check-label" for="P">Perempuan</label>
                            </div>
                        </div>

                        <div>
                            <button id="btn-save" type="submit" class="btn btn-primary">Simpan</button>
                            <a href="<?= site_url('siswa') ?>" class="btn btn-danger">Batal</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>