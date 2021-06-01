

<!DOCTYPE html>
<html lang="en">
<head>
  <title>SMS Module</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
  <link rel="stylesheet" href="main.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
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
        <a class="nav-link" href="#">Message</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="sales.php">Sales Report</a>
      </li>
    </ul>
  </nav>

<div class="container">
  <div class="row justify-content-center form-div">
    <div class="col-md-4 col-sm-6 col-xs-12">
      <form method="POST" action="email.php">
        <div class="form-group">
          <label for="name">Your Name</label>
          <input type="text" maxlength="10" class="form-control" id="name" placeholder="Name" name="name" required>
        </div>
        <div class="form-group">
          <label for="number">Recipient's Mobile Number</label>
          <input type="number" maxlength="11" class="form-control" id="number" placeholder="Number" name="number" required>
        </div>
        <div class="form-group">
          <label for="msg">Your Message</label>
          <textarea class="form-control" rows="3" name="msg" placeholder="Message here" onkeyup="countChar(this)" required></textarea>
        </div>
        <p class="text-right" id="charNum">85</p>
        <div class="form-group">
        <button type="submit" class="btn btn-success btn-block">Send</button>
        </div>

<div class="form-group" class="form-control">
  <?php
  function itexmo($number,$message,$apicode){
    $url='https://itexmo.com/php_api/api.php';
    $itexmo=array('1' => $number, '2' => $message, '3' => $apicode);
    $param=array(
      'http' => array(
        'header' => "Content-type: application/x-www-form-urlencoded\r\n",
        'method' => 'POST',
        'content' => http_build_query($itexmo),
      ),
    );
  $context = stream_context_create($param);
  return file_get_contents($url, false, $context);
  }

  if($_POST){
    $number = $_POST['number'];
    $name = $_POST['name'];
    $msg = $_POST['msg'];
    $api = "TR-DESTI400069_C3AAA";
    $text = $name.": ".$msg;

    if(!empty($_POST['name'])&&($_POST['number'])&&($_POST['msg'])){
      $result = itexmo($number,$text,$api);
       if($result==""){
         echo "iTexMo: No Response from Server
         Please check the METHOD used (CURL or CURL-LESS). If you are using CURL then try CURL-LESS and vice versa.
         Please contact us for help.";
       }else if ($result==0){
        ?>
        <div class="alert alert-success">
          <?php echo "Message Sent!";
         }
         else{?>
        </div>
        <div class="alert alert-danger">
          <?php echo "Error Num". $result . "was encountered";
         }
      }
    } ?>
        </div>
</div>

      </form>

  </div>
 </div>
</div>

<script>
 function countChar(val){
   var len = val.value.length;
   if(len>=85){
     val.value = val.value.substring(0,85);
   }
   else {
     $('#charNum').text(85-len);
   };
 }
 </script>

</body>
</html>
