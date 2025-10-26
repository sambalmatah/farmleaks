<?php 
require '../functions.php';
$keywordden = $_GET["keywordden"];
$querycariden  = "SELECT * FROM denomination
                    WHERE denkode LIKE '%$keywordden%'
                    OR dennama LIKE '%$keywordden%'";
$denominations = query($querycariden);

?>

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