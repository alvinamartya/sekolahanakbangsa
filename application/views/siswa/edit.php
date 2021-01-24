<div class="page-breadcrumb">
    <div class="row">
        <div class="col-7 align-self-center">
            <h4 class="page-title text-truncate text-dark font-weight-medium mb-1">Siswa</h4>
            <div class="d-flex align-items-center">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb m-0 p-0">
                        <li class="breadcrumb-item"><a href="index.html" class="text-muted">Home</a></li>
                        <li class="breadcrumb-item"><a href="<?= site_url('siswa') ?>" class="text-muted">Siswa</a></li>
                        <li class="breadcrumb-item text-muted active" aria-current="page">Ubah</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</div>

<div class="container-fluid">
	<div class="card">
		<div class="card-body">
			<form method="post" action="<?php echo base_url('Siswa/edit') ?>" autocomplete="off">
				<div class="row">
					<input type="hidden" value=<?php echo $data->id_siswa ?> name="id_siswa">
					<div class="col">
						Nama siswa
						<input type="text" name="nama_siswa" class="form-control" required value="<?php echo $data->nama_siswa ?>"><br>
					</div>
				</div>
				<div class="row">
					<div class="col">
						NISN
						<input type="number" name="nisn" class="form-control" value="<?php echo $data->nisn ?>" required><br>
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
				<div class="row">
					<div class="col">
						<label>Jenis kelamin</label><br>
						<?php if ($data->jenis_kelamin == 'L') { ?>
							<label class="radio-inline"> <input type="radio" checked value="L" name="jenis_kelamin"> Laki - laki</label>
							<label class="radio-inline"><input type="radio" value="P" name="jenis_kelamin"> Perempuan</label>
						<?php } else { ?>
							<label class="radio-inline"> <input type="radio" value="L" name="jenis_kelamin"> Laki - laki</label>
							<label class="radio-inline"><input type="radio" checked value="P" name="jenis_kelamin"> Perempuan</label>
						<?php  } ?>
					</div>
				</div>
				<br>
				<a href="<?php echo site_url('Siswa') ?>" class="btn btn-secondary">Kembali</a>
				<input type="submit" id="btnSubmit" class="btn btn-primary" value="Perbarui">
			</form>
		</div>
	</div>
</div>