<?php 
    include_once("../../../config/koneksi.php");
    include_once("pengembalian_motor.php");

    $pengembalianMotorController = new TambahDataController($kon);

    $dataPengembalian = "SELECT penyewaan.id_penyewaan,
                            CASE
                                WHEN customer.nama IS NOT NULL THEN customer.nama
                            END AS namapenyewa
                            FROM penyewaan
                            LEFT JOIN customer ON penyewaan.penyewaan_id_customer = customer.id_customer
                            WHERE penyewaan.id_penyewaan NOT IN (SELECT DISTINCT id_pengembalian FROM pengembalian)";
    
    $hasilPengembalian = mysqli_query($kon, $dataPengembalian);

    if (isset($_POST['pengembalian_id_penyewaan'])) {
        $penyewaan_id = $_POST['pengembalian_id_penyewaan'];
        $dataMotor = "SELECT garasi.id_garasi, garasi.kendaraan_id_motor
                     FROM penyewaan_motor
                     INNER JOIN garasi ON penyewaan_motor.penyewaan_id_garasi = garasi.id_garasi
                     WHERE penyewaan_motor.pengembalian_id_penyewaan = $penyewaan_id";
        $hasilMotor = mysqli_query($kon, $dataMotor);
    } else {
        // Default: Tampilkan semua Motor
        $dataMotor = "SELECT id_garasi, kendaraan_id_motor FROM garasi";
        $hasilMotor = mysqli_query($kon, $dataMotor);
    }

    if (isset($_POST['submit'])) {
        $data = [
            'pengembalian_id_penyewaan' => (isset($_POST['pengembalian_id_penyewaan'])) ? $_POST['pengembalian_id_penyewaan'] : null,
            'stok' => $_POST['stok'],
            'tanggal_pengembalian' => $_POST['tanggal_pengembalian'],
            'pengembalian_id_garasi' => $_POST['pengembalian_id_garasi'],
        ];
        $message = $pengembalianMotorController->TambahDataPengembalianMotor($data);
        header("Location: tambah.php");
        exit;
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Halaman Pengembalian Motor</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../../../src/output.css">
</head>
<body class="bg-gray-100 min-h-screen flex items-center justify-center">
    <div class="bg-white p-8 rounded shadow-md max-w-md w-full">
        <h1 class="text-xl font-bold mb-4">Tambah Data Pengembalian Motor</h1>
        <a href="../dashboard.php" class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-1 px-3 rounded inline-block mb-4">Home</a>
        
        <form action="tambah.php" method="post" name="motor" enctype="multipart/form-data" onsubmit="return confirmSubmit()">
            <div class="mb-4">
                <label for="pengembalian_id_penyewaan" class="block font-bold">ID Penyewaan</label>
                <select id="pengembalian_id_penyewaan" name="pengembalian_id_penyewaan" class="w-full border border-gray-300 px-3 py-2 rounded-md" onchange="fillTwoInputs()">
                    <?php if (mysqli_num_rows($hasilPengembalian) > 0) : ?>
                        <option value="" disabled selected> Pilih ID Penyewaan </option>
                        <?php while ($row = mysqli_fetch_assoc($hasilPengembalian)) : ?>
                            <option value="<?php echo $row['id_penyewaan']; ?>">
                                <?php echo $row['id_penyewaan'] . ' - ' . $row['namapenyewa']; ?>
                            </option>
                        <?php endwhile; ?>
                    <?php else : ?>
                        <option value="" disabled selected> Tambahkan data penyewaan terlebih dahulu</option>
                    <?php endif; ?>
                </select>
            </div>
            <div class="mb-4">
                <label class="block font-bold">Tanggal Pengembalian</label>
                <input type="date" name="tanggal_pengembalian" class="w-full border border-gray-300 px-3 py-2 rounded-md">
            </div>

            <!-- Bagian untuk memilih ID Motor dan jumlah -->
            <div id="motor-fields" class="mb-4">
                <div class="flex items-center mb-2">
                    <label for="pengembalian_id_garasi" class="block font-bold">ID Motor</label>
                    <select id="pengembalian_id_garasi" name="pengembalian_id_garasi[]" style="width: 100%;" class="ml-2 w-1/2 border border-gray-300 px-3 py-2 rounded-md">
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
                    <label for="stok" class="block ml-4 font-bold">Jumlah Motor</label>
                    <input type="number" id="stok" name="stok[]" class="ml-2 w-1/4 border border-gray-300 px-3 py-2 rounded-md" placeholder="Jumlah">
                </div>
            </div>

            <button type="button" class="bg-green-500 hover:bg-green-600 text-white font-bold py-1 px-3 rounded inline-block mb-4" onclick="addRow()">Tambah Motor</button>
            <input type="submit" name="submit" value="Tambah Data" class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-1 px-3 rounded inline-block mb-4">
        </form>
    </div>
    <?php if (isset($message) && strpos($message, 'Stok Motor tidak mencukupi') !== false): ?>
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
                <select name="pengembalian_id_garasi[]" class="ml-2 w-1/2 border border-gray-300 px-3 py-2 rounded-md">
                    <?php if (mysqli_num_rows($hasilMotor) > 0) : ?>
                        <option value="" disabled selected>Pilih Motor</option>
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
