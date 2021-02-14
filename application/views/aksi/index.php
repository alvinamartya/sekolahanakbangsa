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
                    <h4 class="card-title text-center" style="font-size: 28px;">Transaksi Aksi Galang Dana</h4>
                    <?php if ($this->session->flashdata('success')) { ?>
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <?= $this->session->flashdata('success') ?>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    <?php } ?>
                    <div class="table-responsive">
                        <a href="<?= site_url('aksi/tambah') ?>" class="btn btn-primary mb-2"><i class="fa fa-plus-circle"></i> Tambah Aksi</a>
                        <table id="master-data" class="table table-striped table-bordered no-wrap">
                            <thead>
                                <tr>
                                    <th class="text-center">No.</th>
                                    <th class="text-center">Nama Aksi</th>
                                    <th class="text-center">Target Donasi</th>
                                    <th class="text-center">Tanggal Selesai</th>
                                    <th class="text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $no = 1; ?>
                                <?php foreach ($aksi as $d) { ?>
                                    <tr>
                                        <td><?= $no++ ?></td>
                                        <td><?= $d->nama_aksi ?></td>
                                        <td align="right"><?= "Rp " . number_format($d->target_donasi, 2, ",", "."); ?></td>
                                        <td align="center"><?= date('d-m-Y', strtotime($d->tanggal_selesai)) ?></td>
                                        <td align="center">
                                            <a href="<?= site_url('aksi/ubah/' .  $d->id_aksi) ?>" class="btn btn-warning"><i class="fa fa-edit"></i> Edit</a>
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