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
                                        <a href="" class="btn btn-danger">Hapus</a>
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