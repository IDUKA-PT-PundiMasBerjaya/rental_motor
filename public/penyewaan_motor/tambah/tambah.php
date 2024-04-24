<?php 
    include_once("../../../config/koneksi.php");
    include_once("penyewaan_motor.php");

    $penyewaanMotorController = new TambahMotorController($kon);
    $dataPenyewaan = "SELECT penyewaan.id_penyewaan, customer.nama AS namapeminjam
                        FROM penyewaan
                        LEFT JOIN 
                        customer ON penyewaan.penyewaan_id_customer = customer.id_customer
                        WHERE penyewaan.id_penyewaan NOT IN (SELECT DISTINCT id_penyewaan FROM penyewaan_motor)";
    $hasilPenyewaan = mysqli_query($kon, $dataPenyewaan);

    $dataMotor = "SELECT id_garasi, kendaraan_id_motor FROM garasi";
    $hasilMotor = mysqli_query($kon, $dataMotor);

    if (isset($_POST['submit'])) {
        $data = [
            'id_penyewaan' => (isset($_POST['id_penyewaan'])) ? $_POST['id_penyewaan'] : null,
            'stok' => $_POST['stok'],
            'penyewaan_id_garasi' => $_POST['penyewaan_id_garasi'],
        ];
        $message = $penyewaanMotorController->TambahDataPenyewaanMotor($data);
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Halaman Tambah Penyewaan Motor</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../../../src/output.css">
</head>
<body class="bg-gray-100 min-h-screen flex items-center justify-center">
    <div class="bg-white p-8 rounded shadow-md max-w-md w-full">
        <h1 class="text-xl font-bold mb-4">Tambah Data Penyewaan Motor</h1>
        <a href="../dashboard.php" class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-1 px-3 rounded inline-block mb-4">Home</a>

        <form action="tambah.php" method="post" name="tambahpenyewaanmotor" enctype="multipart/form-data" onsubmit="return confirmSubmit()">
            <div class="mb-4">
                <label class="block font-bold">ID Penyewaan</label>
                <select id="id_penyewaan" name="id_penyewaan" class="w-full border border-gray-300 px-3 py-2 rounded-md">
                    <?php if (mysqli_num_rows($hasilPenyewaan) > 0) : ?>
                        <option value="" disabled selected> Pilih ID Penyewaan </option>
                        <?php while ($row = mysqli_fetch_assoc($hasilPenyewaan)) : ?>
                            <option value="<?php echo $row['id_penyewaan']; ?>">
                                <?php echo $row['id_penyewaan'] . ' - ' . $row['namapeminjam']; ?>
                            </option>
                        <?php endwhile; ?>
                    <?php else : ?>
                        <option value="" disabled selected> Tambahkan data penyewaan terlebih dahulu</option>
                    <?php endif; ?>
                </select>
            </div>

            <div id="motor-fields" class="mb-4">
            <div class="flex items-center mb-2">
                    <label class="block font-bold">ID Motor</label>
                    <select name="penyewaan_id_garasi[]" class="ml-2 w-1/2 border border-gray-300 px-3 py-2 rounded-md">
                        <?php if (mysqli_num_rows($hasilMotor) > 0) : ?>
                            <option value="" disabled selected>Pilih Motor</option>
                            <?php while ($row = mysqli_fetch_assoc($hasilMotor)) : ?>
                                <option value="<?php echo $row['id_garasi']; ?>">
                                    <?php echo $row['id_garasi'] . ' - ' . $row['kendaraan_id_motor']; ?>
                                </option>
                            <?php endwhile; ?>
                        <?php else : ?>
                            <option value="" disabled selected> Tambahkan data Motor terlebih dahulu.</option>
                        <?php endif; ?>
                    </select>
                    <label class="block ml-4 font-bold">Jumlah Motor</label>
                    <input type="number" name="stok[]" class="ml-2 w-1/4 border border-gray-300 px-3 py-2 rounded-md" placeholder="Jumlah">
                </div>
            </div>

            <button type="button" class="bg-green-500 hover:bg-green-600 text-white font-bold py-1 px-3 rounded inline-block mb-4" onclick="addRow()">Tambah Motor</button>
            <input type="submit" name="submit" value="Tambah Data" class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-1 px-3 rounded inline-block mb-4">
        </form>
    </div>

    <!-- Script -->
    <?php if (isset($message) && strpos($message, 'Stok barang tidak mencukupi') !== false): ?>
        <div id="error-message" class="text-red-600 mt-4">
            <?php echo $message; ?>
        </div>
    <?php endif; ?>

    <script>
        let rowCount = 1;

        function addRow() {
            const motorFields = document.getElementById('motor-fields');
            const newRow = document.createElement('div');
            newRow.classList.add('flex', 'items-center', 'mb-2');
            
            newRow.innerHTML = `
                <label class="block font-bold">ID Motor</label>
                <select name="penyewaan_id_garasi[]" class="ml-2 w-1/2 border border-gray-300 px-3 py-2 rounded-md">
                    <?php if (mysqli_num_rows($hasilMotor) > 0) : ?>
                        <?php mysqli_data_seek($hasilMotor, 0); // Reset pointer hasilMotor ?>
                        <?php while ($row = mysqli_fetch_assoc($hasilMotor)) : ?>
                            <option value="<?php echo $row['id_garasi']; ?>">
                                <?php echo $row['id_garasi'] . ' - ' . $row['kendaraan_id_motor']; ?>
                            </option>
                        <?php endwhile; ?>
                    <?php else : ?>
                        <option value="" disabled selected> Tambahkan data Motor terlebih dahulu.</option>
                    <?php endif; ?>
                </select>
                <label class="block ml-4 font-bold">Jumlah Motor</label>
                <input type="number" name="stok[]" class="ml-2 w-1/4 border border-gray-300 px-3 py-2 rounded-md" placeholder='Jumlah'>
                <button type="button" class="bg-red-500 hover:bg-red-600 text-white font-bold py-1 px-3 rounded ml-2" onclick="removeRow(this)">X</button>
            `;
            
            motorFields.appendChild(newRow);
            rowCount++;
        }

        function removeRow(button) {
            const rowToRemove = button.parentNode;
            rowToRemove.remove();
        }

        function confirmSubmit() {
            var confirmation = confirm('Data yang sudah disimpan tidak bisa diubah');
            return confirmation; // True jika OK, False jika Cancel
        }
    </script>
</body>
</html>
