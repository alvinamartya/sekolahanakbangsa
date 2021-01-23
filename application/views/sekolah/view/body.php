<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Data Sekolah</h4>
                </h6>
                <div class="table-responsive">
                    <a href="<?= site_url('sekolah/tambah') ?>" class="btn btn-primary mb-2">Tambah Data Sekolah</a>
                    <table id="school_table" class="table table-striped table-bordered no-wrap">
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
                                        <a href="" class="btn btn-primary">Ubah</a>
                                        <a href="" class="btn btn-danger" data-toggle="modal" data-target="#deleteSchool<?= $s->id_sekolah ?>">Hapus</a>
                                    </td>
                                </tr>

                                <!-- ============================================================== -->
                                <!-- Start Delete Modal -->
                                <!-- ============================================================== -->
                                <div class="modal fade" id="deleteSchool<?= $s->id_sekolah ?>" tabindex="-1" role="dialog" aria-labelledby="ModalLabelSchool<?= $s->id_sekolah ?>" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <form action="<?= site_url('sekolah/hapus') ?>" method="POST">
                                                <input type="text" name="id" id="id" value="<?= $s->id_sekolah ?>" class="d-none">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Hapus Data Sekolah</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    Apakah anda yakin ingin menghapus <?= $s->nama_sekolah ?>?
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                                                    <button type="submit" class="btn btn-danger">Hapus</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <!-- ============================================================== -->
                                <!-- End Delete Modal -->
                                <!-- ============================================================== -->

                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
</div>