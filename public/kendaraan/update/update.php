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
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../../../src/output.css">
</head>
<body class="bg-gray-100 p-8">
    <h1 class="text-2xl font-bold mb-4">Update Data Kendaraan</h1>
    <a href="../dashboard.php" class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded mr-4">Home</a>
    <form action="update.php" method="post" enctype="multipart/form-data" class="max-w-md mx-auto bg-white p-8 rounded shadow-lg">
        <div class="mb-4">
            <label class="block font-bold">ID</label>
            <input type="text" name="id" value="<?php echo $id; ?>" readonly
                class="w-full border border-gray-300 px-3 py-2 rounded-md">
        </div>
        <div class="mb-4">
            <label class="block font-bold">Brand</label>
            <input type="text" name="brand" value="<?php echo $brand; ?>"
                class="w-full border border-gray-300 px-3 py-2 rounded-md">
        </div>
        <div class="mb-4">
            <label class="block font-bold">Tipe</label>
            <input type="text" name="tipe" value="<?php echo $tipe; ?>"
                class="w-full border border-gray-300 px-3 py-2 rounded-md">
        </div>
        <div class="mb-4">
            <label class="block font-bold">Tahun</label>
            <input type="number" name="tahun" value="<?php echo $tahun; ?>"
                class="w-full border border-gray-300 px-3 py-2 rounded-md">
        </div>
        <div class="mb-4">
            <label class="block font-bold">Warna</label>
            <input type="text" name="warna_motor" value="<?php echo $warna_motor; ?>"
                class="w-full border border-gray-300 px-3 py-2 rounded-md">
        </div>
        <div class="mb-4">
            <label class="block font-bold">Harga per Hari</label>
            <input type="text" name="harga_per_hari" value="<?php echo $harga_per_hari; ?>"
                class="w-full border border-gray-300 px-3 py-2 rounded-md">
        </div>
        <button type="submit" name="update"
            class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded-md">Update Data</button>
    </form>
</body>
</html>