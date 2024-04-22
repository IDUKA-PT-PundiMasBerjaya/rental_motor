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

    if (isset($_POST[''])) {
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
            'pengembalian_id_penyewaan' => (isset($_POST['pengembalian_id_penyewaan'])) ? $_POST['pengembalian_id_penyewaan'] : '',
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
</head>
<body>
<h1>Tambah Data Pengembalian Motor</h1>
    <a href="../dashboard.php">Home</a>
    <form action="tambah.php" method="post" name="motor" enctype="multipart/form-data" onsubmit="return confirmSubmit()">
        <div class="table-container">
            <table>
                <tr>
                    <th>ID Penyewaan</th>
                    <th>Tanggal Pengembalian</th>
                </tr>
                <tr>
                    <td>
                        <select id="pengembalian_id_penyewaan" name="pengembalian_id_penyewaan" style="width: 100%;" onchange="fillTwoInputs()">
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
                    </td>
                    <td><input type="date" name="tanggal_pengembalian" style="width: 100%;"></td>
                </tr>
                <tr>
                    <tr>
                        <th>ID Motor</th>
                        <th>Jumlah</th>
                    </tr>
                <tr>
                    <td>
                        <select id="pengembalian_id_garasi" name="pengembalian_id_garasi[]" style="width: 100%;">
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
                    </td>
                    <td><input type="number" name="stok[]" style="width: 100%;"></td>
                </tr>
            </table>
        </div>
        <button type="button" class="add-row-button" onclick="addRow()">Tambah Motor</button>
        <input type="submit" name="submit" value="Tambah Data">
    </form>
    <?php if (isset($message) && strpos($message, 'Stok Motor tidak mencukupi') !== false): ?>
        <div id="error-message" style="color: red;">
            <?php echo $message; ?>
        </div>
    <?php endif; ?>
    <script>
        function fillTwoInputs() {
            var selectedValue = document.getElementById("pengembalian_id_penyewaan").value;
            document.getElementById("id_pengembalian").value = selectedValue;
        }

        function addRow() {
            var table = document.querySelector('table');
            var lastRow = table.rows[table.rows.length - 1].cloneNode(true);
            var selects = lastRow.getElementsByTagName('select');
            var inputs = lastRow.getElementsByTagName('input');

            // Atur ulang properti name untuk input agar unik
            for (var i = 0; i < inputs.length; i++) {
                inputs[i].value = '';
                inputs[i].name = inputs[i].name.replace(/\[(\d+)\]/g, function(match, p1) {
                    var index = parseInt(p1) + 1;
                    return '[' + index + ']';
                });
            }

            // Hapus nilai dari select
            for (var i = 0; i < selects.length; i++) {
                selects[i].selectedIndex = 0;
            }

            // Hapus tombol hapus jika sudah ada
            var existingDeleteButton = lastRow.querySelector('button');
            if (existingDeleteButton) {
                lastRow.removeChild(existingDeleteButton);
            }

            // Tambahkan tombol Hapus
            var deleteButton = document.createElement('button');
            deleteButton.type = 'button';
            deleteButton.textContent = 'X';
            deleteButton.onclick = function() {
                table.removeChild(lastRow);
            };
            lastRow.appendChild(deleteButton);
            table.appendChild(lastRow);

            // Menghapus pesan kesalahan jika ada
            var existingErrorMessage = document.querySelector('.error-message');
            if (existingErrorMessage) {
                existingErrorMessage.remove();
            }
        }
        //Fungsi menampilkan pesan kesalahan
        function showError(message) {
            var errorMessage = document.createElement('div');
            errorMessage.classList.add('error-message');
            errorMessage.textContent = message;
            errorMessage.style.color = 'red';
            document.body.appendChild(errorMessage);
        }

        function confirmSubmit() {
            var confirmation = confirm('Data yang sudah di simpan tidak bisa di Edit');
            if (confirmation) {
                return true; //Submit Formulir jika menekan OK
            } else {
                return false; // Batalkan jika menekan Cancel
            }
        }
    </script>
</body>
</html>