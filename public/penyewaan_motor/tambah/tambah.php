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
</head>
<body>
    <div>
        <h1>Tambah Data Penyewaan Motor</h1>
        <a href="../dashboard.php">Home</a>
        <form action="tambah.php" method="post" name="tambahpenyewaanmotor" enctype="multipart/form-data" onsubmit="return confirmSubmit()">
            <div>
                <table>
                    <tr> <th colspan="2">ID Penyewaan</th></tr>
                    <tr>
                    <td >
                        <select id="id_penyewaan" name="id_penyewaan">
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
                    </td>
                    </tr>
                    <tr>
                        <th>ID Motor</th>
                        <th>Jumlah</th>
                    </tr>
                <tr>
                    <td>
                        <select id="penyewaan_id_garasi" name="penyewaan_id_garasi[]">
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
                    <td><input type="number" name="stok[]"></td>
                </tr>
            </table>
        </div>
        <button type="button" class="add-row-button" onclick="addRow()">Tambah Motor</button>
        <input type="submit" name="submit" value="Tambah Data">
    </form>
    <!-- Script !-->
    <?php if (isset($message) && strpos($message, 'Stok barang tidak mencukupi') !== false): ?>
        <div>
            <?php echo $message; ?>
        </div>
    <?php endif; ?>
    <script>
        function addRow() {
            var table = document.querySelector('table');
            var lastRow = table.rows[table.rows.length - 1].cloneNode(true);
            var selects = lastRow.getElementsByTagName('select');
            var inputs = lastRow.getElementsByTagName('input');

            for (var i = 0; i < selects.length; i++) {
                selects[i].selectedIndex = 0;
            }
            // Membuat baris baru
            for (var i = 0; i < inputs.length; i++) {
                if (inputs[i].type === 'number') {
                    console.log('Jumlah:', inputs[i].value);
                    inputs[i].value = 0;
                } else {
                    inputs[i].value = '';
                }
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
        // Fungsi menampilkan pesan kesalahan
        function showError(message) {
            var errorMessage = document.createElement('div');
            errorMessage.classList.add('error-message');
            errorMessage.textContent = message;
            errorMessage.style.color = 'red';
            document.body.appendChild(errorMessage);
        }

        function confirmSubmit() {
            var confirmation = confirm('Data yang sudah disimpan tidak bisa diubah');
            if (confirmation) {
                return true; // Submit Formulir jika menekan OK
            } else {
                return false; // Batalkan jika menekan Cancel
            }
        }
    </script>
</body>
</html>