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
});