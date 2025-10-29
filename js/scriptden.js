// jika dokumen ready, jalankan jquery
$(document).ready(function () {
    // hilangkan tombol cari
    $("#btn-cariden").hide();

    // event keyword ketika ditulis
    $("#cariden").on("keyup", function () {
        // munculkan loading
        $(".loading-img").show();

        // $.get()
        $.get(
            "ajax/cariden.php?keywordden=" + $("#cariden").val(),
            function (cariden) {
                $("#container-den").html(cariden);
                $(".loading-img").hide();
            }
        );
    });
});
