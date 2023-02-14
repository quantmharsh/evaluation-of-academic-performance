<?php

/*
This file contains database configuration, running mysql where user = "root", password = "".
*/

define('DB_SERVER', 'localhost');
define('DB_USERNASME', 'root');
define('DB_PASSWORD', '');
define('DB_NAME', 'evaluation_of_academic_performance');

//try to connect to the database
$con=mysqli_connect(DB_SERVER, DB_USERNASME, DB_PASSWORD, DB_NAME);

//check connection
if($con == false)
{
    exit('Failed to connect to MySQL:'.mysqli_connect_error());
} 
?>