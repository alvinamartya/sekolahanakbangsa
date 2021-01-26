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

    // get province
    await $.get('https://dev.farizdotid.com/api/daerahindonesia/provinsi', (data) => {
        provinces = [];
        data.provinsi.forEach(e => {
            let option;
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
        getCityByProvinceId(provinces[$("#provinsi")[0].selectedIndex].id);

        $("#provinsi").change(() => {
            getCityByProvinceId(provinces[$("#provinsi")[0].selectedIndex].id);
        });
    }

    // get city by province id
    async function getCityByProvinceId(id) {
        // clear option
        $("#kota")
            .find('option')
            .remove();

        // binding cities
        await $.get('https://dev.farizdotid.com/api/daerahindonesia/kota?id_provinsi=' + id, (data) => {
            data.kota_kabupaten.forEach(e => {
                let option;
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