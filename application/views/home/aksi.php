<section class="aksi bg-white">
    <div class="section-title">
        <div>
            <h3>Aksi</h3>
            <p>Mari bantu saudara kita di Rumah Singgah dan Sekolah Pedalaman</p>
        </div>
    </div>
    <div class="row mt-4">
        <?php foreach ($aksi as $a) { ?>
            <div class="col-xs-12 col-sm-6 col-md-4 my-2">
                <a href="<?= site_url('donasi?id=' . $a->id_aksi); ?>">
                    <div class="card h-100">
                        <img class="card-img-top" src="<?php echo base_url('assets/images/aksi/' . $a->gambar) ?>" alt="<?= $a->nama_aksi ?>">
                        <div class="card-body">
                            <div class="card-title aksi-title"><?= $a->nama_aksi ?></div>
                            <div class="card-content">
                                <div class="progress">
                                    <div class="progress-bar bg-danger" role="progressbar" style="width: 50%" aria-valuenow="<?= $a->percentage ?>" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                                <div class="aksi-content">
                                    <div>
                                        <p class="mb-2">Sisa Waktu</p>
                                        <h6 class="font-weight-bold text-danger"><?= $a->selisih_hari ?> hari</h6>
                                    </div>
                                    <div>
                                        <p class="mb-2 text-right">Terkumpul</p>
                                        <h6 class="font-weight-bold text-danger text-right"><?= 'Rp ' . number_format($a->total_donasi, 2, ',', '.');  ?></h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
        <?php } ?>
    </div>

</section>