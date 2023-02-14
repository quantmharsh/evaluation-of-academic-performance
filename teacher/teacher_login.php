<?php
//This script will handle login
session_start();

// check if the user is already logged in
if (isset($_SESSION['teacher_loggedin'])) {
	header("location: index.php");
	exit;
}
require('../login_files/config.php');

$email = $password = $name = $phone = $department = "";
$err = "";

// if request method is post
if (isset($_POST['login'])) {
	if (empty(trim($_POST['t_email'])) || empty(trim($_POST['t_password']))) {
		$err = "Please enter email + password";
	} else {
		$email = trim($_POST['t_email']);
		$password = trim($_POST['t_password']);
	}

	if (empty($err)) {
		$sql = "SELECT id, t_name, t_email, t_password, phone,  department FROM teacher_data WHERE t_email = ?";
		$stmt = mysqli_prepare($con, $sql);
		mysqli_stmt_bind_param($stmt, "s", $param_email);
		$param_email = $email;


		// Try to execute this statement
		if (mysqli_stmt_execute($stmt)) {
			mysqli_stmt_store_result($stmt);
			if (mysqli_stmt_num_rows($stmt) == 1) {
				mysqli_stmt_bind_result($stmt, $id, $t_name, $t_email, $hashed_password, $phone, $department);
				if (mysqli_stmt_fetch($stmt)) {
					if (password_verify($password, $hashed_password)) {
						// this means the password is correct. Allow user to login
						session_start();
						$_SESSION["id"] = $id;
						$_SESSION['t_name'] = $t_name;
						$_SESSION['t_email'] = $t_email;
						$_SESSION['department'] = $department;
						$_SESSION["teacher_loggedin"] = true;

						//Redirect user to welcome page
						header('location:index.php');
					} else {
?>
						<script>
							alert("Wrong email or password");
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
	<title>Teacher Login</title>
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
				<form method="post" action=" teacher_login.php" class="login100-form validate-form">
					<span class="login100-form-title p-b-49">
						Login
					</span>

					<div class="wrap-input100 validate-input m-b-23" data-validate="Username is reauired">
						<span class="label-input100">Email ID</span>
						<input class="input100" type="email" name="t_email" placeholder="Enter your email">
						<span class="focus-input100" data-symbol="&#xf206;"></span>
					</div>

					<div class="wrap-input100 validate-input" data-validate="Password is required">
						<span class="label-input100">Password</span>
						<input class="input100" type="password" name="t_password" placeholder="Type your password">
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
					<a href="../student/student_login.php" class="redirect_link">Go to Student Login</a>

					<div class="txt1 text-center p-t-54 p-b-20">
						<span>
							Or Sign Up using
						</span>
					</div>

					<div class="flex-c-m">
						<a href="#" class="login100-social-item bg1">
							<i class="fa fa-facebook"></i>
						</a>

						<a href="#" class="login100-social-item bg2">
							<i class="fa fa-twitter"></i>
						</a>

						<a href="#" class="login100-social-item bg3">
							<i class="fa fa-google"></i>
						</a>
					</div>

					<div class="flex-col-c p-t-155">
						<span class="txt1 p-b-17">
							Or Sign Up Using
						</span>

						<a href="#" class="txt2">
							Sign Up
						</a>
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