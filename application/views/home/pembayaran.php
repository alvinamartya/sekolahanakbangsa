
    <section class="bg-gray section-page mb-5 container">
        <div class="row mt-5">
            <div class="col-md-12">
                <div class="card shadow-sm mb-4">
                    <div class="card-body d-flex align-items-center">
                        <h3 class="card-title mb-0 ml-4 font-weight-bold text-center"><?= $data_aksi->nama_aksi ?></h3>
                    </div>
                </div>

                <div class="card shadow-sm">
                    <div class="card-body">
                        <form action="<?= site_url('donasi/add/' . $data_aksi->id_aksi) ?>" method="POST">
                            <div class="form-group">
                                <label for="nominal">Nominal Donasi</label>
                                <input type="text" class="priceformat form-control <?php echo (form_error('donasi') != null ? 'is-invalid' : '') ?>" id="donasi" name="donasi" aria-describedby="schoolNameHelp" value="<?php echo set_value('donasi'); ?>" placeholder="Rp. " required>
                                <div class="invalid-feedback"><?php echo form_error('donasi'); ?></div>
                            </div>

                            <div class="form-group">
                                <label for="pesan">Pesan</label>
                                <textarea name="keterangan" id="keterangan" class="form-control <?php echo (form_error('keterangan') != null ? 'is-invalid' : '') ?>" rows="10" placeholder="Tulis Keterangan / Pesan" value="<?php echo set_value('keterangan'); ?>"><?= isset($barang) ? $barang->keterangan : '' ?></textarea>
                                <div class="invalid-feedback"><?php echo form_error('keterangan'); ?></div>
                            </div>
                            <div class="mt-3 row">
                                <div class="col-md-6">
                                    <a href="<?= site_url('donasi?id='. $idkembali) ?>" class="btn btn-warning btn-lg font-weight-bold mt-3 d-block w-100"><i class="fa fa-chevron-left mr-2"></i> Kembali</a>
                                    <!-- <button type="submit" class="btn btn-warning btn-lg font-weight-bold mt-3 d-block w-100"><i class="fa fa-chevron-left mr-2"></i> Kembali</button> -->
                                </div>
                                <div class="col-md-6 pl-0">
                                    <button type="submit" class="btn btn-danger btn-lg font-weight-bold mt-3 d-block w-100">Lanjut ke Pembayaran <i class="fa fa-chevron-right ml-2"></i></button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>