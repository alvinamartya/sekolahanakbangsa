<div class="page-breadcrumb">
    <div class="row">
        <div class="col-7 align-self-center">
            <h4 class="page-title text-truncate text-dark font-weight-medium mb-1">Kebutuhan Tahunan</h4>
            <div class="d-flex align-items-center">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb m-0 p-0">
                        <li class="breadcrumb-item"><a href="index.html" class="text-muted">Home</a></li>
                        <li class="breadcrumb-item"><a href="<?php echo base_url('Bantuan_sekolah')?>" class="text-muted">Kebutuhan Tahunan</a></li>
						<li class="breadcrumb-item text-muted active" aria-current="page">Konfirmasi</li>
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
  
            
			
	<h4 class="card-title">Kebutuhan Tahunan</h4>			
	<div class="row">
		<div class="col-md-2">
			<label class="form-control">Tahun : <?=$kebutuhan_tahunan->tahun?><label>
		</div>
		<div class="col">
			<label class="form-control">Sekolah / Rumah singgah : <?=$sekolah->nama_sekolah?><label>
		</div>
	</div>
	<br>
	<!-- Deskripsi Kebutuhan tahunan -->
	<div class="card">
		<div class="card-body">
			<h4 class="card-title">Deskripsi Kebutuhan Tahunan</h4>
			<label class="form-label">
				<?=$kebutuhan_tahunan->deskripsi?>
			</label>
		</div>
	</div>
	<br>
	<!-- KT Biaya -->
	<div class="row">
		<div class="col-md-6">
			<div class="card">
				<div class="card-body">
					<h4 class="card-title">Kebutuhan Tahunan Biaya</h4>
					<div class="table-responsive">
					<small>
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
							<?php foreach($kt_biaya_lainnya as $kt) { ?>
							<tr>
								<td><?=$i ?>.</td>
								<td>
								<?php
								foreach($biaya_lainnya as $bl){
									if($bl->id_biaya_lainnya == $kt->id_biaya_lainnya){
										echo $bl->nama_biaya_lainnya;
									}
								}
								?>
								</td>
								<td>
									<?php echo 'Rp '.number_format($kt->biaya,2,',','.'); ?>
								</td>								
							</tr>
							<?php $i++; }?>
							</tbody>
						</table>
					</small>
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
					<small>
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
							<?php foreach($kt_barang as $kt) { ?>
								<tr>
									<td><?=$i?>.</td>
									<td>
									<?php foreach($barang as $b) {
										if($b->id_barang == $kt->id_barang){
											echo $b->nama_barang;
										}
									} ?>
									</td>
									<td><?=$kt->jumlah?></td>
									<td>
									<?php echo 'Rp '.number_format($kt->harga_satuan,2,',','.'); ?>
									</td>									
								</tr>
							<?php $i++; } ?>
							</tbody>
						</table>
					</small>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-12 d-flex justify-content-between">
			<h3 class="text-danger font-weight-bold">Total Kebutuhan : <?php echo 'Rp '.number_format($kebutuhan_tahunan->total_kebutuhan,2,',','.'); ?></h3>
			<div class="d-flex">
				<form action="<?php echo base_url('Bantuan_sekolah/verifikasi'); ?>" method="post" class="d-inline">
					<input type="hidden" name="id" value="<?=$kebutuhan_tahunan->id ?>">
					<button onclick="return confirm('tekan OK jika ingin mengkonfirmasi')" class="btn btn-primary mr-3" title="Tekan untuk mengkonfirmasi"><i class="fa fa-check"></i> Verifikasi</button>
				</form>
				<form action="<?php echo base_url('Bantuan_sekolah/tolak'); ?>" method="post" class="d-inline">
					<input type="hidden" name="id" value="<?=$kebutuhan_tahunan->id ?>">
					<button onclick="return confirm('tekan OK jika ingin menolak')" class="btn btn-danger mr-3"  title="Tekan untuk menolak"><i class="fa fa-times"></i> Tolak</button>
				</form>
			</div>
		</div>
	</div>
	<br>
    <div class="row">
		<div class="col-md-2">
			<a href="<?php echo base_url("Bantuan_sekolah")?>" class="btn btn-secondary">Kembali</a>
		</div>
	</div>
</div>

<!-- footer -->
<!-- ============================================================== -->
<!-- ============================================================== -->
<!-- End footer -->
<!-- ============================================================== -->
</div>