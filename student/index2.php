<!DOCTYPE html>
<html>

<head>
  <title>Creating dynamic data chart using PHP and Chart.js</title>
  <style type="text/css">
    BODY {
      width: 550PX;
    }

    #chart-container {
      width: 100%;
      height: auto;
    }

    .card {
      position: relative;
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
</head>


<body>
  <div class="card-body">
    <p>How to create pie chart with Mysql dynamic data </p>
    <div class="card" id="chart-container">
      <canvas id="graphCanvas"></canvas>
    </div>
  </div>


  <script type="text/javascript">
    $(document).ready(function() {
      $.ajax({
        url: "chart.php",
        method: "POST",
        success: function(data) {
          console.log(data);
          var name = ['Computer Network Security', 'ISADIE', 'Knowledge Management', 'E-Commerce'];
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
              data: [c,j,k,e]

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

</body>

</html>