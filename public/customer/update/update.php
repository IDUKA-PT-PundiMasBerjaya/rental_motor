<?php 
    include_once("../../../config/koneksi.php");
    include_once("customerupdate.php");

    $customerController = new CustomerController($kon);

    if (isset($_POST['update'])) {
        $id = $_POST['id'];
        $nama = $_POST['nama'];
        $email = $_POST['email'];
        $no_telp = $_POST['no_telp'];
        $alamat = $_POST['alamat'];
        
        $message = $customerController->updateCustomer($id, $nama, $email, $no_telp , $alamat);
        echo $message;

        header("Location: ../dashboard.php");
    }

    $id = null;
    $nama = null;
    $email = null;
    $no_telp = null;
    $alamat = null;

    if (isset($_GET['id']) && is_numeric($_GET['id'])) {
        $id = $_GET['id'];
        $result = $customerController->getDataCustomer($id);

        if ($result) {
            $id = $result['id_customer'];
            $nama = $result['nama'];
            $email = $result['email'];
            $no_telp = $result['no_telp'];
            $alamat = $result['alamat'];
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
    <title>Update Customer</title>
</head>
<body>
    <h1>Update Data Customer</h1>
    <a href="../dashboard.php">Home</a>
    <form action="update.php" method="post" enctype="multipart/form-data">
        <table border="1">
            <tr>
                <td>ID</td>
                <td><input type="text" name="id" value="<?php echo $id; ?>" readonly></td>
            </tr>
            <tr>
                <td>Nama</td>
                <td><input type="text" name="nama" value="<?php echo $nama; ?>"></td>
            </tr>
            <tr>
                <td>Email</td>
                <td><input type="text" name="email" value="<?php echo $email; ?>"></td>
            </tr>
            <tr>
                <td>No. Telp</td>
                <td><input type="number" name="no_telp" value="<?php echo $no_telp; ?>"></td>
            </tr>
            <tr>
                <td>Alamat</td>
                <td><input type="text" name="alamat" value="<?php echo $alamat; ?>"></td>
            </tr>
            <tr>
                <td><input type="hidden" name="id" value="<?php echo $id; ?>"></td>
                <td><input type="submit" name="update" value="Update"></td>
            </tr>
        </table>
    </form>
</body>
</html>