<div class="page-breadcrumb">
    <div class="row">
        <div class="col-7 align-self-center">
            <h4 class="page-title text-truncate text-dark font-weight-medium mb-1">Validasi Uang Masuk</h4>
            <div class="d-flex align-items-center">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb m-0 p-0">
                        <li class="breadcrumb-item"><a href="index.html" class="text-muted">Home</a></li>
                        <li class="breadcrumb-item text-muted active" aria-current="page">View Data</li>
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
                    <h4 class="card-title text-center" style="font-size: 28px;">Validasi Uang Masuk</h4>
                    <?php if ($this->session->flashdata('success')) { ?>
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <?= $this->session->flashdata('success') ?>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    <?php } ?>
                    <div class="table-responsive">
                        <table id="master-data" class="table table-striped table-bordered no-wrap">
                            <thead>
                                <tr>
                                    <th class="text-center">No</th>
                                    <th class="text-center">Aksi</th>
                                    <th class="text-center">Nama donatur</th>
                                    <th class="text-center">Nominal</th>
                                    <th class="text-center">Keterangan</th>
                                    <th class="text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i = 0; ?>
                                <?php foreach ($donatur_aksi as $da) { ?>
                                    <tr>
                                        <td>
                                            <?php
                                            $i++;
                                            echo $i;
                                            ?>
                                        </td>
                                        <td>
                                            <?php foreach ($data_aksi as $data2) { ?>
                                                <?php
                                                    if($data2->id_aksi == $da->id_aksi){
                                                        echo $data2->nama_aksi;
                                                    }
                                                ?>
                                            <?php } ?>
                                        </td>
                                        <td>
                                            <?php foreach ($donatur as $d) { ?>
                                                <?php
                                                    if($d->id_donatur == $da->id_donatur){
                                                        echo $d->nama_donatur;
                                                    }
                                                ?>
                                            <?php } ?>
                                        </td>
                                        <td><?= "Rp" . number_format($da->donasi, 2, ",", "."); ?></td>
                                        <td><?= $da->keterangan ?></td>
                                        <td align="center">
                                            <a href="<?= site_url('validasi_uang_masuk/ubah/' .  $da->id) ?>" class="btn btn-primary"><i class="fa fa-edit"></i> Ubah</a>
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