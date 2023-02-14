<?php
$con = mysqli_connect("localhost", "root", "", "evaluation_of_academic_performance");
$id = $_GET['id'];

$query = "SELECT * FROM teacher_data WHERE id='$id'";
$run = mysqli_query($con, $query);
$row = mysqli_fetch_array($run);
?>

<!DOCTYPE html>

<head>
<meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="../css/editteacher.css">
    <title>Teacher's Edit</title>
</head>

<body>
<div id="main">
    <form method="get" action="edit_teacher.php" name="myForm" onsubmit="return validate()" class="edit_teacher">

        <div class="t_username">
            <label>Teacher Name : </label> <input type="text" value="<?php echo $row['t_name']; ?>" name="t_username" />
        </div>
        <!--div class="t_password">
            <label>t_password : </label> <input type="text" value="<?php echo $row['t_password']; ?>" name="t_password" />
        </div-->
        <div class="t_name">
            <label>Teacher Email : </label> <input type="text" value="<?php echo $row['t_email']; ?>" name="t_name" />
        </div>
        <div class="mobile_no">
            <label>Mobile No : </label> <input type="number" value="<?php echo $row['phone']; ?>" name="mobile_no" />
        </div>
        <div class="gender">
            <label>Gender : </label> <input type="text" value="<?php echo $row['gender']; ?>" name="gender" />
        </div>
        <div class="department">
        <label>Department : </label>
                <select name="department">
                    <option name="value" value=""><?php echo $row['department']; ?></option>
                    <option name="bca" value="BCA">BCA</option>
                    <option name="bba" value="BBA">BBA</option>
                    <option name="bcom" value="BCOM">BCOM</option>
                    <option name="bjmc" value="BJMC">BJMC</option>
                </select>
            </div>

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
            <button type="submit" name="update" class="update_button">Update</button>
        </div>
        <!--div class="cancel_button">
            <button type="submit" name="cancel">Cancel</button>
        </div!-->
    </form>
</div>

    <?php
    if (isset($_GET['update'])) {
        $t_name = $_GET['t_name'];
        //$t_password = $_GET['t_password'];
        $t_email = $_GET['t_email'];
        $phone = $_GET['phone'];
        $gender = $_GET['gender'];
        $department = $_GET['department'];
        $id = $_GET['id'];
        $queryupdate = "UPDATE teacher_data SET t_name ='$t_name', t_password='$t_password', t_name='$t_name', phone='$phone', gender='$gender', department='$department' WHERE id='$id'";

        $runupdate = mysqli_query($con, $queryupdate);
        if ($runupdate) {
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
    ?>
    <script>
        function validate() {

            t_username = document.forms["myForm"]["t_username"].value;
            t_password = document.forms["myForm"]["t_password"].value;
            t_name = document.forms["myForm"]["t_name"].value;
            mobile_no = document.forms["myForm"]["mobile_no"].value;
            gender = document.forms["myForm"]["gender"].value;
            department = document.forms["myForm"]["department"].value;

            if (t_username == "") {
                alert("'t_username' cannot be blank");
                return false;
            }
            if (t_password == "") {
                alert("'t_password' cannot be blank");
                return false;
            }
            if (t_name == "") {
                alert("'t_name' cannot be blank");
                return false;
            }
            if (mobile_no == "") {
                alert("'mobile_no' cannot be blank");
                return false;
            }
            if (gender == "") {
                alert("'gender' cannot be blank");
                return false;
            }
            if (department == "") {
                alert("'department' cannot be blank");
                return false;
            }
        }
    </script>

</body>

</html>