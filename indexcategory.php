<?php 
    // jalankan session diawal
    session_start();

    // cek sudah login atau tidak
    if( !isset($_SESSION["login"]) ) {
        header("Location: login.php");
        exit;
    }
    
    // kaitkan file function.php
    include 'functions.php';

    $query = "SELECT * FROM category";

    $categories = query($query);

    // tombol cari ditekan
    if( isset($_POST["cari"]) ) {
        // jalankan fungsi pencarian
        $categories = caricat($_POST["caricat"]);
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Category</title>
    
    <script src="js/jquery-3.7.1.js"></script>
    <script src="js/scriptcat.js"></script>

    <style>
        .loading-img {
            width: 20px;
            position: absolute;
            padding-left: 6px;
            display: none;
        }
    </style>
</head>
<body>
    <a href="index.php">Home</a> | 
    <a href="index.php">Kembali</a>
    <br>
    <h1>Master Category</h1>
    <a href="tambahcategory.php">Tambah Category</a>
    <br><br>

    <form action="" method="post">
        <div>
            <input type="text" id="caricat" name="caricat" placeholder="masukan pencarian..." size="40" autocomplete="off" autofocus>
            <button type="submit" id="btn-caricat" name="cari" class="btn btn-primary">Cari</button>
            <img src="img/loading.gif" class="loading-img" alt="">
        </div>
    </form>
    <br>
    <!-- bungkus dengan id agar memungkinkan DOM -->
    <div id="container-cat">
        <table border="1" cellpadding="10" cellspacing="0">
            <tr>
                <th>No.</th>
                <th>Aksi</th>
                <th>Kode</th>
                <th>Nama</th>
                <th>Keterangan</th>
                <th>Gambar</th>
            </tr>
            <?php $i = 1 ?>
            <?php foreach( $categories as $category ) : ?>
            <tr>
                <td><?php echo $i; ?></td>
                <td>
                    <a href="ubahcategory.php?catkode=<?php echo $category["catkode"] ?>">Ubah</a>
                    <a href="hapuscategory.php?catkode=<?php echo $category["catkode"] ?>" onclick="return confirm('Apakah Anda yakin ingin menghapus Kategori : <?php echo $category["catnama"]; ?>?')">Hapus</a>
                </td>
                <td><?php echo $category["catkode"]; ?></td>
                <td><?php echo $category["catnama"]; ?></td>
                <td><?php echo $category["catketerangan"]; ?></td>
                <td><img src="img/<?php echo $category["catgambar"]; ?>" alt=""></td>
            </tr>
            <?php $i++; ?>
            <?php endforeach; ?>
        </table>
        
    </div>
</body>
</html>