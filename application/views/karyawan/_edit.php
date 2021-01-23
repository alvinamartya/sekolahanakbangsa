<!-- EDIT KARYAWAN -->
<!-- TAMBAH KARYAWAN -->

<!-- TAMBAH KARYAWAN -->

<div class="container-fluid">
	<div class="card">
		<div class="card-body">
			<div class="card-header">Tambah Data Karyawan</div>
			<form method="post" action="<?php echo base_url('Karyawan/edit') ?>" autocomplete="off">
				<br>								
				<div class="row">
					<input type="hidden" value=<?php echo $data->id_karyawan ?> name="id_karyawan">					
					<div class="col">
					<hr>
						Nama pengguna
						<input type="text" name="nama_karyawan" class="form-control" required value="<?php echo $data->nama_karyawan ?>"><br>				
					</div>
				</div>
				<div class="row">
					<div class="col">
						<label>Jenis kelamin</label><br>
						<?php if($data->jenis_kelamin == 'L'){?>
						<label class="radio-inline"> <input type="radio" checked value="L" name="jenis_kelamin"> Laki - laki</label>
						<label class="radio-inline"><input type="radio" value="P" name="jenis_kelamin"> Perempuan</label>
						<?php } else {?>
						<label class="radio-inline"> <input type="radio" value="L" name="jenis_kelamin"> Laki - laki</label>
						<label class="radio-inline"><input type="radio" checked value="P" name="jenis_kelamin"> Perempuan</label>
						<?php  } ?>
					</div>
				</div>
				<div class="row">
					<div class="col">
						Jabatan pengguna
						<select disabled name="jabatan_karyawan" class="form-control">
							<option value="Admin" selected>Admin</option>
							<option value="Super Admin">Super Admin</option>
						</select>
						<br>					
					</div>
				</div>
				<div class="row">
					<div class="col">
						NIK
						<input type="number" name="nik" class="form-control" value="<?php echo $data->nik ?>" required><br>				
					</div>
				</div>
				<div class="row">
					<div class="col">
						No telepon
						<input type="number" name="no_telepon" class="form-control" value="<?php echo $data->no_telepon ?>" required><br>				
					</div>
				</div>
				<div class="row">
					<div class="col">
						Email
						<input type="email" name="email" class="form-control" value="<?php echo $data->email ?>" required><br>				
					</div>
				</div>
				<div class="row">
					<div class="col">
						Tempat lahir
						<input type="text" name="tempat_lahir" class="form-control" value="<?php echo $data->tempat_lahir ?>" required><br>
					</div>
				</div>
				<div class="row">
					<div class="col">
						Tanggal lahir
						<input type="date" name="tanggal_lahir" class="form-control" value="<?php echo date("Y-m-d", strtotime($data->tanggal_lahir)); ?>" required>						
					</div>
				</div>
				<br>
				<a href="<?php echo base_url('Karyawan') ?>" class="btn btn-secondary">Kembali</a>
				<input type="submit" id="btnSubmit" class="btn btn-primary" value="Perbarui">
			</form>
		</div>
	</div>
</div>

<script>
	function check()
	{	
		document.getElementById("ipassword").innerHTML = "";
		
		var pass = document.getElementById("password").value;
		var vpass = document.getElementById("ver_password").value;
	if(pass == "" || vpass == ""){
			return;
		}
		if(pass != vpass){
			document.getElementById("ipassword").innerHTML = "Kata sandi tidak sesuai!";
			document.getElementById("ipassword").style.color = "red";
			document.getElementById("btnSubmit").disabled = true;
		}else{
			document.getElementById("ipassword").innerHTML = "Kata sandi sesuai!";
			document.getElementById("ipassword").style.color = "green"
			document.getElementById("btnSubmit").disabled = false;
		}
	}
</script>