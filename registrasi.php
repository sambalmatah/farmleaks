<?php 

    // kaitkan file functions.php
    require 'functions.php';

    // cek apakah tombol daftar sudah di tekan
    if( isset($_POST["register"]) ) {
        // cek apakah registrasi berhasil ditambahkan
        if( registrasi($_POST) > 0 ) {
            echo "
            <script>
                alert('user baru berhasil ditambahkan');
            </script>
            ";
        } else {
            echo mysqli_error($connect);
        }
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrasi</title>
    <style>
        label {
            display: block;
        }
    </style>
</head>
<body>
    <h1>Halaman Registrasi</h1>

    <form action="" method="post">
        <div>
            <label for="kodeusr">Kode : </label>
            <input type="text" id="kodeusr" name="kodeusr" placeholder="username...">
        </div>
        <div>
            <label for="usernameusr">Username : </label>
            <input type="text" id="usernameusr" name="usernameusr" placeholder="username...">
        </div>
        <div>
            <label for="passwordusr">Password : </label>
            <input type="password" id="passwordusr" name="passwordusr" placeholder="password...">
        </div>
        <div>
            <label for="passwordconfrm">Konfirmasi Password : </label>
            <input type="password" id="passwordconfrm" name="passwordconfrm" placeholder="konfirmasi password...">
        </div>
        <div>
            <button type="submit" name="register" class="btn btn-primary">Daftar</button>
        </div>

    </form>
</body>
</html>