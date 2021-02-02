<div class="page-breadcrumb">
    <div class="row">
        <div class="col-7 align-self-center">
            <h4 class="page-title text-truncate text-dark font-weight-medium mb-1">Relawan</h4>
            <div class="d-flex align-items-center">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb m-0 p-0">
                        <li class="breadcrumb-item"><a href="index.html" class="text-muted">Home</a></li>
                        <li class="breadcrumb-item text-muted active" aria-current="page">Relawan</li>
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
                    <h4 class="card-title text-center" style="font-size: 28px;">Master Relawan</h4>
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
                                    <th class="text-center">NIK</th>
                                    <th class="text-center">Nama Relawan</th>
                                    <th class="text-center">Jenis Kelamin</th>
                                    <th class="text-center">No Telepon</th>
                                    <th class="text-center">Email</th>
                                    <th class="text-center">Tempat Lahir</th>
                                    <th class="text-center">Tanggal Lahir</th>
                                    <th class="text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i = 0; ?>
                                <?php foreach ($relawan as $r) { ?>
                                    <tr>
                                        <td>
                                            <?php
                                            $i++;
                                            echo $i;
                                            ?>
                                        </td>
                                        <td><?= $r->nik ?></td>
                                        <td><?= $r->nama_relawan ?></td>
                                        <td><?= $r->jenis_kelamin == "L" ? "Laki-Laki" : "Perempuan" ?></td>
                                        <td><?= $r->no_telepon ?></td>
                                        <td><?= $r->email ?></td>
                                        <td><?= $r->tempat_lahir ?></td>
                                        <td><?= date_format(date_create($r->tanggal_lahir), "d/m/Y")   ?></td>
                                        <td align="center">
                                            <a href="<?= site_url('relawan/ubah/' .  $r->id_relawan) ?>" class="btn btn-primary"><i class="fa fa-edit"></i> Ubah</a>
                                            <a href="<?= site_url('relawan/destroy/' .  $r->id_relawan) ?>" onclick="return confirm('Apakah anda yakin ingin menghapus data ini?')" class="btn btn-danger"><i class="fa fa-trash"></i> Hapus</a>
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