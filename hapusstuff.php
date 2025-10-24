<?php 
    // jalankan session diawal
    session_start();

    // cek sudah login atau tidak
    if( !isset($_SESSION["login"]) ) {
        header("Location: login.php");
        exit;
    }
    
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