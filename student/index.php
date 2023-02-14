<?php
session_start();
require('../login_files/config.php');
if (!($_SESSION["student_loggedin"])) {
    header('location:student_login.php');
}
echo '<div style="margin:0.5cm; color:white;"><h3>Welcome ' . $_SESSION['s_name'] . "<br>Department: " . $_SESSION['department'], '</h3></div>';

$s_name = $_SESSION['s_name'];
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="css/profile.css">

    <style type="text/css">
        #chart-container {
            width: 30%;
            height: 33%;
        }

        .card {
            position: fixed;
            display: -webkit-box;
            display: -ms-flexbox;
            display: flex;
            -webkit-box-orient: vertical;
            -webkit-box-direction: normal;
            -ms-flex-direction: column;
            flex-direction: column;
            min-width: 0;
            word-wrap: break-word;
            background-color: #fff;
            background-clip: border-box;
            border: 1px solid rgba(0, 0, 0, 0.125);
            border-radius: 0.25rem;
        }

        .card-body {
            -webkit-box-flex: 1;
            -ms-flex: 1 1 auto;
            flex: 1 1 auto;
            padding: 1.25rem;
        }
    </style>
    <script type="text/javascript" src="js/jquery.min.js"></script>
    <script type="text/javascript" src="js/Chart.min.js"></script>
    <title>Student Profile</title>
</head>

<body>

    <div class="header">
        <form method="POST" action="logout.php">
            <button name="logout" class="logout">Logout</button>
        </form>
    </div>

    <form method="GET" action="profile.php">
        <h2 class="student_panel">Student Profile</h2>
        <div class="student_container">
            <table class="student_profile">

                <?php
                $id = $_SESSION['id'];
                $queryprofile = "SELECT DISTINCT * FROM student_data WHERE s_name = '$s_name'";
                $runprofile = mysqli_query($con, $queryprofile);
                while ($row = mysqli_fetch_array($runprofile)) {
                ?>

                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Student Name</th>
                            <th>Student Email</th>
                            <th>Course</th>
                            <th>Roll Number</th>
                            <th>Attendance</th>
                            <th>CNS</th>
                            <th>ISADIE</th>
                            <th>KM</th>
                            <th>ECOM</th>
                            <th>Total Marks</th>
                        </tr>
                    </thead>

                    <tr>
                        <td><?php echo $row['id']; ?></td>
                        <td><?php echo $row['s_name']; ?></td>
                        <td><?php echo $row['s_email']; ?></td>
                        <td><?php echo $row['course']; ?></td>
                        <td><?php echo $row['roll_no']; ?></td>
                        <td><?php echo $row['attendance']; ?></td>
                        <td><?php echo $row['CNS']; ?></td>
                        <td><?php echo $row['ISADIE']; ?></td>
                        <td><?php echo $row['KM']; ?></td>
                        <td><?php echo $row['ECOM']; ?></td>
                        <td><?php $marks = $row['CNS'] + $row['KM'] + $row['ECOM'] + $row['ISADIE'];
                            echo $marks . '/400'; ?></td>
                    </tr>
                <?php } ?>
            </table>
        </div>
    </form>

    <div class="graphs">



        <!-- PUT YOUR ATTENDANCE PIE CHART IN THIS DIV -->
        <div class="card-body">

        </div>

        <!-- PUT YOUR ATTENDANCE PIE CHART IN THIS DIV -->

        <div class="card-body">
            <h3>Subject Chart</h3>

            <div class="card" id="chart-container">
                <canvas id="graphCanvas"></canvas>
            </div>


            <script type="text/javascript">
                $(document).ready(function() {
                    $.ajax({
                        url: "chart.php",
                        method: "POST",
                        success: function(data) {
                            console.log(data);
                            var name = ['Information System', 'Knowledge Management', 'E-Commerce', 'Computer Network Security'];
                            var zero = 0;
                            //var m = [];
                            //var marks_1 = [];
                            //var marks_2 = [];
                            var c = [];
                            var j = [];
                            var k = [];
                            var e = [];

                            for (var i in data) {
                                //name.push(data[i].student_name);

                                //m.push(data[i].marks);

                                //marks_1.push(data[i].marks_1);

                                //marks_2.push(data[i].marks_2);

                                c.push(data[i].CNS);

                                j.push(data[i].ISADIE);

                                k.push(data[i].KM);

                                e.push(data[i].ECOM);
                            }
                            var chartdata = {
                                labels: name,
                                datasets: [{
                                    label: 'Marks',
                                    backgroundColor: ['#f56954', '#00a65a', '#f39c12', '#00c0ef', '#3c8dbc', '#d2d6de'],
                                    hoverBackgroundColor: 'rgba(230, 236, 235, 0.75)',
                                    hoverBorderColor: 'rgba(230, 236, 235, 0.75)',
                                    data: [j, k, e, c]

                                }]
                            };
                            var graphTarget = $("#graphCanvas");
                            var barGraph = new Chart(graphTarget, {
                                type: 'pie',
                                data: chartdata,
                                options: {
                                    legend: {
                                        position: 'left',
                                        display: true,
                                    }
                                }
                            });
                        },
                        error: function(data) {
                            console.log(data);
                        }

                    });
                });
            </script>
        </div>

    </div>

</body>

</html>