<div class="page-breadcrumb">
    <div class="row">
        <div class="col-7 align-self-center">
            <h4 class="page-title text-truncate text-dark font-weight-medium mb-1">Sekolah</h4>
            <div class="d-flex align-items-center">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb m-0 p-0">
                        <li class="breadcrumb-item"><a href="index.html" class="text-muted">Home</a></li>
                        <li class="breadcrumb-item"><a href="<?= site_url('sekolah') ?>" class="text-muted">Sekolah</a></li>
                        <li class="breadcrumb-item text-muted active" aria-current="page">Tambah</li>
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
                    <form action="<?= site_url('sekolah/add') ?>" method="POST">
                        <div class="form-group">
                            <label for="nama_sekolah">Nama Sekolah</label>
                            <input type="text" class="form-control <?php echo (form_error('nama_sekolah') != null ? 'is-invalid' : '') ?>" id="nama_sekolah" name="nama_sekolah" aria-describedby="schoolNameHelp" placeholder="Nama Sekolah">
                            <div class="invalid-feedback"><?php echo form_error('nama_sekolah'); ?></div>
                        </div>

                        <div class="form-group">
                            <label for="jenis_sekolah">Jenis Sekolah</label>
                            <select name="jenis_sekolah" id="jenis_sekolah" class="form-control <?php echo (form_error('jenis_sekolah') != null ? 'is-invalid' : '') ?>">
                                <option value="Rumah Singgah">Rumah Singgah</option>
                                <option value="Sekolah Pedalaman">Sekolah Pedalaman</option>
                            </select>
                            <div class="invalid-feedback"><?php echo form_error('jenis_sekolah'); ?></div>
                        </div>

                        <div class="form-group">
                            <label for="alamat">Alamat</label>
                            <textarea name="alamat" id="alamat" class="form-control <?php echo (form_error('alamat') != null ? 'is-invalid' : '') ?>" cols="100" rows="4" placeholder="Alamat"></textarea>
                            <div class="invalid-feedback"><?php echo form_error('alamat'); ?></div>
                        </div>

                        <div class="form-group">
                            <label for="provinsi">Provinsi</label>
                            <select name="provinsi" id="provinsi" class="form-control <?php echo (form_error('provinsi') != null ? 'is-invalid' : '') ?>"></select>
                            <div class="invalid-feedback"><?php echo form_error('provinsi'); ?></div>
                        </div>

                        <div class="form-group">
                            <label for="kota">Kota</label>
                            <select name="kota" id="kota" class="form-control <?php echo (form_error('kota') != null ? 'is-invalid' : '') ?>"></select>
                            <div class="invalid-feedback"><?php echo form_error('kota'); ?></div>
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
<!-- footer -->
<!-- ============================================================== -->
<footer class="footer text-center text-muted">
    All Rights Reserved by Adminmart. Designed and Developed by <a href="https://wrappixel.com">WrapPixel</a>.
</footer>
<!-- ============================================================== -->
<!-- End footer -->
<!-- ============================================================== -->
</div>
<!-- ============================================================== -->
<!-- End Page wrapper  -->
<!-- ============================================================== -->
</div>
<!-- ============================================================== -->
<!-- End Wrapper -->
<!-- ============================================================== -->
<!-- End Wrapper -->
<!-- ============================================================== -->
<!-- All Jquery -->
<!-- ============================================================== -->
<script src="<?= base_url('assets') ?>/libs/jquery/dist/jquery.min.js"></script>
<script src="<?= base_url('assets') ?>/libs/popper.js/dist/umd/popper.min.js"></script>
<script src="<?= base_url('assets') ?>/libs/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- apps -->
<!-- apps -->
<script src="<?= base_url('assets') ?>/js/app-style-switcher.js"></script>
<script src="<?= base_url('assets') ?>/js/feather.min.js"></script>
<script src="<?= base_url('assets') ?>/libs/perfect-scrollbar/dist/perfect-scrollbar.jquery.min.js"></script>
<script src="<?= base_url('assets') ?>/js/sidebarmenu.js"></script>
<!--Custom JavaScript -->
<script src="<?= base_url('assets') ?>/js/custom.min.js"></script>
<!--This page JavaScript -->
<script src="<?= base_url('assets') ?>/extra-libs/c3/d3.min.js"></script>
<script src="<?= base_url('assets') ?>/extra-libs/c3/c3.min.js"></script>
<script src="<?= base_url('assets') ?>/libs/chartist/dist/chartist.min.js"></script>
<script src="<?= base_url('assets') ?>/libs/chartist-plugin-tooltips/dist/chartist-plugin-tooltip.min.js"></script>
<script src="<?= base_url('assets') ?>/libs/datatables/js/datatables.min.js"></script>
<script src="<?= base_url('assets') ?>/extra-libs/jvector/jquery-jvectormap-2.0.2.min.js"></script>
<script src="<?= base_url('assets') ?>/extra-libs/jvector/jquery-jvectormap-world-mill-en.js"></script>
<script src="<?= base_url('assets') ?>/js/pages/dashboards/dashboard1.min.js"></script>
<!-- ============================================================== -->
<!-- All Jquery -->
<!-- ============================================================== -->
<script src="<?= base_url('assets/js/edit_school.js') ?>"></script>
</body>

</html>