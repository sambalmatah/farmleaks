<?php 
    // kaitkan file function.php
    include 'functions.php';

    $query = "SELECT * FROM category";

    $categories = query($query);
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

    <table border="1" cellpadding="10" cellspacing="0">
        <tr>
            <th>No.</th>
            <th>Aksi</th>
            <th>Kode</th>
            <th>Nama</th>
            <th>Keterangan</th>
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
        </tr>
        <?php $i++; ?>
        <?php endforeach; ?>
    </table>
</body>
</html>