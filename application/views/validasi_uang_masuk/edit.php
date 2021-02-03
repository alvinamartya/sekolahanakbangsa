<div class="page-breadcrumb">
    <div class="row">
        <div class="col-7 align-self-center">
            <h4 class="page-title text-truncate text-dark font-weight-medium mb-1">Validasi Uang Masuk</h4>
            <div class="d-flex align-items-center">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb m-0 p-0">
                        <li class="breadcrumb-item"><a href="index.html" class="text-muted">Home</a></li>
                        <li class="breadcrumb-item"><a href="<?= site_url('validasi_uang_masuk') ?>" class="text-muted">View Data</a></li>
                        <li class="breadcrumb-item text-muted active" aria-current="page">Cek Valid</li>
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
            <form method="post" action="<?php echo base_url('validasi_uang_masuk/edit/' . $donatur_aksi->id) ?>" autocomplete="off">
                <div class="form-group">
                    <label for="nik">Nama Aksi : </label>
                    <?php foreach ($data_aksi as $data2) { ?>
                        <?php
                            if($data2->id_aksi == $donatur_aksi->id_aksi){
                                echo $data2->nama_aksi;
                            }
                        ?>
                    <?php } ?>
                </div>

                <div class="form-group">
                    <label for="nama_relawan">Nama Donatur : </label>
                    <?php foreach ($donatur as $d) { ?>
                        <?php
                            if($d->id_donatur == $donatur_aksi->id_donatur){
                                echo $d->nama_donatur;
                            }
                        ?>
                    <?php } ?>
                </div>

                <div class="form-group">
                    <label for="nama_relawan">Pesan : </label>
                    <?= $donatur_aksi->keterangan ?>
                </div>

                <div class="form-group">
                    <label for="nama_relawan">Bukti Transfer : </label><br>
                        <?php
                            if($donatur_aksi->bukti_transfer != null ){
                                ?>
                                <img class="d-block w-30" src="<?php echo base_url('assets/images/bukti_transfer/' . $donatur_aksi->bukti_transfer) ?>" alt="First slide">
                            <?php
                            }
                        ?>
                </div>

                <div class="form-group">
                    <label for="Y" class="d-block">Cek Valid</label>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" id="Y" name="is_valid" value="Y" <?= ($donatur_aksi->is_valid == 'Y' ? 'checked' : '') ?>>
                        <label class="form-check-label" for="Y">Valid</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" id="N" name="is_valid" value="N" <?= ($donatur_aksi->is_valid == 'N' ? 'checked' : '') ?>>
                        <label class="form-check-label" for="N">No Valid</label>
                    </div>
                    <small class="text-danger"><?php echo form_error('is_valid') ?></small>
                </div>

                <div>
                    <button id="btn-save" type="submit" class="btn btn-primary">Perbarui</button>
                    <a href="<?= site_url('validasi_uang_masuk') ?>" class="btn btn-danger">Kembali</a>
                </div>
            </form>
        </div>
    </div>
</div>