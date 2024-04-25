<?php 
    include_once("../../config/koneksi.php");
    include_once("tambahakun.php");

    $akunController = new AkunController($kon);

    if (isset($_POST['submit'])) {
        $id = $akunController->tambahAkun();

        $data = [
            'id_users' => $id,
            'username' => $_POST['username'],
            'password' => $_POST['password'],
        ];

        $message = $akunController->tambahDataAkun($data);

        if ($message === "Data berhasil disimpan.") {
            header("Location: ../../login.php");
            exit(); // Penting untuk menghentikan eksekusi script setelah redirect
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register Akun</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../../../src/output.css">
    <style>
        .login-form {
            max-width: 400px;
            margin: auto;
            padding: 20px;
            background-color: #f7fafc;
            border: 1px solid #e2e8f0;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }
    </style>
</head>
<body class="bg-gray-200">
    <div class="flex justify-center items-center h-screen">
        <form action="tambah.php" method="post" class="login-form bg-white p-8 shadow-md" onsubmit="validasiForm()">
            <h1 class="text-2xl font-bold mb-4">Register Page</h1>
            <div class="mb-4">
                <label for="username" class="block text-sm font-medium text-gray-600">Username:</label>
                <input type="text" name="username" id="username" class="mt-1 px-4 py-2 w-full border border-gray-300 rounded-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500" required">
            </div>
            <div class="mb-4">
                <label for="password" class="block text-sm font-medium text-gray-600">Password:</label>
                <input type="password" name="password" id="password" class="mt-1 px-4 py-2 w-full border border-gray-300 rounded-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500" required">
            </div>
            <div class="mb-4">
                <label for="confirmPassword" class="block text-sm font-medium text-gray-600">Validasi Password:</label>
                <input type="password" name="confirmPassword" id="confirmPassword" class="mt-1 px-4 py-2 w-full border border-gray-300 rounded-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500" required">
            </div>
            <p class="text-sm text-gray-600">Sudah memiliki Akun? <a href="../../login.php" class="text-blue-500">Login</a></p><br>
            <button type="submit" name="submit" class="w-full bg-blue-500 text-white py-2 rounded-md hover:bg-blue-600 focus:outline-none focus:ring-2 focus-ring-blue-500 focus:ring-opacity-50">Register</button>
        </form>
        <script>
            function validasiForm() {
                var password = document.getElementById("password").value;
                var confirmPassword = document.getElementById("confirmPassword").value;

                if (password != confirmPassword) {
                    alert("Password tidak sama dengan Validasi Password!");
                    return false;
                }

                return true;
            }
        </script>
    </div>
</body>
</html>