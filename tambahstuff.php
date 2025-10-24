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

    // cek apakah tombol submit sudah ditekan atau belum
    if( isset($_POST["submit"]) ) {
        // cek apakah data berhasil ditambahkan atau tidak
        if( tambahstu($_POST) > 0 ) {
            echo "
                <script>
                    alert('data berhasil ditambahkan');
                    document.location.href ='indexstuff.php';
                </script>
            ";
        } else {
            echo "
                <script>
                    alert('data gagal ditambahkan');
                    document.location.href ='indexstuff.php';
                </script>
            ";
        }
    }

    // buat query foreign kategori
    $querycat = "SELECT catkode, catnama FROM category";

    // jalankan query category
    $categories = query($querycat);

    // buat query foreign unit
    $queryden = "SELECT denkode, dennama FROM denomination";

    // jalankan query unit
    $denominations = query($queryden);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Stuff</title>
</head>
<body>
    <a href="index.php">Home</a>
    <a href="indexstuff.php">Kembali</a>
    <br><br>
    <h1>Tambah Stuff</h1>
    <form action="" method="post">
        <div>
            <label for="kodestu">Kode : </label>
            <input type="text" id="kodestu" name="kodestu" placeholder="masukan kode..." required>
        </div>
        <div>
            <label for="namastu">Nama : </label>
            <input type="text" id="namastu" name="namastu" placeholder="masukan nama..." required>
        </div>
        <div>
            <label for="kategoristu">Kategori : </label>
            <select name="kategoristu" id="kategoristu" required>
                <option value="">-- Pilih Kategori --</option>
                <?php foreach ( $categories as $category ) : ?>
                <option value="<?php echo $category["catkode"]; ?>" 
                cat-nama="<?php echo $category["catnama"]; ?>"><?php echo $category["catkode"]; ?> - <?php echo $category["catnama"]; ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <div>
            <label for="kategorinamastu">Kategori Nama :</label>
            <input type="text" id="kategorinamastu" name="kategorinamastu" required readonly>
        </div>
        <div>
            <label for="unitstu">Unit</label>
            <select name="unitstu" id="unitstu" required>
                <option value="">-- Pilih Unit --</option>
                <?php foreach( $denominations as $denomination ) : ?>
                <option value="<?php echo $denomination["denkode"]; ?>"
                den-nama="<?php echo $denomination["dennama"]; ?>"><?php echo $denomination["denkode"]; ?> - <?php echo $denomination["dennama"]; ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <div>
            <label for="unitnamastu">Unit Nama</label>
            <input type="text" id="unitnamastu" name="unitnamastu" required readonly>
        </div>
        <div>
            <label for="stokstu">Stok : </label>
            <input type="text" id="stokstu" name="stokstu" placeholder="masukan stok ..." required>
        </div>
        <div>
            <label for="keteranganstu">Keterangan : </label>
            <input type="text" id="keteranganstu" name="keteranganstu" placeholder="masukan keterangan..." required>
        </div>
        <div>
            <button type="submit" name="submit" class="btn btn-primary">Submit</button>
        </div>
    </form>

    <script>
        // ambil element
        const pilihKategori = document.getElementById('kategoristu');
        const inputKategoriNama =  document.getElementById('kategorinamastu');

        // buat event listener saat pilihan berubah
        pilihKategori.addEventListener('change', function() {
            const selectedKategori = this.options[this.selectedIndex];
            const namaKatagori = selectedKategori.getAttribute('cat-nama') || '';
            inputKategoriNama.value = namaKatagori;
        });

        // ambil element
        const pilihUnit = document.getElementById('unitstu');
        const inputUnitNama = document.getElementById('unitnamastu');

        // buat event listener saat pilihan berubah
        pilihUnit.addEventListener('change', function() {
            const selectedUnit = this.options[this.selectedIndex];
            const namaUnit = selectedUnit.getAttribute('den-nama') || '';
            inputUnitNama.value = namaUnit;
        })
    </script>
</body>
</html>