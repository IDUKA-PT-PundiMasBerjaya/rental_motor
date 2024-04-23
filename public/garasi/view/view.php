<?php 
include_once("../../../config/koneksi.php");
include_once("viewdata.php");

$garasiController = new KendaraanController($kon);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Data Kendaraan</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../../../src/output.css">
</head>

<body class="bg-gray-100 p-8">
    <a href="../dashboard.php" class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded mr-4">Home</a>
    <br><br>

    <div class="max-w-md mx-auto bg-white p-8 rounded shadow-lg">
        <h1 class="text-2xl font-bold mb-4">Detail Kendaraan</h1>
        <form action="view.php" name="update_data" method="post">
            <div class="grid grid-cols-3 gap-4">
                <div class="col-span-3">
                    <label class="font-bold">ID Garasi :</label>
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
                    <span><?php echo $tahun; ?></span>
                </div>
                <div class="col-span-3">
                    <label class="font-bold">Warna :</label>
                    <span><?php echo $warna_motor; ?></span>
                </div>
                <div class="col-span-3">
                    <label class="font-bold">Ketersediaan :</label>
                    <span><?php echo $stok; ?></span>
                </div>
                <div class="col-span-3">
                    <label class="font-bold">Gambar Motor :</label>
                    <img src="../../kendaraan/aset/<?php echo $gambar_motor; ?>" alt="<?php echo $gambar_motor; ?>"
                        class="mt-2 w-full h-auto">
                </div>
            </div>
        </form>
    </div>
</body>

</html>
