$(document).ready(async () => {
    // provinces array
    let provinces = [];

    // get province
    await $.get('https://dev.farizdotid.com/api/daerahindonesia/provinsi', (data) => {
        provinces = [];
        data.provinsi.forEach(e => {
            $("#provinsi").append(new Option(e.nama, e.nama));
            provinces.push(e);
        });
    });

    // get cities
    if (provinces.length > 0) {
        getCityByProvinceId(provinces[0].id);

        $("#provinsi").change(() => {
            getCityByProvinceId(provinces[$("#provinsi")[0].selectedIndex].id);
        });
    }

    // get city by province id
    function getCityByProvinceId(id) {
        // clear option
        $("#kota")
            .find('option')
            .remove();

        // binding cities
        $.get('https://dev.farizdotid.com/api/daerahindonesia/kota?id_provinsi=' + id, (data) => {
            data.kota_kabupaten.forEach(e => {
                $("#kota").append(new Option(e.nama, e.nama));
            });
        });
    }

    // validate data
    function validateForm() {
        const isNotFilled = $("#nama_sekolah").val() == "" || $("#alamat").val() == "";
        return !isNotFilled;
    }

    // validate for each input
    $("#nama_sekolah").focusout(() => {
        buttonState();
        if ($("#nama_sekolah").val() == "") {
            // set state in nama_sekolah_err
            $("#nama_sekolah_err").removeClass("d-none");
            $("#nama_sekolah_err").text("Nama sekolah harus diisi.");

            // set state in nama_sekolah
            $("#nama_sekolah").addClass("is-invalid");
        } else {
            // set state in input form
            $("#nama_sekolah_err").addClass("d-none");
            $("#nama_sekolah").removeClass("is-invalid");
        }
    });

    $("#alamat").focusout(() => {
        buttonState();
        if ($("#alamat").val() == "") {
            // set state in alamat
            $("#alamat_err").removeClass("d-none");
            $("#alamat_err").text("Alamat harus diisi.");

            // set state in alamat
            $("#alamat").addClass("is-invalid");
        } else {
            // set state in input form
            $("#alamat_err").addClass("d-none");
            $("#alamat").removeClass("is-invalid");
        }
    });

    // change button state
    function buttonState() {
        if (validateForm()) {
            $("#btn-save").prop('disabled', false);
        } else {
            $("#btn-save").prop('disabled', true);
        }
    }

    buttonState();
});