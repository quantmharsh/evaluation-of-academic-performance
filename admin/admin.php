<?php

//This script will handle login
session_start();

// check if the user is already logged in
if (isset($_SESSION["admin_loggedin"])) {
	header("location: index.php");
	exit;
}
require('../login_files/config.php');

$email = $password = "";
$err = "";

// if request method is post
if (isset($_POST['login'])) {
	if (empty(trim($_POST['email'])) || empty(trim($_POST['password']))) {
		$err = "Please enter email + password";
	} else {
		$email = trim($_POST['email']);
		$password = trim($_POST['password']);
	}

	if (empty($err)) 
	{
		//$con=mysqli_connect('localhost', 'root', '', 'evaluation_of_academic_performance');
		$sql = "SELECT id, admin_email, admin_password FROM admin_data WHERE admin_email = ?";
		$stmt = mysqli_prepare($con, $sql);
		mysqli_stmt_bind_param($stmt, "s", $param_email);
		$param_email = $email;


		// Try to execute this statement
		if (mysqli_stmt_execute($stmt)) {
			mysqli_stmt_store_result($stmt);
			if (mysqli_stmt_num_rows($stmt) == 1) {
				mysqli_stmt_bind_result($stmt, $id, $admin_email, $hashed_password);
				if (mysqli_stmt_fetch($stmt)) {
					if (password_verify($password, $hashed_password)) {
						// this means the password is correct. Allow user to login
						session_start();
						$_SESSION["id"] = $id;
						$_SESSION['email'] = $email;
						$_SESSION["admin_loggedin"] = true;
						
						//Redirect user to welcome page
						header('location:index.php');
					} else {
						?>
						<script>
						alert ("Wrong email or password");
						</script>
						<?php
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
	<title>Admin Portal</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!--===============================================================================================-->
	<link rel="icon" type="image/png" href="images/icons/favicon.ico" />
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/bootstrap/css/bootstrap.min.css">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="fonts/font-awesome-4.7.0/css/font-awesome.min.css">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="fonts/iconic/css/material-design-iconic-font.min.css">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/animate/animate.css">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/css-hamburgers/hamburgers.min.css">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/animsition/css/animsition.min.css">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/select2/select2.min.css">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/daterangepicker/daterangepicker.css">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="css/util.css">
	<link rel="stylesheet" type="text/css" href="css/main.css">
	<!--===============================================================================================-->
</head>

<body>

	<div class="limiter">
		<div class="container-login100" style="background-image: url('images/bg-01.jpg');">
			<div class="wrap-login100 p-l-55 p-r-55 p-t-65 p-b-54">
				<form method="POST" action="admin.php" class="login100-form validate-form">
					<span class="login100-form-title p-b-49">
						Login
					</span>

					<div class="wrap-input100 validate-input m-b-23" data-validate="Username is required">
						<span class="label-input100">Email ID</span>
						<input class="input100" type="email" name="email" placeholder="Type your email">
						<span class="focus-input100" data-symbol="&#xf206;"></span>
					</div>

					<div class="wrap-input100 validate-input" data-validate="Password is required">
						<span class="label-input100">Password</span>
						<input class="input100" type="password" name="password" placeholder="Type your password">
						<span class="focus-input100" data-symbol="&#xf190;"></span>
					</div>

					<div class="text-right p-t-8 p-b-31">
						<a href="#">
							Forgot password?
						</a>
					</div>

					<div class="container-login100-form-btn">
						<div class="wrap-login100-form-btn">
							<div class="login100-form-bgbtn"></div>
							<button type="submit" name="login" class="login100-form-btn">
								Login
							</button>
						</div>
					</div>

				</form>
			</div>
		</div>
	</div>


	<div id="dropDownSelect1"></div>

	<!--===============================================================================================-->
	<script src="vendor/jquery/jquery-3.2.1.min.js"></script>
	<!--===============================================================================================-->
	<script src="vendor/animsition/js/animsition.min.js"></script>
	<!--===============================================================================================-->
	<script src="vendor/bootstrap/js/popper.js"></script>
	<script src="vendor/bootstrap/js/bootstrap.min.js"></script>
	<!--===============================================================================================-->
	<script src="vendor/select2/select2.min.js"></script>
	<!--===============================================================================================-->
	<script src="vendor/daterangepicker/moment.min.js"></script>
	<script src="vendor/daterangepicker/daterangepicker.js"></script>
	<!--===============================================================================================-->
	<script src="vendor/countdowntime/countdowntime.js"></script>
	<!--===============================================================================================-->
	<script src="js/main.js"></script>

</body>

</html>