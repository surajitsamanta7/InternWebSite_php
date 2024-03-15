<?php

@include 'config.php';

session_start();

if(!isset($_SESSION['user_name'])){
   header('location:login_form.php');
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Trainer page</title>

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/styleadminuser.css">

</head>
<body>
   
<div class="container">

   <div class="content">
      <h3>hi, <span>Trainer</span></h3>
      <h1>welcome <span><?php echo $_SESSION['user_name'] ?></span></h1>
      <p>this is an Trainer, page</p>
      <a href="registar.php" class="btn">login</a>
      <a href="registar.php" class="btn">register</a>
      <a href="index.html" class="btn">logout</a>
   </div>

</div>

</body>
</html>