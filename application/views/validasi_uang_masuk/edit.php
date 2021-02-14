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
            <h4 class="card-title" style="font-size: 28px;">Detail Donasi</h4>
            <form method="post" action="<?php echo base_url('validasi_uang_masuk/edit/' . $donatur_aksi->id) ?>" autocomplete="off">
                <table class="table table-sm table-borderless mb-0">
                    <tbody>
                        <tr>
                            <th class="pl-0 w-25" scope="row"><strong>Nama Aksi</strong></th>
                            <td><?= $donatur_aksi->nama_aksi ?></td>
                        </tr>
                        <tr>
                            <th class="pl-0 w-25" scope="row"><strong>Nama Donatur</strong></th>
                            <td><?= $donatur_aksi->nama_donatur ?></td>
                        </tr>
                        <tr>
                            <th class="pl-0 w-25" scope="row"><strong>Pesan</strong></th>
                            <td><?= $donatur_aksi->keterangan ?></td>
                        </tr>
                    </tbody>
                </table>

                <div class="form-group">
                    <label for="nama_relawan"><strong> Bukti Transfer</strong> </label><br>
                    <?php if ($donatur_aksi->bukti_transfer != null) { ?>
                        <a href="" data-toggle="modal" data-target=".bd-example-modal-lg">
                            <img class="d-block w-25" src="<?php echo base_url('assets/images/bukti_transfer/' . $donatur_aksi->bukti_transfer) ?>" alt="First slide">
                        </a>
                    <?php } ?>
                </div>

                <div class="form-group">
                    <label for="Y" class="d-block">Cek Valid</label>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" id="Y" name="is_valid" value="Y" <?= ($donatur_aksi->is_valid == 'Y' ? 'checked' : '') ?>>
                        <label class="form-check-label" for="Y">Valid</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" id="N" name="is_valid" value="N" <?= ($donatur_aksi->is_valid == 'N' ? 'checked' : '') ?>>
                        <label class="form-check-label" for="N">Tidak Valid</label>
                    </div>
                    <small class="text-danger"><?php echo form_error('is_valid') ?></small>
                </div>

                <div>
                    <button id="btn-save" type="submit" class="btn btn-primary"><i class="fa fa-pencil-alt"></i> Perbarui</button>
                    <a href="<?= site_url('validasi_uang_masuk') ?>" class="btn btn-danger"><i class="fa fa-reply"></i> Kembali</a>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalCenterTitle">Bukti Transfer</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-content">
            <span class="zoom zoom-image">
                <img class="d-block w-100" src="<?php echo base_url('assets/images/bukti_transfer/' . $donatur_aksi->bukti_transfer) ?>" alt="First slide">
            </span>
        </div>
    </div>
  </div>
</div>