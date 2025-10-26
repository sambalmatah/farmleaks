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

    // buat query stuff
    $query = "SELECT * FROM stuff";

    // jalankan query stuff
    $stuffs = query($query);

    // jika tombol cari ditekan
    if( isset($_POST["cari"]) ) {
        // jalankan fungsi pencarian
        $stuffs = caristu($_POST["caristu"]);
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Stuff</title>
</head>
<body>
    <a href="index.php">Home</a>
    <a href="index.php">Kembali</a>
    <br>
    <h1>Master Stuff</h1>
    <a href="tambahstuff.php">Tambah Stuff</a>
    <br><br>
    <form action="" method="post">
        <div>
            <input type="text" id="caristu" name="caristu" placeholder="masukan pencarian..." size="40" autocomplete="off" autofocus>
            <button type="submit"id="btn-caristu"  name="cari" class="btn btn-primary">Cari</button>
        </div>
    </form>
    <br>
    <div id="container-stu">
        <table border="1" cellpadding="10" cellspacing="0">
            <tr>
                <th>No.</th>
                <th>Aksi</th>
                <th>Kode</th>
                <th>Nama</th>
                <th>Kategori</th>
                <th>Kategori Nama</th>
                <th>Unit</th>
                <th>Unit Nama</th>
                <th>Stok</th>
                <th>Keterangan</th>
            </tr>
            <?php $i = 1; ?>
            <?php foreach( $stuffs as $stuff ) : ?>
            <tr>
                <td><?php echo $i; ?></td>
                <td>
                    <a href="ubahstuff.php?stukode=<?php echo $stuff["stukode"]; ?>">Ubah</a>
                    <a href="hapusstuff.php?stukode=<?php echo $stuff["stukode"]; ?>">Hapus</a>
                </td>
                <td><?php echo $stuff["stukode"]; ?></td>
                <td><?php echo $stuff["stunama"]; ?></td>
                <td><?php echo $stuff["stukategori"]; ?></td>
                <td><?php echo $stuff["stukategorinama"]; ?></td>
                <td><?php echo $stuff["stuunit"]; ?></td>
                <td><?php echo $stuff["stuunitnama"]; ?></td>
                <td><?php echo $stuff["stustok"]; ?></td>
                <td><?php echo $stuff["stuketerangan"]; ?></td>
            </tr>
            <?php $i++; ?>
            <?php endforeach; ?>
        </table>

    </div>

    <script src="js/scriptstu.js"></script>
</body>
</html>