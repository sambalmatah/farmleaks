// jika document sudah ready maka jalankan jquery
$(document).ready(function () {
    // hilangkan tombol cari
    $("#btn-caricat").hide();

    // event ketika keyword ditulis
    $("#caricat").on("keyup", function () {
        // munculkan icon loading
        $(".loading-img").show();

        // cari container wrap dan load halaman lain (ajax)
        // $("#container-cat").load(
        //     "ajax/caricat.php?keywordcat=" + $("#caricat").val()
        // );

        // $.get()
        $.get(
            "ajax/caricat.php?keywordcat=" + $("#caricat").val(),
            function (caridat) {
                $("#container-cat").html(caridat);
                $(".loading-img").hide();
            }
        );
    });
});
