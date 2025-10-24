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

    // ambil data dari URL menggunakan $_GET
    $catkode = $_GET['catkode'];

    // buat query mengambil data berdasarkan URL $_GET
    $query = "SELECT * FROM category
                WHERE catkode = '$catkode'";

    // jalankan query select
    $category = query($query)[0];

    // cek apakah tombol submit sudah ditekan atau belum
    if( isset($_POST["submit"]) ) {
        // cek apakah data berahsil ditambahkan atau tidak
        if( ubahcat($_POST) > 0) {
            echo "
                <script>
                    alert('data berhasil diubah!');
                    document.location.href = 'indexcategory.php';
                </script>
            ";
        } else {
            echo "
                <script>
                    alert('data gagal diubah!');
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
    <form action="" method="post" enctype="multipart/form-data">
        <input type="hidden" name="gambarlama" value="<?php echo $category['catgambar']; ?>">
        <div>
            <label for="kodecat">Kode : </label>
            <input type="text" id="kodecat" name="kodecat" placeholder="masukan kode..."  value="<?php echo $category["catkode"]; ?>" required readonly>
        </div>
        <div>
            <label for="namacat">Nama : </label>
            <input type="text" id="namacat" name="namacat" placeholder="masukan nama..." value="<?php echo $category["catnama"]; ?>" required>
        </div>
        <div>
            <label for="keterangancat">Keterangan :</label>
            <input type="text" id="keterangancat" name="keterangancat" placeholder="masukan nama..." value="<?php echo $category["catketerangan"]; ?>" required>
        </div>
        <div>
            <label for="gambarcat">Gambar :</label>
            <div>
                <img src="img/<?php echo $category['catgambar']; ?>" alt="">
            </div>
            <input type="file" id="gambarcat" name="gambarcat" placeholder="masukan gambar">
        </div>
        <div>
            <button type="submit" name="submit" class="btn btn-primary">Submit</button>
        </div>

    </form>
</body>
</html>