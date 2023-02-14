<?php
session_start();
require('../login_files/config.php');

if (!($_SESSION["admin_loggedin"] == true)) {
    header('location:admin.php');
    die();
}
echo '<div style="margin:0.5cm; color:white;"><h3>Welcome admin</h3></div>';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="../css/index.css">
    <title>Admin Homepage</title>
</head>

<body>

    <div class="header">
        <form method="POST" action="logout.php">
            <button name="logout" class="logout">Logout</button>
        </form>
    </div>

    <h2 class="teacher_list">Teacher's list</h2>
    <form method="POST" action="../login_files/registerteacher.php">
        <button class="teacher_list">
            Add New Teacher</a>
        </button>
    </form>

    <!-- container for teachers list !-->
    <div class="admin_upper_container">
        <table class="teacher-table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Mobile Number</th>
                    <th>Gender</th>
                    <th>Department</th>
                    <th>Edit</th>
                    <th>Delete
                    <th>
                </tr>
            </thead>

            <tbody>
                <?php
                $query = "SELECT DISTINCT * FROM teacher_data";
                $run = mysqli_query($con, $query);

                while ($row = mysqli_fetch_array($run)) {
                ?>
                    <tr>
                        <td class="id"><?php echo $row['id']; ?></td>
                        <td><?php echo $row['t_name']; ?></td>
                        <td><?php echo $row['t_email']; ?></td>
                        <td><?php echo $row['phone']; ?></td>
                        <td><?php echo $row['gender']; ?></td>
                        <td><?php echo $row['department']; ?></td>
                        <td>

                            <form method="post" action="../login_files/edit_teacher.php?id=<?php echo $row['id']; ?>">

                                <button>
                                    edit
                                </button>
                            </form>
                        </td>
                        <td>
                            <form method="post" action="../login_files/delete.php?deleteteacher=yes&id=<?php echo $row['id']; ?>" onclick="return confirm('Are you sure?')" name="deleteteacher">
                                <button>
                                    Delete
                                </button>
                            </form>
                        </td>
                    </tr>

                <?php } ?>
            </tbody>
        </table>
    </div>



    <div id="confirm" hidden>
        <h3>Confirmation</h3>
        <p>Do you really want to delete ID = '<?php echo $row['id']; ?>'</p>
        <button class="warning" onclick="confirmYes()">Yes</button>
        <button onclick="confirmNo()">No</button>
    </div>
    <br>

    <h2 class="student_list">Student's list</h2>
    <form method="POST" action="../login_files/registerstudent.php">
        <button class="student_list">
            Add New Student
        </button>
    </form>

    <!-- container for students list !-->
    <div class="admin_lower_container">


        <table class="student-table">

            <thead>
                <tr>
                    <th class="id">ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Course</th>
                    <th>Roll Number</th>
                    <th>Edit</th>
                    <th>Delete</th>
                </tr>
            </thead>

            <tbody>
                <?php
                $query = "SELECT DISTINCT * FROM student_data";
                $run = mysqli_query($con, $query);

                while ($row = mysqli_fetch_array($run)) {
                ?>
                    <tr>
                        <td class="id"><?php echo $row['id']; ?></td>
                        <td><?php echo $row['s_name']; ?></td>
                        <td><?php echo $row['s_email']; ?></td>
                        <td><?php echo $row['course']; ?></td>
                        <td><?php echo $row['roll_no']; ?></td>
                        <!--td><?php echo $row['attendance']; ?></td>
                        <td><?php $marks = $row['CNS'] + $row['KM'] + $row['ECOM'] + $row['ISADIE'];
                            echo $marks . '/400'; ?></td-->
                        <td>

                            <form method="post" action="../login_files/edit_student.php?id=<?php echo $row['id']; ?>">
                                <button>
                                    Edit
                                </button>
                            </form>
                        </td>
                        <td>
                            <form method="post" action="../login_files/delete.php?deletestudent=yes&id=<?php echo $row['id']; ?>" onclick="return confirm('Are you sure?')">
                                <button name="deletestudent">
                                    Delete
                                </button>
                            </form>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>

</body>

</html>