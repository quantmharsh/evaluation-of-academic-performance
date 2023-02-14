<?php
$con = mysqli_connect("localhost", "root", "", "evaluation_of_academic_performance");
$id = $_GET['id'];

$query = "SELECT * FROM student_data WHERE id='$id'";
$run = mysqli_query($con, $query);
$row = mysqli_fetch_array($run);
?>

<!DOCTYPE html> 

<head>
<meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="../css/editstudent.css">
    <title>Student's Edit</title>
</head>

<body>
    <div id="main">
    <form method="get" action="edit_student.php" name="myForm" onsubmit="return validate()" class="edit_student">

        <div class="s_username">
            <label>Student Email : </label> <input type="text" value="<?php echo $row['s_email']; ?>" name="s_email" />
        </div>
        <!--div class="s_password">
            <label>s_password : </label> <input type="text" value="<?php echo $row['s_password']; ?>" name="s_password" />
        </div!-->
        <div class="s_name">
            <label>Student Name : </label> <input type="text" value="<?php echo $row['s_name']; ?>" name="s_name" />
        </div>
        <div class="department">
        <label>Department : </label>
                <select name="department">
                <option name="value" value=""><?php echo $row['course']; ?></option>
                    <option name="bca" value="BCA">BCA</option>
                    <option name="bba" value="BBA">BBA</option>
                    <option name="bcom" value="BCOM">BCOM</option>
                    <option name="bjmc" value="BJMC">BJMC</option>
                </select>
            </div>
        <div class="roll_no">
            <label>Roll Number : </label> <input type="text" value="<?php echo $row['roll_no']; ?>" name="roll_no" />
        </div>
        <!--div class="attendance">
            <label>attendance : </label> <input type="text" value="<?php echo $row['attendance']; ?>" name="attendance" />
        </div>
        <div class="subject_marks">
            <label>subject_marks : </label> <input type="text" value="<?php echo $row['subject_marks']; ?>" name="subject_marks" />
        </div!-->

        <!--div class="City">
            <label>Select your city:</label>
            <select name="City">
                <option value="<?php //echo $row['City']; ?>"></option>
                <option>Varanasi</option>
                <option>Delhi</option>
                <option>Kolkata</option>
                <option>Mumbai</option>
            </select>
        </div!-->

        <div class="hidden">
            <input type="hidden" name="id" value="<?php echo $id; ?>" />
        </div>

        <div class="submit_button">
            <button type="submit" name="update">Update</button>
        </div>
        <!--div class="cancel_button">
            <button type="submit" name="cancel">Cancel</button>
        </div!-->
    </form>
</div>
    <?php
    if (isset($_GET['update'])) {
        $s_email = $_GET['s_email'];
        //$s_password = $_GET['s_password'];
        $s_name = $_GET['s_name'];
        $course = $_GET['course'];
        $roll_no = $_GET['roll_no'];
        //$attendance = $_GET['attendance'];
        //$subject_marks = $_GET['subject_marks'];
        $id = $_GET['id'];
        $query1 = "UPDATE student_data SET s_email ='$s_email', s_name='$s_name', course='$course', roll_no='$roll_no' WHERE id='$id'";

        $run1 = mysqli_query($con, $query1);
        if ($run1) {
            ?>
            <script>
            alert("Data updated");
            </script><!--echo 'data updated'; !-->
            <?php 
            }
        echo mysqli_error($con);
        echo '<br><div style="text-align: center;"><h3>Redirecting to homepage...<br>Do not click on anything.</h3></div>';
        header('refresh:1;url=../admin/index.php');
    } 

    /*if(isset($_GET['cancel'])){
        header('location:../admin/index.php');
    }*/
    
    /*else if (isset($_GET['id']) && isset($_GET['delete'])) {
        $id = $_GET['id'];
        $query = "UPDATE student_data SET status ='1' WHERE id='$id'";

        $run = mysqli_query($con, $query);
        if ($run) {
            ?>
            <script>
            alert("Data deleted");
            </script><!--echo 'data updated'; !-->
            <?php
            header('refresh:2;url=../admin_homepage.php');
        }
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