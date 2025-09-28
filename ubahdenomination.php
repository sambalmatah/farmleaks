<?php 
    // kaitkan file functions.php
    include 'functions.php';

    // ambil data dari URL menggunakan $_GET
    $kodeden = $_GET["denkode"];

    // buat query mengambil data berdasarkan URL $_GET
    $query = "SELECT * FROM denomination
                WHERE denkode = '$kodeden'";

    // jalankan query select
    $denomination = query($query)[0];

    // cek apakah tombol submit sudah ditekan atau belum
    if( isset($_POST["submit"]) ) {
        // cek data berhasil ditambahkan atau tidak
        if( ubahden($_POST) > 0) {
            echo "
                <script>
                    alert('data berhasil diubah!');
                    document.location.href = 'indexdenomination.php';
                </script>
            ";
        } else {
            echo "
                <script>
                    alert('data gagal diubah!');
                    document.location.href = 'indexdenomination.php';
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
    <title>Tambah Denomination</title>
</head>
<body>
    <a href="index.php">Home</a>
    <a href="indexdenomination.php">Kembali</a>
    <br><br>
    <h2>Tambah Unit</h2>
    <form action="" method="post">
        <div>
            <label for="kodeden">Kode : </label>
            <input type="text" id="kodeden" name="kodeden" value="<?php echo $denomination["denkode"]; ?>" required readonly>
        </div>
        <div>
            <label for="namaden">Nama : </label>
            <input type="text" id="namaden" name="namaden" value="<?php echo $denomination["dennama"]; ?>" required>
        </div>
        <div>
            <label for="keteranganden">Keterangan : </label>
            <input type="text" id="keteranganden" name="keteranganden" value="<?php echo $denomination["denketerangan"]; ?>" required>
        </div>
        <div>
            <button type="submit" name="submit" class="btn btn-primary">Submit</button>
        </div>

    </form>
</body>
</html>