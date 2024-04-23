<?php 
    include_once("../../../config/koneksi.php");
    include_once("viewdata.php");

    $motorController = new MotorController($kon);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Data Motor</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../../../src/output.css">
</head>
<body class="bg-gray-100 p-8">
    <a href="../dashboard.php" class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded mr-4"> Home </a>
    <br><br>

    <div class="max-w-md mx-auto bg-white p-8 rounded shadow-lg">
        <h1 class="text-2xl font-bold mb-4">Detail Kendaraan</h1>
        <form action="view.php" method="post" name="update_data">
            <div class="grid grid-cols-3 gap-4">
                <div class="col-span-3">
                    <label class="font-bold">No :</label>
                    <span><?php echo $id; ?></span>
                </div>
                <div class="col-span-3">
                    <label class="font-bold">Brand :</label>
                    <span><?php echo $brand; ?></span>
                </div>
                <div class="col-span-3">
                    <label class="font-bold">Tipe :</label>
                    <span><?php echo $tipe; ?></span>
                </div>
                <div class="col-span-3">
                    <label class="font-bold">Tahun :</label>
                    <td><?php echo $tahun; ?></td>
                </div>
                <div class="col-span-3">
                    <label class="font-bold">Warna :</label>
                    <span><?php echo $warna_motor; ?></span>
                </div>
                <div class="col-span-3">
                    <label class="font-bold">Harga Sewa :</label>
                    <span>Rp. <?php echo $harga_per_hari; ?>/Hari</span>
                </div>
                <div class="col-span-3">
                    <label class="font-bold">Gambar :</label>
                    <td>
                        <?php 
                            $data = mysqli_query($kon, "SELECT * FROM kendaraan WHERE id_motor = $id");
                            while ($row = mysqli_fetch_array($data)) :
                        ?>
                            <a href="#" onclick="window.open('../aset/<?php echo $row['gambar_motor']; ?>', '_blank')"></a>
                            <img src="../aset/<?php echo $row['gambar_motor']; ?>" alt="<?php echo $row['gambar_motor']; ?>" 
                                    class="mt-2 w-full h-auto">
                        <?php endwhile; ?>
                    </td>
                </div>
            </table>
            </div>
        </form>
    </div>
</body>
</html>