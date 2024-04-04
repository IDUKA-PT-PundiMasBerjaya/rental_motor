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
</head>
<body>
    <form method="post">
        <h1>Login Page</h1>
        <label for="username"><b>Username : </b></label>
        <input type="text" name="username" required><br><br>
        <label for="password"><b>Password : </b></label>
        <input type="password" name="password" required><br>
        <p>Tidak Punya Akun? <span><a href="#">Register</a></span></p>
        <input type="submit" value="Login">
    </form>
</body>
</html>