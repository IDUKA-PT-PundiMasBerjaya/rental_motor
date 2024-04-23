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
            'harga_per_hari' => $_POST['harga_per_hari'],
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
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../../../src/output.css">
</head>
<body class="bg-gray-100 p-8">
    <h1 class="text-2xl font-bold mb-4">Tambah Data Motor</h1>
    <a href="../dashboard.php" class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded mr-4"> Home </a>
    <form action="tambah.php" method="post" enctype="multipart/form-data" class="max-w-md mx-auto bg-white p-8 rounded shadow-lg">
        <div class="mb-4">
            <label class="block font-bold"> ID </label>
            <input type="text" name="id" value="<?php echo($motorController->tambahMotor())?>" readonly
                class="w-full border border-gray-300 px-3 py-2 rounded-md">
        </div>
        <div class="mb-4">
            <label class="block font-bold"> Brand </label>
            <input type="text" name="brand" required
                class="w-full border border-gray-300 px-3 py-2 rounded-md">
        </div>
        <div class="mb-4">
            <label class="block font-bold"> Tipe </label>
            <input type="text" name="tipe" required
                class="w-full border border-gray-300 px-3 py-2 rounded-md">
        </div>
        <div class="mb-4">
            <label class="block font-bold"> Tahun </label>
            <input type="text" name="tahun" required
                class="w-full border border-gray-300 px-3 py-2 rounded-md">
        </div>
        <div class="mb-4">
            <label class="block font-bold"> Warna </label>
            <input type="text" name="warna_motor" required
                class="w-full border border-gray-300 px-3 py-2 rounded-md">
        <div class="mb-4">
            <label class="block font-bold"> Harga Per Hari </label>
            <input type="number" name="harga_per_hari" required
                class="w-full border border-gray-300 px-3 py-2 rounded-md">
        </div>
        <div class="mb-4">
            <label class="block font-bold"> Gambar Motor </label>
            <input type="file" name="gambar_motor" class="w-full border border-gray-300 px-3 py-2 rounded-md">
        </div>
        <button type="submit" name="submit"
            class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded-md">Tambah Data</button>
        
        <?php if (isset($message)) : ?>
            <div class="success-message mt-4">
                <?php echo $message; ?>
            </div>
        <?php endif; ?>
    </form>
</body>
</html>