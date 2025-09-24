<?php 
    // kaitkan file functions.php
    include 'functions.php';

    // cek apakah tombol submit sudah ditekan atau belum
    if( isset($_POST["submit"]) ) {
        // cek apakah data berahsil ditambahkan atau tidak
        if( tambahcat($_POST) > 0) {
            echo "
                <script>
                    alert('data berhasil ditambahkan!');
                    document.location.href = 'indexcategory.php';
                </script>
            ";
        } else {
            echo "
                <script>
                    alert('data gagal ditambahkan!');
                    document.location.href = 'indexcategory.php';
                </script>
            ";
        }
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
    <a href="indexcategory.php">Kembali</a>
    <br><br>
    <h2>Tambah Kategori</h2>
    <form action="" method="post">
        <div>
            <label for="kodecat">Kode : </label>
            <input type="text" id="kodecat" name="kodecat" placeholder="masukan kode..." required>
        </div>
        <div>
            <label for="namacat">Nama : </label>
            <input type="text" id="namacat" name="namacat" placeholder="masukan nama..." required>
        </div>
        <div>
            <label for="keterangancat">Keterangan :</label>
            <input type="text" id="keterangancat" name="keterangancat" placeholder="masukan nama..." required>
        </div>
        <div>
            <button type="submit" name="submit" class="btn btn-primary">Submit</button>
        </div>

    </form>
</body>
</html>