<?php include 'processPromo.php'?>
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
  <nav class="navbar navbar-expand-sm bg-light justify-content-center">
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" href="customer.php">Requests</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#">Create</a>
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

  <div class="container">



    <div class="row justify-content-center form-div">
      <div class="col-4">
        <form action="addpromo.php" method="post" enctype="multipart/form-data">
          <h3 class="text-center">Add Promotion</h3>


          <div class="form-group text-center">
            <img src="images/image-placeholder.png" onclick="triggerClick()" id="promoDisplay" alt="">
            <label for="promo_image">Promotion Image</label>
            <input type="file" name="promo_image" onchange="displayImage(this)" id="promo_image" style="display:none" value="" required>
            <div class="valid-feedback">Valid.</div>
            <div class="invalid-feedback">Please fill out this field.</div>
          </div>
        </div>

        <div class="col-6">
          <div class="form-group">
            <label for="promo_title">Promotion Title:</label>
            <input type="text" name="promo_title" id="promo_title" placeholder="Title" class="form-control" value="" required>
            <div class="valid-feedback">Valid.</div>
            <div class="invalid-feedback">Please fill out this field.</div>

            <label for="promo_desc">Promotion Description:</label>
            <textarea name="promo_desc" id="promo_desc" placeholder="description" class="form-control" value="" required></textarea>
            <div class="valid-feedback">Valid.</div>
            <div class="invalid-feedback">Please fill out this field.</div>

            <label for="promo_price">Promotion Price:</label>
            <input type="number" name="promo_price" id="promo_price" placeholder="price" class="form-control" value=""required>
            <div class="valid-feedback">Valid.</div>
            <div class="invalid-feedback">Please fill out this field.</div>

            <label for="promo_price">Promotion Cost:</label>
            <input type="number" name="promo_cost" id="promo_cost" placeholder="cost" class="form-control" value="" required>
            <div class="valid-feedback">Valid.</div>
            <div class="invalid-feedback">Please fill out this field.</div>

          </div>
          <div class="form-group">
            <button type="submit" class="btn btn-primary btn-block" name="save_promo">Submit</button>
          </div>
          <div class="form-group">
            <?php if(!empty($msg)): ?>
              <div class="alert <?php echo $css_class; ?>">
                <?php echo $msg; ?>
              </div>
            <?php endif; ?>
          </div>
        </div>
      </form>


    </div>

    <script type="text/javascript">
    function triggerClick(e) {
      document.querySelector('#promo_image').click();
    }
    function displayImage(e) {
      if (e.files[0]) {
        var reader = new FileReader();
        reader.onload = function(e){
          document.querySelector('#promoDisplay').setAttribute('src', e.target.result);
        }
        reader.readAsDataURL(e.files[0]);
      }
    }
    </script>

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
