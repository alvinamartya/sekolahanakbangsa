<!-- VIEW CLUSTER -->

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Data Cluster Relawan</h4>
                </h6>
                <div class="table-responsive">
                    <a href="<?php echo base_url('cluster/page_tambah') ?>" class="btn btn-primary mb-2">Tambah Data Cluster</a>
                    <table id="school_table" class="table table-striped table-bordered no-wrap">
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
                                    <td><?= $k->nama_cluster ?></td>
                                    <td><?= $k->deskripsi_cluster ?></td>									
                                    <td>
                                        <a href="<?php echo base_url('cluster/page_edit/'.$k->id_cluster_relawan.'') ?>" class="btn btn-primary">Ubah</a>
                                        <a href="<?php echo base_url('cluster/hapus/'.$k->id_cluster_relawan) ?>" class="btn btn-danger"
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