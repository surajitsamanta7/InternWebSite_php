<!-- for registration from php Start-->
<?php

@include 'config.php';

if (isset($_POST['submit'])) {

  $name = mysqli_real_escape_string($conn, $_POST['name']);
  $phno = mysqli_real_escape_string($conn, $_POST['phno']);
  $email = mysqli_real_escape_string($conn, $_POST['email']);
  $pass = md5($_POST['password']);
  $cpass = md5($_POST['cpassword']);
  $user_type = $_POST['user_type'];

  $select = " SELECT * FROM user_form WHERE email = '$email' && password = '$pass' ";

  $result = mysqli_query($conn, $select);

  if (mysqli_num_rows($result) > 0) {

    $error = 'user already exist!';
  } else {

    if ($pass != $cpass) {
      $error = 'password not matched!';
    } else {
      $insert = "INSERT INTO `user_form`(`name`, `mobile_number`, `email`, `password`, `user_type`) VALUES('$name', '$phno', '$email','$pass','$user_type')";
      mysqli_query($conn, $insert);
      header('location:login_form.php');
    }
  }
};


?>

<!-- for registration from php end-->
<!-- for login from php Start-->
<?php

@include 'config.php';

session_start();

if (isset($_POST['submit'])) {

  $name = mysqli_real_escape_string($conn, $_POST['name']);
  $email = mysqli_real_escape_string($conn, $_POST['email']);
  $pass = md5($_POST['password']);
  $cpass = md5($_POST['cpassword']);
  $user_type = $_POST['user_type'];

  $select = " SELECT * FROM user_form WHERE email = '$email' && password = '$pass' ";

  $result = mysqli_query($conn, $select);

  if (mysqli_num_rows($result) > 0) {

    $row = mysqli_fetch_array($result);

    if ($row['user_type'] == 'admin') {

      $_SESSION['admin_name'] = $row['name'];
      header('location:admin_page.php');
    } elseif ($row['user_type'] == 'user') {

      $_SESSION['user_name'] = $row['name'];
      header('location:user_page.php');
    }
  } else {
    $error = 'incorrect email or password!';
  }
};
?>
<!-- for login from php end-->


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <script src="https://kit.fontawesome.com/64d58efce2.js" crossorigin="anonymous"></script>
  <link rel="stylesheet" href="register1.css" />
  <title>Sign in & Sign up Form</title>
</head>

<body>
  <div class="container">
    <div class="forms-container">
      <div class="signin-signup">


        <form action="registar.php" method="post" class="sign-in-form">
          <h2 class="title">Sign in</h2>
          <?php
          if (isset($error)) {
            echo '<span class="error-msg">' . $error . '</span>';
          };
          ?>
          <div class="input-field">
            <i class="fas fa-user"></i>
            <input type="text" name="email" placeholder="Email ID" />
          </div>
          <div class="input-field">
            <i class="fas fa-lock"></i>
            <input type="password" name="password" placeholder="Password" />
          </div>
          <input type="submit" name="submit" value="Login" class="btn solid" />
          <p class="social-text">Or Sign in with social platforms</p>
          <div class="social-media">
            <a href="#" class="social-icon">
              <i class="fab fa-facebook-f"></i>
            </a>
            <a href="#" class="social-icon">
              <i class="fab fa-twitter"></i>
            </a>
            <a href="#" class="social-icon">
              <i class="fab fa-google"></i>
            </a>
            <a href="#" class="social-icon">
              <i class="fab fa-linkedin-in"></i>
            </a>
          </div>
        </form>
        <!-- ----- Register from----- -->




        <form action="registar.php" class="sign-up-form" method="post">
          <?php
          if (isset($error)) {
              echo '<span class="error-msg">' . $error . '</span>';
          };
          ?>
          <h2 class="title">Sign up</h2>
          <!-- <div class="input-field">
              <i class="fas fa-user"></i>
              <input type="text" name="usernam" placeholder="Username" />
            </div> -->
          <!-- ---extra--- -->
          <div class="input-field">
            <i class="fas fa-user"></i>
            <input type="text" name="name" placeholder="Your name" />
          </div>
          <div class="input-field">
            <i class="fas fa-user"></i>
            <input type="number" name="phno" placeholder="Phone number" />
          </div>
          <div class="input-field">
            <i class="fas fa-envelope"></i>
            <input type="email" name="email" placeholder="Email" />
          </div>
          <div class="input-field">
            <i class="fas fa-lock"></i>
            <input type="password" name="password" placeholder="Password" />
          </div>
          <div class="input-field">
            <i class="fas fa-lock"></i>
            <input type="password" name="cpassword" placeholder="Confirm Password" />
          </div>
          <select name="user_type" class="input-field">
            <option value="user">Trainer</option>
            <option value="admin">Learner</option>
          </select>
          <input type="submit" name="submit" class="btn" value="Sign up" />
          <p class="social-text">Or Sign up with social platforms</p>
          <div class="social-media">
            <a href="#" class="social-icon">
              <i class="fab fa-facebook-f"></i>
            </a>
            <a href="#" class="social-icon">
              <i class="fab fa-twitter"></i>
            </a>
            <a href="#" class="social-icon">
              <i class="fab fa-google"></i>
            </a>
            <a href="#" class="social-icon">
              <i class="fab fa-linkedin-in"></i>
            </a>
          </div>
        </form>
      </div>
    </div>

    <div class="panels-container">
      <div class="panel left-panel">
        <div class="content">
          <h3>New here ?</h3>
          <p>
            Lorem ipsum, dolor sit amet consectetur adipisicing elit. Debitis,
            ex ratione. Aliquid!
          </p>
          <button class="btn transparent" id="sign-up-btn">
            Sign up
          </button>
        </div>
        <img src="img/log.svg" class="image" alt="" />
      </div>
      <div class="panel right-panel">
        <div class="content">
          <h3>One of us ?</h3>
          <p>
            Lorem ipsum dolor sit amet consectetur adipisicing elit. Nostrum
            laboriosam ad deleniti.
          </p>
          <button class="btn transparent" id="sign-in-btn">
            Sign in
          </button>
        </div>
        <img src="img/register.svg" class="image" alt="" />
      </div>
    </div>
  </div>

  <script src="app.js"></script>
</body>

</html>