<?php
session_start();
header('Content-Type: application/json');

$con = mysqli_connect("localhost","root","","evaluation_of_academic_performance");
//require('../login_files/config.php');

//$profile_id = $_GET['profile_id'];
//echo $_SESSION['profile_id'];
$profile_id = $_SESSION['profile_id'];
$query = "SELECT id,s_name,CNS,ISADIE,KM,ECOM FROM student_data Where id = '$profile_id'";

$result = mysqli_query($con, $query);

if(!$result)
{
    echo 'Error<br>';
}

//create data object

$data = array();
foreach ($result as $row) {
	$data[] = $row;
}

mysqli_close($con);

echo json_encode($data);
?>
