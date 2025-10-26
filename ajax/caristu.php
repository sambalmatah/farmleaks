<?php 
require '../functions.php';
$keywordstu = $_GET["keywordstu"];
$querycaristu = "SELECT * FROM stuff
                    WHERE stukode LIKE '%$keywordstu%'
                    OR stunama LIKE '%$keywordstu%'
                    OR stukategori LIKE '%$keywordstu%'
                    OR stukategorinama LIKE '%$keywordstu%'
                    OR stuunit LIKE '%$keywordstu%'
                    OR stuunitnama LIKE '%$keywordstu%'
                    OR stustok LIKE '%$keywordstu%'";
$stuffs = query($querycaristu);

?>

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