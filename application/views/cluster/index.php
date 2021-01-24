<div class="page-breadcrumb">
    <div class="row">
        <div class="col-7 align-self-center">
            <h4 class="page-title text-truncate text-dark font-weight-medium mb-1">Cluster Relawan</h4>
            <div class="d-flex align-items-center">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb m-0 p-0">
                        <li class="breadcrumb-item"><a href="index.html" class="text-muted">Home</a></li>
                        <li class="breadcrumb-item text-muted active" aria-current="page">Cluster</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</div>
<!-- ============================================================== -->
<!-- End Bread crumb and right sidebar toggle -->
<!-- ============================================================== -->
<!-- VIEW CLUSTER -->
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Master Cluster</h4>
                    </h6>
                    <div class="table-responsive">
                        <a href="<?php echo base_url('cluster/tambah') ?>" class="btn btn-primary mb-2">Tambah Data Cluster</a>
                        <table id="master-data" class="table table-striped table-bordered no-wrap">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama Cluster</th>
                                    <th>Deskripsi</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i = 0; ?>
                                <?php
                                foreach ($cluster as $k) {
                                    if ($k->row_status == "A") {
                                ?>
                                        <tr>
                                            <td>
                                                <?php
                                                $i++;
                                                echo $i;
                                                ?>
                                            </td>
                                            <td><?= $k->nama_cluster ?></td>
                                            <td><?= $k->deskripsi_cluster ?></td>
                                            <td>
                                                <a href="<?php echo site_url('cluster/ubah/' . $k->id_cluster_relawan . '') ?>" class="btn btn-primary">Ubah</a>
                                                <a href="<?php echo site_url('cluster/hapus/' . $k->id_cluster_relawan) ?>" class="btn btn-danger" onclick="return confirm('Dengan menekan OK maka data akan dihapus (dinonaktifkan)')">Hapus</a>
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