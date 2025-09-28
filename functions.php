<?php 
    // koneksi ke database
    $connect = mysqli_connect("localhost", "root", "", "farmleaks");

    function query($query) {
        // daftarkan variabel global untuk $connect
        global $connect;
        // buat variable result ingin melakukan apa
        $result = mysqli_query($connect, $query);
        // buat wadah
        $rows = [];
        // buat perulangan 
        while( $row = mysqli_fetch_assoc($result) ) {
            // simpan setiap row kedalam wadah array yang telah dibuat
            $rows[] = $row;
        }

        // kembalikan nilai array yang telah terisi
        return $rows;

    }

    // ===FUNGSI KATEGORI===
    function tambahcat($data) {
        // daftarkan variabel global untuk $connect
        global $connect;
        // ambil seluruh data yang ada pada $_POST form
        $kodecat = htmlspecialchars($data["kodecat"]);
        $namacat = htmlspecialchars($data["namacat"]);
        $keterangancat = htmlspecialchars($data["keterangancat"]);

        // query insert data
        $query = "INSERT INTO category
                    VALUES
                    ('$kodecat', '$namacat', '$keterangancat')";

        // jalankan query insert data
        mysqli_query($connect, $query);

        // kemabalikan nilai baris database terafeksi
        return mysqli_affected_rows($connect);
    }

    function hapuscat($hapuscat) {
        // daftarkan variabel global untuk $connect
        global $connect;
        // buat query hapus
        $query = "DELETE FROM category 
                    WHERE catkode = '$hapuscat'";

        // jalankan query hapus
        mysqli_query($connect, $query);

        // kembalikan nilai baris database terafeksi
        return mysqli_affected_rows($connect);
    }

    function ubahcat($ubahcat) {
        // daftarkan variabel global untuk $connect
        global $connect;
        // ambil seluruh data yang masuk ke dalam $_POST
        $kodecat = htmlspecialchars($ubahcat["kodecat"]);
        $namacat = htmlspecialchars($ubahcat["namacat"]);
        $keterangancat = htmlspecialchars($ubahcat["keterangancat"]);

        // buat query ubah
        $query = "UPDATE category
                    SET catnama = '$namacat', catketerangan = '$keterangancat'
                    WHERE catkode = '$kodecat'";
        
        // jalankan query ubah
        mysqli_query($connect, $query);

        // kembalikan nilai baris database terafeksi
        return mysqli_affected_rows($connect);
    }

    // ===FUNGSI DENOMINATION===
    function tambahden($data) {
        // daftarkan variabel global untuk $connect
        global $connect;
        // rekam seluruh data yang masuk ke dalam $_POST
        $kodeden = htmlspecialchars($data["kodeden"]);
        $namaden = htmlspecialchars($data["namaden"]);
        $keteranganden = htmlspecialchars($data["keteranganden"]);

        $query = "INSERT INTO denomination
                    VALUES ('$kodeden', '$namaden', '$keteranganden')";

        mysqli_query($connect, $query);

        // kembalikan nilai baris database terafeksi
        return mysqli_affected_rows($connect);
    }

    function hapusden($hapusden) {
        // daftarkan global variabel untuk $connect
        global $connect;
        // buat query hapus
        $query = "DELETE FROM denomination
                    WHERE denkode = '$hapusden'";
        
        // jalankan query hapus
        mysqli_query($connect, $query);

        // kembalikan nilai baris database terafeksi
        return mysqli_affected_rows($connect);
    }

    function ubahden($ubahden) {
        // daftarkan global variabel untuk $connect
        global $connect;
        // rekam seluruh data yang masuk ke dalam $_POST
        $kodeden = htmlspecialchars($ubahden["kodeden"]);
        $namaden = htmlspecialchars($ubahden["namaden"]);
        $keteranganden = htmlspecialchars($ubahden["keteranganden"]);

        // buat query ubah
        $query = "UPDATE denomination
                    SET dennama = '$namaden', denketerangan = '$keteranganden'
                    WHERE denkode = '$kodeden'";
        
        // jalankan query ubah
        mysqli_query($connect, $query);

        // kembalikan nilai baris database terafeksi
        return mysqli_affected_rows($connect);
    }

    function tambahstu($data) {
        // daftarkan global variabel untuk $connect
        global $connect;
        // rekam seluruh data yang masuk ke dalam $_POST
        $kodestu = htmlspecialchars($data["kodestu"]);
        $namastu = htmlspecialchars($data["namastu"]);
        $kategoristu = htmlspecialchars($data["kategoristu"]);
        $kategorinamastu = htmlspecialchars($data["kategorinamastu"]);
        $unitstu = htmlspecialchars($data["unitstu"]);
        $unitnamastu = htmlspecialchars($data["unitnamastu"]);
        $stokstu = htmlspecialchars($data["stokstu"]);
        $keteranganstu = htmlspecialchars($data["keteranganstu"]);

        // buat query tambah
        $query = "INSERT INTO stuff
                    VALUES ('$kodestu', '$namastu', '$kategoristu', '$kategorinamastu', '$unitstu', '$unitnamastu', '$stokstu','$keteranganstu')";

        // jalan query tambah
        mysqli_query($connect, $query);

        // kembalikan nilai baris database terafeksi
        return mysqli_affected_rows($connect);
        
    }

    function hapusstu($hapusstu) {
        // daftarkan global variabel untuk $connect
        global $connect;
        // buat query hapus
        $query = "DELETE FROM stuff
                    WHERE stukode = '$hapusstu'";
        
        // jalankan query hapus
        mysqli_query($connect, $query);

        // kembalikan nilai baris database terafeksi
        return mysqli_affected_rows($connect);
    }
?>