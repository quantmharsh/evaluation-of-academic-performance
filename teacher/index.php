<?php

session_start();
require('../login_files/config.php');

if (!($_SESSION["teacher_loggedin"] == true)) {
    header('location:admin.php');
    die();
}
echo '<div style="margin:0.5cm; color:white;"><h3>Welcome ' . $_SESSION['t_name'] . "<br>Department: " . $_SESSION['department'], '</h3></div>';

$department = $_SESSION['department'];
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="css/index.css">
    <title>Teacher Homepage</title>
</head>


<body>

    <div class="header">
        <form method="POST" action="logout.php">
            <button name="logout" class="logout">Logout</button>
        </form>
    </div>

    <!--h2 class="student_panel">Student Panel</h2!-->


    <form method="post" action="register_student.php">
        <button class="register_student">
            Add New Student
        </button>
    </form>


    <?php
    if (isset($_GET['id']) && isset($_GET['profile'])) {
        //echo $id;
        $id = $_GET['id'];
        $queryprofile = "SELECT DISTINCT * FROM student_data WHERE id='$id'";
        $runprofile = mysqli_query($con, $queryprofile);
        while ($row = mysqli_fetch_array($runprofile)) {
    ?>

            <thead>
                <tr>
                    <th>id</th>
                    <th>s_username</th>
                    <th>s_password</th>
                    <th>s_name</th>
                    <th>course</th>
                    <th>roll_no</th>
                    <th>attendance</th>
                    <th>subject_marks</th>
                </tr>
            </thead>

            <tr>
                <td><?php echo $row['id']; ?></td>
                <td><?php echo $row['s_username']; ?></td>
                <td><?php echo $row['s_password']; ?></td>
                <td><?php echo $row['s_name']; ?></td>
                <td><?php echo $row['course']; ?></td>
                <td><?php echo $row['roll_no']; ?></td>
                <td><?php echo $row['attendance']; ?></td>
                <td><?php echo $row['subject_marks']; ?></td>
            </tr>

            <tr>
                <td>
                    <button>
                        <a href="edit_s.php?edit=yes&id=<?php echo $row['id']; ?>">Edit Student Profile</a>
                    </button>
                </td>
                <td>
                    <button>
                        <a href="profile.php?openprofile=yes&id=<?php echo $row['id']; ?>">Open Student Profile</a>
                    </button>
                </td>
            </tr>
    <?php }
    } ?>
    </table>
    </div>
    </form!-->

    <h2 class="student_list_title">Student List</h2>

    <div class="teacher_lower_container">

        <!--"print list of students from database"-->
        <table class="student_list">

            <thead>
                <tr>
                    <th>ID</th>
                    <th>Student Name</th>
                    <th>Course</th>
                    <th>Roll_no</th>
                    <th>Open Profile</th>
                    <th>Edit</th>
                    <th>Delete</th>

                </tr>
            </thead>

            <?php
            $query = " SELECT DISTINCT * FROM student_data WHERE course ='$department' ";
            $run = mysqli_query($con, $query);

            while ($row = mysqli_fetch_array($run)) {
            ?>
                <tbody>
                    <tr>
                        <td><?php echo $row['id']; ?></td>
                        <td><?php echo $row['s_name']; ?></td>
                        <td><?php echo $row['course']; ?></td>
                        <td><?php echo $row['roll_no']; ?></td>
                        <td>

                            <form method="post" action="profile.php?openprofile=yes&profile_id=<?php echo $row['id']; ?>">
                                <button><a href="profile.php?profile_id=<?php echo $row['id']; ?>"></a>
                                    Profile

                                </button>
                            </form>
                        </td>

                        <td>
                            <form method="post" action="edit_s.php?edit=yes&id=<?php echo $row['id']; ?>">
                                <button>
                                    edit
                                </button>
                            </form>
                        </td>


                        <td>
                            <form method="post" action="delete.php?deletestudent=yes&id=<?php echo $row['id']; ?>" onclick="return confirm('Are you sure?')">
                                <button name="deletestudent">
                                    Delete
                                </button>
                            </form>
                        </td>
                    </tr>
                </tbody>
            <?php } ?>
        </table>
    </div>
</body>

</html>