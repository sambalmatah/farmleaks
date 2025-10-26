<?php 
require '../functions.php';
$keywordcat = $_GET["keywordcat"];
$querycaricat = "SELECT * FROM category 
                    WHERE catkode LIKE '%$keywordcat%' 
                    OR catnama LIKE '%$keywordcat%'";
$categories = query($querycaricat);

?>

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