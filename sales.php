<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
  <title>Destina Travel and Tours</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
  <link rel="stylesheet" type="text/css" href="main.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/chart.js@2.8.0"></script>
  <link href="https://fonts.googleapis.com/css?family=Roboto:300,400&display=swap" rel="stylesheet">
</head>
<body>
  <nav class="navbar navbar-expand-sm bg-light justify-content-center">
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" href="customer.php">Requests</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="addpromo.php">Create</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="viewpromo.php">View</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="email.php">Message</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#">Sales Report</a>
      </li>
    </ul>
  </nav>

  <div class="container div-sales">
    <h1 class="text-center">Sales Report</h1>
    <div class="row">
      <div class="col-md-6">
        <div class="Card left">
          <canvas id="cSales"></canvas>
        </div>
      </div>
      <div class="col-md-6">
        <div class="Card right">
          <canvas id="cPrice"></canvas>
        </div>
      </div>
      <div class="col-md-6">
        <div class="Card left">
          <canvas id="cCost"></canvas>
        </div>
      </div>
      <div class="col-md-6">
        <div class="Card right">
          <canvas id="cNetWorth"></canvas>
        </div>
      </div>
      <div class="col-md-6">
        <div class="Card left">
          <canvas id="cBooking"></canvas>
        </div>
      </div>
      <div class="col-md-6">
        <div class="Card right">
          <canvas id="cPeople"></canvas>
        </div>
      </div>
    </div>

  </div>

  <?php
  $totalSale = 0;
  $totalCost = 0;
  $netWorth = 0;
  $tpeople =0;
  $booking = 0;
  $people = array();
  $cPrice =array();
  $cCost =array();
  $cNetworth =array();
  $paid = "paid";

  $mysqli = new mysqli('localhost','root','','destina') or die(mysqli_error($mysqli));
  $result = $mysqli->query("SELECT * FROM customer WHERE status ='$paid'") or die($mysqli->error());

  while($row = $result->fetch_assoc()){
    $totalSale = $totalSale + $row['price'];
    $totalCost = $totalCost + $row['cost'];
    $tpeople = $tpeople + $row['npeople'];
    $booking = $booking + 1;
    array_push($people,$row['npeople']);
    array_push($cPrice,$row['price']);
    array_push($cCost,$row['cost']);
    array_push($cNetworth,$row['price']-$row['cost']);
  }

  $netWorth = $totalSale - $totalCost;


  ?>

  <script>
  var ctx = document.getElementById('cSales').getContext('2d');
  var chart = new Chart(ctx, {
    // The type of chart we want to create
    type: 'pie',

    // The data for our dataset
    data: {
      labels: ['Total Sale', 'Total Cost','Total Networth'],
      datasets: [{
        label: 'Sales',
        backgroundColor: ['#59baf2','#f2b259','#f26659'],
        borderColor: ['#59baf2','#f2b259','#f26659'],
        data: [<?php echo $totalSale; ?>, <?php echo $totalCost; ?>,<?php echo $netWorth ?>]
      }]
    },
  });

  var ctx = document.getElementById('cBooking').getContext('2d');
  var chart = new Chart(ctx, {
    // The type of chart we want to create
    type: 'pie',

    // The data for our dataset
    data: {
      labels: ['Total Number of People', 'Total Number of Booking'],
      datasets: [{
        label: 'Booking',
        backgroundColor: ['#fca87e','#7ed6fc'],
        borderColor: ['#fca87e','#7ed6fc'],
        data: [<?php echo $tpeople; ?>, <?php echo $booking; ?>]
      }]
    },
  });

  var ctx = document.getElementById('cPeople').getContext('2d');
  var chart = new Chart(ctx, {
    // The type of chart we want to create
    type: 'bar',

    // The data for our dataset
    data: {
      labels: [<?php for ($x = 1; $x <= $booking; $x++) { echo "$x,"; } ?>],
      datasets: [{
        label: 'Number of People each Order',
        backgroundColor:'#fca87e',
        borderColor: '#fca87e',

        data: [<?php $string=implode(",",$people); echo $string; ?>]
      }]
    },
    options: {
      scales: {
        yAxes: [{
          ticks: {
            suggestedMax: 10,beginAtZero: true
          }
        }]
      }
    }

  });

  var ctx = document.getElementById('cPrice').getContext('2d');
  var chart = new Chart(ctx, {
    // The type of chart we want to create
    type: 'bar',

    // The data for our dataset
    data: {
      labels: [<?php for ($x = 1; $x <= $booking; $x++) { echo "$x,"; } ?>],
      datasets: [{
        label: 'Price by each Order',
        backgroundColor:'#59baf2',
        borderColor: '#59baf2',

        data: [<?php $string=implode(",",$cPrice); echo $string; ?>]
      }]
    },
    options: {
      scales: {
        yAxes: [{
          ticks: {
            suggestedMax: 10,beginAtZero: true
          }
        }]
      }
    }

  });

  var ctx = document.getElementById('cCost').getContext('2d');
  var chart = new Chart(ctx, {
    // The type of chart we want to create
    type: 'bar',

    // The data for our dataset
    data: {
      labels: [<?php for ($x = 1; $x <= $booking; $x++) { echo "$x,"; } ?>],
      datasets: [{
        label: 'Cost by each Order',
        backgroundColor:'#f2b259',
        borderColor: '#f2b259',

        data: [<?php $string=implode(",",$cCost); echo $string; ?>]
      }]
    },
    options: {
      scales: {
        yAxes: [{
          ticks: {
            suggestedMax: 10,beginAtZero: true
          }
        }]
      }
    }

  });

  var ctx = document.getElementById('cNetWorth').getContext('2d');
  var chart = new Chart(ctx, {
    // The type of chart we want to create
    type: 'bar',

    // The data for our dataset
    data: {
      labels: [<?php for ($x = 1; $x <= $booking; $x++) { echo "$x,"; } ?>],
      datasets: [{
        label: 'Networth by each Order',
        backgroundColor:'#f26659',
        borderColor: '#f26659',

        data: [<?php $string=implode(",",$cNetworth); echo $string; ?>]
      }]
    },
    options: {
      scales: {
        yAxes: [{
          ticks: {
            suggestedMax: 10,beginAtZero: true
          }
        }]
      }
    }

  });
  </script>

</body>
</html>
