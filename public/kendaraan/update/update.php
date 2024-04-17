<?php 
    include_once("../../../config/koneksi.php");
    include_once("motorupdate.php");

    $motorController = new MotorController($kon);

    if (isset($_POST['update'])) {
        $id = $_POST['id'];
        $brand = $_POST['brand'];
        $tipe = $_POST['tipe'];
        $tahun = $_POST['tahun'];
        $warna_motor = $_POST['warna_motor'];
        $harga_per_hari = $_POST['harga_per_hari'];
        
        $message = $motorController->updateMotor($id, $brand, $tipe, $tahun , $warna_motor, $harga_per_hari);
        echo $message;

        header("Location: ../dashboard.php");
    }

    $id = null;
    $brand = null;
    $tipe = null;
    $tahun = null;
    $warna_motor = null;

    if (isset($_GET['id']) && is_numeric($_GET['id'])) {
        $id = $_GET['id'];
        $result = $motorController->getDataMotor($id);

        if ($result) {
            $id = $result['id_motor'];
            $brand = $result['brand'];
            $tipe = $result['tipe'];
            $tahun = $result['tahun'];
            $warna_motor = $result['warna_motor'];
            $harga_per_hari = $result['harga_per_hari'];
        } else {
            echo "ID tidak ditemukan.";
        }
    }
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
                <td><input type="text" name="id" value="<?php echo $id; ?>" readonly></td>
            </tr>
            <tr>
                <td>Brand</td>
                <td><input type="text" name="brand" value="<?php echo $brand; ?>"></td>
            </tr>
            <tr>
                <td>Tipe</td>
                <td><input type="text" name="tipe" value="<?php echo $tipe; ?>"></td>
            </tr>
            <tr>
                <td>Tahun</td>
                <td><input type="number" name="tahun" value="<?php echo $tahun; ?>"></td>
            </tr>
            <tr>
                <td>Warna</td>
                <td><input type="text" name="warna_motor" value="<?php echo $warna_motor; ?>"></td>
            </tr>
            <tr>
                <td>Harga per Hari</td>
                <td><input type="text" name="harga_per_hari" value="<?php echo $harga_per_hari; ?>"></td>
            </tr>
            <tr>
                <td><input type="hidden" name="id" value="<?php echo $id; ?>"></td>
                <td><input type="submit" name="update" value="Update"></td>
            </tr>
        </table>
    </form>
</body>
</html>