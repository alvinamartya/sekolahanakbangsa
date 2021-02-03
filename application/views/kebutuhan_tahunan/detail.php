<div class="page-breadcrumb">
    <div class="row">
        <div class="col-7 align-self-center">
            <h4 class="page-title text-truncate text-dark font-weight-medium mb-1">Kebutuhan Tahunan</h4>
            <div class="d-flex align-items-center">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb m-0 p-0">
                        <li class="breadcrumb-item"><a href="index.html" class="text-muted">Home</a></li>
                        <li class="breadcrumb-item"><a href="<?php echo base_url('kebutuhan-tahunan') ?>" class="text-muted">Kebutuhan Tambahan</a></li>
                        <li class="breadcrumb-item text-muted active" aria-current="page">Index</li>
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


    <div class="card">
        <div class="card-body">
            <h4 class="card-title">Kebutuhan Tahunan</h4>
            <div class="row">
                <div class="col-md-2">
                    <label class="form-control">Tahun : <?= $kebutuhan_tahunan->tahun ?><label>
                </div>
                <div class="col">
                    <label class="form-control">Sekolah / Rumah singgah : <?= $sekolah->nama_sekolah ?><label>
                </div>
            </div>
        </div>
    </div>
    <!-- Deskripsi Kebutuhan tahunan -->
    <?php if($kebutuhan_tahunan->is_approved == 'Y') { ?>
    <div class="row">
        <div class="col-md-6 d-flex align-self-stretch">
            <div class="card w-100">
                <div class="card-body">
                    <h4 class="card-title">Deskripsi Kebutuhan Tahunan</h4>
                    <label class="form-label">
                        <?= $kebutuhan_tahunan->deskripsi ?>
                    </label>
                </div>
            </div>
        </div>
        <div class="col-md-6 d-flex align-self-stretch">
            <div class="card w-100">
                <div class="card-body">
                    <h4 class="card-title">Unggah Laporan Pertanggungjawaban</h4>
                    <?php if ($this->session->flashdata('success')) { ?>
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <?= $this->session->flashdata('success') ?>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    <?php } ?>

                    <?php if($this->session->flashdata('failed')){ ?>
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <?= $this->session->flashdata('failed') ?>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    <?php } ?>
                    <form action="<?= site_url('kebutuhan_tahunan/unggahlpj/'.$kebutuhan_tahunan->id) ?>" method="POST" enctype="multipart/form-data">
                        <div class="form-group">
                            <?php if($kebutuhan_tahunan->laporan_pertanggung_jawaban != null) { ?>
                                <label for="upload">Laporan Pertanggungjawaban (<a href="<?= site_url('assets/lpj/'. $kebutuhan_tahunan->laporan_pertanggung_jawaban) ?>"><?= $kebutuhan_tahunan->laporan_pertanggung_jawaban ?></a>)</label><br>
                            <?php } else { ?>
                                <label for="upload">Laporan Pertanggungjawaban</label><br>
                            <?php } ?>
                            <input type="file" name="lpj" required>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">Unggah</button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
    <?php } else { ?>
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">Deskripsi Kebutuhan Tahunan</h4>
            <label class="form-label">
                <?= $kebutuhan_tahunan->deskripsi ?>
            </label>
        </div>
    </div>

    <?php } ?>
    <!-- KT Biaya -->
    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Kebutuhan Tahunan Biaya</h4>
                    <div class="table-responsive">
                        <table id="biaya-table" class="table table-striped table-bordered no-wrap">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama Biaya</th>
                                    <th>Biaya</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i = 1; ?>
                                <?php foreach ($kt_biaya_lainnya as $kt) { ?>
                                    <tr>
                                        <td><?= $i ?>.</td>
                                        <td>
                                            <?php
                                            foreach ($biaya_lainnya as $bl) {
                                                if ($bl->id_biaya_lainnya == $kt->id_biaya_lainnya) {
                                                    echo $bl->nama_biaya_lainnya;
                                                }
                                            }
                                            ?>
                                        </td>
                                        <td>
                                            <?php echo 'Rp ' . number_format($kt->biaya, 2, ',', '.'); ?>
                                        </td>
                                    </tr>
                                <?php $i++;
                                } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <!-- KT Barang -->
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Kebutuhan Tahunan Barang</h4>
                    <div class="table-responsive">
                        <table id="barang-table" class="table table-striped table-bordered no-wrap">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama Barang</th>
                                    <th>Jumlah</th>
                                    <th>Harga Satuan</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i = 1; ?>
                                <?php foreach ($kt_barang as $kt) { ?>
                                    <tr>
                                        <td><?= $i ?>.</td>
                                        <td>
                                            <?php foreach ($barang as $b) {
                                                if ($b->id_barang == $kt->id_barang) {
                                                    echo $b->nama_barang;
                                                }
                                            } ?>
                                        </td>
                                        <td><?= $kt->jumlah ?></td>
                                        <td>
                                            <?php echo 'Rp ' . number_format($kt->harga_satuan, 2, ',', '.'); ?>
                                        </td>
                                    </tr>
                                <?php $i++;
                                } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12 d-flex justify-content-between">
            <h3 class="text-danger font-weight-bold">Total Kebutuhan : <?php echo 'Rp ' . number_format($kebutuhan_tahunan->total_kebutuhan, 2, ',', '.'); ?></h3>
        </div>
    </div>
    <br>
    <div class="row">
        <div class="col-md-1">
            <a href="<?php echo base_url("kebutuhan-tahunan") ?>" class="btn btn-secondary">Kembali</a>
        </div>
    </div>
</div>

<!-- footer -->
<!-- ============================================================== -->
<!-- ============================================================== -->
<!-- End footer -->
<!-- ============================================================== -->
</div>