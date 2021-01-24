<!-- EDIT CLUSTER -->

<div class="container-fluid">
	<div class="card">
		<div class="card-body">
			<div class="card-header">Edit Data Cluster</div>
			<form method="post" action="<?php echo base_url('cluster/edit') ?>" autocomplete="off">
				<br>
				<input type="hidden" name="id_cluster_relawan" value="<?php echo $cluster->id_cluster_relawan ?>" >
				<div class="row">
					<div class="col">
						Nama Cluster
						<input type="text" name="nama_cluster" class="form-control" required value="<?php echo $cluster->nama_cluster ?>"><br>
					</div>
				</div>
				<div class="row">
					<div class="col">
						Deskripsi Cluster
						<textarea id="ideskripsi" class="form-control" onkeyup="insert()"><?php echo $cluster->deskripsi_cluster ?></textarea>
						<input type="hidden" name="deskripsi_cluster" id="deskripsi" value="<?php echo $cluster->deskripsi_cluster ?>"><br>				
					</div>
				</div>				
				<br>
				<a href="<?php echo base_url('Cluster') ?>" class="btn btn-secondary">Kembali</a>
				<input type="submit" id="btnSubmit" class="btn btn-primary" value="Perbarui">
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