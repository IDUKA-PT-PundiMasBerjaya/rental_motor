<?php 
    include_once("../../../config/koneksi.php");
    include_once("kendaraantambah.php");

    $garasiController = new KendaraanController($kon);

    if (isset($_POST['submit'])) {
        $id= $garasiController->TambahKendaraan();

        $data = [
            'id_garasi' => $id,
            'kendaraan_id_motor' => $_POST['kendaraan_id_motor'],
            'ketersediaan' => $_POST['ketersediaan'],
        ];

        $message = $garasiController->tambahDataKendaraan($data);
    }

    $dataMotor = "SELECT id_motor, brand, tipe, tahun, warna_motor FROM kendaraan WHERE id_motor NOT IN (SELECT kendaraan_id_motor FROM garasi)";
    $hasilMotor = mysqli_query($kon, $dataMotor);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Data Kendaraan</title>
</head>
<body>
    <h1>Tambah Data Kendaraan</h1>
    |<a href="../dashboard.php"> Home </a>|
    <form action="tambah.php" method="post" enctype="multipart/form-data">
        <table border="1">
            <tr>
                <td>NO ID</td>
                <td><input style="width: 98%;" type="text" name="id" value="<?php echo($garasiController->TambahKendaraan()) ?>" readonly></td>
            </tr>
            <tr>
                <td>Motor</td>
                <td>
                    <select name="kendaraan_id_motor" id="kendaraan_id_motor" required>
                        <?php if (mysqli_num_rows($hasilMotor) == 0) : ?>
                            <option disabled>Tidak ada data di Kendaraan.</option>
                        <?php else : ?>
                            <?php while ($row = mysqli_fetch_assoc($hasilMotor)) : ?>
                                <option value="<?php echo $row['id_motor']; ?>">
                                    <?php echo $row['id_motor'] . ' - ' . $row['brand'] . ' ' . $row['tipe'] . ' ' . $row['tahun'] . ' - ' . $row['warna_motor'] ?>
                                </option>
                            <?php endwhile; ?>
                        <?php endif; ?>
                    </select>
                </td>
            </tr>
            <tr>
                <td>Ketersediaan</td>
                <td>
                    <label>
                        <input type="radio" name="ketersediaan" value="1"> Sedia
                    </label>
                    <label>
                        <input type="radio" name="ketersediaan" value="0"> Kosong
                    </label>
                </td>
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
