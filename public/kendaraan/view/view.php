<?php 
    include_once("../../../config/koneksi.php");
    include_once("viewdata.php");

    $motorController = new MotorController($kon);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Data Motor</title>
</head>
<body>
    |<a href="../dashboard.php"> Home </a>|
    <br><br>
    <form action="view.php" method="post" name="update_data">
        <table>
            <tr>
                <td>No</td>
                <td>: </td>
                <td><?php echo $id; ?></td>
            </tr>
            <tr>
                <td>Brand</td>
                <td>: </td>
                <td><?php echo $brand; ?></td>
            </tr>
            <tr>
                <td>Tipe</td>
                <td>: </td>
                <td><?php echo $tipe; ?></td>
            </tr>
            <tr>
                <td>Tahun</td>
                <td>: </td>
                <td><?php echo $tahun; ?></td>
            </tr>
            <tr>
                <td>Warna</td>
                <td>: </td>
                <td><?php echo $warna_motor; ?></td>
            </tr>
            <tr>
                <td>Warna</td>
                <td>: </td>
                <td>Rp. <?php echo $harga_per_hari; ?>/Hari</td>
            </tr>
            <tr>
                <td>Gambar</td>
                <td>: </td>
                <td>
                    <?php 
                        $data = mysqli_query($kon, "SELECT * FROM kendaraan WHERE id_motor = $id");
                        while ($row = mysqli_fetch_array($data)) :
                    ?>
                        <a href="#" onclick="window.open('../aset/<?php echo $row['gambar_motor']; ?>', '_blank')"></a>
                        <img src="../aset/<?php echo $row['gambar_motor']; ?>" alt="<?php echo $row['gambar_motor']; ?>">
                    <?php endwhile; ?>
                </td>
            </tr>
        </table>
    </form>
</body>
</html>