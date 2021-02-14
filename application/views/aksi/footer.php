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
        return aksi.map(item => item.harga).reduce((prev, next) => prev + next, 0);
    }

    function getSumBarang(aksi) {
        return aksi.reduce((acc, barang) => {
            return acc + (barang.harga_satuan * barang.jumlah)
        }, 0);
    }

    function updateHarga(aksiBiaya, aksiBarang) {
        let total = getSumBiaya(aksiBiaya) + getSumBarang(aksiBarang);

        $("#target_donasi").html(txtMoney(total));
    }

    function updateBiayaTable(aksiBiaya) {
        $("#biaya-table tbody").html("");
        aksiBiaya.forEach(data => {
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
        aksiBarang.forEach(data => {
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
        var aksiBiaya = [];
        var aksiBarang = [];
        $('#validationAlert').hide();

        $("#btnSave").on("click", function() {

            let formData = new FormData();
            formData.append("nama_aksi", $('#nama_aksi').val())
            formData.append("tanggal_selesai", $('#tanggal_selesai').val());
            formData.append("deskripsi_aksi", $('#deskripsi_aksi').val());
            formData.append("target_donasi", getNumber($('#target_donasi').html()));
            formData.append("barang", JSON.stringify(aksiBarang));
            formData.append("biaya", JSON.stringify(aksiBiaya));

            if (getNumber($('#target_donasi').html()) === 0) {
                $("#validationAlert").html('<p>Target donasi wajib diisi.<\/p>\n');
                $("#validationAlert").show();
                $('html, body').animate({scrollTop: '0px'}, 300);
            } else {
                $.each($('#gambar_aksi')[0].files, function(key, input) {
                    formData.append('files[]', input);
                });

                $.ajax({
                    url: "<?= site_url('aksi/add') ?>",
                    type: "POST",
                    contentType: false,
                    processData: false,
                    data: formData,
                    success: function(res) {
                        var respon = JSON.parse(res);
                        if (respon.success) {
                            window.location.href = "<?= site_url('aksi') ?>"
                        } else {
                            $("#validationAlert").html(respon.message);
                            $("#validationAlert").show();
                            $('html, body').animate({scrollTop: '0px'}, 300);
                        }

                    },
                    error: function(err) {
                        console.log(err);
                    }
                });
            }
        });

        $("#biaya-table, #barang-table").on('click', '.btnDelete', function() {
            if (confirm('Apakah anda yakin ingin menghapus data ini?')) {
                const tr = $(this).closest('tr');
                const data_id = tr.find('.btnDelete').data("id").toString();
                const buttonType = tr.find('.btnDelete').data("type").toString();

                if (buttonType == 'biaya') {
                    const idx = aksiBiaya.map(i => i.id_biaya).indexOf(data_id);
                    aksiBiaya.splice(idx, 1);
                } else {
                    const idx = aksiBarang.map(i => i.id_barang).indexOf(data_id);
                    aksiBarang.splice(idx, 1);
                }

                tr.remove();

                updateHarga(aksiBiaya, aksiBarang);
            }
        });

        $('#harga_satuan, #biaya').priceFormat({
            prefix: 'Rp',
            centsLimit: 0,
            thousandsSeparator: '.'
        });

        // Show biaya edit modal
        $("#biaya-table").on('click', '.btnEdit', function() {
            $('#modalBiaya').modal('show');
            $("#btnSubmitBiaya").data('type', 'edit');
            let idbiaya = $(this).data('id').toString();
            const idx = aksiBiaya.map(i => i.id_biaya).indexOf(idbiaya);

            $('#id_biaya_lainnya').data('idx', idx);
            $('#id_biaya_lainnya').val(aksiBiaya[idx].id_biaya);
            $('#biaya').val(currencyFormat.format(aksiBiaya[idx].harga));
        });

        // Show barang edit modal
        $("#barang-table").on('click', '.btnEdit', function() {
            $('#modalBarang').modal('show');
            $("#btnSubmitBarang").data('type', 'edit');
            let idbarang = $(this).data('id').toString();
            const idx = aksiBarang.map(i => i.id_barang).indexOf(idbarang);

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

        $("#frmBiaya").submit((e) => {
            e.preventDefault();

            let idBiaya = $('#id_biaya_lainnya').val();
            let namaBiaya = $('#id_biaya_lainnya option:selected').html().trim();
            let hargaBiaya = $('#biaya').val();
            let formType = $("#frmBiaya").find("button[type='submit']").data('type');

            // check if biaya exists
            let hasBiaya = aksiBiaya.some(a => a['id_biaya'] === idBiaya);

            if (hasBiaya && formType == "add") {
                alert('Aksi Biaya sudah ditambahkan!');
            } else {
                if(formType == "add") {
                    // add data to array
                    aksiBiaya.push({
                        id_biaya: idBiaya,
                        nama_biaya: namaBiaya,
                        harga: getNumber(hargaBiaya)
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
            let hasBarang = aksiBarang.some(a => a['id_barang'] === idBarang);

            if (hasBarang && formType == "add") {
                alert('Aksi Barang sudah ditambahkan!');
            } else {
                if(formType == "add") {
                    // add data to array
                    aksiBarang.push({
                        id_barang: idBarang,
                        nama_barang: namaBarang,
                        jumlah: getNumber(jumlahBarang),
                        harga_satuan: getNumber(hargaBarang)
                    });
                } else {
                    let idx = $("#id_barang").data('idx');
                    aksiBarang[idx].id_barang = idBarang;
                    aksiBarang[idx].nama_barang = namaBarang;
                    aksiBarang[idx].jumlah = getNumber(jumlahBarang);
                    aksiBarang[idx].harga_satuan = getNumber(hargaBarang);
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