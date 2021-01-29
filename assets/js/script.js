$(function () {
    // Datatable - master
    $('#master-data').DataTable();

    // Alert Auto Fade
    setTimeout(function () {
        $(".alert").slideUp(500);
    }, 3000);

})