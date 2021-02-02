<div class="page-breadcrumb">
    <div class="row">
        <div class="col-7 align-self-center">
            <h4 class="page-title text-truncate text-dark font-weight-medium mb-1">Karyawan</h4>
            <div class="d-flex align-items-center">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb m-0 p-0">
                        <li class="breadcrumb-item"><a href="index.html" class="text-muted">Home</a></li>
                        <li class="breadcrumb-item text-muted active" aria-current="page">Karyawan</li>
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
    <!-- Karyawan -->
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <?php if ($this->session->flashdata('success')) { ?>
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <?= $this->session->flashdata('success') ?>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    <?php } ?>
                    <h4 class="card-title text-center" style="font-size: 28px;">Master Karyawan</h4>
                    </h6>
                    <div class="table-responsive">
                        <a href="<?php echo base_url('karyawan/tambah') ?>" class="btn btn-primary mb-2">Tambah Data Karyawan</a>
                        <table id="master-data" class="table table-striped table-bordered no-wrap">
                            <thead>
                                <tr>
                                    <th class="text-center">No</th>
                                    <th class="text-center">Nama karyawan</th>
                                    <th class="text-center">Jabatan</th>
                                    <th class="text-center">Jenis kelamin</th>
                                    <th class="text-center">No telepon</th>
                                    <th class="text-center">Email</th>
                                    <th class="text-center">Tempat lahir</th>
                                    <th class="text-center">Tanggal lahir</th>
                                    <th class="text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i = 0; ?>
                                <?php
                                foreach ($karyawan as $k) {
                                    if ($k->row_status == "A") {
                                ?>
                                        <tr>
                                            <td>
                                                <?php
                                                $i++;
                                                echo $i;
                                                ?>
                                            </td>
                                            <td><?= $k->nama_karyawan ?></td>
                                            <td><?= $k->jabatan_karyawan ?></td>
                                            <td>
                                                <?php
                                                if ($k->jenis_kelamin == "L") {
                                                    echo "Laki-laki";
                                                } else {
                                                    echo "Perempuan";
                                                }
                                                ?>
                                            </td>
                                            <td><?= $k->no_telepon ?></td>
                                            <td><?= $k->email ?></td>
                                            <td><?= $k->tempat_lahir ?></td>
                                            <td><?= date("d/m/Y", strtotime($k->tanggal_lahir)) ?></td>
                                            <td align="center">
                                                <a href="<?php echo base_url('karyawan/ubah/' . $k->id_karyawan . '') ?>" class="btn btn-primary"><i class="fa fa-edit"></i> Ubah</a>
                                                <a href="<?php echo base_url('karyawan/hapus/' . $k->id_karyawan) ?>" class="btn btn-danger" onclick="return confirm('Dengan menekan OK maka data akan dihapus (dinonaktifkan)')"><i class="fa fa-trash"></i> Hapus</a>
                                            </td>
                                        </tr>
                                <?php
                                    }
                                } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>