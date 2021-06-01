<?php

session_start();

$mysqli = new mysqli('localhost','root','','destina') or die(mysqli_error($mysqli));

$update = false;
$id = 0;
$promo_image = '';
$promo_title = '';
$promo_desc = '';
$promo_price = '';
$promo_cost='';

if(isset($_POST['savePromo'])){
  $promo_image = $_POST['promo_image'];
  $promo_title = $_POST['promo_title'];
  $promo_desc = $_POST['promo_desc'];
  $promo_price = $_POST['promo_price'];
  $promo_cost= $_POST['promo_cost'];


  $mysqli->query("INSERT INTO promotion (promo_image,promo_title,promo_desc,promo_price,promo_cost)
  VALUES ('$promo_image','$promo_title','$promo_desc','$promo_price','$promo_cost')") or
  die($mysqli->error);

  $_SESSION['message'] = "Record has been saved!";
  $_SESSION['msg_type'] = "success";

  header("location: addpromo.php");
}

if(isset($_GET['deletePromo'])){
  $id = $_GET['deletePromo'];

  $mysqli->query("DELETE FROM promotion WHERE id = $id") or
  die($mysqli->error());

  $_SESSION['message'] = "Record has been deleted!";
  $_SESSION['msg_type'] = "danger";

  header("location: viewpromo.php");
}

if (isset($_GET['editPromo'])) {
  $id = $_GET['editPromo'];
  $update= true;

  $result = $mysqli->query("SELECT * FROM promotion WHERE id=$id") or
  die($mysqli->error());

  if($result->num_rows){
    $row = $result->fetch_array();
    $promo_image = $row['promo_image'];
    $promo_title = $row['promo_title'];
    $promo_desc = $row['promo_desc'];
    $promo_price = $row['promo_price'];
    $promo_cost= $row['promo_cost'];
  }
}

if (isset($_POST['updatePromo'])) {
  $id =$_POST['id'];
  $promo_image =$_POST['promo_image'];
  $promo_title =$_POST['promo_title'];
  $promo_desc = $_POST['promo_desc'];
  $promo_price = $_POST['promo_price'];
  $promo_cost= $_POST['promo_cost'];

  $mysqli->query("UPDATE promotion SET promo_image='$promo_image', promo_title='$promo_title',
    promo_desc = '$promo_desc', promo_price = '$promo_price', promo_cost ='$promo_cost' WHERE id=$id") or
    die($mysqli->error());

    $_SESSION['message'] = "Record has been updated!";
    $_SESSION['msg_type'] = "warning alert-dismissible";

    header("location: viewpromo.php");
  }

  ?>
