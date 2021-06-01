<!DOCTYPE html>
<html lang="en" dir="ltr">
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
<body class = "promo">

  <?php

  include 'processPromo.php';

  $sql = "SELECT * FROM promotion";

  $result = mysqli_query($conn,$sql);
  $promos = mysqli_fetch_all($result,MYSQLI_ASSOC);

  ?>

  <div class="container div-promo">
    <section class="promos">
      <h1 class="text-center">Current Promotions</h1>

      <div class="row">
        <?php foreach($promos as $promo): ?>
          <div class="col-lg-6">
            <div class="card">
              <img class="card-img-top" src="images/<?php echo $promo['promo_image']; ?>" alt="Card image">
              <div class="card-body">
                <h4 class="card-title"><?php echo $promo['promo_title']; ?></h4>
                <p class="card-text"><p><?php echo $promo['promo_desc']; ?></p>
                <a href="#" class="card-link"><?php echo $promo['promo_price']; ?> PHP</a>
              </div>
            </div>
          </div>
        <?php endforeach; ?>
      </div>
    </section>

  </div>
</body>
</html>
