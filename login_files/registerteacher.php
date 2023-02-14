<?php
session_start();
require('../login_files/config.php');
$t_name = $t_email = $t_department = $t_gender = $t_password = $t_phone = $msg = "";

$t_name_err = $t_email_err = $t_password_err = $t_phone_err = "";

if (isset($_POST['add'])) {

    // Check if t_name is empty
    if (empty(trim($_POST["t_name"]))) {
        $t_name_err = "Name cannot be blank";
    } else {
        $sql = " SELECT id FROM teacher_data WHERE t_name = ? ";
        $stmt = mysqli_prepare($con, $sql);
        if ($stmt) {
            mysqli_stmt_bind_param($stmt, "s", $param_t_name);

            // Set the value of param username
            $param_t_name = trim($_POST['t_name']);

            // Try to execute this statement
            if (mysqli_stmt_execute($stmt)) {
                mysqli_stmt_store_result($stmt);
                $t_name = trim($_POST['t_name']);
            } else {
                echo "Something went wrong";
            }
        }
    }
    mysqli_stmt_close($stmt);

    //check for lastname
    /*if (empty(trim($_POST['lastname']))) {
        $lastname_err = "Lastname cannot be blank";
    } else {
        $lastname = trim($_POST['lastname']);
    }*/

    //check for email 
    if (empty(trim($_POST["t_email"]))) {
        $t_email_err = "Email cannot be blank";
    } else {

        $sql = "SELECT id FROM teacher_data WHERE t_email = ?";
        $stmt = mysqli_prepare($con, $sql);
        if ($stmt) {
            mysqli_stmt_bind_param($stmt, "s", $param_t_email);

            // Set the value of param email
            $param_t_email = trim($_POST['t_email']);

            // Try to execute this statement
            if (mysqli_stmt_execute($stmt)) {
                mysqli_stmt_store_result($stmt);
                if (mysqli_stmt_num_rows($stmt) == 1) {
                    $t_email_err = "This email is already taken";
                    echo "<div class='alert'>
                <span class='closebtn' onclick='this.parentElement.style.display='none';'>&times;</span>
                This email is already taken
              </div>";
                } else {
                    $t_email = trim($_POST['t_email']);
                }
            } else {
                echo "Something went wrong";
            }
        }
    }

    //check for city
    /*if (empty(trim($_POST['city']))) {
        $city_err = "City cannot be blank";
    } else {
        $city = trim($_POST['city']);
    }*/

    //check for phone
    if (empty(trim($_POST['t_phone']))) {
        $t_phone_err = "phone cannot be blank";
    } elseif (strlen(trim($_POST['t_phone'])) < 10) {
        $t_phone_err = "Please insert 10 digit valid phone number";
        //echo $t_phone_err;    
        if($t_phone_err)
            {
            ?>
            <script>
            alert("Please insert 10 digit valid phone number");
            </script>
            <?php
            }
    } else {
        $t_phone = trim($_POST['t_phone']);
    }

    //check for department
    if (empty(trim($_POST['department']))) {
        $t_department_err = "Department cannot be blank";
    } else {
        $t_department = trim($_POST['department']);
    }

    //check for gender
    if (empty(trim($_POST['gender']))) {
        $t_gender_err = "Gender cannot be blank";
    } else {
        $t_gender = trim($_POST['gender']);
    }

    // Check for password
    if (empty(trim($_POST['t_password']))) {
        $t_password_err = "Password cannot be blank";
    } elseif (strlen(trim($_POST['t_password'])) < 6) {
        $t_password_err = "Password cannot be less than 6 characters";
    } else {
        $t_password = trim($_POST['t_password']);
    }


    // If there were no errors, go ahead and insert into the database
    if (empty($t_name_err) && empty($t_password_err) && empty($t_email_err) && empty($t_phone_err)) {

        $sql = "INSERT INTO teacher_data (t_name, t_password, t_email, phone, gender, department) VALUES (?, ?, ?, ?, ?, ?)";
        $stmt = mysqli_prepare($con, $sql);
        echo "DB";
        if ($stmt) {

            mysqli_stmt_bind_param($stmt, "ssssss", $param_t_name, $param_t_password, $param_t_email, $param_t_phone, $param_gender, $param_department);
            // Set these parameters
            $param_t_name = $t_name;
            $param_t_password = password_hash($t_password, PASSWORD_DEFAULT);
            $param_t_email = $t_email;
            $param_t_phone = $t_phone;
            $param_gender = $t_gender;
            $param_department = $t_department;

            // Try to execute the query
            if (mysqli_stmt_execute($stmt)) {
                ?>
                <script>
                alert("Data inserted");
                </script>
                <?php
                echo '<br><div style="text-align: center;"><h3>Redirecting to homepage...<br>Do not click on anything.</h3></div>';
                header('refresh:1;url=../admin/index.php');
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
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="../css/registerteacher.css">
    <title>Teachers Register</title>
</head>

<body>

    <div id="main">

        <form action="registerteacher.php" method="POST" name="myForm" onsubmit="return validate()" class="teacher_register">

            <div class="t_name">
                <input type="text" name="t_name" placeholder="Enter teacher name" />
            </div>
            <div class="t_username">
                <input type="email" name="t_email" placeholder="Enter teacher email" />
            </div>
            <div class="t_password">
                <input type="password" name="t_password" placeholder="Enter teacher password" />
            </div>
            <div class="mobile_no">
                <input type="number" name="t_phone" placeholder="Enter teacher mobile_no" />
            </div>
            <label>Gender: </label>
            <div class="gender" style="width: 6cm;">
                <input type="radio" name="gender" value="Male" class="male"><label for="male">Male</label>
                <input type="radio" name="gender" value="Female" class="female"><label for="female">Female</label>
            </div>
            <div class="department"><label>Department: </label>
                <select name="department">
                    <option name="bca" value="BCA">BCA</option>
                    <option name="bba" value="BBA">BBA</option>
                    <option name="bcom" value="BCOM">BCOM</option>
                    <option name="bjmc" value="BJMC">BJMC</option>
                </select>
            </div>

            <!--div class="City">
                <label>Select your city:</label>
                <select name="City">
                    <option>Select City</option>
                    <option>Varanasi</option>
                    <option>Delhi</option>
                    <option>Kolkata</option>
                    <option>Mumbai</option>
                </select>
            </div!-->

            <div class="submit_button">
                <button type="submit" name="add" class="submit-button">Submit</button>
            </div>
            <!--div class="cancel_button">
                <button type="submit" name="cancel">Cancel</button>
            </div!-->
        </form>
    </div>

    <!--?php
    $con = mysqli_connect("localhost", "root", "", "evaluation_of_academic_performance");

    if (isset($_GET['add'])) {
        $t_username = $_GET['t_username'];
        $t_password = $_GET['t_password'];
        $t_name = $_GET['t_name'];
        $mobile_no = $_GET['mobile_no'];
        $gender = $_GET['gender'];
        $department = $_GET['department'];

        $query = "INSERT INTO teacher_data (t_username, t_password, t_name, mobile_no, gender, department) values ('$t_username', '$t_password', '$t_name', '$mobile_no', '$gender', '$department')";
        $run = mysqli_query($con, $query);
        if ($run) {
    ?>
            <script>
                alert("Data inserted");
            </script>
            <echo 'data updated';>
    <!--?php
        }
        echo mysqli_error($con);
        echo '<br><div style="text-align: center;"><h3>Redirecting to homepage...<br>Do not click on anything.</h3></div>';
        header('refresh:1;url=../admin/index.php');
    }

    /*if(isset($_GET['cancel'])){
        header('location:../admin/index.php');
    }*/
    ?!-->

    <script>
        function validate() {

            t_name = document.forms["myForm"]["t_name"].value;
            t_password = document.forms["myForm"]["t_password"].value;
            t_email = document.forms["myForm"]["t_email"].value;
            t_phone = document.forms["myForm"]["t_phone"].value;
            gender = document.forms["myForm"]["gender"].value;
            department = document.forms["myForm"]["department"].value;

            if (t_name == "") {
                alert("Teacher name cannot be blank");
                return false;
            }
            if (t_password == "") {
                alert("Teacher password cannot be blank");
                return false;
            }
            if (t_email == "") {
                alert("Teacher email cannot be blank");
                return false;
            }
            if (t_phone == "" || strlen(t_phone) < 10) {
                alert("Teacher phone should be 10 digit");
                return false;
            }
            if (gender == "") {
                alert("Please select gender");
                return false;
            }
            if (department == "") {
                alert("Please select department");
                return false;
            }
        }
    </script>
</body>

</html>