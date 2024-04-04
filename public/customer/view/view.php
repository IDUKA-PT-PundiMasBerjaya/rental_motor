<?php 
    include_once("../../../config/koneksi.php");
    include_once("viewdata.php");

    $customerController = new CustomerController($kon);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Data Customer</title>
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
                <td>Nama</td>
                <td>: </td>
                <td><?php echo $nama; ?></td>
            </tr>
            <tr>
                <td>Email</td>
                <td>: </td>
                <td><?php echo $email; ?></td>
            </tr>
            <tr>
                <td>No. Telp</td>
                <td>: </td>
                <td><?php echo $no_telp; ?></td>
            </tr>
            <tr>
                <td>Alamat</td>
                <td>: </td>
                <td><?php echo $alamat; ?></td>
            </tr>
        </table>
    </form>
</body>
</html>