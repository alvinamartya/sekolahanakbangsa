<div class="page-breadcrumb">
    <div class="row">
        <div class="col-7 align-self-center">
            <h4 class="page-title text-truncate text-dark font-weight-medium mb-1">Sekolah</h4>
            <div class="d-flex align-items-center">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb m-0 p-0">
                        <li class="breadcrumb-item"><a href="index.html" class="text-muted">Home</a></li>
                        <li class="breadcrumb-item text-muted active" aria-current="page">Sekolah</li>
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
                    <h4 class="card-title">Master Sekolah</h4>
                    <?php if ($this->session->flashdata('success')) { ?>
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <?= $this->session->flashdata('success') ?>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    <?php } ?>
                    <div class="table-responsive">
                        <a href="<?= site_url('sekolah/tambah') ?>" class="btn btn-primary mb-2">Tambah Data Sekolah</a>
                        <table id="master-data" class="table table-striped table-bordered no-wrap">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama Sekolah</th>
                                    <th>Jenis Sekolah</th>
                                    <th>Alamat Sekolah</th>
                                    <th>Provinsi</th>
                                    <th>Kota</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i = 0; ?>
                                <?php foreach ($sekolah as $s) { ?>
                                    <tr>
                                        <td>
                                            <?php
                                            $i++;
                                            echo $i;
                                            ?>
                                        </td>
                                        <td><?= $s->nama_sekolah ?></td>
                                        <td><?= $s->jenis_sekolah ?></td>
                                        <td><?= $s->alamat ?></td>
                                        <td><?= $s->provinsi ?></td>
                                        <td><?= $s->kota ?></td>
                                        <td>
                                            <a href="<?= site_url('sekolah/ubah/' .  $s->id_sekolah) ?>" class="btn btn-primary"><i class="fa fa-edit"></i> Ubah</a>
                                            <a href="<?= site_url('sekolah/destroy/' .  $s->id_sekolah) ?>" onclick="return confirm('Apakah anda yakin ingin menghapus data ini?')" class="btn btn-danger"><i class="fa fa-trash"></i> Hapus</a>
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