<?php 
    include_once("../../../config/koneksi.php");
    include_once("penyewaantambah.php"); // Ubah nama file jika perlu

    $penyewaanController = new PenyewaanController($kon); // Ubah nama class jika perlu

    if (isset($_POST['submit'])) {
        $id_penyewa = $penyewaanController->tambahPenyewaan(); // Ubah nama fungsi jika perlu
        $data = [
            'id_penyewaan' => $id_penyewa, // Ubah nama variabel
            'penyewaan_id_customer' => $_POST['penyewaan_id_customer'], // Ubah nama variabel
            'tanggal_pinjam' => $_POST['tanggal_pinjam'],
            'tanggal_balik' => $_POST['tanggal_balik'],
        ];
        $message = $penyewaanController->tambahDataPenyewaan($data); // Ubah nama fungsi jika perlu
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
    <title>Tambah Data Penyewa</title> <!-- Ubah judul -->
</head>
<body>
    <h1>Tambah Data Penyewa</h1> <!-- Ubah heading -->
    <a href="../dashboard.php">Home</a>
    <form action="tambah.php" method="post" name="tambah" enctype="multipart/form-data">
        <table border="1">
            <tr>
                <td>ID Penyewa</td> <!-- Ubah label -->
                <td><input style="width: 97%;" type="text" name="id_penyewaan" value="<?php echo($penyewaanController->tambahPenyewaan()) ?>" readonly></td> <!-- Ubah nama variabel dan fungsi -->
            </tr>
            <tr>
                <td>Data Customer</td>
                <td>
                    <select name="penyewaan_id_customer"> <!-- Ubah nama variabel -->
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