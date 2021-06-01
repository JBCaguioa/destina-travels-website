
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Destina Travel and Tours</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
  <link rel="stylesheet" type="text/css" href="main.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
  <link href="https://fonts.googleapis.com/css?family=Roboto:300,400&display=swap" rel="stylesheet">
</head>
<body>

  <?php require_once 'process.php'; ?>

  <?php

  include 'processPromo.php';

  $sql = "SELECT * FROM promotion";

  $result = mysqli_query($conn,$sql);
  $promos = mysqli_fetch_all($result,MYSQLI_ASSOC);

  ?>

<nav class="navbar navbar-expand-sm bg-light justify-content-center">
  <ul class="navbar-nav">
    <li class="nav-item">
      <a class="nav-link" href="#">Requests</a>
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
      <a class="nav-link" href="sales.php">Sales Report</a>
    </li>
  </ul>
</nav>


<div class="container-fluid div-customer">
  <?php
  $mysqli = new mysqli('localhost','root','','destina') or die(mysqli_error($mysqli));
  $result = $mysqli->query("SELECT * FROM customer") or die($mysqli->error());
  ?>

  <div class="row justify-content-center">
    <table class="table table-striped table-bordered">
      <thead class="thead-dark">
        <tr>
          <th>Name</th>
          <th>Email Address</th>
          <th>Phone Number</th>
          <th>Address</th>
          <th>Package</th>
          <th>Date of Departure</th>
          <th>People</th>
          <th>Visa</th>
          <th>Total Price</th>
          <th>Status</th>
          <th colspan="2">Action</th>
        </tr>
      </thead>
      <?php while ($row = $result->fetch_assoc()): ?>
      <tr>
        <td><?php echo $row['name']; ?></td>
        <td><?php echo $row['email']; ?></td>
        <td><?php echo $row['pnumber']; ?></td>
        <td><?php echo $row['address']; ?></td>
        <td><?php echo $row['package']; ?></td>
        <td><?php echo $row['departure']; ?></td>
        <td><?php echo $row['npeople']; ?></td>
        <td><?php echo $row['visa']; ?></td>
        <td><?php echo $row['price']; ?></td>
        <td><?php echo $row['status']; ?></td>
        <td><a href="customer.php?edit=<?php echo $row['id']; ?>" class="btn btn-info btn-sm">EDIT</a></td>
        <td><a href="process.php?delete=<?php echo $row['id']; ?>" class="btn btn-danger btn-sm">DEL</a></td>
      </tr>
    <?php endwhile; ?>
  </table>

  <form action="process.php" method="POST">
    <input type="hidden" name="id" value="<?php echo $id; ?>">
    <div class="form-group">
      <div class="form-row">
        <div class="col">
          <label for="name">Set Name:</label>
          <input type="text" class="form-control" value="<?php echo $name ?>" id="name" placeholder="name" name="name" required>
          <div class="valid-feedback">Valid.</div>
          <div class="invalid-feedback">Please fill out this field.</div>
        </div>
        <div class="col">
          <label for="email">Set Email address:</label>
          <input type="email" class="form-control" value="<?php echo $email ?>" id="email" placeholder="email" name="email" required>
          <div class="valid-feedback">Valid.</div>
          <div class="invalid-feedback">Please fill out this field.</div>
        </div>
        <div class="col">
          <label for="pnumber">Set Phone Number:</label>
          <input type="text" class="form-control" maxlength="11" value="<?php echo $pnumber ?>"   id="pnumber" placeholder="phone number" name="pnumber" required>
          <div class="valid-feedback">Valid.</div>
          <div class="invalid-feedback">Please fill out this field.</div>
        </div>
      </div>
      <div class="form-row">
        <div class="col">
          <label for="address">Set Address:</label>
          <input type="text" class="form-control" value="<?php echo $address ?>" id="address" placeholder="address" name="address" required>
          <div class="valid-feedback">Valid.</div>
          <div class="invalid-feedback">Please fill out this field.</div>
        </div>
      </div>
      <div class="form-row">
        <div class="col">
          <label for="package">Select package:</label>
          <select class="form-control" name="package" id="package">
            <?php foreach($promos as $promo): ?>
            <option><?php echo $promo['promo_title']; ?> (<?php echo $promo['promo_price']; ?> PHP/HEAD)</option>
            <?php endforeach; ?>
          </select>
        </div>
        <div class="col">
          <label for="departure">Date of departure:</label>
          <input type="date" class="form-control" value="<?php echo $departure ?>"id="departure" name="departure" required>
          <div class="valid-feedback">Valid.</div>
          <div class="invalid-feedback">Please fill out this field.</div>
        </div>
        <div class="col">
          <label for="npeople">Number of people:</label>
          <input type="number" class="form-control" value="<?php echo $npeople ?>"id="npeople" placeholder="number of people" name="npeople" required>
          <div class="valid-feedback">Valid.</div>
          <div class="invalid-feedback">Please fill out this field.</div>
        </div>
        <div class="col">
          <label for="visa">Set Visa Status:</label>
          <input type="text" class="form-control" value="<?php echo $visa ?>" id="visa" placeholder="Visa" name="visa" required>
          <div class="valid-feedback">Valid.</div>
          <div class="invalid-feedback">Please fill out this field.</div>
        </div>
        <div class="col">
          <label for="price">Set price:</label>
          <input type="number" class="form-control" value="<?php echo $price ?>" id="price" placeholder="Price" name="price" required>
          <div class="valid-feedback">Valid.</div>
          <div class="invalid-feedback">Please fill out this field.</div>
        </div>

        <div class="col">
          <label for="status">Set Status:</label>
          <input type="text" class="form-control" value="<?php echo $status ?>"id="status" placeholder="Status" name="status" required>
          <div class="valid-feedback">Valid.</div>
          <div class="invalid-feedback">Please fill out this field.</div>
        </div>
      </div>
        <div class=" form-group">
          <br><center><button type="submit" class="btn btn-info btn-block" name="update"> Update </button></center>
        </div>
      </form>
      <?php
      if(isset($_SESSION['message'])): ?>
      <div class="alert alert-<?=$_SESSION['msg_type']?>">
        <?php
        echo $_SESSION['message'];
        unset($_SESSION['message']);
        ?>

      </div>
    <?php endif ?>
    </div>
  </div>

<script src="date.js" charset="utf-8"></script>
  <script>
  // Disable form submissions if there are invalid fields
  (function() {
    'use strict';
    window.addEventListener('load', function() {
      // Get the forms we want to add validation styles to
      var forms = document.getElementsByClassName('needs-validation');
      // Loop over them and prevent submission
      var validation = Array.prototype.filter.call(forms, function(form) {
        form.addEventListener('submit', function(event) {
          if (form.checkValidity() === false) {
            event.preventDefault();
            event.stopPropagation();
          }
          form.classList.add('was-validated');
        }, false);
      });
    }, false);
  })();
</script>


</body>
</html>
