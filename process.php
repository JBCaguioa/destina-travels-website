<?php

session_start();

$mysqli = new mysqli('localhost','root','','destina') or die(mysqli_error($mysqli));

$update = false;
$id = 0;
$name='';
$email='';
$pnumber='';
$address='';
$price = '';
$visa ='';
$status ='';


if(isset($_POST['save'])){
  $fname = $_POST['fname'];
  $mname = $_POST['mname'];
  $lname = $_POST['lname'];
  $faddress = $_POST['faddress'];
  $city = $_POST['city'];
  $state = $_POST['state'];
  $iprice = $_POST['price'];
  $icost = $_POST['cost'];


  $name = $lname . ", " . $fname . " " . $mname;
  $email = $_POST['email'];
  $pnumber = $_POST['pnumber'];
  $address = $faddress . ", ". $city . ", ". $state;
  $package =$_POST['package'];
  $departure = $_POST['departure'];
  $npeople = $_POST['npeople'];
  $visa = $_POST['visa'];
  $price = $iprice * $npeople;
  $cost = $icost * $npeople;
  $status= "unpaid";


  $mysqli->query("INSERT INTO customer (name,email,pnumber,address,package,departure,npeople,visa,price,cost,status)
  VALUES ('$name','$email','$pnumber','$address','$package','$departure','$npeople','$visa','$price','$cost','$status')") or
  die($mysqli->error);


  $_SESSION['message'] = "Record has been saved!";
  $_SESSION['msg_type'] = "success";

  header("location: request.php");
}

if(isset($_GET['delete'])){
  $id = $_GET['delete'];

  $mysqli->query("DELETE FROM customer WHERE id = $id") or
  die($mysqli->error());

  $_SESSION['message'] = "Record has been deleted!";
  $_SESSION['msg_type'] = "danger";

  header("location: customer.php");
}

if (isset($_GET['edit'])) {
  $id = $_GET['edit'];
  $update= true;

  $result = $mysqli->query("SELECT * FROM customer WHERE id=$id") or
  die($mysqli->error());

  if($result->num_rows){
    $row = $result->fetch_array();
    $name=$row['name'];
    $email=$row['email'];
    $pnumber=$row['pnumber'];
    $address=$row['address'];
    $package = $row['package'];
    $departure =$row['departure'];
    $npeople = $row['npeople'];
    $visa = $row['visa'];
    $price = $row['price'];
    $status = $row['status'];
  }
}

if (isset($_POST['update'])) {
  $id =$_POST['id'];
  $name=$_POST['name'];
  $email=$_POST['email'];
  $pnumber=$_POST['pnumber'];
  $address=$_POST['address'];
  $package =$_POST['package'];
  $departure = $_POST['departure'];
  $npeople = $_POST['npeople'];
  $visa = $_POST['visa'];
  $price = $_POST['price'];
  $status =  $_POST['status'];

  $mysqli->query("UPDATE customer SET name='$name', email='$email',pnumber='$pnumber',
    address='$address', package='$package', departure='$departure', npeople='$npeople',
    visa ='$visa',price='$price',status='$status' WHERE id=$id") or
    die($mysqli->error());

    $_SESSION['message'] = "Record has been updated!";
    $_SESSION['msg_type'] = "warning alert-dismissible";

    header("location: customer.php");
  }
  ?>
