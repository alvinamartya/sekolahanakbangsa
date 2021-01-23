<!-- TAMBAH KARYAWAN -->

<div class="container-fluid">
	<div class="card">
		<div class="card-body">
			<div class="card-header">Tambah Data Karyawan</div>
			<form method="post" action="<?php echo base_url('Karyawan/tambah') ?>" autocomplete="off">
				<br>
				<div class="row">
					<div class="col">
						Username
						<input type="text" name="username" class="form-control" required><br>
					</div>
				</div>
				<div class="row">
					<div class="col">
						Password
						<input type="password" name="password" id="password" onkeyup="check()" class="form-control" required><br>				
					</div>
				</div>
				<div class="row">
					<div class="col">
						Verifikasi password
						<input type="password" name="ver_password" id="ver_password" onkeyup="check()" class="form-control" required><br>
						<div id="ipassword" style="color:red"></div>
					</div>
				</div>
				<hr>
				<div class="row">
					<div class="col">
						Role akun
						<select name="role" class="form-control" disabled>
							<option value="Donatur">Donatur</option>
							<option value="Relawan">Relawan</option>
							<option value="Karyawan" selected>Karyawan</option>
						</select>				
					</div>
				</div>
				<div class="row">
					<div class="col">
					<hr>
						Nama pengguna
						<input type="text" name="nama_karyawan" class="form-control" required><br>				
					</div>
				</div>
				<div class="row">
					<div class="col">
						<label>Jenis kelamin</label><br>
						<label class="radio-inline"> <input type="radio" checked value="L" name="jenis_kelamin"> Laki - laki</label>
						<label class="radio-inline"><input type="radio" value="P" name="jenis_kelamin"> Perempuan</label>
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
						<input type="number" name="nik" class="form-control" required><br>				
					</div>
				</div>
				<div class="row">
					<div class="col">
						No telepon
						<input type="number" name="no_telepon" class="form-control" required><br>				
					</div>
				</div>
				<div class="row">
					<div class="col">
						Email
						<input type="email" name="email" class="form-control" required><br>				
					</div>
				</div>
				<div class="row">
					<div class="col">
						Tempat lahir
						<input type="text" name="tempat_lahir" class="form-control" required><br>
					</div>
				</div>
				<div class="row">
					<div class="col">
						Tanggal lahir
						<input type="date" name="tanggal_lahir" value="1971-01-01" class="form-control" required>						
					</div>
				</div>
				<br>
				<a href="<?php echo base_url('Karyawan') ?>" class="btn btn-secondary">Kembali</a>
				<input type="submit" id="btnSubmit" disabled class="btn btn-primary" value="Simpan">
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