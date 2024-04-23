<?php 
    include_once("../../../config/koneksi.php");
    include_once("penyewaantambah.php"); // Ubah nama file jika perlu

    $penyewaanController = new PenyewaanController($kon); // Ubah nama class jika perlu

    if (isset($_POST['submit'])) {
        $id_penyewa = $penyewaanController->tambahPenyewaan(); // Ubah nama fungsi jika perlu
        $data = [
            'id_penyewaan' => $id_penyewa, // Ubah nama variabel
            'penyewaan_id_customer' => $_POST['penyewaan_id_customer'], // Ubah nama variabel
            'tanggal_pinjam' => $_POST['tanggal_pinjam'],
            'tanggal_balik' => $_POST['tanggal_balik'],
        ];
        $message = $penyewaanController->tambahDataPenyewaan($data); // Ubah nama fungsi jika perlu
    } else {
        $message = "Harap pilih customer";
    }

    $dataCustomer = mysqli_query($kon, "SELECT id_customer, nama FROM customer");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Data Penyewa</title>
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
    <h1 class="text-2xl font-bold mb-4">Tambah Data Penyewa</h1>
    <a href="../dashboard.php" class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded mr-4">Home</a>
    <form action="tambah.php" method="post" name="tambah" enctype="multipart/form-data" class="max-w-md mx-auto bg-white p-8 rounded shadow-lg">
        <div class="mb-4">
            <label class="block font-bold">ID Penyewa</label>
            <input style="width: 97%;" type="text" name="id_penyewaan" value="<?php echo($penyewaanController->tambahPenyewaan()) ?>" readonly
            class="w-full border border-gray-300 px-3 py-2 rounded-md">
        </div>
        <div class="mb-4">
            <label class="block font-bold">Data Customer</label>
            <select name="penyewaan_id_customer" id="penyewaan_id_customer" requied
                class="w-full border border-gray-300 px-3 py-2 rounded-md">
                <?php while($row = mysqli_fetch_assoc($dataCustomer)) : ?>
                    <option value="<?php echo $row['id_customer']; ?>">
                        <?php echo $row['id_customer'] . ' - ' . $row['nama'] ?>
                    </option>
                <?php endwhile; ?>
            </select>
        </div>
        <div class="mb-4">
            <label class="block font-bold">Tanggal Peminjaman</label>
            <input type="date" name="tanggal_pinjam" required
                class="w-full border border-gray-300 px-3 py-2 rounded-md">
        </div>
        <div class="mb-4">
            <label class="block font-bold">Tanggal Pengembalian</label>
            <input type="date" name="tanggal_balik" required
                class="w-full border border-gray-300 px-3 py-2 rounded-md">
        </div>
        <button type="submit" name="submit"
            class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded-md">Tambah Data</button>
        <?php if (isset($message)) : ?>
            <div class="success-message">
                <?php echo $message; ?>
            </div>
        <?php endif; ?>
    </form>
</body>
</html>