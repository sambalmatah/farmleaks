<?php 
    // kaitkan file functions.php
    include 'functions.php';

    // get data dari tabel
    $kodeden = $_GET["denkode"];

    // cek apakah data berhasil dihapus atau tidak
    if( hapusden($kodeden) > 0 ) {
        echo "
            <script>
                alert('data berhasil dihapus!');
                document.location.href = 'indexdenomination.php';
            </script>
        ";
    } else {
        echo "
            <script>
                alert('data gagal dihapus!');
                document.location.href = 'indexdenomination.php';
            </script>
        ";
    }
?>