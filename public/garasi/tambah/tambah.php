<?php 
include_once("../../../config/koneksi.php");
include_once("kendaraantambah.php");

$garasiController = new KendaraanController($kon);

if (isset($_POST['submit'])) {
    $id = $garasiController->TambahKendaraan();

    $data = [
        'id_garasi' => $id,
        'kendaraan_id_motor' => $_POST['kendaraan_id_motor'],
        'stok' => $_POST['stok'],
    ];

    $message = $garasiController->tambahDataKendaraan($data);
}

$dataMotor = "SELECT id_motor, brand, tipe, tahun, warna_motor FROM kendaraan WHERE id_motor NOT IN (SELECT kendaraan_id_motor FROM garasi)";
$hasilMotor = mysqli_query($kon, $dataMotor);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Data Kendaraan</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../../../src/output.css">
    <style>
        .success-message {
            margin-top: 1rem;
            padding: 1rem;
            background-color: #d1f5e9;
            border: 1px solid #4caf50;
            color: #4caf50;
            border-radius: 0.5rem;
        }
    </style>
</head>

<body class="bg-gray-100 p-8">
    <h1 class="text-2xl font-bold mb-4">Tambah Data Kendaraan</h1>
    <a href="../dashboard.php" class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded mr-4">Home</a>

    <form action="tambah.php" method="post" enctype="multipart/form-data" class="max-w-md mx-auto bg-white p-8 rounded shadow-lg">
        <div class="mb-4">
            <label for="id" class="block font-bold">NO ID</label>
            <input type="text" name="id" id="id" value="<?php echo $garasiController->TambahKendaraan() ?>" readonly
                class="w-full border border-gray-300 px-3 py-2 rounded-md">
        </div>
        <div class="mb-4">
            <label for="kendaraan_id_motor" class="block font-bold">Motor</label>
            <select name="kendaraan_id_motor" id="kendaraan_id_motor" required
                class="w-full border border-gray-300 px-3 py-2 rounded-md">
                <?php if (mysqli_num_rows($hasilMotor) == 0) : ?>
                    <option disabled>Tidak ada data di Kendaraan.</option>
                <?php else : ?>
                    <?php while ($row = mysqli_fetch_assoc($hasilMotor)) : ?>
                        <option value="<?php echo $row['id_motor']; ?>">
                            <?php echo $row['id_motor'] . ' - ' . $row['brand'] . ' ' . $row['tipe'] . ' ' . $row['tahun'] . ' - ' . $row['warna_motor'] ?>
                        </option>
                    <?php endwhile; ?>
                <?php endif; ?>
            </select>
        </div>
        <div class="mb-4">
            <label for="stok" class="block font-bold">Stok</label>
            <input type="number" name="stok" id="stok" class="w-full border border-gray-300 px-3 py-2 rounded-md"
                required>
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
