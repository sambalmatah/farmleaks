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

    // pagination konfigurasi
    $jumlahdataperhalaman = 3;
    // menjumlahkan total baris data
    $jumlahdata = count(query("SELECT * FROM category"));
    // cari tahu jumlah data perhalaman
    $jumlahhalaman = ceil($jumlahdata / $jumlahdataperhalaman);
    // mencari halaman terkini berada
    // cek jika url memiliki $_GET["page"]
    if( isset($_GET["page"]) ) {
        $halamanaktif = $_GET["page"];
    } else {
        $halamanaktif = 1;
    }

    $awaldata = ($jumlahdataperhalaman * $halamanaktif) - $jumlahdataperhalaman;

    $query = "SELECT * FROM category LIMIT $awaldata, $jumlahdataperhalaman";

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
            <button type="submit" name="cari" class="btn btn-primary">Cari</button>
        </div>
    </form>
    <br>
    <!-- navigation pagination -->
    <?php if($halamanaktif > 1) : ?>
    <a href="?page=<?php echo $halamanaktif - 1; ?>">&laquo;</a>
    <?php endif; ?>
    <?php for($i = 1; $i <= $jumlahhalaman; $i++) : ?>
        <?php if($i == $halamanaktif) : ?>
        <a href="?page=<?php echo $i ?>" style="font-weight: bold; color: salmon;"><?php echo $i; ?></a>
        <?php else : ?>
        <a href="?page=<?php echo $i ?>"><?php echo $i; ?></a>
        <?php endif; ?>
    <?php endfor; ?>
    <?php if($halamanaktif < $jumlahhalaman) : ?>
    <a href="?page=<?php echo $halamanaktif + 1; ?>">&laquo;</a>
    <?php endif; ?>
    <br>
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
</body>
</html>