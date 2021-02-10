<div class="page-breadcrumb">
	<div class="row">
		<div class="col-7 align-self-center">
			<h4 class="page-title text-truncate text-dark font-weight-medium mb-1">Donasi Aksi</h4>
			<div class="d-flex align-items-center">
				<nav aria-label="breadcrumb">
					<ol class="breadcrumb m-0 p-0">
						<li class="breadcrumb-item"><a href="index.html" class="text-muted">Home</a></li>
						<li class="breadcrumb-item"><a href="<?php echo base_url('Dashboard/relawan') ?>" class="text-muted">Dashbord</a></li>
						<li class="breadcrumb-item text-muted active" aria-current="page">Detail</li>
					</ol>
				</nav>
			</div>
		</div>
	</div>
</div>
<div class="container-fluid">
	<div class="card">
		<div class="card-body">

			<div class="row mt-5">
				<div class="col-md-8">
					<div id="carouselExampleIndicators" class="carousel slide carousel-aksi" data-ride="carousel">
						<ol class="carousel-indicators">
							<?php
							$i = 0;
							foreach ($data_gambar_aksi as $g) {
							?>
								<li data-target="#carouselExampleIndicators" data-slide-to="<?php echo $i ?>" <?php if ($i == 0) echo "class='active'" ?>></li>
							<?php $i++;
							} ?>
						</ol>
						<div class="carousel-inner">
							<?php
							$i = 0;
							foreach ($data_gambar_aksi as $g) {
							?>
								<div class="carousel-item <?= ($i == 0) ? 'active' : '' ?>">
									<img class="d-block w-100" src="<?php echo base_url('assets/images/aksi/' . $g->gambar) ?>" alt="First slide">
								</div>
							<?php $i++;
							} ?>

						</div>
						<a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
							<span class="carousel-control-prev-icon" aria-hidden="true"></span>
							<span class="sr-only">Previous</span>
						</a>
						<a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
							<span class="carousel-control-next-icon" aria-hidden="true"></span>
							<span class="sr-only">Next</span>
						</a>
					</div>

					<h3 class="mt-5 font-weight-bold"><?php echo $data_aksi->nama_aksi ?></h3>

					<div class="row my-5">
						<div class="col-12">
							<p class="font-weight-bold">Deskripsi</p>
							<p class="form-control text-muted"><?php echo $data_aksi->deskripsi_aksi ?></p>
						</div>
					</div>
				</div>

				<div class="col-md-4">
					<div class="card shadow-sm">
						<div class="card-body">
							<h3 class="card-title mb-4 font-weight-bold text-left"><?php echo $data_aksi->nama_aksi ?></h3>
							<h6><?php echo $data_relawan->nama_relawan ?> <i class="fa fa-check-circle text-success"></i></h6>

							<div class="d-flex flex-column mt-4">
								<p class="font-weight-bold text-danger h3">Rp<?php echo number_format($data_donatur_aksi, 2, ',', '.'); ?></p>
								<p>terkumpul dari target Rp<?php echo number_format($data_aksi->target_donasi, 2, ',', '.'); ?></p>
							</div>
							<?php $persen = $data_donatur_aksi * 100 / $data_aksi->target_donasi  ?>
							<div class="progress">
								<div class="progress-bar bg-danger" role="progressbar" style="width: <?php echo $persen ?>%" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
							</div>

							<p class="mt-3 mb-4"><?php echo round($persen) ?>% tercapai</p>

						</div>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-md-6">
					<p class="mt-5 font-weight-bold">Barang</p>
					<table class="table table-hover">
						<thead class="bg-dark text-white">
							<tr>
								<th>No.</th>
								<th>Barang</th>
								<th>Jumlah</th>
								<th>Satuan</th>
							</tr>
						</thead>
						<tbody>
							<?php $i = 1;
							foreach ($data_aksi_barang as $barang) {
							?>
								<tr>
									<td><?php echo $i ?>.</td>
									<td>
										<?php
										foreach ($data_barang as $b) {
											if ($b->id_barang == $barang->id_barang) {
												echo $b->nama_barang;
											}
										}
										?>
									</td>
									<td><?php echo $barang->jumlah ?></td>
									<td align="right"><?php echo 'Rp ' . number_format($barang->harga_satuan, 2, ',', '.'); ?></td>
								</tr>
							<?php $i++;
							} ?>
						</tbody>
					</table>
				</div>
				<div class="col-md-6">
					<p class="mt-5 font-weight-bold">Biaya Lainnya</p>
					<table class="table table-hover">
						<thead class="bg-dark text-white">
							<tr>
								<th>No.</th>
								<th>Biaya Lainnya</th>
								<th>Biaya</th>
							</tr>
						</thead>
						<tbody>
							<?php $i = 1;
							foreach ($data_aksi_biaya_lainnya as $biaya_lainnya) {
							?>
								<tr>
									<td><?php echo $i ?>.</td>
									<td>
										<?php
										foreach ($data_biaya_lainnya as $b) {
											if ($b->id_biaya_lainnya == $biaya_lainnya->id_biaya_lainnya) {
												echo $b->nama_biaya_lainnya;
											}
										}
										?>
									</td>
									<td align="right"><?php echo 'Rp ' . number_format($biaya_lainnya->biaya, 2, ',', '.'); ?></td>
								</tr>
							<?php $i++;
							} ?>
						</tbody>
					</table>
				</div>
			</div>
			<div class="row">
				<div class="col-md-1">
					<a href="<?=base_url('dashboard/relawan')?>" class="btn btn-secondary">Kembali</a>
				</div>
			</div>
		</div>
	</div>
	</div>