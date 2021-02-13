<div class="page-breadcrumb">
    <div class="row">
        <div class="col-7 align-self-center">
            <h4 class="page-title text-truncate text-dark font-weight-medium mb-1">Pengelolaan SDM</h4>
            <div class="d-flex align-items-center">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb m-0 p-0">
                        <li class="breadcrumb-item"><a href="index.html" class="text-muted">Home</a></li>
                        <li class="breadcrumb-item"><a href="<?= site_url('sdm_relawan') ?>" class="text-muted">Pengelolaan SDM</a></li>
                        <li class="breadcrumb-item text-muted active" aria-current="page">Tambah Sekolah</li>
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
            <form method="post" action="<?php echo base_url('sdm_relawan/edit/' . $r->id_relawan) ?>" autocomplete="off">

                <div class="form-group">
                    <label for="nama_relawan">Nama Relawan</label>
                    <input type="text" class="form-control <?php echo (form_error('nama_relawan') != null ? 'is-invalid' : '') ?>" id="nama_relawan" name="nama_relawan" placeholder="Nama Relawan" value="<?= $r->nama_relawan ?>" readonly>
                    <div class="invalid-feedback"><?php echo form_error('nama_relawan'); ?></div>
                </div>

                <div class="form-group">
                    <label for="id_sekolah">Sekolah</label>
                    <select name="id_sekolah" id="id_sekolah" class="form-control">
                        <?php if($r->id_sekolah==null){
                            ?>
                                <option value="" hidden>Pilih Sekolah</option>
                            <?php
                        } ?>

						<?php foreach ($sekolah as $s) { ?>
							<option value="<?= $s->id_sekolah ?>" <?= $s->id_sekolah == $r->id_sekolah ? "selected" : "" ?>>
								<?= $s->nama_sekolah ?>
							</option>
						<?php } ?>
					</select>
                </div>

                <div>
                    <button id="btn-save" type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Simpan</button>
                    <a href="<?= site_url('sdm_relawan') ?>" class="btn btn-danger"><i class="fa fa-reply"></i> Kembali</a>
                </div>
            </form>
        </div>
    </div>
</div>