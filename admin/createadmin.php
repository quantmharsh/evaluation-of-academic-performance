<?php
require('../login_files/config.php');

$email = $password = "";
$firtname_err = $email_err = $password_err = $phone_err = "";

if (isset($_POST['register'])) {

    $email = trim($_POST['email']);
    $password = trim($_POST['password']);

    //check for email 
    if (empty(trim($_POST["email"]))) {
        $email_err = "Email cannot be blank";
    } else {

        $sql = "SELECT id FROM admin_data WHERE email = ?";
        $stmt = mysqli_prepare($con, $sql);
        if ($stmt) {
            mysqli_stmt_bind_param($stmt, "s", $param_email);

            // Set the value of param email
            $param_email = trim($_POST['email']);

            // Try to execute this statement
            if (mysqli_stmt_execute($stmt)) {
                mysqli_stmt_store_result($stmt);
                if (mysqli_stmt_num_rows($stmt) == 1) {
                    $email_err = "This email is already taken";
                    echo "<div class='alert'>
                <span class='closebtn' onclick='this.parentElement.style.display='none';'>&times;</span>
                This email is already taken
              </div>";
                } else {
                    $email = trim($_POST['email']);
                }
            } else {
                echo "Something went wrong";
            }
        }
    }


    // Check for password
    if (empty(trim($_POST['password']))) {
        $password_err = "Password cannot be blank";
    } elseif (strlen(trim($_POST['password'])) < 6) {
        $password_err = "Password cannot be less than 6 characters";
    } else {
        $password = trim($_POST['password']);
    }


    // If there were no errors, go ahead and insert into the database
    if (empty($password_err) && empty($email_err)) {

        $sql = "INSERT INTO admin_data (admin_email, admin_password) VALUES (?, ?)";
        $stmt = mysqli_prepare($con, $sql);
        if ($stmt) {

            mysqli_stmt_bind_param($stmt, "ss", $param_email, $param_password);
            // Set these parameters
            $param_email = $email;
            $param_password = password_hash($password, PASSWORD_DEFAULT);

            // Try to execute the query
            if (mysqli_stmt_execute($stmt)) {
?>
                <script>
                    alert("account created");
                </script>
<?php
                header("location: createadmin.php");
            } else {
                echo "Something went wrong... cannot redirect!";
            }
        }
        mysqli_stmt_close($stmt);
    }
    mysqli_close($con);
}
?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <form method="POST" class="login100-form validate-form">
        <span class="login100-form-title p-b-49">
            Login
        </span>

        <div class="wrap-input100 validate-input m-b-23" data-validate="Username is required">
            <span class="label-input100">Email</span>
            <input class="input100" type="email" name="email" placeholder="Type your email">
            <span class="focus-input100" data-symbol="&#xf206;"></span>
        </div>

        <div class="wrap-input100 validate-input" data-validate="Password is required">
            <span class="label-input100">Password</span>
            <input class="input100" type="password" name="password" placeholder="Type your password">
            <span class="focus-input100" data-symbol="&#xf190;"></span>
            <input class="button" type="submit" value="register" name="register" class="btn" />
        </div>
    </form>
</body>

</html>