<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="css/registerstudent.css">
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

        <form action="register_student.php" method="get" name="myForm" onsubmit="return validate()" class="student_register">

            <div class="s_username">
                <input type="email" name="s_email" placeholder="Enter student email"/>
            </div>
            <div class="s_password">
                <input type="text" name="s_password" placeholder="Enter student password"/>
            </div>
            <div class="s_name">
                <input type="text" name="s_name" placeholder="Enter student name"/>
            </div>
            <div class="department">
                <select name="department">
                    <option name="bca" value="bca">BCA</option>
                    <option name="bba" value="bba">BBA</option>
                    <option name="bcom" value="bcom">BCOM</option>
                    <option name="bjmc" value="bjmc">BJMC</option>
                </select>
            </div>
            <div class="roll_no">
                <input type="text" name="roll_no" placeholder="Enter student roll_no"/>
            </div>
            <div class="attendance">
                <input type="number" name="attendance" placeholder="Enter student attendance"/>
            </div>
            <!--div class="subject_marks">
                <input type="number" name="subject_marks" placeholder="Enter student subject marks"/>
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

    <?php
    $con = mysqli_connect("localhost", "root", "", "evaluation_of_academic_performance");

    if (isset($_GET['submit'])) {
        $s_email = $_GET['s_email'];
        $s_password = $_GET['s_password'];
        $s_name = $_GET['s_name'];
        $course = $_GET['department'];
        $roll_no = $_GET['roll_no'];
        $attendance = $_GET['attendance'];

        $query = "INSERT INTO student_data (s_email, s_password, s_name, course, roll_no, attendance) values ('$s_email', '$s_password', '$s_name', '$course', '$roll_no', '$attendance')";
        $run = mysqli_query($con, $query);
        if ($run) {
            ?>
            <script>
            alert("Data inserted");
            </script><!--echo 'data updated'; !-->
            <?php 
        }
        echo mysqli_error($con);
        echo '<br><div style="text-align: center;"><h3>Redirecting to homepage...<br>Do not click on anything.</h3></div>';
        header('refresh:1;url=index.php');
    }

    /*if(isset($_GET['cancel'])){
        header('location:../admin/index.php');
    }*/
    ?>

    <script>
        function validate() {

            s_username = document.forms["myForm"]["s_username"].value;
            s_password = document.forms["myForm"]["s_password"].value;
            s_name = document.forms["myForm"]["s_name"].value;
            course = document.forms["myForm"]["course"].value;
            roll_no = document.forms["myForm"]["roll_no"].value;
            attendance = document.forms["myForm"]["attendance"].value;
            subject_marks = document.forms["myForm"]["subject_marks"].value;

            if (s_username == "") {
                alert("'s_username' cannot be blank");
                return false;
            }
            if (s_password == "") {
                alert("'s_password' cannot be blank");
                return false;
            }
            if (s_name == "") {
                alert("'s_name' cannot be blank");
                return false;
            }
            if (course == "") {
                alert("'course' cannot be blank");
                return false;
            }
            if (roll_no == "") {
                alert("'roll_no' cannot be blank");
                return false;
            }
            if (attendance == "") {
                alert("'attendance' cannot be blank");
                return false;
            }
            if (subject_marks == "") {
                alert("'subject_marks' cannot be blank");
                return false;
            }
        }
    </script>
</body>

</html>