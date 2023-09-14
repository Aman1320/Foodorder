<?php
require_once "includes/connect.php";
if (isset($_POST['signup'])) {
$name = mysqli_real_escape_string($conn, $_POST['name']);
$username = mysqli_real_escape_string($conn, $_POST['username']);
$email = mysqli_real_escape_string($conn, $_POST['email']);
$mobile = mysqli_real_escape_string($conn, $_POST['mobile']);
$password = mysqli_real_escape_string($conn, $_POST['password']);
$cpassword = mysqli_real_escape_string($conn, $_POST['cpassword']); 
if (!preg_match("/^[a-zA-Z ]+$/",$name)) {
$name_error = "Name must contain only alphabets and space";
}
if(!filter_var($email,FILTER_VALIDATE_EMAIL)) {
$email_error = "Please Enter Valid Email ID";
}
if(strlen($password) < 6) {
$password_error = "Password must be minimum of 6 characters";
}       
if(strlen($mobile) < 10) {
$mobile_error = "Mobile number must be minimum of 10 characters";
}
if($password != $cpassword) {
$cpassword_error = "Password and Confirm Password doesn't match";
}
if (!$error) {
if(mysqli_query($conn, "INSERT INTO users(name,username,password,email,contact) VALUES('$name','$username','$password','$email','$mobile')")) {
header("location: new.php");
exit();
} else {
echo "Error: " . $sql . "" . mysqli_error($conn);
}
}
mysqli_close($conn);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0, user-scalable=no">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="msapplication-tap-highlight" content="no">
  <title>Register</title>
<link rel="icon" href="images/favicon/favicon_32x32.png" sizes="32x32">
  <!-- Favicons-->
  <link rel="apple-touch-icon-precomposed" href="images/favicon/apple-touch-icon-152x152.png">
  <!-- For iPhone -->
  <meta name="msapplication-TileColor" content="#00bcd4">
  <meta name="msapplication-TileImage" content="images/favicon/mstile-144x144.png">
  <!-- For Windows Phone -->


  <!-- CORE CSS-->
  
  <link href="css/materialize.min.css" type="text/css" rel="stylesheet" media="screen,projection">
  <link href="css/style.min.css" type="text/css" rel="stylesheet" media="screen,projection">
    <!-- Custome CSS-->    
    <link href="css/custom/custom.min.css" type="text/css" rel="stylesheet" media="screen,projection">
  <link href="css/layouts/page-center.css" type="text/css" rel="stylesheet" media="screen,projection">

  <link href="js/plugins/perfect-scrollbar/perfect-scrollbar.css" type="text/css" rel="stylesheet" media="screen,projection">
    <style type="text/css">
  .input-field div.error{
    position: relative;
    top: -1rem;
    left: 0rem;
    font-size: 0.8rem;
    color:#FF4081;
    -webkit-transform: translateY(0%);
    -ms-transform: translateY(0%);
    -o-transform: translateY(0%);
    transform: translateY(0%);
  }
  .input-field label.active{
      width:100%;
  }
  .left-alert input[type=text] + label:after, 
  .left-alert input[type=password] + label:after, 
  .left-alert input[type=email] + label:after, 
  .left-alert input[type=url] + label:after, 
  .left-alert input[type=time] + label:after,
  .left-alert input[type=date] + label:after, 
  .left-alert input[type=datetime-local] + label:after, 
  .left-alert input[type=tel] + label:after, 
  .left-alert input[type=number] + label:after, 
  .left-alert input[type=search] + label:after, 
  .left-alert textarea.materialize-textarea + label:after{
      left:0px;
  }
  .right-alert input[type=text] + label:after, 
  .right-alert input[type=password] + label:after, 
  .right-alert input[type=email] + label:after, 
  .right-alert input[type=url] + label:after, 
  .right-alert input[type=time] + label:after,
  .right-alert input[type=date] + label:after, 
  .right-alert input[type=datetime-local] + label:after, 
  .right-alert input[type=tel] + label:after, 
  .right-alert input[type=number] + label:after, 
  .right-alert input[type=search] + label:after, 
  .right-alert textarea.materialize-textarea + label:after{
      right:70px;
  }
  </style> 
</head>
<body class=" light-blue">
    <div id="loader-wrapper">
      <div id="loader"></div>        
      <div class="loader-section section-left"></div>
      <div class="loader-section section-right"></div>
  </div>

   <div id="login-page" class="row">
    <div class="col s12 z-depth-4 card-panel">
<form class="formValidate" id="formValidate" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" novalidate="novalidate" class="col s12">

<div class="row">
          <div class="input-field col s12 center">
            <h4>Register</h4>
            <p class="center">Join us now!</p>
          </div>
        </div>

<div class="row margin">
    <div class="input-field col s12">
        <i class="mdi-social-person-outline prefix"></i>
        <label>Name</label>
        <input type="text" name="name" class="form-control" value="" maxlength="50" required="">
        <span class="text-danger"><?php if (isset($name_error)) echo $name_error; ?></span>
    </div>
</div>
<div class="row margin">
    <div class="input-field col s12">
        <i class="mdi-social-person prefix"></i>
            <label>Username</label>
            <input type="text" name="username" class="form-control" value="" maxlength="50" required="">
            <span class="text-danger"><?php if (isset($username_error)) echo $username_error; ?></span>
    </div>
</div>
<div class="row margin">
    <div class="input-field col s12">
        <i class="mdi-communication-phone prefix"></i>
        <label>Email</label>
        <input type="email" name="email" class="form-control" value="" maxlength="30" required="">
        <span class="text-danger"><?php if (isset($email_error)) echo $email_error; ?></span>
    </div>
</div>

<div class="row margin">
    <div class="input-field col s12">
        <i class="mdi-communication-phone prefix"></i>
        <label>Mobile</label>
        <input type="text" name="mobile" class="form-control" value="" maxlength="12" required="">
        <span class="text-danger"><?php if (isset($mobile_error)) echo $mobile_error; ?></span>
    </div>
</div>
<div class="row margin">
    <div class="input-field col s12">
        <i class="mdi-communication-phone prefix"></i>
        <label>Password</label>
        <input type="password" name="password" class="form-control" value="" maxlength="8" required="">
        <span class="text-danger"><?php if (isset($password_error)) echo $password_error; ?></span>
    </div>
</div>  
<div class="row margin">
    <div class="input-field col s12">
        <i class="mdi-communication-phone prefix"></i>
        <label>Confirm Password</label>
        <input type="password" name="cpassword" class="form-control" value="" maxlength="8" required="">
        <span class="text-danger"><?php if (isset($cpassword_error)) echo $cpassword_error; ?></span>
    </div>
</div>
<div class="row">
    <div class="input-field col s12">
        <input type="submit" class="btn btn-primary" name="signup" value="submit">
    </div>
    <div class="input-field col s12">
            <p class="margin center medium-small sign-up">Already have an account? <a href="login.php">Login</a></p>
    </div>
</div>
</form>
</div>
</div>
<script type="text/javascript" src="js/plugins/jquery-1.11.2.min.js"></script>
  <!--materialize js-->
  <script type="text/javascript" src="js/materialize.min.js"></script>
  <!--scrollbar-->
  <script type="text/javascript" src="js/plugins/perfect-scrollbar/perfect-scrollbar.min.js"></script>
     <script type="text/javascript" src="js/plugins/jquery-validation/jquery.validate.min.js"></script>
    <script type="text/javascript" src="js/plugins/jquery-validation/additional-methods.min.js"></script>
     
      <!--plugins.js - Some Specific JS codes for Plugin Settings-->
    <script type="text/javascript" src="js/plugins.min.js"></script>
    <!--custom-script.js - Add your own theme custom JS-->
    <script type="text/javascript" src="js/custom-script.js"></script>
    <script type="text/javascript">
</body>
</html>