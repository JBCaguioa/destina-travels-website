

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
  <?php

  include 'processPromo.php';

  $sql = "SELECT * FROM promotion";

  $result = mysqli_query($conn,$sql);
  $promos = mysqli_fetch_all($result,MYSQLI_ASSOC);

  ?>
 <?php require_once 'process.php'; ?>

  <div class="container div-request">
    <h1>Trip Request</h1>
    <form action="process.php" method="post" class="needs-validation" novalidate>
      <div class="form-group">
        <?php
        if(isset($_SESSION['message'])): ?>
        <div class="alert alert-<?=$_SESSION['msg_type']?>">
          <?php
          echo $_SESSION['message'];
          unset($_SESSION['message']);
          ?>
        </div>
      <?php endif ?>
      <div class="form-group">
        <div class="form-row">
          <div class="col">
            <label for="fname">First Name:</label>
            <input type="text" class="form-control" id="fname" placeholder="Enter first name" name="fname" required>
            <div class="valid-feedback">Valid.</div>
            <div class="invalid-feedback">Please fill out this field.</div>
          </div>
          <div class="col">
            <label for="mname">Middle Name:</label>
            <input type="text" class="form-control" id="mname" placeholder="Enter middle name" name="mname" required>
            <div class="valid-feedback">Valid.</div>
            <div class="invalid-feedback">Please fill out this field.</div>
          </div>
          <div class="col">
            <label for="lname">Last Name:</label>
            <input type="text" class="form-control" id="lname" placeholder="Enter last name" name="lname" required>
            <div class="valid-feedback">Valid.</div>
            <div class="invalid-feedback">Please fill out this field.</div>
          </div>
        </div>
        <div class="form-row">
          <div class="col">
            <label for="Email">Email address:</label>
            <input type="email" class="form-control" id="Mname" placeholder="Enter email address" name="email" required>
            <div class="valid-feedback">Valid.</div>
            <div class="invalid-feedback">Please fill out this field.</div>
          </div>
          <div class="col">
            <label for="pnumber">Phone Number:</label>
            <input type="text"  maxlength="11" class="form-control" id="pnumber" placeholder="Enter Phone number" name="pnumber" required>
            <div class="valid-feedback">Valid.</div>
            <div class="invalid-feedback">Please fill out this field.</div>
          </div>
        </div>
      </div>

      <div class="form-group">
        <label for="faddress">Address:</label>
        <input type="text" class="form-control" id="faddress" placeholder="Enter your address" name="faddress" required>
        <div class="valid-feedback">Valid.</div>
        <div class="invalid-feedback">Please fill out this field.</div>
        <div class="form-row">
          <div class="col">
            <label for="city">City:</label>
            <input type="text" class="form-control" id="city" placeholder="Enter your city" name="city" required>
            <div class="valid-feedback">Valid.</div>
            <div class="invalid-feedback">Please fill out this field.</div>
          </div>
          <div class="col">
            <label for="state">State:</label>
            <input type="text" class="form-control" id="state" placeholder="Enter your state" name="state" required>
            <div class="valid-feedback">Valid.</div>
            <div class="invalid-feedback">Please fill out this field.</div>
          </div>
          <div class="col">
            <label for="zip">ZIP code:</label>
            <input type="number" class="form-control" id="zip" placeholder="Enter your zip code" name="zip" required>
            <div class="valid-feedback">Valid.</div>
            <div class="invalid-feedback">Please fill out this field.</div>
          </div>
        </div>
      </div>

      <div class="form-group">
        <div class="form-row">
          <div class="col">
            <label for="package">Select package:</label>
            <select class="form-control" name="package" id="package">
              <?php foreach($promos as $promo): ?>
              <option><?php echo $promo['promo_title']; ?>(<?php echo $promo['promo_price']; ?> PHP/HEAD)</option>
            <?php endforeach; ?>
            </select>
            <?php foreach($promos as $promo): ?>
            <input type="hidden" name="price" value="<?php echo $promo['promo_price']; ?>">
            <input type="hidden" name="cost" value="<?php echo $promo['promo_cost']; ?>">
<?php endforeach; ?>
          </div>
          <div class="col">
            <label for="departure">Date of departure:</label>
            <input type="date" class="form-control" min='2020-01-01' id="departure" name="departure" required>
            <div class="valid-feedback">Valid.</div>
            <div class="invalid-feedback">Please fill out this field.</div>
          </div>
        </div>

        <div class="form-group">
          <label for="npeople">Number of people:</label>
          <input type="number" min="1" class="form-control" id="npeople" placeholder="Enter number of people" name="npeople" required>
          <div class="valid-feedback">Valid.</div>
          <div class="invalid-feedback">Please fill out this field.</div>

          <div class="form-group">
            <label for="visa">Do you have Visa(s)?</label>
            <div class="form-check">
              <input class="form-check-input" type="radio" name="visa" id="visa" value="yes" required>
              <label class="form-check-label" for="yes">
                Yes
              </label>
            </div>
            <div class="form-check">
              <input class="form-check-input" type="radio" name="visa" id="visa" value="no" required>
              <label class="form-check-label" for="no">
                No
              </label>
              <div class="invalid-feedback">
                You need to select either Yes or No.
              </div>
            </div>
          </div>

        </div>

        <div class="form-group form-check">
          <label class="form-check-label">
            <input class="form-check-input" type="checkbox" name="remember" required> I Agree With The Terms And Condition.
            <div class="valid-feedback">Valid.</div>
            <div class="invalid-feedback">Check this checkbox to continue.</div>
          </label>
        </div>
        <button type="submit" class="btn btn-primary" name="save">Submit</button>

        </div>
      </form>
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
