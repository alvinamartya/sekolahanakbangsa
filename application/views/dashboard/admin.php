    <!-- ============================================================== -->
    <!-- Bread crumb and right sidebar toggle -->
    <!-- ============================================================== -->
    <div class="container-fluid">
    	<div class="row">
    		<div class="col-lg-12 col-md-12">
    			<div class="card">
    				<div class="card-body">
    					<div class="row">
    						<div class="col">
    							<h4 class="card-title form-control" style="border:0px">LAPORAN KEBUTUHAN SEKOLAH</h4>
    						</div>
    						<div class="col">
    							<form id="ddlsekolah" class="d-inline" action="<?= base_url("dashboard/admin") ?>" method="post">
    								<div class="row">
    									<div class="col-8">
    										<select class="form-control" id="id_sekolah" name="id_sekolah">
    											<?php foreach ($sekolah as $s) { ?>
    												<!-- PENGUBAHAN DDL AGAR SESUAI DENGAN YANG DIPILIH -->
    												<?php if ($id_sekolah == $s->id_sekolah) {
														$nama_sekolah = $s->nama_sekolah;
													?>
    													<option selected value="<?= $s->id_sekolah ?>"><?= $s->nama_sekolah ?></option>
    												<?php } else { ?>
    													<option value="<?= $s->id_sekolah ?>"><?= $s->nama_sekolah ?></option>
    												<?php } ?>
    											<?php } ?>
    										</select>
    									</div>
    									<div class="col">
    										<button class="btn btn-primary form-control"><span class="fa fa-search"></span> FILTER</button>
    									</div>
    								</div>
    							</form>
    						</div>
    					</div>
    				</div>
    			</div>
    			<div class="card">
    				<div class="card-body">
    					<div class="barchart-sekolah mt-4 position-relative" style="height:294px;"></div>
    					<ul class="list-inline text-center mt-5 mb-2">
    						<li class="list-inline-item text-muted font-italic">Laporan Kebutuhan Tahunan <?= $nama_sekolah ?></li>
    					</ul>
    				</div>
    				<br>
    			</div>
    			<br>
    			<div class="card">
    				<div class="card-body">
    					<h4 class="card-title text-center">Tabel Laporan Kebutuhan Tahunan <?= $nama_sekolah ?></h4>
    					<table class="table table-striped">
    						<thead class="thead-light">
    							<tr class="text-center">
    								<td>No</td>
    								<td>Tahun</td>
    								<td>Kebutuhan</td>
    								<td>Aksi</td>
    							</tr>
    						</thead>
    						<tbody>
    							<?php
								$i = 1;
								$label = "[";
								$data = "[";
								?>
    							<?php
								foreach ($kebutuhan_tahunan as $k) {
									$label = $label . "'" . $k->tahun . "',";
									$data = $data . $k->total_kebutuhan . ",";
								?>


    								<tr class="text-center">
    									<td><?= $i ?>.</td>
    									<td align="center"><?= $k->tahun ?></td>
    									<td align="right"><?php echo 'Rp ' . number_format($k->total_kebutuhan, 2, ',', '.'); ?></td>
    									<td align="center">
    										<form action="<?php echo base_url('dashboard/detail_kebutuhan') ?>" method="post" class="d-inline">
    											<input type="hidden" name="id" value="<?= $k->id ?>">
    											<button class="btn btn-primary"><span class="fa fa-eye"></span> Detail</button>
    										</form>
    									</td>
    								</tr>
    							<?php
									$i++;
								}

								// Label dan kebutuhan data untuk chart
								$label = substr($label, 0, strlen($label) - 1) . ']';
								$data = substr($data, 0, strlen($data) - 1) . ']';

								?>
    						</tbody>
    					</table>
    				</div>
    			</div>
    		</div>
    	</div>
    	<a class="btn btn-success" href="<?= site_url('dashboard/export_laporan_admin/' . $id_sekolah) ?>">Export Laporan</a>
    	<a class="btn btn-warning" style="margin-left: 10px;" href="" data-toggle="modal" data-target=".bd-example-modal-lg">Export Semua</a>
    </div>

    <div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    	<div class="modal-dialog modal-lg">
    		<div class="modal-content">
    			<form action="<?= site_url('dashboard/export_all_admin') ?>" method="POST">
    				<div class="modal-header">
    					<h5 class="modal-title" id="exampleModalLabel">Pilih Sekolah/Rumah Singgah</h5>
    					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
    						<span aria-hidden="true">&times;</span>
    					</button>
    				</div>
    				<div class="modal-body">
    					<?php foreach ($sekolah as $s) { ?>
    						<div class="form-check form-check-inline">
    							<input class="form-check-input" type="checkbox" id="<?= $s->id_sekolah ?>" name="sekolah[]" value="<?= $s->id_sekolah ?>">
    							<label class="form-check-label" for="<?= $s->id_sekolah ?>"><?= $s->nama_sekolah ?></label>
    						</div>
    					<?php } ?>
    				</div>
    				<div class="modal-footer">
    					<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
    					<button type="submit" class="btn btn-primary">Export</button>
    				</div>
    			</form>
    		</div>
    	</div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.0.js"></script>
    <script>
    	window.onload = function() {
    		var label = <?= $label ?>;
    		//var label = ['2019','2020'];
    		var data = {
    			labels: label,
    			series: [
    				<?= $data ?>
    			],
    		};

    		var options = {
    			axisY: {
    				labelInterpolationFnc: function(value) {
    					return (value / 1000000) + 'jt';
    				}
    			},
    			axisX: {
    				showGrid: false,
    			},
    			seriesBarDistance: 10,
    			chartPadding: {
    				top: 10,
    				right: 15,
    				bottom: 5,
    				left: 0
    			},
    			plugins: [
    				Chartist.plugins.tooltip()
    			],
    			width: '100%'
    		};

    		var responsiveOptions = [
    			['screen and (max-width: 640px)', {
    				seriesBarDistance: 5,
    				axisX: {
    					labelInterpolationFnc: function(value) {
    						return value[0];
    					},
    				},
    			}]
    		];
    		new Chartist.Bar('.barchart-sekolah', data, options, responsiveOptions);
    	}
    	/*
    	function formSubmit() {

    	    document.getElementById("ddlsekolah").submit();
    	}
    	$( "#id_sekolah" ).change(function() {
    	  $( "#ddlsekolah" ).submit();
    	});*/
    </script>