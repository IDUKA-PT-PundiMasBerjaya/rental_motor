<?php 
    include_once("../../../config/koneksi.php");
    include_once("motor_tambah.php");

    $motorController = new MotorController($kon);

    if (isset($_POST['submit'])) {
        $id = $motorController->tambahMotor();

        $data = [
            'id_motor' => $id,
            'brand' => $_POST['brand'],
            'tipe' => $_POST['tipe'],
            'tahun' => $_POST['tahun'],
            'warna_motor' => $_POST['warna_motor'],
        ];

        $message = $motorController->tambahDataMotor($data);
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Data Motor</title>
</head>
<body>
    <h1>Tambah Data Motor</h1>
    |<a href="../dashboard.php"> Home </a>|
    <form action="tambah.php" method="post" enctype="multipart/form-data">
        <table border="0">
            <tr>
                <td> ID </td>
                <td> : </td>
                <td><input type="text" name="id" value="<?php echo($motorController->tambahMotor())?>" readonly></td>
            </tr>
            <tr>
                <td> Brand </td>
                <td> : </td>
                <td><input type="text" name="brand" required></td>
            </tr>
            <tr>
                <td> Tipe </td>
                <td> : </td>
                <td><input type="text" name="tipe" required></td>
            </tr>
            <tr>
                <td> Tahun </td>
                <td> : </td>
                <td><input type="text" name="tahun" required></td>
            </tr>
            <tr>
                <td> Warna </td>
                <td> : </td>
                <td><input type="text" name="warna_motor" required></td>
            </tr>
            <tr>
                <td> Gambar Motor </td>
                <td> : </td>
                <td><input type="file" name="gambar_motor"></td>
            </tr>
        </table>
        <input type="submit" name="submit" value="Tambah Data">
        <?php if (isset($message)) : ?>
            <div class="success-message">
                <?php echo($message) ?>
            </div>
        <?php endif; ?>
    </form>
</body>
</html>