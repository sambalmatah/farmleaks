<?php 
    // jalankan session diawal
    session_start();

    if( isset($_SESSION["login"]) ) {
        header("Location: index.php");
        exit;
    }

    // kaitkan dengan file functions.php
    require 'functions.php';

    // cek apakah tombol login sudah ditekan
    if( isset($_POST["login"]) ) {
        // tangkap data
        $username = $_POST["username"];
        $password = $_POST["password"];
        
        // buat query
        $queryuser = "SELECT * FROM user
                        WHERE usrusername = '$username'";

        // cek password
        $result =  mysqli_query($connect, $queryuser);

        // cek username
        if( mysqli_num_rows($result) === 1 ) {
            // cek password
            $row = mysqli_fetch_assoc($result);
            if( password_verify($password, $row["usrpassword"]) ) {
                // set session
                $_SESSION["login"] = true;

                header("Location: index.php");
                exit;
            }
        }

        $error = true;

    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Halaman Login</title>
    <style>
        p {
            font-style: italic;
            color: red;
        }
    </style>
</head>
<body>
    <h1>Halaman Login</h1>

    <?php if( isset($error) ) : ?>
        <p>username atau password salah!</p>
    <?php endif; ?>

    <form action="" method="post">
        <div>
            <label for="username">Username : </label>
            <br>
            <input type="text" id="username" name="username" placeholder="masukan username...">
        </div>
        <div>
            <label for="password">Password : </label>
            <br>
            <input type="password" id="password" name="password" placeholder="masukan password">
        </div>
        <div>
            <button type="submit" name="login" class="btn btn-primary">Login</button>
        </div>
    </form>
</body>
</html>