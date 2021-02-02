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
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title text-center" style="font-size: 28px;">Transaksi Kebutuhan Tahunan</h4>
                    <?php if ($this->session->flashdata('success')) { ?>
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <?= $this->session->flashdata('success') ?>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    <?php } else if ($this->session->flashdata('failed')) { ?>
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <?= $this->session->flashdata('failed') ?>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    <?php } ?>
                    <div class="table-responsive">
                        <a href="<?= site_url('kebutuhan-tahunan/tambah') ?>" class="btn btn-primary mb-2">Tambah</a>
                        <table id="master-data" class="table table-striped table-bordered no-wrap">
                            <thead>
                                <tr>
                                    <th class="text-center">No.</th>
                                    <th class="text-center">Tahun</th>
                                    <th class="text-center">Total Kebutuhan</th>
                                    <th class="text-center">Status</th>
                                    <th class="text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $no = 1; ?>
                                <?php foreach ($kebutuhan_tahunan as $kt) { ?>
                                    <tr>
                                        <td><?= $no++ ?></td>
                                        <td><?= $kt->tahun ?></td>
                                        <td><?= "Rp" . number_format($kt->total_kebutuhan, 0, ",", "."); ?></td>
                                        <td><?php
                                            if ($kt->is_approved == null) {
                                                echo 'Menunggu Persetujuan';
                                            } else if ($kt->is_approved == 'Y') {
                                                echo 'Disetujui';
                                            } else if ($kt->is_approved == 'N') {
                                                echo 'Ditolak';
                                            }
                                            ?></td>
                                        <td align="center">
                                            <a href="<?= site_url('kebutuhan_tahunan/detail/' .  $kt->id) ?>" class="btn btn-primary"><i class="fa fa-eye"></i> Detail</a>
                                            <a href="<?= site_url('kebutuhan_tahunan/destroy/' .  $kt->id) ?>" onclick="return confirm('Apakah anda yakin ingin menghapus data ini?')" class="btn btn-danger"><i class="fa fa-trash"></i> Hapus</a>
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
</div>