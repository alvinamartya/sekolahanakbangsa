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
                    <h4 class="card-title">Kebutuhan Tahunan</h4>
                    <form action="">
                        <div class="form-group">
                            <label for="year">Tahun</label>
                            <input type="text" id="year" name="year" class="yearpicker form-control" value="" />
                        </div>

                        <div class="form-group">
                            <label for="desc">Deskripsi</label>
                            <textarea name="desc" id="desc" cols="30" rows="5" class="form-control"></textarea>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Aksi Biaya -->
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title text-center" style="font-size: 26px;">Detail Biaya Lainnya</h4>
                    <div class="alert alert-success alert-dismissible fade show d-none" role="alert" id="messageBiaya">
                        Biaya berhasil ditambahkan!
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="table-responsive">
                        <button type="button" class="btn btn-primary mb-3" data-toggle="modal" data-target="#modalBiaya">Tambah</button>
                        <table id="biaya-table" class="table table-striped table-bordered no-wrap">
                            <thead>
                                <tr>
                                    <th class="text-center">Nama Biaya</th>
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

        <!-- Aksi Barang -->
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title text-center" style="font-size: 26px;">Detail Barang</h4>
                    <div class="alert alert-success alert-dismissible fade show d-none" role="alert" id="messageBarang">
                        Barang berhasil ditambahkan!
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="table-responsive">
                        <button type="button" class="btn btn-primary mb-3" data-toggle="modal" data-target="#modalBarang">Tambah</button>
                        <table id="barang-table" class="table table-striped table-bordered no-wrap">
                            <thead>
                                <tr>
                                    <th class="text-center">Nama Barang</th>
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
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="col-12 d-flex justify-content-between">
                        <h3 class="text-danger font-weight-bold">Total Harga : Rp<span id="target_donasi">0</span></h3>
                        <div class="d-flex">
                            <button class="btn btn-primary mr-3" type="button" id="btnSave"><i class="fa fa-save"></i> Simpan</button>
                            <button class="btn btn-danger" type="button"><i class="fa fa-times"></i> Batal</button>
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