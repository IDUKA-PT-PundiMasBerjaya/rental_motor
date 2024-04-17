<?php 
    include_once("../../../config/koneksi.php");
    include_once("peminjamtambah.php");

    $peminjamController = new PeminjamController($kon);

    if (isset($_POST['submit'])) {
        $id_peminjam = $peminjamController->tambahPeminjam();
        $data = [
            'id_peminjam' => $id_peminjam,
            'peminjam_id_customer' => $_POST['peminjam_id_customer'],
            'tanggal_pinjam' => $_POST['tanggal_pinjam'],
            'tanggal_balik' => $_POST['tanggal_balik'],
        ];
        $message = $peminjamController->tambahDataPeminjam($data);
    } else {
        $message = "Harap pilih customer";
    }

    $dataCustomer = mysqli_query($kon, "SELECT id_customer, nama FROM customer");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Data Peminjam</title>
</head>
<body>
    <h1>Tambah Data Peminjam</h1>
    <a href="../dashboard.php">Home</a>
    <form action="tambah.php" method="post" name="tambah" enctype="multipart/form-data">
        <table border="1">
            <tr>
                <td>ID Peminjam</td>
                <td><input style="width: 97%;" type="text" name="id_peminjam" value="<?php echo($peminjamController->tambahPeminjam()) ?>" readonly></td>
            </tr>
            <tr>
                <td>Data Customer</td>
                <td>
                    <select name="peminjam_id_customer">
                        <?php while($row = mysqli_fetch_assoc($dataCustomer)) : ?>
                            <option value="<?php echo $row['id_customer']; ?>">
                                <?php echo $row['id_customer'] . ' - ' . $row['nama'] ?>
                            </option>
                        <?php endwhile; ?>
                    </select>
                </td>
            </tr>
            <tr>
                <td>Tanggal Peminjaman</td>
                <td><input type="date" name="tanggal_pinjam" required></td>
            </tr>
            <tr>
                <td>Tanggal Pengembalian</td>
                <td><input type="date" name="tanggal_balik" required></td>
            </tr>
        </table>
        <input type="submit" name="submit" value="Tambah Data">
        <?php if (isset($message)) : ?>
            <div class="success-message">
                <?php echo $message; ?>
            </div>
        <?php endif; ?>
    </form>
</body>
</html>