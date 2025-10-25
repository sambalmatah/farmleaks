<?php 
    // jalankan session diawal
    session_start();

    // cek sudah login atau tidak
    if( !isset($_SESSION["login"]) ) {
        header("Location: login.php");
        exit;
    }
    
    // kaitkan file functions.php
    include 'functions.php';

    // paginantion konfigurasi
    $jumlahdataperhalaman = 3;
    // menjumlahkan total baris seluruh data
    $jumlahdata = count(query("SELECT * FROM denomination"));
    // cari tahu jumlah halaman
    $jumlahhalaman = ceil($jumlahdata / $jumlahdataperhalaman);
    // mencari halaman terkini berada
    // cek jika url ada $_GET["page"]
    if( isset($_GET["page"]) ) {
        $halamanaktif = $_GET["page"];
    } else {
        $halamanaktif = 1;
    }
    // mencari awaldata setiap halaman
    $awaldata = ($jumlahdataperhalaman * $halamanaktif) - $jumlahdataperhalaman;

    // buat query
    $query = "SELECT * FROM denomination LIMIT $awaldata, $jumlahdataperhalaman";

    // jalankan query select
    $denominations = query($query);

    // jika tombol cari ditekan
    if( isset($_POST["cari"]) ) {
        // jalankan fungsi pencarian
        $denominations = cariden($_POST["cariden"]);
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Denomination</title>
</head>
<body>
    <a href="index.php">Home</a>
    <a href="index.php">Kembali</a>
    <br>
    <h1>Master Denomination</h1>
    <a href="tambahdenomination.php">Tambah Denomination</a>
    <br><br>
    <form action="" method="post">
        <div>
            <input type="text" id="cariden" name="cariden" placeholder="masukan pencarian..." size="40" autocomplete="off" autofocus>
            <button type="submit" name="cari" class="btn btn-primary">Cari</button>
        </div>
    </form>
    <br>
    <!-- navigasi pagination -->
    <?php if( $halamanaktif > 1 ) : ?>
    <a href="?page=<?php echo $halamanaktif - 1; ?>">&laquo;</a>
    <?php endif; ?>
    <?php for($i = 1; $i <= $jumlahhalaman; $i++) : ?>
        <?php if( $i == $halamanaktif ) : ?>
        <a href="?page=<?php echo $i ?>" style="font-weight: bold; color:salmon"><?php echo $i ?></a>
        <?php else : ?>
        <a href="?page=<?php echo $i ?>"><?php echo $i ?></a>
        <?php endif; ?>
    <?php endfor; ?>
    <?php if( $halamanaktif < $jumlahhalaman ) : ?>
    <a href="?page=<?php echo $halamanaktif + 1; ?>">&raquo;</a>
    <?php endif; ?>
    <br>
    <table border="1" cellpadding="10" cellspacing="0">
        <tr>
            <th>No.</th>
            <th>Aksi</th>
            <th>Kode</th>
            <th>Nama</th>
            <th>Keterangan</th>
        </tr>
        <?php $i = 1; ?>
        <?php foreach( $denominations as $denomination ) : ?>
        <tr>
            <td><?php echo $i; ?></td>
            <td>
                <a href="ubahdenomination.php?denkode=<?php echo $denomination["denkode"]; ?>">Ubah</a>
                <a href="hapusdenomination.php?denkode=<?php echo $denomination["denkode"]; ?>">Hapus</a>
            </td>
            <td><?php echo $denomination["denkode"]; ?></td>
            <td><?php echo $denomination["dennama"]; ?></td>
            <td><?php echo $denomination["denketerangan"]; ?></td>
        </tr>
        <?php $i++; ?>
        <?php endforeach; ?>
    </table>
</body>
</html>