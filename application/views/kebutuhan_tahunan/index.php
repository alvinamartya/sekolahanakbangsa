<div class="page-breadcrumb">
    <div class="row">
        <div class="col-7 align-self-center">
            <h4 class="page-title text-truncate text-dark font-weight-medium mb-1">Kebutuhan Tahunan</h4>
            <div class="d-flex align-items-center">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb m-0 p-0">
                        <li class="breadcrumb-item"><a href="index.html" class="text-muted">Home</a></li>
                        <li class="breadcrumb-item text-muted active" aria-current="page">Kebutuhan Tahunan</li>
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
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title text-center" style="font-size: 26px;">Data Kebutuhan Tahunan</h4>
                    <form action="">
                        <div class="form-group">
                            <label for="year">Pilih Tahun</label>
                            <input type="text" id="year" name="year" class="yearpicker form-control" value="" />
                        </div>

                        <div class="form-group">
                            <label for="desc">Deskripsi Kebutuhan</label>
                            <textarea name="desc" id="desc" cols="30" rows="5" class="form-control"></textarea>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-7">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title text-center" style="font-size: 26px;">Detail Barang</h4>
                    <a href="<?php echo base_url('karyawan/tambah') ?>" class="btn btn-primary mb-2">Tambah</a>
                    <table id="master-data-barang" class="table table-striped table-bordered no-wrap">
                        <thead>
                            <tr>
                                <th class="text-center">No</th>
                                <th class="text-center">Nama</th>
                                <th class="text-center">Jumlah</th>
                                <th class="text-center">Harga Satuan</th>
                                <th class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-5">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title text-center" style="font-size: 26px;">Detail Biaya Lainnya</h4>
                    <a href="<?php echo base_url('karyawan/tambah') ?>" class="btn btn-primary mb-2">Tambah</a>
                    <table id="master-data-biaya" class="table table-striped table-bordered no-wrap">
                        <thead>
                            <tr>
                                <th class="text-center">No</th>
                                <th class="text-center">Nama</th>
                                <th class="text-center">Biaya</th>
                                <th class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-8" style="font-size: 24px;">
                            Total: Rp.5.000.000,00
                        </div>
                        <div class="col-4 d-flex flex-row-reverse">
                            <a href="<?= site_url('karyawan') ?>" class="btn btn-danger" style="margin-left: 10px;">Kembali</a>
                            <button id="btn-save" type="submit" class="btn btn-primary">Simpan</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
<script>
    $(document).ready(function() {
        $(".yearpicker").yearpicker({
            year: 2017,
            startYear: 2012,
            endYear: 2030
        });
    });

    $('#master-data-barang').DataTable({
        "language": {
            "lengthMenu": "_MENU_ Data per halaman",
            "info": "Menampilkan _START_ sampai _END_ dari _TOTAL_ entries",
            "zeroRecords": "Tidak ada data.",
            "search": "Pencarian :",
            "infoFiltered": "(tersaring dari total _MAX_ data)",
            "paginate": {
                "previous": "Sebelumnya",
                "next": "Selanjutnya"
            }
        },
    });

    $('#master-data-biaya').DataTable({
        "language": {
            "lengthMenu": "_MENU_ Data per halaman",
            "info": "Menampilkan _START_ sampai _END_ dari _TOTAL_ entries",
            "zeroRecords": "Tidak ada data.",
            "search": "Pencarian :",
            "infoFiltered": "(tersaring dari total _MAX_ data)",
            "paginate": {
                "previous": "Sebelumnya",
                "next": "Selanjutnya"
            }
        },
    });
</script>