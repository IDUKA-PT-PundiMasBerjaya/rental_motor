<?php 
    include_once("../../../config/koneksi.php");
    include_once("viewdata.php");

    $penyewaanController = new PenyewaanController($kon);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vide Data Peminjam</title>
</head>
<body>
    <a href="../dashboard.php">| Home |</a>
    <br><br>
    <form action="view.php" name="update_data" method="post">
        <table>
            <tr>
                <td>ID Peminjam</td>
                <td>: </td>
                <td><?php echo $id; ?></td>
            </tr>
            <tr>
                <td>Nama Peminjam</td>
                <td>: </td>
                <td><?php echo $namapenyewa; ?></td>
            </tr>
            <tr>
                <td>Tanggal Peminjaman</td>
                <td>: </td>
                <td><?php echo $tanggal_pinjam; ?></td>
            </tr>
            <tr>
                <td>Tanggal Pengembalian</td>
                <td>: </td>
                <td><?php echo $tanggal_balik; ?></td>
            </tr>
        </table>
    </form>
</body>
</html>