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

        // upload gambar
        $gambarcat = uploadcat();

        // cek apakah fungsi upload memberikan return kepada $gambar
        if( !$gambarcat ) {
            return false;
        }

        // query insert data
        $query = "INSERT INTO category
                    VALUES
                    ('$kodecat', '$namacat', '$keterangancat', '$gambarcat')";

        // jalankan query insert data
        mysqli_query($connect, $query);

        // kemabalikan nilai baris database terafeksi
        return mysqli_affected_rows($connect);
    }

    function uploadcat() {
        // ambil isi dari $_FILES
        $namafile = $_FILES['gambarcat']['name'];
        $ukuranfile = $_FILES['gambarcat']['size'];
        $error = $_FILES['gambarcat']['error'];
        $tmpname = $_FILES['gambarcat']['tmp_name'];

        // cek apakah tidak ada gambar yang diupload
        if( $error === 4 ) {
            echo "
            <script>
                alert('pilih gambar terlebih dahulu');
            </script>
            ";
            return false;
        }

        // cek apakah file yang diupload adalah gambar
        $ekstensigambarvalid = ['jpg', 'png', 'jpeg'];
        // memecah nama file dengan (delimiter, variable)
        $ekstensigambar = explode('.', $namafile);
        // ambil data terakhir array
        $ekstensigambar = strtolower(end($ekstensigambar));
        // cek apakah data file sesuai kriteria tidak
        if( !in_array($ekstensigambar, $ekstensigambarvalid)) {
            echo "
            <script>
                alert('yang anda upload bukan gambar');
            </script>
            ";
            return false;
        };

        // cek apakah ukuran file sesuai
        if( $ukuranfile > 1000000 ) {
            echo "
            <script>
                alert('ukuran gambar terlalu besar!');
            </script>
            ";
            return false;
        }

        // lolos pengecekan, gambar siap diupload
        // generate nama gambar baru
        $namafilebaru = uniqid();
        $namafilebaru .= '.';
        $namafilebaru .= $ekstensigambar;
        move_uploaded_file($tmpname, 'img/' . $namafilebaru);

        return $namafilebaru;
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
        $gambarlama = htmlspecialchars($ubahcat["gambarlama"]);

        // cek apakah user pilih gambar baru atau tidak
        if( $_FILES['gambarcat']['error'] === 4 ) {
            $gambarcat = $gambarlama;
        } else {
            $gambarcat = uploadcat();
        }

        // buat query ubah
        $query = "UPDATE category
                    SET catnama = '$namacat', catketerangan = '$keterangancat', catgambar = '$gambarcat'
                    WHERE catkode = '$kodecat'";
        
        // jalankan query ubah
        mysqli_query($connect, $query);

        // kembalikan nilai baris database terafeksi
        return mysqli_affected_rows($connect);
    }

    function caricat($caricat) {
        // buat query
        $query = "SELECT * FROM category
                    WHERE catkode LIKE '%$caricat%' 
                    OR catnama LIKE '%$caricat%'";

        return query($query);
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

    function cariden($cariden) {
        // buat query
        $query = "SELECT * FROM denomination
                    WHERE denkode LIKE '%$cariden%'
                    OR dennama LIKE '%$cariden%'";

        return query($query);
    }

    // ===FUNGSI STUFF===
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

    // ===FUNGSI EXPENSE===
    function tambahexp($tambahexp) {
        // daftarkan global variabel untuk $connect
        global $connect;
        // tangkap data
        $kodeexp = htmlspecialchars($tambahexp["kodeexp"]);
        $tanggalexp = htmlspecialchars($tambahexp["tanggalexp"]);
        $totalexp = htmlspecialchars($tambahexp["totalexp"]);
        $keteranganexp = htmlspecialchars($tambahexp["keteranganexp"]);

        // buat query cek
        $querycek = "SELECT * FROM expense
                        WHERE expkode = '$kodeexp'";
        
        // simpan variabel cek
        $cek = mysqli_query($connect, $querycek);

        // cek apakah data sudah ada
        if( mysqli_num_rows($cek) == 0 ) {

            // buat query tambah
            $query = "INSERT INTO expense
                        VALUES ('$kodeexp', '$tanggalexp', '$totalexp', '$keteranganexp')";
    
            // jalankan query tambah
            mysqli_query($connect, $query);
        }

        // kembalikan nilai bari database terafeksi
        return mysqli_affected_rows($connect);
    }

    function caristu($caristu) {
        // buat query
        $query = "SELECT * FROM stuff
                    WHERE stukode LIKE '%$caristu%'
                    OR stunama LIKE '%$caristu%'
                    OR stukategori LIKE '%$caristu%'
                    OR stukategorinama LIKE '%$caristu%'
                    OR stuunit LIKE '%$caristu%'
                    OR stuunitnama LIKE '%$caristu%'
                    OR stustok LIKE '%$caristu%'";

        return query($query);
    }

    // ===FUNGSI EXPENSE DETAIL===
    function tambahexd($tambahexd) {
        // daftarkan global variabel untuk $connect
        global $connect;
        // tangkap data
        $expensekodeexd = htmlspecialchars($tambahexd["expensekodeexd"]);
        $kodeexd = htmlspecialchars($tambahexd["kodeexd"]);
        $stuffexd = htmlspecialchars($tambahexd["stuffexd"]);
        $stuffnamaexd = htmlspecialchars($tambahexd["stuffnamaexd"]);
        $qtyexd = htmlspecialchars($tambahexd["qtyexd"]);
        $hargaexd = htmlspecialchars($tambahexd["hargaexd"]);
        $subhargaexd = htmlspecialchars($tambahexd["subhargaexd"]);

        // buat query tambah
        $query = "INSERT INTO expensedetail
                    VALUES ('$expensekodeexd', '$kodeexd', '$stuffexd', '$stuffnamaexd', '$qtyexd', '$hargaexd', '$subhargaexd')";

        // jalankan query tambah
        mysqli_query($connect, $query);

        return mysqli_affected_rows($connect);
    }

    // ===FUNGSI REGISTRASI===
    function registrasi($regisdata) {
        // daftarkan global variabel untuk $connect
        global $connect;
        // tangkap data
        $kodeusr = htmlspecialchars($regisdata["kodeusr"]);
        $usernameusr = strtolower(stripslashes($regisdata["usernameusr"]));
        $passwordusr = mysqli_real_escape_string($connect, $regisdata["passwordusr"]);
        $passwordconfrm = mysqli_real_escape_string($connect, $regisdata["passwordconfrm"]);

        // cek apakah data username sudah ada
        $querycek = "SELECT usrusername FROM user
                        WHERE usrusername = '$usernameusr'";

        // eksekusi querycek
        $resultquerycek = mysqli_query($connect, $querycek);

        // periksa hasil query
        if( mysqli_fetch_assoc($resultquerycek) ) {
            echo "
            <script>
                alert('username yang dipilih sudah terdaftar');
            </script>
            ";

            // gagalkan fungsi
            return false;
        }

        // cek konfirmasi password
        if( $passwordusr !== $passwordconfrm ) {
            echo "
            <script>
                alert('konfirmasi password tidak sesuai');
            </script>
            ";

            // gagalkan fungsi
            return false;
        }

        // enkripsi password
        $passwordusr = password_hash($passwordusr, PASSWORD_DEFAULT);

        // buat query
        $query = "INSERT INTO user
                    VALUES ('$kodeusr', '$usernameusr', '$passwordusr')";

        // tambahkan user baru ke database
        mysqli_query($connect, $query);

        return mysqli_affected_rows($connect);
    }
?>