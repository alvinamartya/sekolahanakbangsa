<div class="page-breadcrumb">
    <div class="row">
        <div class="col-7 align-self-center">
            <h4 class="page-title text-truncate text-dark font-weight-medium mb-1">Relawan</h4>
            <div class="d-flex align-items-center">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb m-0 p-0">
                        <li class="breadcrumb-item"><a href="index.html" class="text-muted">Home</a></li>
                        <li class="breadcrumb-item"><a href="<?= site_url('relawan') ?>" class="text-muted">Relawan</a></li>
                        <li class="breadcrumb-item text-muted active" aria-current="page">Ubah</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</div>
<!-- ============================================================== -->
<!-- End Bread crumb and right sidebar toggle -->
<!-- ============================================================== -->
<!-- EDIT CLUSTER -->
<div class="container-fluid">
    <div class="card">
        <div class="card-body">
            <form method="post" action="<?php echo base_url('relawan/edit/' . $r->id_relawan) ?>" autocomplete="off">
                <div class="form-group">
                    <label for="nik">NIK Relawan</label>
                    <input type="number" class="form-control <?php echo (form_error('nik') != null ? 'is-invalid' : '') ?>" id="nik" name="nik" placeholder="NIK Relawan" value="<?= $r->nik ?>">
                    <div class="invalid-feedback"><?php echo form_error('nik'); ?></div>
                </div>

                <div class="form-group">
                    <label for="nama_relawan">Nama Relawan</label>
                    <input type="text" class="form-control <?php echo (form_error('nama_relawan') != null ? 'is-invalid' : '') ?>" id="nama_relawan" name="nama_relawan" placeholder="Nama Relawan" value="<?= $r->nama_relawan ?>">
                    <div class="invalid-feedback"><?php echo form_error('nama_relawan'); ?></div>
                </div>

                <div class="form-group">
                    <label for="id_cluster_relawan">Cluster</label>
                    <select name="id_cluster_relawan" id="id_cluster_relawan" class="form-control <?php echo (form_error('id_cluster_relawan') != null ? 'is-invalid' : '') ?>">
                        <?php foreach ($cluster as $c) { ?>
                            <option value="<?= $c->id_cluster_relawan ?>" <?= $c->id_cluster_relawan == $r->id_cluster_relawan ? 'selected' : '' ?>>
                                <?= $c->nama_cluster ?>
                            </option>
                        <?php } ?>
                    </select>
                    <div class="invalid-feedback"><?php echo form_error('id_cluster_relawan'); ?></div>
                </div>

                <div class="form-group">
                    <label for="L" class="d-block">Jenis Kelamin</label>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" id="L" name="jenis_kelamin" value="L" <?= ($r->jenis_kelamin == 'L' ? 'checked' : '') ?>>
                        <label class="form-check-label" for="L">Laki-laki</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" id="P" name="jenis_kelamin" value="P" <?= ($r->jenis_kelamin == 'P' ? 'checked' : '') ?>>
                        <label class="form-check-label" for="P">Perempuan</label>
                    </div>
                    <small class="text-danger"><?php echo form_error('jenis_kelamin') ?></small>
                </div>

                <div class="form-group">
                    <label for="no_telepon">No. Telepon</label>
                    <input type="number" id="no_telepon" class="form-control <?php echo (form_error('no_telepon') != null ? 'is-invalid' : '') ?>" name="no_telepon" value="<?= $r->no_telepon ?>">
                    <div class="invalid-feedback"><?php echo form_error('no_telepon'); ?></div>
                </div>

                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="text" id="email" class="form-control <?php echo (form_error('email') != null ? 'is-invalid' : '') ?>" name="email" value="<?= $r->email ?>">
                    <div class="invalid-feedback"><?php echo form_error('email'); ?></div>
                </div>

                <div class="form-group">
                    <label for="tempat_lahir">Tempat lahir</label>
                    <input type="text" id="tempat_lahir" name="tempat_lahir" class="form-control <?php echo (form_error('tempat_lahir') != null ? 'is-invalid' : '') ?>" name="tempat_lahir" value="<?= $r->tempat_lahir ?>">
                    <div class="invalid-feedback"><?php echo form_error('tempat_lahir'); ?></div>
                </div>

                <div class="form-group">
                    <label for="tanggal_lahir">Tanggal lahir</label>
                    <input type="date" id="tanggal_lahir" name="tanggal_lahir" class="form-control <?php echo (form_error('tanggal_lahir') != null ? 'is-invalid' : '') ?>" value="<?= date_format(date_create($r->tanggal_lahir), "Y-m-d")  ?>">
                    <div class="invalid-feedback"><?php echo form_error('tanggal_lahir'); ?></div>
                </div>

                <div>
                    <button id="btn-save" type="submit" class="btn btn-primary">Perbarui</button>
                    <a href="<?= site_url('relawan') ?>" class="btn btn-danger">Kembali</a>
                </div>
            </form>
        </div>
    </div>
</div>