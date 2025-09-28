<?php 
    // kaitkan dengan file functions.php
    include 'functions.php';
    // tangkap id dengan menggunakan $_GET
    $stukode = $_GET["stukode"];

    if( hapusstu($stukode) > 0 ) {
        echo "
            <script>
                alert('data berhasil dihapus!');
                document.location.href = 'indexstuff.php';
            </script>
        ";
    } else {
        echo "
            <script>
                alert('data gagal dihapus!');
                document.location.href = 'indexstuff.php';
            </script>
        ";
    }
?>