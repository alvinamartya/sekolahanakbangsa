
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
<script src="<?php echo base_url('assets/libs/jquery/dist/jquery.min.js') ?>"></script>
<script src="<?php echo base_url('assets/libs/popper.js/dist/umd/popper.min.js') ?>"></script>
<script src="<?php echo base_url('assets/libs/bootstrap/dist/js/bootstrap.min.js') ?>"></script>
<!-- apps -->
<!-- apps -->
<script src="<?php echo base_url('assets/js/app-style-switcher.js') ?>"></script>
<script src="<?php echo base_url('assets/js/feather.min.js') ?>"></script>
<script src="<?php echo base_url('assets/libs/perfect-scrollbar/dist/perfect-scrollbar.jquery.min.js') ?>"></script>
<script src="<?php echo base_url('assets/js/sidebarmenu.js') ?>"></script>
<!--Custom JavaScript -->
<script src="<?php echo base_url('assets/js/custom.min.js') ?>"></script>
<!--This page JavaScript -->
<script src="<?php echo base_url('assets/extra-libs/c3/d3.min.js') ?>"></script>
<script src="<?php echo base_url('assets/extra-libs/c3/c3.min.js') ?>"></script>
<script src="<?php echo base_url('assets/libs/chartist/dist/chartist.min.js') ?>"></script>
<script src="<?php echo base_url('assets/libs/chartist-plugin-tooltips/dist/chartist-plugin-tooltip.min.js') ?>"></script>
<script src="<?php echo base_url('assets/extra-libs/jvector/jquery-jvectormap-2.0.2.min.js') ?>"></script>
<script src="<?php echo base_url('assets/extra-libs/jvector/jquery-jvectormap-world-mill-en.js') ?>"></script>
<script src="<?php echo base_url('assets/js/pages/dashboards/dashboard1.min.js') ?>"></script>
<script src="<?php echo base_url('assets/extra-libs/datatables.net/js/jquery.dataTables.min.js') ?>"></script>
<script src="<?php echo base_url('assets/js/jquery.priceformat.min.js') ?>"></script>
<script src="<?php echo base_url('assets/js/jquery.zoom.min.js') ?>"></script>
<script src="<?php echo base_url('assets/js/script.js') ?>"></script>
<script>
    function getSumBiaya(aksi) {
        return aksi.filter((a) => a.row_status == "A").map(item => item.harga).reduce((prev, next) => prev + next, 0);
    }

    function getSumBarang(aksi) {
        return aksi.filter((a) => a.row_status == "A").reduce((acc, barang) => {
            return acc + (barang.harga_satuan * barang.jumlah)
        }, 0);
    }

    function updateHarga(aksiBiaya, aksiBarang) {
        let total = getSumBiaya(aksiBiaya) + getSumBarang(aksiBarang);

        $("#target_donasi").html(txtMoney(total));
    }

    function updateBiayaTable(aksiBiaya) {
        $("#biaya-table tbody").html("");
        aksiBiaya.filter(a => a.row_status == "A").forEach(data => {
            $("#biaya-table tbody").append(`<tr>
                <td>${data.nama_biaya}</td>
                <td>${currencyFormat.format(data.harga)}</td>
                <td>
                    <button type="button" class="btn btn-warning btn-sm btnEdit" data-id="${data.id_biaya}" data-type="biaya"><i class="fa fa-edit"></i> Ubah</button>
                    <button type="button" class="btn btn-danger btn-sm btnDelete" data-id="${data.id_biaya}" data-type="biaya"><i class="fa fa-trash"></i> Hapus</button>
                </td>
            </tr>`);
        });
    }

    function updateBarangTable(aksiBarang) {
        $("#barang-table tbody").html("");
        aksiBarang.filter(a => a.row_status == "A").forEach(data => {
            $("#barang-table tbody").append(`<tr>
                <td>${data.nama_barang}</td>
                <td>${data.jumlah}</td>
                <td>${currencyFormat.format(data.harga_satuan)}</td>
                <td>
                    <button type="button" class="btn btn-warning btn-sm btnEdit" data-id="${data.id_barang}" data-type="barang"><i class="fa fa-edit"></i> Ubah</button>
                    <button type="button" class="btn btn-danger btn-sm btnDelete" data-id="${data.id_barang}" data-type="barang"><i class="fa fa-trash"></i> Hapus</button>
                </td>
            </tr>`);
        });
    }

    $(document).ready(() => {
        $('#validationAlert').hide();
        var aksiBiaya = [];
        var aksiBarang = [];
        var aksiGambar = [];

        var barangs = <?php echo json_encode($aksi_barang) ?>;
        $.each(barangs, function(key, value) {
            aksiBarang.push({
                id: value.id,
                id_barang: value.id_barang,
                nama_barang: value.nama_barang,
                jumlah: parseInt(value.jumlah),
                harga_satuan: parseInt(value.harga_satuan),
                row_status: 'A'
            })
        });

        var biayas = <?php echo json_encode($aksi_biaya) ?>;
        $.each(biayas, function(key, value) {
            aksiBiaya.push({
                id: value.id,
                id_biaya: value.id_biaya_lainnya,
                nama_biaya_lainnya: value.nama_biaya_lainnya,
                harga: parseInt(value.biaya),
                row_status: 'A'
            })
        });

        var gambars = <?php echo json_encode($aksi_gambar) ?>;
        $.each(gambars, function(key, value) {
            aksiGambar.push({
                id: value.id,
                gambar: value.gambar,
                row_status: 'A'
            })
        });

        // Show biaya edit modal
        $("#biaya-table").on('click', '.btnEdit', function() {
            $('#modalBiaya').modal('show');
            $("#btnSubmitBiaya").data('type', 'edit');
            let idbiaya = $(this).data('id').toString();
            const idx = aksiBiaya.findIndex(e => e.id_biaya == idbiaya && e.row_status == 'A');

            $('#id_biaya_lainnya').data('idx', idx);
            $('#id_biaya_lainnya').val(aksiBiaya[idx].id_biaya);
            $('#biaya').val(currencyFormat.format(aksiBiaya[idx].harga));
        });

        // Show barang edit modal
        $("#barang-table").on('click', '.btnEdit', function() {
            $('#modalBarang').modal('show');
            $("#btnSubmitBarang").data('type', 'edit');
            let idbarang = $(this).data('id').toString();
            const idx = aksiBarang.findIndex(e => e.id_barang == idbarang && e.row_status == 'A');

            $('#id_barang').data('idx', idx);
            $('#id_barang').val(aksiBarang[idx].id_barang);
            $('#jumlah').val(aksiBarang[idx].jumlah);
            $('#harga_satuan').val(currencyFormat.format(aksiBarang[idx].harga_satuan));
        });

        // Clear form on modal close
        $('#modalBiaya, #modalBarang').on('hidden.bs.modal', function (e) {
            $(this).find("input,textarea,select").val('');
            $(this).find("button[type='submit']").data('type', 'add');
        });

        $("#mainForm").submit((e) => {
            e.preventDefault();
            let formData = new FormData();
            formData.append("nama_aksi", $('#nama_aksi').val())
            formData.append("tanggal_selesai", $('#tanggal_selesai').val());
            formData.append("deskripsi_aksi", $('#deskripsi_aksi').val());
            formData.append("target_donasi", getNumber($('#target_donasi').html()));
            formData.append("target_donasi", getNumber($('#target_donasi').html()));
            formData.append("barang", JSON.stringify(aksiBarang));
            formData.append("biaya", JSON.stringify(aksiBiaya));
            formData.append("gambar", JSON.stringify(aksiGambar));

            $.each($('#gambar_aksi')[0].files,function(key,input){
                formData.append('files[]', input);
            });

            $.ajax({
                url: "<?= site_url('aksi/edit/'.$aksi->id_aksi) ?>",
                type: "POST",
                contentType: false,
                processData: false,
                data: formData,
                success:function(res) {
                    var respon = JSON.parse(res);
                    if(respon.status) {
                        window.location.href = "<?= site_url('aksi') ?>"
                    } else {
                        $("#validationAlert").html(respon.message);
                        $("#validationAlert").show();
                        $('html, body').animate({scrollTop: '0px'}, 300);
                    }

                },
                error:function(err){
                    console.log(err);
                }
            });
        });

        $("#biaya-table, #barang-table").on('click', '.btnDelete', function() {
            if (confirm('Apakah anda yakin ingin menghapus data ini?')) {
                const tr = $(this).closest('tr');
                const data_id = tr.find('.btnDelete').data("id").toString();
                const buttonType = tr.find('.btnDelete').data("type").toString();

                if(buttonType == 'biaya') {
                    const idx = aksiBiaya.findIndex(e => e.id_biaya == data_id && e.row_status == 'A');
                    aksiBiaya[idx].row_status = 'D';
                } else {
                    const idx = aksiBarang.findIndex(e => e.id_barang == data_id && e.row_status == 'A');
                    aksiBarang[idx].row_status = 'D';
                }

                tr.remove();

                updateHarga(aksiBiaya, aksiBarang);
            }
        });

        $(".btnHapusFoto").on('click', function() {
            const data_id = $(this).data("id").toString();
            const idx = aksiGambar.map(i => i.id).indexOf(data_id);

            aksiGambar[idx].row_status = 'D';

            $(this).parents('.col-md-4.mt-3').remove();
        });

        $('#harga_satuan, #biaya').priceFormat({
            prefix: 'Rp',
            centsLimit: 0,
            thousandsSeparator: '.'
        });

        $("#frmBiaya").submit((e) => {
            e.preventDefault();

            let idBiaya = $('#id_biaya_lainnya').val();
            let namaBiaya = $('#id_biaya_lainnya option:selected').html().trim();
            let hargaBiaya = $('#biaya').val();
            let formType = $("#frmBiaya").find("button[type='submit']").data('type');

            // check if biaya exists
            let hasBiaya = aksiBiaya.filter(a => a.row_status == 'A').some(a => a['id_biaya'] === idBiaya);

            if (hasBiaya && formType == "add") {
                alert('Aksi Biaya sudah ditambahkan!');
            } else {
                if(formType == "add") {
                    // add data to array
                    aksiBiaya.push({
                        id_biaya: idBiaya,
                        nama_biaya: namaBiaya,
                        harga: getNumber(hargaBiaya),
                        row_status: 'A'
                    });
                } else {
                    let idx = $("#id_biaya_lainnya").data('idx');
                    aksiBiaya[idx].id_biaya = idBiaya;
                    aksiBiaya[idx].nama_biaya = namaBiaya;
                    aksiBiaya[idx].harga = getNumber(hargaBiaya);
                }

                // Clear Form
                $("#id_biaya_lainnya").val("");
                $('#biaya').val("");

                // Close Modal
                $('#modalBiaya').modal('hide');

                updateBiayaTable(aksiBiaya);
                updateHarga(aksiBiaya, aksiBarang);
            }
        });

        $("#frmBarang").submit((e) => {
            e.preventDefault();

            let idBarang = $('#id_barang').val();
            let namaBarang = $('#id_barang option:selected').html().trim();
            let jumlahBarang = $('#jumlah').val();
            let hargaBarang = $('#harga_satuan').val();
            let formType = $("#frmBarang").find("button[type='submit']").data('type');

            // check if barang exists
            let hasBarang = aksiBarang.filter(a => a.row_status == 'A').some(a => a['id_barang'] === idBarang);

            if(hasBarang && formType == "add") {
                alert('Aksi Barang sudah ditambahkan!');
            } else {
                // if form type add, add data to array, else edit data from array
                if(formType == "add") {
                    // add data to array
                    aksiBarang.push({
                        id_barang: idBarang,
                        nama_barang: namaBarang,
                        jumlah: getNumber(jumlahBarang),
                        harga_satuan: getNumber(hargaBarang),
                        row_status: 'A'
                    });
                } else {
                    // if jumlah barang 0, remove barang from table, and update array data with status D
                    let idx = $("#id_barang").data('idx');
                    if(getNumber(jumlahBarang) == 0) {
                        aksiBarang[idx].row_status = 'D';
                    } else {
                        // edit data from array
                        aksiBarang[idx].id_barang = idBarang;
                        aksiBarang[idx].nama_barang = namaBarang;
                        aksiBarang[idx].jumlah = getNumber(jumlahBarang);
                        aksiBarang[idx].harga_satuan = getNumber(hargaBarang);
                    }
                }

                // Clear Form
                $("#id_barang").val("");
                $('#jumlah').val("");
                $('#harga_satuan').val("");

                // Close Modal
                $('#modalBarang').modal('hide');

                updateBarangTable(aksiBarang);
                updateHarga(aksiBiaya, aksiBarang);
            }
        });
    });
</script>
</body>

</html>