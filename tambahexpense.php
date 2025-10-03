<?php 
    // start session
    session_start();

    // kaitkan file functions.php
    include 'functions.php';

    // variable default, ambil data session kalau ada
    $expense = $_SESSION['expense'] ?? null;

    // flag untuk kontrol tampilan expense detail
    $showDetailForm = false;

    // cek apakah tombol tambah expese sudah ditekan atau belum
    if( isset($_POST["tambahexpense"]) ) {
        tambahexp($_POST);

        // tangkap data ke dalam session
        $_SESSION['expense'] = [
            'kodeexp' => $_POST['kodeexp'],
            'tanggalexp' => $_POST['tanggalexp'],
            'keteranganexp' => $_POST['keteranganexp'],
            'totalexp' => $_POST['totalexp']
        ];

        $showDetailForm = true;

        // reload halaman agar session langsung terbaca
        header("Location: ".$_SERVER['PHP_SELF']);
        exit;
    }

    // cek apakah tombol tambah expense detail sudah ditekan atau belum
    if( isset($_POST["simpanexd"]) ) {
        if( !isset($_SESSION['expense']) ) {
            die("Tidak ada header aktif. Silahkan tambah expense header dulu");
        }
        tambahexd($_POST);

        // setelah simpan expense detail, update total di expense
        $kodeexp = $_SESSION['expense']['kodeexp'];
        $querysum = "SELECT SUM(exdsubharga) AS total FROM expensedetail
                        WHERE exdexpensekode = '$kodeexp'";
        $result = query($querysum);
        $total = $result[0]['total'] ?? 0;

        // update session dan database
        $_SESSION['expense']['totalexp'] = $total;
        $queryupdate = "UPDATE expense SET exptotalharga = '$total'
                            WHERE expkode = '$kodeexp'";
        mysqli_query($connect, $queryupdate);

        // setelah simpan expense detail, form kembali hidden
        $showDetailForm = false;
    }

    // reset untuk buat faktur baru
    if( isset($_POST['resetexp']) ) {
        unset($_SESSION['expense']);    // hapus session
        header("Location: ".$_SERVER['PHP_SELF']); // refresh halaman
        exit;
    }

    // ambil data session kalau ada
    $expense = $_SESSION['expense'] ?? null;

    // kontrol tampilan form detail via GET jika baru menekan tambah expense
    if( isset($_GET['showdetail']) && $_GET['showdetail'] ==1 ) {
        $showDetailForm = true;
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Expense</title>
    <script>
        function toggleDetail(show) {
            document.getElementById('formDetailWrapper').style.display = show ? 'block' : 'none';
        }
    </script>
</head>
<body>
    <a href="index.php">Home</a>
    <a href="indexexpense.php">Kembali</a>
    <h1>Tambah Expense</h1>
    <?php if( !$expense) : ?>
    <form action="" method="post">
        <div>
            <label for="kodeexp">Kode : </label>
            <input type="text" id="kodeexp" name="kodeexp" placeholder="masukan kode..." required>
        </div>
        <div>
            <label for="tanggalexp">Tanggal : </label>
            <input type="date" id="tanggalexp" name="tanggalexp" placeholder="masukan tanggal..." required>
        </div>
        <div>
            <label for="totalexp">Total Expense : </label>
            <input type="text" id="totalexp" name="totalexp" value="0" required readonly>
        </div>
        <div>
            <label for="keteranganexp">Keterangan : </label>
            <input type="text" id="keteranganexp" name="keteranganexp" placeholder="masukan keterangan..." required>
        </div>
        <div>
            <button type="submit" name="batalexp" class="btn btn-primary">Batal</button>
            <button type="submit" name="simpanexp" class="btn btn-primary">Selesai</button>
        </div>
        <button type="submit" name="tambahexpense" class="btn btn-primary">Tambah Expense</button>
    </form>

    <?php else : ?>

    <form action="" method="post">
        <div>
            <label for="kodeexp">Kode : </label>
            <input type="text" id="kodeexp" name="kodeexp" value="<?php echo $expense['kodeexp']; ?>" readonly>
        </div>
        <div>
            <label for="tanggalexp">Tanggal : </label>
            <input type="date" id="tanggalexp" name="tanggalexp" value="<?php echo $expense['tanggalexp']; ?>" readonly>
        </div>
        <div>
            <label for="totalexp">Total Expense : </label>
            <input type="text" id="totalexp" name="totalexp" value="<?php echo $expense['totalexp']; ?>" readonly>
        </div>
        <div>
            <label for="keteranganexp">Keterangan : </label>
            <input type="text" id="keteranganexp" name="keteranganexp" value="<?php echo $expense['keteranganexp']; ?>" readonly>
        </div>
        <div>
            <button type="submit" name="resetexp" class="btn btn-primary">Buat Expense Baru</button>
        </div>
    </form>

    <?php endif; ?>

    <div id="formDetailWrapper" style="display: <?php echo $showDetailForm ? 'block' : 'none'; ?>">
        <h2>Tambah Detail Expense</h2>
        <form action="" method="post">
            <div>
                <label for="expensekodeexd">Kode : </label>
                <input type="text" id="expensekodeexd" name="expensekodeexd" value="<?php echo $expense['kodeexp']; ?>" readonly>
            </div>
            <div>
                <label for="kodeexd">Kode Detail : </label>
                <input type="text" id="kodeexd" name="kodeexd" placeholder="masukan kode..." required>
            </div>
            <div>
                <label for="stuffexd">Kode Stuff :</label>
                <input type="text" id="stuffexd" name="stuffexd" placeholder="masukan kode..." required>
            </div>
            <div>
                <label for="stuffnamaexd">Nama Stuff : </label>
                <input type="text" id="stuffnamaexd" name="stuffnamaexd" placeholder="masukan nama stuff..." required>
            </div>
            <div>
                <label for="qtyexd">Qty : </label>
                <input type="text" id="qtyexd" name="qtyexd" placeholder="masukan qty..." required>
            </div>
            <div>
                <label for="hargaexd">Harga</label>
                <input type="text" id="hargaexd" name="hargaexd" placeholder="masukan harga..." required>
            </div>
            <div>
                <label for="subhargaexd">Sub Harga : </label>
                <input type="text" id="subhargaexd" name="subhargaexd" placeholder="masukan subharga..." required>
            </div>
            <div>
                <button type="submit" name="batalexd" class="btn btn-primary">Batal</button>
                <button type="submit" name="simpanexd" class="btn btn-primary">Simpan</button>
            </div>

        </form>
    </div>

    <!-- tabel detail -->
    <?php if($expense) : ?>
    <h3>Detail Expense <?php echo $expense["kodeexp"]; ?></h3>
    <table border="1" cellpadding="10" cellspacing="0">
        <tr>
            <th>Kode Expense</th>
            <th>Kode Expense Detail</th>
            <th>Kode Stuff</th>
            <th>Nama Stuff</th>
            <th>Qty</th>
            <th>Harga</th>
            <th>Sub Harga</th>
        </tr>
        <?php 
            // buat query select
            $queryselect = "SELECT * FROM expensedetail
                                WHERE exdexpensekode ='".$expense['kodeexp']."'";
            
            // jalankan query select
            $expensedetails = query($queryselect);

            foreach( $expensedetails as $expensedetail ) :
        ?>
        <tr>
            <td><?php echo $expensedetail['exdexpensekode']; ?></td>
            <td><?php echo $expensedetail['exdkode']; ?></td>
            <td><?php echo $expensedetail['exdstuff']; ?></td>
            <td><?php echo $expensedetail['exdstuffnama']; ?></td>
            <td><?php echo $expensedetail['exdqty']; ?></td>
            <td><?php echo $expensedetail['exdharga']; ?></td>
            <td><?php echo $expensedetail['exdsubharga']; ?></td>
        </tr>
        <?php endforeach; ?>
    </table>
    <?php endif; ?>
</body>
</html>