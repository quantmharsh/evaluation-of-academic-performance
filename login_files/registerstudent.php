<?php
session_start();
require('../login_files/config.php');
$s_name = $s_email = $s_password = $department = $roll_no = $attendance = $msg = "";

$s_name_err = $s_email_err = $s_password_err = $department_err = $roll_no_err = $attendance_err = "";

if (isset($_POST['submit'])) {

    // Check if s_name is empty
    if (empty(trim($_POST["s_name"]))) {
        $s_name_err = "Name cannot be blank";
    } else {
        $sql = " SELECT id FROM student_data WHERE s_name = ? ";
        $stmt = mysqli_prepare($con, $sql);
        if ($stmt) {
            mysqli_stmt_bind_param($stmt, "s", $param_s_name);

            // Set the value of param username
            $param_s_name = trim($_POST['s_name']);

            // Try to execute this statement
            if (mysqli_stmt_execute($stmt)) {
                mysqli_stmt_store_result($stmt);
                $s_name = trim($_POST['s_name']);
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
    if (empty(trim($_POST["s_email"]))) {
        $s_email_err = "Email cannot be blank";
    } else {

        $sql = "SELECT id FROM student_data WHERE s_email = ?";
        $stmt = mysqli_prepare($con, $sql);
        if ($stmt) {
            mysqli_stmt_bind_param($stmt, "s", $param_s_email);

            // Set the value of param email
            $param_s_email = trim($_POST['s_email']);

            // Try to execute this statement
            if (mysqli_stmt_execute($stmt)) {
                mysqli_stmt_store_result($stmt);
                if (mysqli_stmt_num_rows($stmt) == 1) {
                    $s_email_err = "This email is already taken";
                    echo "<div class='alert'>
                <span class='closebtn' onclick='this.parentElement.style.display='none';'>&times;</span>
                This email is already taken
              </div>";
                } else {
                    $s_email = trim($_POST['s_email']);
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


    //check for department
    if (empty(trim($_POST['department']))) {
        $department_err = "Department cannot be blank";
    } else {
        $department = trim($_POST['department']);
    }

    //check for roll_no
    if (empty(trim($_POST['roll_no']))) {
        $roll_no_err = "Roll No. cannot be blank";
    } else {
        $roll_no = trim($_POST['roll_no']);
    }

    //check for attendance
    /*if (empty(trim($_POST['attendance']))) {
        $attendance_err = "Department cannot be blank";
    } else {
        $attendance = trim($_POST['attendance']);
    }*/

    // Check for password
    if (empty(trim($_POST['s_password']))) {
        $s_password_err = "Password cannot be blank";
    } elseif (strlen(trim($_POST['s_password'])) < 6) {
        $s_password_err = "Password cannot be less than 6 characters";
    } else {
        $s_password = trim($_POST['s_password']);
    }


    // If there were no errors, go ahead and insert into the database
    if (empty($s_name_err) && empty($s_password_err) && empty($s_email_err)) {

        $sql = "INSERT INTO student_data (s_name, s_email, s_password, course, roll_no, attendance) VALUES (?, ?, ?, ?, ?, ?)";
        $stmt = mysqli_prepare($con, $sql);
        if ($stmt) {

            mysqli_stmt_bind_param($stmt, "ssssss", $param_s_name, $param_s_email, $param_s_password, $param_course, $param_roll_no, $param_attendance);
            // Set these parameters
            $param_s_name = $s_name;
            $param_s_email = $s_email;
            $param_s_password = password_hash($s_password, PASSWORD_DEFAULT);
            $param_course = $department;
            $param_roll_no = $roll_no;
            $param_attendance = $attendance;

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
    <link rel="stylesheet" type="text/css" href="../css/registerstudent.css">
    <title>Students Register</title>
</head>

<body>

    <!--style>
        .main {
            float: left;
            position: relative;
            border: 5px solid black;
            padding: 50px;
        }
        input {
            height: 50px;
            width:  500px;
        }
        .name, .roll, .age, .address, .City, .submit_button {
            width: 1000px;
            padding: 20px;
            float:left;
            position: relative;
            border: 1px solid black;
            margin: 5px;
            box-shadow: 0 0 5px black;
        }
        label {
            font-weight: bold;
            font-size: 30px;
            margin: 20px;
        }
        button {
            width: 200px;
            margin: 10px 400px;
        }
    </style!-->

    <div id="main">

        <form action="registerstudent.php" method="post" name="myForm" onsubmit="return validate()" class="student_register">

        <div class="s_name">
                <input type="text" name="s_name" placeholder="Enter student name" />
            </div>
            <div class="s_email">
                <input type="email" name="s_email" placeholder="Enter student email" />
            </div>
            <div class="s_password">
                <input type="password" name="s_password" placeholder="Enter student password" />
            </div>

            <div class="department">
                <select name="department">
                    <option name="bca" value="BCA">BCA</option>
                    <option name="bba" value="BBA">BBA</option>
                    <option name="bcom" value="BCOM">BCOM</option>
                    <option name="bjmc" value="BJMC">BJMC</option>
                </select>
            </div>

            <div class="roll_no">
                <input type="text" name="roll_no" placeholder="Enter student roll_no" />
            </div>

            <!--div class="attendance">
                <input type="number" name="attendance" placeholder="Enter student attendance" />
            </div>
            <div class="subject_marks">
                <input type="number" name="subject_marks" placeholder="Enter student subject marks" />
            </div-->

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
                <button type="submit" name="submit">Submit</button>
            </div>
            <!--div class="cancel_button">
                <button type="submit" name="cancel">Cancel</button>
            </div!-->
        </form>
    </div>

    <!--?php
    $con = mysqli_connect("localhost", "root", "", "evaluation_of_academic_performance");

    if (isset($_GET['submit'])) {
        $s_username = $_GET['s_username'];
        $s_password = $_GET['s_password'];
        $s_name = $_GET['s_name'];
        $course = $_GET['course'];
        $roll_no = $_GET['roll_no'];
        $attendance = $_GET['attendance'];
        $subject_marks = $_GET['subject_marks'];

        $query = "INSERT INTO student_data (s_username, s_password, s_name, course, roll_no, attendance, subject_marks) values ('$s_username', '$s_password', '$s_name', '$course', '$roll_no', '$attendance', '$subject_marks')";
        $run = mysqli_query($con, $query);
        if ($run) {
    ?>
            <script>
                alert("Data inserted");
            </script>
            <!--echo 'data updated'; !-->
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

            s_name = document.forms["myForm"]["s_name"].value;
            s_password = document.forms["myForm"]["s_password"].value;
            s_email = document.forms["myForm"]["s_email"].value;
            department = document.forms["myForm"]["department"].value;
            roll_no = document.forms["myForm"]["roll_no"].value;
            //attendance = document.forms["myForm"]["attendance"].value;
            //subject_marks = document.forms["myForm"]["subject_marks"].value;

            if (s_name == "") {
                alert("Student name cannot be blank");
                return false;
            }
            if (s_password == "") {
                alert("Student password cannot be blank");
                return false;
            }
            if (s_email == "") {
                alert("Student email cannot be blank");
                return false;
            }
            if (department == "") {
                alert("Please select department");
                return false;
            }
            if (roll_no == "") {
                alert("Roll number cannot be blank");
                return false;
            }
            /*if (attendance == "") {
                alert("'attendance' cannot be blank");
                return false;
            }
            if (subject_marks == "") {
                alert("'subject_marks' cannot be blank");
                return false;
            }*/
        }
    </script>
</body>

</html>