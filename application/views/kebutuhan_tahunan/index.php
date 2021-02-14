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
                        <a href="<?= site_url('kebutuhan-tahunan/tambah') ?>" class="btn btn-primary mb-2"><i class="fa fa-plus-circle"></i> Tambah Kebutuhan Tahunan</a>
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
                                        <td align="center"><?= $kt->tahun ?></td>
                                        <td align="right"><?= "Rp " . number_format($kt->total_kebutuhan, 2, ",", "."); ?></td>
                                        <td><?php echo $kt->kt_status ?></td>
                                        <td align="center">
                                            <a href="<?= site_url('kebutuhan-tahunan/detail/' .  $kt->id) ?>" class="btn btn-secondary"><i class="fa fa-eye"></i> Detail</a>
                                            <?php if ($kt->kt_status == 'Draft') { ?>
                                            <form action="<?= site_url('kebutuhan-tahunan/kirim/' .  $kt->id) ?>" method="post" class="d-inline">
                                                <button type="submit" class="btn btn-info" onclick="return confirm('Apakah anda yakin ingin mengirim kebutuhan tahunan ini?') "><i class="fa fa-paper-plane"></i> Kirim</button>
                                            </form>
                                            <a href="<?= site_url('kebutuhan-tahunan/edit/' .  $kt->id) ?>" class="btn btn-warning"><i class="fa fa-edit"></i> Edit</a>
                                            <a href="<?= site_url('kebutuhan-tahunan/destroy/' .  $kt->id) ?>" onclick="return confirm('Apakah anda yakin ingin menghapus data ini?')" class="btn btn-danger"><i class="fa fa-trash"></i> Hapus</a>
                                            <?php } ?>

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