<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Tambah Sekolah</h4>
                </h6>
                <form action="<?= site_url('sekolah/tambah_action') ?>" method="POST">
                    <label for="nama_sekolah">Nama Sekolah</label>
                    <div class="form-group">
                        <input type="text" class="form-control" id="nama_sekolah" name="nama_sekolah" aria-describedby="schoolNameHelp" placeholder="Nama Sekolah">
                        <small id="nama_sekolah_err" class="text-danger d-none">Nama sekolah harus diisi</small>
                    </div>

                    <label for="jenis_sekolah">Jenis Sekolah</label>
                    <div class="form-group">
                        <select name="jenis_sekolah" id="jenis_sekolah" class="form-control">
                            <option value="Rumah Singgah">Rumah Singgah</option>
                            <option value="Sekolah Pedalaman">Sekolah Pedalaman</option>
                        </select>
                    </div>

                    <label for="alamat">Alamat</label>
                    <div class="form-group">
                        <textarea name="alamat" id="alamat" class="form-control" cols="100" rows="4" placeholder="Alamat"></textarea>
                        <small id="alamat_err" class="text-danger d-none">Alamat harus diisi</small>
                    </div>

                    <label for="provinsi">Provinsi</label>
                    <div class="form-group">
                        <select name="provinsi" id="provinsi" class="form-control"></select>
                    </div>

                    <label for="kota">Kota</label>
                    <div class="form-group">
                        <select name="kota" id="kota" class="form-control"></select>
                    </div>

                    <div>
                        <button id="btn-save" type="submit" class="btn btn-primary">Simpan</button>
                        <a href="<?= site_url('sekolah') ?>" class="btn btn-danger">Batal</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
</div>