
<?php

$msg='';
$css_class='';

$conn = mysqli_connect('localhost','root','','destina');

if(isset($_POST['save_promo'])){

  $promo_title = $_POST['promo_title'];
  $promo_desc = $_POST['promo_desc'];
  $promo_price = $_POST['promo_price'];
  $promo_cost = $_POST['promo_cost'];
  $promoImageName = time() . '_' . $_FILES['promo_image']['name'];

  $target = 'images/' . $promoImageName;

  if(move_uploaded_file($_FILES['promo_image']['tmp_name'],$target)){

    $sql = "INSERT INTO promotion (promo_image,promo_title,promo_desc,promo_price,promo_cost) VALUES
    ('$promoImageName','$promo_title','$promo_desc','$promo_price','$promo_cost')";

    if (mysqli_query($conn,$sql)) {
      $msg = "Uploaded Successfully";
      $css_class = "alert-success";
    }else{
    $msg = "Failed to upload";
    $css_class = "alert-danger";
  }
}

}
 ?>
