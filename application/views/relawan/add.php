<div class="page-breadcrumb">
    <div class="row">
        <div class="col-7 align-self-center">
            <h4 class="page-title text-truncate text-dark font-weight-medium mb-1">Relawan</h4>
            <div class="d-flex align-items-center">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb m-0 p-0">
                        <li class="breadcrumb-item"><a href="index.html" class="text-muted">Home</a></li>
                        <li class="breadcrumb-item"><a href="<?= site_url('relawan') ?>" class="text-muted">Relawan</a></li>
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
                    <form action="<?= site_url('relawan/add') ?>" method="POST">
                        <div class="form-group">
                            <label for="nama_relawan">Nama Relawan</label>
                            <input type="text" class="form-control <?php echo (form_error('nama_relawan') != null ? 'is-invalid' : '') ?>" id="nama_relawan" name="nama_relawan" aria-describedby="schoolNameHelp" value="<?php echo set_value('nama_relawan'); ?>" placeholder="Nama Relawan">
                            <div class="invalid-feedback"><?php echo form_error('nama_relawan'); ?></div>
                        </div>

                        <div class="form-group">
                            <label for="nik">NIK</label>
                            <input type="text" class="form-control <?php echo (form_error('nik') != null ? 'is-invalid' : '') ?>" id="nik" name="nik" aria-describedby="schoolNameHelp" value="<?php echo set_value('nik'); ?>" placeholder="NIK">
                            <div class="invalid-feedback"><?php echo form_error('nik'); ?></div>
                        </div>

                        <div class="form-group">
                            <label for="no_telepon">No Telepon</label>
                            <input type="text" class="form-control <?php echo (form_error('no_telepon') != null ? 'is-invalid' : '') ?>" id="no_telepon" name="no_telepon" aria-describedby="schoolNameHelp" value="<?php echo set_value('no_telepon'); ?>" placeholder="No Telepon">
                            <div class="invalid-feedback"><?php echo form_error('no_telepon'); ?></div>
                        </div>

                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="text" class="form-control <?php echo (form_error('email') != null ? 'is-invalid' : '') ?>" id="email" name="email" aria-describedby="schoolNameHelp" value="<?php echo set_value('email'); ?>" placeholder="Email ">
                            <div class="invalid-feedback"><?php echo form_error('email'); ?></div>
                        </div>

                        <div class="form-group">
                            <label for="tempat_lahir">Tempat Lahir</label>
                            <textarea name="tempat_lahir" id="tempat_lahir" class="form-control <?php echo (form_error('tempat_lahir') != null ? 'is-invalid' : '') ?>" cols="100" rows="4" value="<?php echo set_value('tempat_lahir'); ?>" placeholder="Tempat Lahir"></textarea>
                            <div class="invalid-feedback"><?php echo form_error('tempat_lahir'); ?></div>
                        </div>

                        <div class="form-group">
                            <label for="tanggal_lahir">Tanggal lahir</label>
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
                            <a href="<?= site_url('relawan') ?>" class="btn btn-danger">Batal</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>