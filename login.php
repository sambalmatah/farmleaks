<?php 
    // jalankan session diawal
    session_start();

    // kaitkan dengan file functions.php
    require 'functions.php';

    // cek apakah ada $_COOKIE
    if( isset($_COOKIE['id']) && isset($_COOKIE['key']) ) {
        $id = $_COOKIE['id'];
        $key = $_COOKIE['key'];

        // buat queryuser
        $queryuser = "SELECT usrusername FROM user
                        WHERE usrkode = '$id'";

        // ambil username berdasarkan id
        $result = mysqli_query($connect, $queryuser);

        $row = mysqli_fetch_array($result);

        // cek cookie dan username
        if( $key === hash('sha256', $row['usrusername']) ) {
            $_SESSION['login'] = true;
        }
    }

    // cek apakah ada $_SESSION
    if( isset($_SESSION["login"]) ) {
        header("Location: index.php");
        exit;
    }

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
            // tampung $result kedalam $row
            $row = mysqli_fetch_assoc($result);

            // cek password
            if( password_verify($password, $row["usrpassword"]) ) {
                // set session
                $_SESSION["login"] = true;

                // cek remember me
                if( isset($_POST["remember"]) ) {
                    // buat cookie
                    setcookie('id', $row['usrkode'], time()+60);
                    setcookie('key', hash('sha256', $row['usrusername']), time()+60);
                }

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
            <input type="checkbox" id="remember" name="remember" placeholder="">
            <label for="remember">Remember me</label>
        </div>
        <div>
            <button type="submit" name="login" class="btn btn-primary">Login</button>
        </div>
    </form>
</body>
</html>