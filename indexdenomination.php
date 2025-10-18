<?php 
    // kaitkan file functions.php
    include 'functions.php';

    // buat query
    $query = "SELECT * FROM denomination";

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