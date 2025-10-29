// jika dokumen ready, jalankan jquery
$(document).ready(function () {
    // hilangkan tombol cari
    $("#btn-caristu").hide();

    // cari keyword jika ditekan
    $("#caristu").on("keyup", function () {
        // munculkan image loading
        $(".loading-img").show();

        // $.get()
        $.get(
            "ajax/caristu.php?keywordstu=" + $("#caristu").val(),
            function (caristu) {
                $("#container-stu").html(caristu);

                // hilangkan image loading
                $(".loading-img").hide();
            }
        );
    });
});
