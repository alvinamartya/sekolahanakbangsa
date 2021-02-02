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
                        }

                    },
                    error: function(err) {
                        console.log(err);
                    }
                });
            }
        });

        $("#biaya-table, #barang-table").on('click', '.btnDelete', function() {
            const tr = $(this).closest('tr');
            const data_id = tr.find('.btnDelete').data("id").toString();
            const buttonType = tr.find('.btnDelete').data("type").toString();

            if (buttonType == 'biaya') {
                const idx = aksiBiaya.map(i => i.id_biaya).indexOf(data_id);
                aksiBiaya.splice(idx, 1);
            } else {
                const idx = aksiBarang.map(i => i.id_biaya).indexOf(data_id);
                aksiBarang.splice(idx, 1);
            }

            tr.remove();

            updateHarga(aksiBiaya, aksiBarang);
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

            // check if biaya exists
            let hasBiaya = aksiBiaya.some(a => a['id_biaya'] === idBiaya);

            if (hasBiaya) {
                alert('Aksi Biaya sudah ditambahkan!');
            } else {
                // add data to array
                aksiBiaya.push({
                    id_biaya: idBiaya,
                    harga: getNumber(hargaBiaya)
                });

                // Add row
                $("#biaya-table tbody").append(`<tr>
                    <td>${namaBiaya}</td>
                    <td>${hargaBiaya}</td>
                    <td>
                        <button type="button" class="btn btn-danger btn-sm btnDelete" data-id="${idBiaya}" data-type="biaya">Hapus</button>
                    </td>
                </tr>`);

                // Clear Form
                $("#id_biaya_lainnya").val("");
                $('#biaya').val("");

                // Close Modal
                $('#modalBiaya').modal('hide');

                updateHarga(aksiBiaya, aksiBarang);
            }
        });

        $("#frmBarang").submit((e) => {
            e.preventDefault();

            let idBarang = $('#id_barang').val();
            let namaBarang = $('#id_barang option:selected').html().trim();
            let jumlahBarang = $('#jumlah').val();
            let hargaBarang = $('#harga_satuan').val();

            // check if barang exists
            let hasBarang = aksiBarang.some(a => a['id_barang'] === idBarang);

            if (hasBarang) {
                alert('Aksi Barang sudah ditambahkan!');
            } else {
                // add data to array
                aksiBarang.push({
                    id_barang: idBarang,
                    jumlah: getNumber(jumlahBarang),
                    harga_satuan: getNumber(hargaBarang)
                });

                // Add row
                $("#barang-table tbody").append(`<tr>
                    <td>${namaBarang}</td>
                    <td>${jumlahBarang}</td>
                    <td>${hargaBarang}</td>
                    <td>
                        <button type="button" class="btn btn-danger btn-sm btnDelete" data-id="${idBarang}" data-type="barang">Hapus</button>
                    </td>
                </tr>`);

                // Clear Form
                $("#id_barang").val("");
                $('#jumlah').val("");
                $('#harga_satuan').val("");

                // Close Modal
                $('#modalBarang').modal('hide');

                updateHarga(aksiBiaya, aksiBarang);
            }
        });
    });
</script>
</body>

</html>