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
  <link href="https://fonts.googleapis.com/css?family=Roboto:300,400&display=swap" rel="stylesheet">
</head>
<body>
  <?php require_once 'viewpromoProcess.php'; ?>

<nav class="navbar navbar-expand-sm bg-light justify-content-center">
  <ul class="navbar-nav">
    <li class="nav-item">
      <a class="nav-link" href="customer.php">Requests</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="addpromo.php">Create</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="#">View</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="email.php">Message</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="sales.php">Sales Report</a>
    </li>
  </ul>
</nav>

<div class="container-fluid div-view">

  <?php
  $mysqli = new mysqli('localhost','root','','destina') or die(mysqli_error($mysqli));
  $result = $mysqli->query("SELECT * FROM promotion") or die($mysqli->error());
  ?>

  <div class="row justify-content-center">
    <table class="table table-striped table-bordered">
      <thead class="thead-dark">
        <tr>
          <th>Product Image</th>
          <th>Product Title</th>
          <th>Product Description</th>
          <th>Product Price</th>
          <th>Product Cost</th>
          <th colspan="2">Action</th>
        </tr>
      </thead>

      <?php while ($row = $result->fetch_assoc()): ?>

      <tr>
        <td><img width ="200px" height="100px" src="images/<?php echo $row['promo_image']; ?>" alt="Card image"></td>
        <td><?php echo $row['promo_title']; ?></td>
        <td><?php echo $row['promo_desc']; ?></td>
        <td><?php echo $row['promo_price']; ?></td>
        <td><?php echo $row['promo_cost']; ?></td>
        <td><a href="viewpromo.php?editPromo=<?php echo $row['id']; ?>" class="btn btn-info btn-sm">EDIT</a></td>
        <td><a href="viewpromoProcess.php?deletePromo=<?php echo $row['id']; ?>" class="btn btn-danger btn-sm">DEL</a></td>
      </tr>

    <?php endwhile; ?>
  </table>

  <form action="viewpromoProcess.php" method="POST">
    <input type="hidden" name="id" value="<?php echo $id; ?>">
    <div class="form-group">
      <div class="form-row">
        <div class="col">
          <label for="promo_image">Set Product Image:</label>
          <input type="text" class="form-control" value="<?php echo $promo_image ?>" id="promo_image" placeholder="Product Image" name="promo_image" required>
          <div class="valid-feedback">Valid.</div>
          <div class="invalid-feedback">Please fill out this field.</div>
        </div>
        <div class="col">
          <label for="promo_price">Set Product Price:</label>
          <input type="number" class="form-control" value="<?php echo $promo_price ?>" id="promo_title" placeholder="Product Price" name="promo_price" required>
          <div class="valid-feedback">Valid.</div>
          <div class="invalid-feedback">Please fill out this field.</div>
        </div>
      </div>
      <div class="form-row">
        <div class="col">
          <label for="promo_title">Set Product Title:</label>
          <input type="text" class="form-control" value="<?php echo $promo_title ?>" id="promo_price" placeholder="Product Title" name="promo_title" required>
          <div class="valid-feedback">Valid.</div>
          <div class="invalid-feedback">Please fill out this field.</div>
        </div>
        <div class="col">
          <label for="promo_cost">Set Product Cost:</label>
          <input type="number" class="form-control" value="<?php echo $promo_cost ?>" id="promo_cost" placeholder="Product Cost" name="promo_cost" required>
          <div class="valid-feedback">Valid.</div>
          <div class="invalid-feedback">Please fill out this field.</div>
        </div>
      </div>
      <div class="form-row">
        <div class="col">
          <label for="status">Set Product Description:</label>
          <textarea class="form-control" name="promo_desc" rows="4" cols="120" required><?php echo $promo_desc ?></textarea>
          <div class="valid-feedback">Valid.</div>
          <div class="invalid-feedback">Please fill out this field.</div>
        </div>
      </div>
        <div class=" form-group">
          <br><center><button type="submit" class="btn btn-info btn-block" name="updatePromo"> Update </button></center>
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
