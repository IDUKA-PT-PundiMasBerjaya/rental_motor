<?php 
    include_once("../../../config/koneksi.php");
    include_once("viewdata.php");

    $customerController = new CustomerController($kon);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Data Customer</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../../../src/output.css">
</head>
<body class="bg-gray-100 p-8">
    <a href="../dashboard.php" class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded mr-4"> Home </a>
    <br><br>

    <div class="max-w-md mx-auto bg-white p-8 rounded shadow-lg">
        <h1 class="text-2xl font-bold mb-4">Detail Customer</h1>
        <form action="view.php" method="post" name="update_data">
            <div class="grid grid-cols-3 gap-4">
                <div class="col-span-3">
                    <label class="font-bold">No :</label>
                    <span><?php echo $id; ?></span>
                </div>
                <div class="col-span-3">
                    <label class="font-bold">Nama :</label>
                    <span><?php echo $nama; ?></span>
                </div>
                <div class="col-span-3">
                    <label class="font-bold">Email :</label>
                    <span><?php echo $email; ?></span>
                </div>
                <div class="col-span-3">
                    <label class="font-bold">No. Telp :</label>
                    <span><?php echo $no_telp; ?></span>
                </div>
                <div class="col-span-3">
                    <label class="font-bold">Alamat :</label>
                    <span><?php echo $alamat; ?></span>
                </div>
            </div>
        </form>
    </div>
</body>
</html>