<?php 
    include_once("../../../config/koneksi.php");
    include_once("hargatambah.php");

    $hargaController = new HargaController($kon);

    if (isset($_POST['submit'])) {
        $id= $hargaController->TambahHarga();

        $data = [
            'id_harga' => $id,
            'kendaraan_id_motor' => $_POST['kendaraan_id_motor'],
            'harga_per_hari' => $_POST['harga_per_hari'],
        ];

        $message = $hargaController->tambahDataHarga($data);
    }

    $dataMotor = "SELECT id_motor, brand, tipe, tahun, warna FROM kendaraan";
    $hasilMotor = mysqli_query($kon, $dataMotor);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Data Harga</title>
</head>
<body>
    <h1>Tambah Data Harga</h1>
    |<a href="../dashboard.php"> Home </a>|
    <form action="tambah.php" method="post" enctype="multipart/form-data">
        <table border="1">
            <tr>
                <td>NO ID</td>
                <td><input style="width: 97%;" type="text" name="id" value="<?php echo($hargaController->TambahHarga()) ?>" readonly></td>
            </tr>
            <tr>
                <td>ID Motor</td>
                <td>
                    <select name="kendaraan_id_motor" id="kendaraan_id_motor">
                        <?php while ($row = mysqli_fetch_assoc($hasilMotor)) : ?>
                            <option value="<?php echo $row['id_motor'];?>">
                                <?php echo $row['id_motor'] . ' - ' . $row['brand'] . ' ' . $row['tipe'] . ' ' . $row['tahun'] . ' - ' . $row['warna']; ?>
                            </option>
                        <?php endwhile; ?>
                    </select>
                </td>
            </tr>
            <tr>
                <td>Harga per Hari</td>
                <td><input style="width: 97%;" type="number" name="harga_per_hari" required></td>
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
