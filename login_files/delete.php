<?php
$con = mysqli_connect("localhost", "root", "", "evaluation_of_academic_performance");
$id = $_GET['id'];

if (isset($_GET['id']) && isset($_GET['deleteteacher'])) {
    $id = $_GET['id'];
    $querydelete_t = "DELETE FROM teacher_data WHERE id='$id'";
    
    $rundelete_t = mysqli_query($con, $querydelete_t);
    if ($rundelete_t) {
        ?>
        <script>
        alert("Data deleted");
        </script><!--echo 'data updated'; !-->
        <?php
        header('location:../admin/index.php');
    } 
    else echo mysqli_error($rundelete_t);
}
else if (isset($_GET['id']) && isset($_GET['deletestudent'])) {
    $id = $_GET['id'];
    $querydelete_s = "DELETE FROM student_data WHERE id='$id'";

    $rundelete_s = mysqli_query($con, $querydelete_s);
    if ($rundelete_s) {
        ?>
        <script>
        alert("Data deleted");
        </script><!--echo 'data updated'; !-->
        <?php
        header('location:../admin/index.php');
    } 
    else echo mysqli_error($rundelete_s);
}
?>
