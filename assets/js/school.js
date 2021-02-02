$(document).ready(async () => {
    // provinces array
    let provinces = [];

    // get selectedCity
    function getCookie(name) {
        const value = `; ${document.cookie}`;
        const parts = value.split(`; ${name}=`);
        if (parts.length === 2) return parts.pop().split(';').shift();
    }

    let selectedProvince = getCookie("provinsi") == undefined ? undefined : getCookie("provinsi").replaceAll("%20", " ");
    let selectedCity = getCookie("kota") == undefined ? undefined : getCookie("kota").replaceAll("%20", " ");

    console.log();

    // get province
    await $.get('https://dev.farizdotid.com/api/daerahindonesia/provinsi', (data) => {
        provinces = [];
        let option;
        option = '<option value="" hidden>Pilih Provinsi</option>';
        $("#provinsi").append(option);
        data.provinsi.forEach(e => {
            if (selectedProvince !== undefined) {
                option = '<option value="' + e.nama + '"' + (e.nama == selectedProvince ? ' selected' : '') + '>' + e.nama + '</option>';
            } else {
                option = '<option value="' + e.nama + '">' + e.nama + '</option>';
            }

            $("#provinsi").append(option);
            provinces.push(e);
        });
    });

    // get cities
    if (provinces.length > 0) {
        let province = selectedProvince === undefined ? provinces[$("#provinsi")[0].selectedIndex] : provinces[$("#provinsi")[0].selectedIndex - 1];
        getCityByProvinceId(province.id);
        $("#provinsi").change(() => {
            province = provinces[$("#provinsi")[0].selectedIndex - 1];
            getCityByProvinceId(province.id);
        });
    }

    // get city by province id
    async function getCityByProvinceId(id) {
        // clear option
        $("#kota")
            .find('option')
            .remove();

        let option;
        option = '<option value="" hidden>Pilih Kota</option>';
        $("#kota").append(option);
        // binding cities
        await $.get('https://dev.farizdotid.com/api/daerahindonesia/kota?id_provinsi=' + id, (data) => {
            data.kota_kabupaten.forEach(e => {
                if (selectedProvince !== undefined) {
                    option = '<option value="' + e.nama + '"' + (e.nama == selectedCity ? ' selected' : '') + '>' + e.nama + '</option>';
                } else {
                    option = '<option value="' + e.nama + '">' + e.nama + '</option>';
                }
                $("#kota").append(option);
            });
        });
    }
});