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
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../../../src/output.css">
</head>
<body class="bg-gray-100 p-8">
    <h1  class="text-2xl font-bold mb-4">Update Data Customer</h1>
    <a href="../dashboard.php" class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded mr-4">Home</a>
    <form action="update.php" method="post" enctype="multipart/form-data" class="max-w-md mx-auto bg-white p-8 rounded shadow-lg">
        <div class="mb-4">
            <label class="block font-bold">ID</label>
            <input type="text" name="id" value="<?php echo $id; ?>" readonly
                class="w-full border border-gray-300 px-3 py-2 rounded-md">
        </div>
        <div class="mb-4">
            <label class="block font-bold">Nama</label>
            <input type="text" name="nama" value="<?php echo $nama; ?>"
                class="w-full border border-gray-300 px-3 py-2 rounded-md">
        </div>
        <div class="mb-4">
            <label class="block font-bold">Email</label>
            <input type="text" name="email" value="<?php echo $email; ?>"
                class="w-full border border-gray-300 px-3 py-2 rounded-md">
        </div>
        <div class="mb-4">
            <label class="block font-bold">No. Telp</label>
            <input type="number" name="no_telp" value="<?php echo $no_telp; ?>"
                class="w-full border border-gray-300 px-3 py-2 rounded-md">
        </div>
        <div class="mb-4">
            <label class="block font-bold">Alamat</label>
            <input type="text" name="alamat" value="<?php echo $alamat; ?>"
                class="w-full border border-gray-300 px-3 py-2 rounded-md">
        </div>
            <button type="submit" name="update"
            class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded-md">Update Data</button>
    </form>
</body>
</html>