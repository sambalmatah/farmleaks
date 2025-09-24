<?php 
    // kaitkan file functions.php
    include 'functions.php';
    
    // tangkap id dengan menggunakan get
    $catkode = $_GET["catkode"];

    if( hapuscat($catkode) > 0 ) {
        echo "
                <script>
                    alert('data berhasil dihapus!');
                    document.location.href = 'indexcategory.php';
                </script>
            ";
    } else {
        echo "
                <script>
                    alert('data gagal dihapus!');
                    document.location.href = 'indexcategory.php';
                </script>
            ";
    }
?>