<!-- TAMBAH CLUSTER -->

<div class="container-fluid">
	<div class="card">
		<div class="card-body">
			<div class="card-header">Tambah Data Cluster</div>
			<form method="post" action="<?php echo base_url('Cluster/tambah') ?>" autocomplete="off">
				<br>
				<div class="row">
					<div class="col">
						Nama Cluster
						<input type="text" name="nama_cluster" class="form-control" required><br>
					</div>
				</div>
				<div class="row">
					<div class="col">
						Deskripsi Cluster
						<textarea id="ideskripsi" class="form-control" onkeyup="insert()"></textarea>
						<input type="hidden" name="deskripsi_cluster" id="deskripsi"><br>				
					</div>
				</div>				
				<br>
				<a href="<?php echo base_url('Cluster') ?>" class="btn btn-secondary">Kembali</a>
				<input type="submit" id="btnSubmit" class="btn btn-primary" value="Simpan">
			</form>
		</div>
	</div>
</div>

<script>
	function insert()
	{	
		var des = document.getElementById("ideskripsi").value;
		
		document.getElementById("deskripsi").value = des;
		
	}
</script>