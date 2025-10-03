<?php 
    // kaitkan file functions.php
    include 'functions.php';

    // buat query select *
    $categories = query("SELECT * FROM category");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FarmLeaks</title>
</head>
<body>
    <h1>Ini adalah Dashboard pertama kali dibuat.</h1>
    <p>Saya memulai project farm ini dengan cukup ambisius agar farm ini dapat berdiri secara mandiri sebagai penghasilan bagi saya dan lingkungan. Saya harap dengan adanya project ini dapat mendukung pertumbuhan dan perkembangan farmleaks yang saya gagas dengan berbagai sumber ilmu yang didapat secara luring dan daring.</p>

    <!-- membuat tombol tambah category -->
    <a href="indexcategory.php">Master Category</a>
    <br><br>
    <a href="indexdenomination.php">Master Denomination</a>
    <br><br>
    <a href="indexstuff.php">Master Stuff</a>
    <br><br>
    <a href="indexexpense.php">Expense</a>
    <br><br>

</body>
</html>