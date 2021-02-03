<div class="page-breadcrumb">
    <div class="row">
        <div class="col-7 align-self-center">
            <h4 class="page-title text-truncate text-dark font-weight-medium mb-1">Kebutuhan Tahunan</h4>
            <div class="d-flex align-items-center">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb m-0 p-0">
                        <li class="breadcrumb-item"><a href="index.html" class="text-muted">Home</a></li>
                        <li class="breadcrumb-item text-muted active" aria-current="page">Kebutuhan Tahunan</li>
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
                    <h4 class="card-title text-center" style="font-size: 28px;">Kebutuhan Tahunan belum dikonfirmasi</h4>
                    </h6>
                    <div class="table-responsive">
                        <table id="master-data" class="table table-striped table-bordered table">
                            <thead>
                                <tr>
                                    <th class="text-center">No</th>
                                    <th class="text-center">Penanggung jawab</th>
                                    <th class="text-center">Sekolah / rumah singgah</th>
                                    <th class="text-center">Tahun</th>
                                    <th class="text-center">Kebutuhan</th>
                                    <th class="text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i = 0; ?>
                                <?php
                                foreach ($kebutuhan_tahunan as $k) {
                                ?>
                                        <tr>
                                            <td>
                                                <?php
                                                $i++;
                                                echo $i;
                                                ?>
                                            </td>
                                            <td>
											<?php
												foreach($relawan as $r){
													if($r->id_relawan == $k->id_relawan){
														echo $r->nama_relawan;
													}
												}
											?>
											</td>
                                            <td>
											<?php
												foreach($sekolah as $s){
													if($s->id_sekolah == $k->id_sekolah){
														echo $s->nama_sekolah;
													}
												}
											?>
											</td>
											<td>
												<?=$k->tahun?>
											</td>
                                            <td>
												<?php echo 'Rp '.number_format($k->total_kebutuhan,2,',','.'); ?>
											</td>
                                            <td align="center">
												<form action="<?php echo base_url('bantuan_sekolah/page_konfirmasi') ?>" method="post"  class="d-inline">
													<input type="hidden" name="id" value="<?=$k->id?>">
													<button class="btn btn-success"><span class="fa fa-check"></span> Konfirmasi</button>
												</form>
												<form action="<?php echo base_url('bantuan_sekolah/detail') ?>" method="post" class="d-inline">
													<input type="hidden" name="id" value="<?=$k->id?>">
													<button class="btn btn-primary"><span class="fa fa-eye"></span> Detail</button>
												</form>
                                            </td>
                                        </tr>
                                <?php
                                }
								?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>