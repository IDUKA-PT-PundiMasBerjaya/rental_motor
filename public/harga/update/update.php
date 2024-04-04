<?php 
    include_once("../../../config/koneksi.php");
    include_once("hargaupdate.php");

    $hargaController = new HargaController($kon);

    if (isset($_POST['update'])) {
        $id = $_POST['id'];
        $kendaraan_id_motor = $_POST['kendaraan_id_motor'];
        $harga_per_hari = $_POST['harga_per_hari'];
        
        $message = $hargaController->updateHarga($id, $kendaraan_id_motor, $harga_per_hari);
        echo $message;

        header("Location: ../dashboard.php");
    }

    $id = null;
    $kendaraan_id_motor = null;
    $harga_per_hari = null;

    if (isset($_GET['id']) && is_numeric($_GET['id'])) {
        $id = $_GET['id'];
        $result = $hargaController->getDataHarga($id);

        if ($result) {
            $id = $result['id_harga'];
            $kendaraan_id_motor = $result['kendaraan_id_motor'];
            $harga_per_hari = $result['harga_per_hari'];
        } else {
            echo "ID tidak ditemukan.";
        }
    }

    $dataMotor = "SELECT id_motor, brand, tipe, tahun, warna_motor FROM kendaraan";
    $hasilMotor = mysqli_query($kon, $dataMotor);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Kendaraan</title>
</head>
<body>
    <h1>Update Data Kendaraan</h1>
    <a href="../dashboard.php">Home</a>
    <form action="update.php" method="post" enctype="multipart/form-data">
        <table border="1">
            <tr>
                <td>ID</td>
                <td><input style="width: 97%;" type="text" name="id" value="<?php echo $id; ?>" readonly></td>
            </tr>
            <tr>
                <td>Motor</td>
                <td>
                    <select name="kendaraan_id_motor" id="kendaraan_id_motor">
                        <?php while ($row = mysqli_fetch_assoc($hasilMotor)) : ?>
                            <option value="<?php echo $row['id_motor'];?>">
                                <?php echo $row['id_motor'] . ' - ' . $row['brand'] . ' ' . $row['tipe'] . ' ' . $row['tahun'] . ' - ' . $row['warna_motor']; ?>
                            </option>
                        <?php endwhile; ?>
                    </select>
                </td>
            </tr>
            <tr>
                <td>harga_per_hari</td>
                <td><input style="width: 97%;" type="text" name="harga_per_hari" value="<?php echo $harga_per_hari; ?>"></td>
            </tr>
            <tr>
                <td><input type="hidden" name="id" value="<?php echo $id; ?>"></td>
                <td><input type="submit" name="update" value="Update"></td>
            </tr>
        </table>
    </form>
</body>
</html>