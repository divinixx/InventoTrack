<?php

session_start();

if (isset($_SESSION['admin_name'])) {
	header("location: admin_dashboard.php");
	exit;
}
require_once "config.php";

$admin_name = $password = "";
$err = "";

if ($_SERVER['REQUEST_METHOD'] == "POST") {
	if (empty(trim($_POST['admin_name'])) || empty(trim($_POST['password']))) {
		$err = "Please enter admin_name + password";
	} else {
		$admin_name = trim($_POST['admin_name']);
		$password = trim($_POST['password']);
	}


	if (empty($err)) {
		$sql = "SELECT id, admin_name, password FROM admin WHERE admin_name = ?";
		$stmt = mysqli_prepare($conn, $sql);
		mysqli_stmt_bind_param($stmt, "s", $param_admin_name);
		$param_admin_name = $admin_name;


		if (mysqli_stmt_execute($stmt)) {
			mysqli_stmt_store_result($stmt);
			if (mysqli_stmt_num_rows($stmt) == 1) {
				mysqli_stmt_bind_result($stmt, $id, $admin_name, $hashed_password);
				if (mysqli_stmt_fetch($stmt)) {
					if (password_verify($password, $hashed_password)) {
						session_start();
						$_SESSION["admin_name"] = $admin_name;
						$_SESSION["id"] = $id;
						$_SESSION["loggedin"] = true;

						header("location: admin_dashboard.php");

					}
				}

			}

		}
	}


}


?>
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<title>Admin Login Page</title>
	<link rel="stylesheet" href="./style.css">
	<link rel="apple-touch-icon" sizes="180x180" href="img/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="img/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="img/favicon-16x16.png">
    <link rel="manifest" href="img/site.webmanifest">
</head>

<body>

	<body id="page-login">
		<div class="login-container">
			<h2>Login to Admin Panel</h2>
			<form action="" method="post">
				<div class="login-box">
					<div class="login-form">
						
						<input type="text" name="admin_name" id="admin_name" placeholder="User Name">
						<input type="password" name="password" id="password" placeholder="Password">
						<button type="submit">Login to Admin Panel</button>
					</div>
				</div>
			</form>
		</div>
	</body>

</body>

</html>