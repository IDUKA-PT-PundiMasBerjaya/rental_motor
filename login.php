<?php 
    session_start();
    include_once("config/koneksi.php");

    if ($kon->connect_error) {
        die("Connection failed: " . $kon->connect_error);
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
		$username = $_POST["username"];
		$password = $_POST["password"];

		$sql =  "SELECT id_users, username, password FROM users WHERE username = '$username' AND password = '$password'";
		$result = $kon->query($sql);

		if ($result->num_rows == 1) {
			$row = $result->fetch_assoc();

			$_SESSION["user_id"] = $row["id_users"];
			$_SESSION["username"] = $row["username"];

			header("Location: public/dashboard.php");
		} else {
			echo "Login gagal. Silahkan coba lagi.";
		}
	}

    $kon->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="src/output.css" rel="stylesheet">
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
        <form method="post" class="login-form bg-white p-8 shadow-md">
            <h1 class="text-2xl font-bold mb-4">Login Page</h1>
            <div class="mb-4">
                <label for="username" class="block text-sm font-medium text-gray-600">Username:</label>
                <input type="text" name="username" id="username" class="mt-1 px-4 py-2 w-full border border-gray-300 rounded-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500" required>
            </div>
            <div class="mb-6">
                <label for="password" class="block text-sm font-medium text-gray-600">Password:</label>
                <input type="password" name="password" id="password" class="mt-1 px-4 py-2 w-full border border-gray-300 rounded-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500" required>
            </div>
            <p class="text-sm text-gray-600">Tidak Punya Akun? <a href="#" class="text-blue-500">Register</a></p><br>
            <button type="submit" class="w-full bg-blue-500 text-white py-2 rounded-md hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-opacity-50">Login</button>
        </form>
    </div>
</body>
</html>