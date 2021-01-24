<!-- Karyawan -->
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Data Karyawan</h4>
                </h6>
                <div class="table-responsive">
                    <a href="<?php echo base_url('karyawan/page_tambah') ?>" class="btn btn-primary mb-2">Tambah Data Karyawan</a>
                    <table id="school_table" class="table table-striped table-bordered no-wrap">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama karyawan</th>
                                <th>Jabatan</th>
                                <th>Jenis kelamin</th>
                                <th>No telepon</th>
                                <th>Email</th>
								<th>Tempat lahir</th>
								<th>Tanggal lahir</th>								
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i = 0; ?>
                            <?php 
							foreach ($karyawan as $k) {
								if($k->row_status == "A")
								{
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
										if($k->jenis_kelamin=="L"){
											echo "Laki-laki";
										}else{
											echo "Perempuan";
										}
									?>
									</td>
									<td><?= $k->no_telepon ?></td>
									<td><?= $k->email ?></td>
									<td><?= $k->tempat_lahir ?></td>
									<td><?= date("d/m/Y", strtotime($k->tanggal_lahir)) ?></td>											 
                                    <td>
                                        <a href="<?php echo base_url('karyawan/page_edit/'.$k->id_karyawan.'') ?>" class="btn btn-primary">Ubah</a>
                                        <a href="<?php echo base_url('karyawan/hapus/'.$k->id_karyawan) ?>" class="btn btn-danger"
										onclick="return confirm('Dengan menekan OK maka data akan dihapus (dinonaktifkan)')"
										>Hapus</a>
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