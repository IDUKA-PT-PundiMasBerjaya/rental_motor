<?php 
    include_once("../../../config/koneksi.php");
    include_once("customertambah.php");

    $customerController = new CustomerController($kon);

    if (isset($_POST['submit'])) {
        $id = $customerController->tambahCustomer();

        $data = [
            'id_customer' => $id,
            'nama' => $_POST['nama'],
            'email' => $_POST['email'],
            'no_telp' => $_POST['no_telp'],
            'alamat' => $_POST['alamat'],
        ];

        $message = $customerController->tambahDataCustomer($data);
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Data Customer</title>
</head>
<body>
    <h1>Tambah Data Customer</h1>
    |<a href="../dashboard.php"> Home </a>|
    <form action="tambah.php" method="post" enctype="multipart/form-data">
        <table border="0">
            <tr>
                <td> ID </td>
                <td> : </td>
                <td><input type="text" name="id" value="<?php echo($customerController->tambahCustomer())?>" readonly></td>
            </tr>
            <tr>
                <td> Nama </td>
                <td> : </td>
                <td><input type="text" name="nama" required></td>
            </tr>
            <tr>
                <td> Email </td>
                <td> : </td>
                <td><input type="text" name="email" required></td>
            </tr>
            <tr>
                <td> No. Telp </td>
                <td> : </td>
                <td><input type="text" name="no_telp" required></td>
            </tr>
            <tr>
                <td> Alamat </td>
                <td> : </td>
                <td><input type="text" name="alamat" required></td>
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